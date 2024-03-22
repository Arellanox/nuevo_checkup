
$(document).on('click', '#btn-NuevoProveedor', function (e) {
    // Reinicia y abre nuevo modalw
    document.getElementById('form-proveedores').reset();
    setFormProveedores = 0;
    $('#modalVistaProveedores').modal('show');
})


$(document).on('submit', '#form-proveedores', function (e) {
    e.preventDefault();
    e.stopPropagation();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar el proveedor?',
        text: 'Podrás agregar más información del proveedor después'
    }, () => {

        // Mandar los datos
        let dataJson = {
            api: 1
        }

        if (setFormProveedores) dataJson['id_proveedores'] = setFormProveedores;

        ajaxAwaitFormData(dataJson, 'proveedores_api', 'form-proveedores', { callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Proveedor guardado', 'success');

            tablaVistaProveedores.ajax.reload();

            $('#modalVistaProveedores').modal('hide');
        })

    }, 1)
})






//  --------------Funciones ---------------- //

// Actualizar proveedor
function setProveedorForm(data) {
    // Reiniciar formulario
    document.getElementById("form-proveedores").reset();

    // Desmarcar ambos botones primero

    // Marcar el botón de radio basado en su valor
    if (ifnull(data, false, ['TIPO_PERSONA'])) {
        $('input[name="tipo_persona"]').prop('checked', false);
        $('input[name="tipo_persona"][value="' + data.TIPO_PERSONA + '"]').prop('checked', true);
    }

    // Inputs
    $('#razon_social-proveedor').val(ifnull(data, '', ['RAZON_SOCIAL']))
    $('#nombre_comercial-proveedor').val(ifnull(data, '', ['NOMBRE_COMERCIAL']))
    $('#representante_legal-proveedor').val(ifnull(data, '', ['NOMBRE_REPRESENTANTE']))
    $('#objeto_social-proveedor').val(ifnull(data, '', ['OBJETO_SOCIAL']))
    $('#telefono-proveedor').val(ifnull(data, '', ['TELEFONO']))
    $('#correo_electronico-proveedor').val(ifnull(data, '', ['EMAIL']))
    $('#sitio_web-proveedor').val(ifnull(data, '', ['SITIO_WEB']))

}

