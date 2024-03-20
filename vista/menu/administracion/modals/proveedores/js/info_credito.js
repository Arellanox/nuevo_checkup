let proveedor_id_credito = 0;
// Formulario para nuevos contactos
$(document).on('click', '.btn-cargar-documentos', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const btn = $(this)
    // Obtenemos la id de proveedor
    proveedor_id_credito = btn.attr('data-bs-id');

    // Vaciamos areas seleccionadas
    areas_seleccionadas = []

    // Reinicia y abre nuevo modalw
    document.getElementById('form-info_credito').reset();
    // Formulario y vista de contactos
    $('#modalVistaInfoCredito').modal('show');

    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 300);
})

// Formulario
$(document).on('submit', '#form-info_credito', function (e) {
    e.preventDefault();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar correctamente el contacto?',
        text: 'Este nuevo contacto se guardará con el proveedor correspondiente'
    }, () => {

        // Mandar los datos
        ajaxAwaitFormData({
            api: 5, id_proveedores: proveedor_id_credito
        }, 'proveedores_api', 'form-info_credito', { callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Contacto guardado', 'success');

            // Reseteamos el formulario
            document.getElementById('form-info_credito').reset();
            tablaVistaContactos.ajax.reload();

            // $('#modalVistaProveedores').modal('hide');

            // Recargar tabla de contactos

        })
    }, 1)
})



// Tabla de areas
let TableAreasSelect = $('#servicio_table_select').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    searching: false,
    scrollY: '40vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 2 },
        method: 'POST',
        url: '../../../api/areas_api.php',
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'DESCRIPCION', },
    ],
    columnDefs: [
        { target: 0, title: 'Areas', className: 'all' },
    ]

})


inputBusquedaTable('TableAreasSelect', servicio_table_select, [], [], 'col-12')




let areas_seleccionadas = [];
selectTable('#servicio_table_select', TableAreasSelect, {
    multipleSelect: true, noColumns: false
}, async function (select, data, callback) {

    if (select) {
        areas_seleccionadas[data.ID_AREA];
    } else {
        areas_seleccionadas.splice(data.ID_AREA, 1)
    }
})
// --------------Funciones---------------------
// --------------------------------------------



InputDragDrop('#dropCaratulaCuentaBancaria', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        id_proveedores: proveedor_id_credito, api: 10, id_tipo_archivo: 5
    }, 'proveedores_api', 'formCaratulaCuentaBancaria', { callbackAfter: true }, false, function () {
        // Siempre se ejecuta al final del proceso
        salidaInput();

    })
}, { multiple: true })



InputDragDrop('#dropDatosPago', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        id_proveedores: proveedor_id_credito, api: 10, id_tipo_archivo: 6
    }, 'proveedores_api', 'formDatosPado', { callbackAfter: true }, false, function () {
        // Siempre se ejecuta al final del proceso
        salidaInput();

    })
}, { multiple: true })

function getArchivosInformacionCredito() {
    ajaxAwait()
}