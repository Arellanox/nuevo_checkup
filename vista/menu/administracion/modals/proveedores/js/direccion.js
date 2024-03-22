let id_direccion

// Formulario para agregar direccion
$(document).on('click', '.btn-direccion', function (e) {
    id_direccion = $(this).attr('data-bs-id')

    // Reinicia y abre nuevo modalw
    document.getElementById('form-proveedores').reset();

    // Buscamos las direcciones guardadas de ese proveedor
    recargarDireccion(id_direccion)

    // Formulario y vista de contactos
    $('#modalVistaDirecciones').modal('show');

})

$(document).on('submit', '#form-proveedores_direccion', function (e) {
    e.preventDefault();
    e.stopPropagation();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar una nueva dirección?',
        text: 'No podra actualizarlo'
    }, () => {

        // Mandar los datos
        ajaxAwaitFormData({
            api: 8,
            proveedor_id: id_direccion
        }, 'proveedores_api', 'form-proveedores_direccion', { formJquery: $('#subirComprobanteDomicilio'), callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Dirección guardada', 'success');

            recargarDireccion(id_direccion)
        })
    }, 1)
})

InputDragDrop('#dropComprobanteDomicilio', (inputArea, salidaInput) => {

    // Siempre se ejecuta al final del proceso
    salidaInput({
        msj: { pregunta: 'Carga otro arrastrándolo' },
        dropArea_css: {
            background: 'rgb(200 254 216)', // Indicativo que hay algo cargado
        },
        strong: {
            class: 'none-p',
            borderBottom: '1px solid'
        }
    });

    // Configuraciones
}, { multiple: false })


function recargarDireccion(data) {
    ajaxAwait(
        { api: 14, proveedor_id: data }, 'proveedores_api', { callbackAfter: true }, false, function (row) {
            //Llamamos una funcion donde se veran todos las tarjetas

            $('#lista-DireccionProveedores').html('');

            listaDireccionProveedores(row)
        })
}


function listaDireccionProveedores(data) {
    let listDirecciones = data.response.data

    listDirecciones.forEach(direccion => {

        var tarjetaDireccion = `
        <div class="rounded shadow p-3 my-3">
            <div class="d-flex justify-content-between">
                <h5>${direccion.TIPO_DIRECCION}</h5>
                <i class="bi bi-pencil-square btn-delete-direccion icons-btn d-block" 
                    data-bs-id="${direccion.ID_PROVEEDOR_DIRECCION}">
                </i>
            </div>
            <p>Calle: ${direccion.CALLE}, ${direccion.NUM_EXTERIOR} ${direccion.NUM_INTERIOR ? 'Int. ' + direccion.NUM_INTERIOR : ''}</p>
            <p>Colonia: ${direccion.COLONIA}, ${direccion.CIUDAD}, ${direccion.MUNICIPIO}</p>
            ${direccion.COMPROBANTE_DOMICILIO ? '<p><a href="' + direccion.COMPROBANTE_DOMICILIO + '" target="_blank">Comprobante de Domicilio</a></p>' : ''}
        </div>
        `;

        $('#lista-DireccionProveedores').append(tarjetaDireccion);
    });
}



$(document).on('click', '.btn-delete-direccion', function (e) {
    e.preventDefault();
    e.stopPropagation();

    let btn = $(this);
    let id_direccion_eliminar = btn.attr('data-bs-id');

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas eliminar la dirección actual?',
        text: 'No podrás recuperar esta dirección.'
    }, () => {

        // Mandar los datos
        ajaxAwait({
            api: 17, id_proveedor_direccion: id_direccion_eliminar
        }, 'proveedores_api', { callbackAfter: true }, false, (data) => {

            alertToast('Dirección eliminada', 'success');

            // Recarga de nuevo las direcciones
            recargarDireccion(id_direccion)
        })
    }, 1)

})