var responsablesCajaEnviar = new Array();


$("#crearCaja").on("click", function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: "¿Desea agregar un nueva caja?",
        text: "Es necesario confirmar para añadir esta nueva caja",
        icon: "question"
    }, function () {

        ajaxAwaitFormData({
            api: 1,
        }, 'corte_caja_api', 'formCrearCaja', { callbackAfter: true }, false, function (data) {

            alertToast("La caja fue agregada con exito", "success", 5000)

        })

    }, 1)
})


var TablaTotaldeCajas = $('#TablaTotaldeCajas').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 2 },
        method: 'POST',
        url: '../../../api/corte_caja_api.php',
        beforeSend: function () { loader("In") },
        complete: function () { loader("Out") },
        dataSrc: 'response.data'
    },
    columns: [
        {

            data: "COUNT", render: function (data) {
                // Mes
                return "COUNT";
            }
        },
        {
            data: "DESCRIPCION", render: function (data) {

                return "DESCRIPCION";
            }
        },
        {
            data: "MONTO",
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'NOMBRE', className: 'all' },
        { target: 2, title: 'MONTO', className: 'none' }
    ],

})

inputBusquedaTable("TablaTotaldeCajas", TablaTotaldeCajas, [{
    msj: 'Tabla de los totales de cajas',
    place: 'top'
}], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")


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

//AGREGAR RESPONSABLES A LAS CAJAS

select2("#select-user", "ModalAdministrarCajas", 'Seleccione un responsable para esta caja');

rellenarSelect("#select-user", "corte_caja_api", 5, 'ID_USUARIO','nombrecompleto', {

}, function (data) {
    estudiosLab = data;
});


$('#btnAgregarResponsableCaja').on('click', function () {
    let text = $("#select-user option:selected").text();
    let id = $("#select-user").val();

    agregarFilaDivUsuarios('#listResponsablesCajas', text, id)
})


function agregarFilaDivUsuarios(appendDiv, text, id) {
    responsablesCajaEnviar.push(id)
    let html = '<li class="list-group-item">' +
        '<div class="row">' +
        '<div class="col-10 d-flex  align-items-center">' +
        text +
        '</div>' +
        '<div class="col-2">' +
        '<button type="button" class="btn btn-hover me-2 eliminarfilaEncargado" data-bs-id="' + id + '"> <i class="bi bi-trash"></i> </button>' +
        '</div>' +
        '</div>' +
        '</li>';
    $(appendDiv).append(html);
    // console.log(estudiosEnviar);
}

function eliminarElementoArray(id) {
    responsablesCajaEnviar = jQuery.grep(responsablesCajaEnviar, function (value) {
        return value != id;
    });
}


$(document).on('click', '.eliminarfilaEncargado', function () {
    let id = $(this).attr('data-bs-id');
    eliminarElementoArray(id);
    var parent_element = $(this).closest("li[class='list-group-item']");
    $(parent_element).remove()

});