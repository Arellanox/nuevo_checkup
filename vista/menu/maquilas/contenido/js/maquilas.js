let listaMaquilas = [];
let maquilasPendientes = [];
let maquilasCompletadas = [];
let maquilasRechazadas = [];

const tablaMaquilaasPorAprobar = $('#TablaMaquilaasPorAprobar').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 200),
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 2 },
        method: 'POST',
        url: '../../../api/laboratorio_estudios_maquila_api.php',
        dataSrc: 'response.data',
        beforeSend: function () { },
        complete: function (data) {
            if (data.responseJSON && data.responseJSON.response) {
                listaMaquilas = data.responseJSON.response.data ?? [];

                ({ maquilasPendientes, maquilasCompletadas, maquilasRechazadas } =
                    guardarMaquilasPorEstatus(listaMaquilas));
            }
        },
        error: function () { Toast.fire({icon: 'error', title: '¡Error al recuperar las maquilas!'}); }
    },
    columns: [
        {data: "FOLIO"},
        {data: "PREFOLIO"},
        {data: "LABORATORIO"},
        {data: "SERVICIO_CLAVE"},
        {
            data: null,
            render: (data, type, row) => {
                return row.PACIENTE_NOMBRE + " " + row.PACIENTE_APELLIDO_PATERNO
                    + " " + row.PACIENTE_APELLIDO_MATERNO
            }
        },
        {data: "SOLICITANTE"},
        {
            data: "ESTATUS",
            render: function (data, type, row) {
                let text = "Desconocido: " + data;
                let className = "badge bg-secondary"; // Estilos por defecto

                if (data === null || data === 0 || data === '0') {
                    text = "Pendiente";
                    className = "badge bg-warning text-dark"; // Amarillo
                }
                if (data === 1 || data === '1') {
                    text = "Aprobado";
                    className = "badge bg-success"; // Verde
                }
                if (data === 2 || data === '2') {
                    text = "Rechazado";
                    className = "badge bg-danger"; // Rojo
                }

                return `<span class="${className}">${text}</span>`;
            }
        },
        {data: "FECHA_REGISTRO"},
        { // Botones de acciones
            data: null,
            render: function (data, type, row) {
                return `
                    <div class="d-flex gap-2 align-items-center justify-content-center">
                        <button type="button" role="button" class="btnRechazar" 
                            data-bs-toggle="tooltip" data-bs-title="Rechazar maquila"
                            onclick="rechazarMaquila(${row.ID_MAQUILA})" `+ (row.ESTATUS != 0 ? 'disabled' : '') +`
                        >
                            <i class="bi bi-file-earmark-excel-fill"></i>
                       </button>
                        <button type="button" role="button" class="btnAprobar" 
                            data-bs-toggle="tooltip" data-bs-title="Aprobar maquila"
                            onclick="aprobarMaquila(${row.ID_MAQUILA})" `+ (row.ESTATUS != 0 ? 'disabled' : '') +`
                        >
                            <i class="bi bi-file-earmark-check-fill"></i>
                        </button>
                        
                       <button type="button" role="button" class="btnEliminar" 
                            data-bs-toggle="tooltip" data-bs-title="Eliminar maquila"
                            onclick="eliminarMaquila(${row.ID_MAQUILA})" `+ (row.ESTATUS == 1 ? 'disabled' : '') +`
                        >
                            <i class="bi bi-trash-fill"></i>
                       </button>
                    </div>
                `;
            }
        }
    ],
    columnDefs: [
        { width: "50px", targets: 0 }
    ]
});

//---Guardar maquilas por estatus
function guardarMaquilasPorEstatus(response) {
    return response.reduce(
        (acc, maquila) => {
            const estatus = maquila.ESTATUS?.toString(); // Convierte a string para evitar inconsistencias

            if (estatus === null || estatus === undefined || estatus === "0") {
                acc.maquilasPendientes.push(maquila.ID_MAQUILA);
            } else if (estatus === "1") {
                acc.maquilasCompletadas.push(maquila.ID_MAQUILA);
            } else if (estatus === "2") {
                acc.maquilasRechazadas.push(maquila.ID_MAQUILA);
            }

            return acc;
        },
        { maquilasPendientes: [], maquilasCompletadas: [], maquilasRechazadas: [] }
    );
}
//---

//---Aprobación de todas las maquilas pendientes
$('#btn-aprobar-todos').on('click', function () { aprobarTodasMaquilas(maquilasPendientes); });

function aprobarTodasMaquilas(ids){
    alertMensajeConfirm({
        title: '¿Está seguro de aprobar todas las maquilas?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        if (ids && ids.length > 0) {
            Toast.fire({ icon: 'info', title: 'Espere un momento, estamos procesando su solicitud.' });

            ajaxAwait({
                api: 3,
                ID_MAQUILA: ids,
                MAQUILA_ESTATUS: 1
            }, 'laboratorio_estudios_maquila_api', { callbackAfter: true }, false, function (response) {
                if (response.response.code) {
                    Toast.fire({ icon: 'success', title: '¡Maquilas aprobadas!', timer: 2000 });
                    tablaMaquilaasPorAprobar.ajax.reload();
                }
            });
        }
    });
}
//---

//---Aprobación de una maquila
function aprobarMaquila(id) {
    alertMensajeConfirm({
        title: '¿Está seguro de aprobar esta maquila?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        ajaxAwait({
            api: 3,
            ID_MAQUILA: id,
            MAQUILA_ESTATUS: 1
        }, 'laboratorio_estudios_maquila_api', {callbackAfter: true}, false, function (response) {
            if (response.response.code) {
                Toast.fire({icon: 'success', title: '¡Maquila aprobada!', timer: 2000});
                tablaMaquilaasPorAprobar.ajax.reload();
            }
        }).then(r => {});
    });
}
//---

//---Rechazo de una maquila
function rechazarMaquila(id) {
    alertMensajeConfirm({
        title: '¿Está seguro de rechazar esta maquila?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        ajaxAwait({
            api: 3,
            ID_MAQUILA: id,
            MAQUILA_ESTATUS: 2
        }, 'laboratorio_estudios_maquila_api', {callbackAfter: true}, false, function (response) {
            if (response.response.code) {
                Toast.fire({icon: 'success', title: '¡Maquila rechazada!', timer: 2000});
                tablaMaquilaasPorAprobar.ajax.reload();
            }
        }).then(r => {});
    });
}
//---

function eliminarMaquila(id) {
    alertMensajeConfirm({
        title: '¿Está seguro de eliminar esta maquila?',
        text: 'No podrá revertir los cambios',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }, function () {
        ajaxAwait({
            api: 4,
            ID_MAQUILA: id
        }, 'laboratorio_estudios_maquila_api', {callbackAfter: true}, false, function (response) {
            if (response.response.code) {
                Toast.fire({icon: 'success', title: '¡Maquila eliminada!', timer: 2000});
                tablaMaquilaasPorAprobar.ajax.reload();
            }
        }).then(r => {});
    });
}