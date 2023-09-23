let html = ''
var TablaUsuariosResponsables = ''
$("#formCrearCaja").on("submit", function (e) {
    e.preventDefault();



    alertMensajeConfirm({
        title: "¿Desea agregar un nueva caja?",
        text: "Es necesario confirmar para añadir esta nueva caja",
        icon: "question"
    }, function () {

        alertPassConfirm({
            title: "Agregue su contraseña para continuar", icon: "info"
        }, () => {
            ajaxAwaitFormData({
                api: 1,
            }, 'corte_caja_api', 'formCrearCaja', { callbackAfter: true }, false, async function (data) {

                $("#formCrearCaja").trigger("reset");
                TablaTotaldeCajas.ajax.reload();

                await switchCajasSelect(true, true)
                alertToast("La caja fue agregada con exito", "success", 4000)

            })
        })

    }, 1)
})

// Tabla de cajas
var TablaTotaldeCajas = $('#TablaTotaldeCajas').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 2 },
        method: 'POST',
        url: '../../../api/corte_caja_api.php',
        beforeSend: function () {
            loader("In")
            fadeTabla('Out')
        },
        complete: function () { loader("Out") },
        dataSrc: 'response.data'
    },
    columns: [
        { data: "COUNT" },
        { data: "DESCRIPCION" },
        {
            data: "MONTO", render: function (data) {
                const monte_actual = parseFloat(ifnull(data, '0')).toFixed(2)
                return `$${monte_actual}`;
            }
        },
        {
            data: null, render: function (meta) {
                let html;

                if (meta['MONTO'] < 1 || meta['MONTO'] === null || meta['MONTO'] === "null") {
                    html = `
                    <i class="bi bi-trash borarCaja" style = "cursor:pointer"></i>`;
                } else {
                    html = "";
                }

                return html;
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Monto Actual', className: 'min-tablet' },
        { target: 3, title: 'Acción', className: 'all', width: '10px' }
    ],

})

inputBusquedaTable("TablaTotaldeCajas", TablaTotaldeCajas, [{
    msj: 'Tabla de los totales de cajas',
    place: 'top'
}], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")


let id_caja = ''
selectTable('#TablaTotaldeCajas', TablaTotaldeCajas, {
    unSelect: true, ClickClass: [
        {

            class: 'borarCaja',
            callback: async function (data) {
                console.log(data)
                data = {
                    api: 4,
                    id_caja: data['ID_CAJAS']
                }

                alertMensajeConfirm({
                    title: "¿Esta seguro de eliminar esta caja?",
                    text: "Es necesario confirmar para eliminar esta nueva caja",
                    icon: "question"
                }, function () {
                    alertPassConfirm({
                        title: "Agregue su contraseña para continuar", icon: "info"
                    }, () => {
                        ajaxAwait(data, 'corte_caja_api', { callbackAfter: true }, false,
                            async function (data) {
                                TablaTotaldeCajas.ajax.reload();

                                await switchCajasSelect(true, true)

                                alertToast('La caja fue eliminada con exito', 'success', 4000)
                            })
                    })
                }, 1)

            }
        }
    ]

}, (select, data) => {
    // fadeTabla('Out')
    if (select) {
        console.log(data)
        $("#nombreCaja").text(data["DESCRIPCION"])
        $("#btnAgregarResponsableCaja").prop('disabled', false)
        $("#select-user").prop('disabled', false)

        dataUsuariosResponsables['id_caja'] = data["ID_CAJAS"]

        fadeTabla('In')

        TablaUsuariosResponsables.ajax.reload()
    } else {
        // Parametros o funciones que hara cuando un row no este seleccionado

        fadeTabla('Out')
    }



})



const adminCajasModal = document.getElementById('ModalAdministrarCajas')
adminCajasModal.addEventListener('show.bs.modal', event => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 200);

})




let dataUsuariosResponsables = { api: 6, id_caja: 0 }
// Tabla de usuarios responsable de una caja
TablaUsuariosResponsables = $('#TablaUsuariosResponsables').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataUsuariosResponsables);
        },
        method: 'POST',
        url: '../../../api/corte_caja_api.php',
        beforeSend: function () { loader("In") },
        complete: function () { loader("Out") },
        dataSrc: 'response.data'
    },
    columns: [
        { data: "USUARIO_ID" },
        { data: "px" },
        {
            data: 'ID_CAJAS_USUARIOS', render: function (data) {
                return `<i class="bi bi-trash" data-id = "${data}" style = "cursor: pointer"
                onclick="desactivarTablaResponsables.call(this)"></i>`;
            }
        },

    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: '<i class="bi bi-trash borarUsuarioResponsable"></i>', className: 'all', width: '10px' }
    ],

})

inputBusquedaTable("TablaUsuariosResponsables", TablaUsuariosResponsables, [{
    msj: 'Tabla de usuarios responsables',
    place: 'top'
}], {
    msj: "Filtre los resultados por nombre",
    place: 'top'
}, "col-12")


//----------------------------------------------------------------AGREGAR USUARIOS
select2("#select-user", "ModalAdministrarCajas", 'Seleccione un responsable para esta caja');
rellenarSelect("#select-user", "corte_caja_api", 8, 'ID_USUARIO', 'nombrecompleto', {

}, function (data) {
    estudiosLab = data;
});


$("#btnAgregarResponsableCaja").on('click', function () {

    dataJson_agreagarUsuarios = {
        api: 5,
        id_caja: array_selected["ID_CAJAS"],
        usuario_encargado: $("#select-user").val()
    }

    alertMensajeConfirm({
        title: "¿Esta seguro de agregar este usuario?",
        text: "Es necesario confirmar para realizar esta acción",
        icon: "question"
    }, function () {
        alertPassConfirm({
            title: "Agregue su contraseña para continuar", icon: "info"
        }, () => {
            ajaxAwait(dataJson_agreagarUsuarios, 'corte_caja_api', { callbackAfter: true }, false, function (data) {
                alertToast('Usuario agregado', 'success', 4000)
                TablaUsuariosResponsables.ajax.reload()

            })
        })
    }, 1)
})

//Eliminar en tabla de usuario responsable
function desactivarTablaResponsables() {

    var usuario_Responsable = $(this).data("id");

    alertMensajeConfirm({
        title: '¿Está seguro de eliminar este usuario?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {
        alertPassConfirm({
            title: "Agregue su contraseña para continuar", icon: "info"
        }, () => {
            ajaxAwait({ api: 7, id_cajas_usuarios: usuario_Responsable }, 'corte_caja_api', { callbackAfter: true }, false, function (data) {
                alertToast('Responsable eliminado eliminado!', 'success', 4000)

                TablaUsuariosResponsables.ajax.reload();
            })
        })
    }, 1)
}

// Function Fade
function fadeTabla(type) {
    if (type === "Out") {
        $('#form_tabla_responsable').fadeOut();
    } else if (type === "In") {
        $('#form_tabla_responsable').fadeIn();
    }
}

