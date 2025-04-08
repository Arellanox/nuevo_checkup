const EnvioLotesPacientes = document.getElementById('EnvioLotesPacientes')
EnvioLotesPacientes.addEventListener('show.bs.modal', event => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();

        console.log(event)
    }, 300);
})

// |----------------- Tabla 1 --------------------|
tablaPacientesFaltantes = $('#tablaPacientesFaltantes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, {
                api: 2,
                id_cliente: session.id_cliente,
                bit_solitudes: 0,
                id_turno: turno,
            });
        },
        method: 'POST',
        url: `${current_url}/api/franquicias_api.php`,
        complete: function () {
            if (tablaPacientesFaltantes_inicio)
                $('#EnvioLotesPacientes').modal('show');
        },
        error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
            // console.log('Error')
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE' },
        { data: 'SIHO_CUENTA' },
        { data: 'FOLIO' },
        { data: 'FECHA_ALTA' },
        { data: 'USUARIO' },
    ],
    columnDefs: [
        { targets: 0, className: 'all', title: '#', width: "0px", },
        { targets: 1, className: 'all', title: 'Paciente', width: '50%' }, // PACIENTE
        { targets: 2, className: 'all', title: 'Cuenta' }, // SIHO_CUENTA
        { targets: 3, className: 'none', title: 'Folio' }, // FOLIO
        // { targets: 4, className: 'none', title: 'Procedencia' },
        { targets: 4, className: 'none', title: 'Registro' }, // FECHA_ALTA
        { targets: 5, className: 'none', title: 'Quién registro' } // USUARIO
    ],
})

inputBusquedaTable('tablaPacientesFaltantes', tablaPacientesFaltantes, [{
    msj: 'Filtrará los pacientes con su toma de muestra tomada',
    place: 'top'
}], [], 'col-12')

let pacientesLeft = [];
selectTable('#tablaPacientesFaltantes', tablaPacientesFaltantes, {
    unSelect: true, multipleSelect: true, divPadre: '#false'
}, (select, dataRow, callback) => {
    console.log(dataRow)
    pacientesLeft = dataRow
})

// |----------------- Tabla 2 --------------------|
TablaPacientesNewGrupo = $('#TablaPacientesNewGrupo').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE' },
        { data: 'SIHO_CUENTA' },
        { data: 'FOLIO' },
        { data: 'FECHA_ALTA' },
        { data: 'USUARIO' },
    ],
    columnDefs: [
        { targets: 0, className: 'all', title: '#', width: "0px", },
        { targets: 1, className: 'all', title: 'Paciente', width: '50%' }, // PACIENTE
        { targets: 2, className: 'all', title: 'Cuenta' }, // SIHO_CUENTA
        { targets: 3, className: 'none', title: 'Folio' }, // FOLIO
        { targets: 4, className: 'none', title: 'Registro' }, // FECHA_ALTA
        { targets: 5, className: 'none', title: 'Quién registro' } // USUARIO
    ]
})


inputBusquedaTable('TablaPacientesNewGrupo', TablaPacientesNewGrupo, [], [], 'col-12');

let pacientesNewGroup
selectTable('#TablaPacientesNewGrupo', TablaPacientesNewGrupo, {
    unSelect: true, multipleSelect: true, divPadre: '#false'
}, (select, dataRow, callback) => {
    pacientesNewGroup = dataRow
})

// -------------------------------------------------------- //

// Agrega un nuevo paciente
$(document).on('click', '#AgregarPacientesGrupo', function () {
    if (ifnull(pacientesLeft, 0, ['lenght'])) {
        removeRows(tablaPacientesFaltantes)
        insertRowTable(pacientesLeft, TablaPacientesNewGrupo)
        pacientesLeft = []
    } else {
        alertToast('No ha seleccionado ningún registro.', 'info', 4000)
    }
})

// Elimina y regresa un paciente a la lista principal
$(document).on('click', '#QuitarPacientesGrupo', function () {
    if (ifnull(pacientesNewGroup, 0, ['lenght'])) {
        removeRows(TablaPacientesNewGrupo)
        insertRowTable(pacientesNewGroup, tablaPacientesFaltantes)
        pacientesNewGroup = []
    }
})

