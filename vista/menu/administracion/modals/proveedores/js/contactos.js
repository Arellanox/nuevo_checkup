let proveedor_id = 0;
// Formulario para nuevos contactos
$(document).on('click', '.btn-contantos', function (e) {
    e.preventDefault();
    e.stopPropagation();

    alertToast('Cargando contactos disponibles', 'info');

    const btn = $(this)
    proveedor_id = btn.attr('data-bs-id');
    dataVistacontactos['proveedor_id'] = proveedor_id;
    tablaVistaContactos.ajax.reload();

    // Reinicia y abre nuevo modalw
    document.getElementById('form-proveedores').reset();
    // Formulario y vista de contactos
    $('#modalVistaContacto').modal('show');

})

// Formulario
$(document).on('submit', '#form-Contacto', function (e) {
    e.preventDefault();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar correctamente el contacto?',
        text: 'Este nuevo contacto se guardará con el proveedor correspondiente'
    }, () => {

        // Mandar los datos
        ajaxAwaitFormData({
            api: 5, id_proveedores: proveedor_id
        }, 'proveedores_api', 'form-Contacto', { callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Contacto guardado', 'success');

            // Reseteamos el formulario
            document.getElementById('form-Contacto').reset();
            tablaVistaContactos.ajax.reload();

            // $('#modalVistaProveedores').modal('hide');

            // Recargar tabla de contactos

        })
    }, 1)
})


// Tabla de contactos por proveedor
dataVistacontactos = { api: 7, proveedor_id: proveedor_id }
tablaVistaContactos = $('#tablaVistaContactos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataVistacontactos);
        },
        method: 'POST',
        url: '../../../api/proveedores_api.php',
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT', },
        { data: 'NOMBRE', },
        { data: 'TIPO_CONTACTO', },
        { data: 'TELEFONO', },
        {data: 'ID_CONTACTO', render: function(data){
            return `<i class="bi bi-trash eliminar-contacto" data-id = "${data}" style = "cursor: pointer"></i>`;
        }}
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Teléfono', className: 'desktop' },
        { target: 3, title: 'Correo', className: 'desktop' },
        { target: 4, title: '<i class="bi bi-trash"></i>', className: 'all' },


    ]

})

inputBusquedaTable('tablaVistaContactos', tablaVistaContactos, [
    {
        msj: 'Visualiza todo los contactos disponibles del proveedor',
        place: 'top'
    },
    {
        msj: '',
        place: 'top'
    }
], [], 'col-12')


selectTable('#tablaVistaContactos', tablaVistaContactos, {
    multipleSelect: false, noColumns: false, unSelect: true,
    ClickClass: [
        {
            class: 'eliminar-contacto',
            callback: (data) => {
                desactivarContactoProveedor(data)
            },
            selected: true
        }
    ]
})


// --------------Funciones---------------------
// --------------------------------------------

function desactivarContactoProveedor(data) {

    alertMensajeConfirm({
        title: '¿Está seguro que desea desactivar este contacto?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        ajaxAwait({
        api: 6,
        id_contacto: data['ID_CONTACTO'],
        },
            'proveedores_api', { callbackAfter: true }, false, function (data) {
                alertToast('Contacto eliminado!', 'success', 4000)

                tablaVistaContactos.ajax.reload();
            })
    }, 1)
}