// Paginacion, envia a la pagina de advertencia
$(document).on('click', '#envioLotes-beforeConfirm', function (event) {
    event.preventDefault();
    event.stopPropagation();

    // Verificamos que existan pacientes
    if (getPacientes(TablaPacientesNewGrupo).length) {
        // Siguiente pagina
        combinePages('page_control-envio_lotes', 1)
        btnCambioPages(2)
    } else {
        alertToast('Ningún paciente ha sido selecionado', 'info', 4000);
    }
})

// Cierra el modal cuando ya haya enviado el envio ya este al final
$(document).on('click', '#procesoFinal_aceptar-enviarLote', function (event) {
    event.preventDefault();
    $('#EnvioLotesPacientes').modal('hide');
})

$(document).on('click', '.page2-botons', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = $(this);
    let action = btn.attr('action');

    if(action === "rechazo"){
        combinePages('page_control-envio_lotes', 0)
        btnCambioPages(1)
    }

    if (action === "aceptar") {
        alertPassConfirm({
            title: 'Para seguir,  por favor confirme su contraseña a continuación',
            icon: 'warning'
        }, () => {
            // envio de paquete a back
            ajaxAwait({
                    api: 4, pacientes: `${getPacientes(TablaPacientesNewGrupo, 1)}`
                }, 'maquilas_api', { callbackAfter: true, callbackBefore: true },
                // Before del ajax
                () => {
                    // Aviso antes de enviar
                    alertMsj({
                        title: '¡Genial, espere un momento!',
                        text: 'Esto puede tardar un rato, estamos configurando el proceso del paciente',
                        showCancelButton: false, showConfirmButton: false,
                        icon: 'info'

                    })
                },

                //Success del ajax
                (data) => {
                    // Datos
                    swal.close();

                    const row = data.response.data[0];

                    // Suponiendo que llega asi:
                    let url_reporte = row.RUTA_REPORTE;
                    let folio = row.FOLIO

                    $('#folio_de_solicitud_muestras').html(folio)
                    $('#formato_de_envio').attr('href', url_reporte);

                    // Siguiente página para mostrarle formato cargado:
                    combinePages('page_control-envio_lotes', 1) // Cambia de pagina
                })
        })
    }
})

// | ------------------------ Funciones para las tablas ------------------------------|

// Obtiene los pacientes de las tablas
function getPacientes(dataTable, type) {
    let valoresIDTurno = [];

    // Obtener los datos del DataTable sin importar si está filtrado
    let datos = dataTable.rows({ search: "applied" }).data();

    // Iterar sobre los datos y obtener los valores de la columna "ID_TURNO"
    datos.each(function (row) {
        let idTurno = row.ID_TURNO; // Reemplaza "ID_TURNO" con el nombre de la columna correspondiente en tu DataTable
        valoresIDTurno.push(idTurno);
    });

    if (type)
        return valoresIDTurno.join();

    return valoresIDTurno;
}

// Inserta nuevas filas
function insertRowTable(datosArray, table) {
    // Insertar cada conjunto de datos en la tabla
    // Obtener los datos existentes en la tabla de destino
    let existingData = table.rows().data().toArray();

    // Filtrar los nuevos datos para eliminar duplicados
    let uniqueData = datosArray.filter(function (newData) {
        return !existingData.some(function (existingRow) {
            return JSON.stringify(existingRow) === JSON.stringify(newData);
        });
    });

    // Agregar los datos únicos a la tabla de destino
    table.rows.add(uniqueData).draw();

    // Obtener los datos omitidos
    let omittedData = datosArray.filter(function (newData) {
        return existingData.some(function (existingRow) {
            return JSON.stringify(existingRow) === JSON.stringify(newData);
        });
    });

    // Mostrar una alerta con la información de los datos omitidos
    if (omittedData.length > 0) {
        alertToast('Se omitieron algunos pacientes repetidos', 'info', 4000);
        console.log('Datos omitidos:', omittedData);
    }
}

// Remueve filas seleccionadas
function removeRows(table) {
    // Obtener las filas seleccionadas
    let filasSeleccionadas = table.rows('.selected').indexes();

    // Remover las filas seleccionadas de la tabla
    table.rows(filasSeleccionadas).remove().draw();
}

// Cambia la forma de los botones
function btnCambioPages(key) {
    // Primera pagina
    $('.btn-footer_envioLote').fadeOut(0);
    $('.btn-footer_envioLote').prop('disabled', true);

    if(key === 1){
        $('.btn-footer_envioLote').fadeIn(0).prop('disabled', false);
    }
}