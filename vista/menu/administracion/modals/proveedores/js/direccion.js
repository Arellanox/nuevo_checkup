let id_direccion

// Formulario para agregar direccion
$(document).on('click', '.btn-direccion', function (e) {
    id_direccion = $(this).attr('data-bs-id')

    // Reinicia y abre nuevo modalw
    document.getElementById('form-proveedores').reset();
    // Formulario y vista de contactos
    $('#modalVistaDirecciones').modal('show');
})

$(document).on('submit', '#form-proveedores_direccion', function (e) {
    e.preventDefault();
    e.stopPropagation();

    // Preguntar si esta todo bien
    alertMensajeConfirm({
        icon: 'info',
        title: '¿Deseas guardar un nuevo proveedor?',
        text: 'Debes guardar un proveedor para agregar nueva información'
    }, () => {

        // Mandar los datos
        ajaxAwaitFormData({
            api: 8,
            proveedor_id : id_direccion
        }, 'proveedores_api', 'form-proveedores_direccion', { formJquery: $('#subirComprobanteDomicilio'), callbackAfter: true, resetForm: true }, false, (data) => {

            alertToast('Proveedor guardado', 'success');
            // $('#modalVistaProveedores').modal('hide');
        })
    }, 1)
})

InputDragDrop('#dropComprobanteDomicilio', (inputArea, salidaInput) => {



    // Suponiendo que inputArea es un input de tipo file con el atributo "multiple" habilitado
    // var files = inputArea.get(0).files;

    // // Obten el nombre
    // var nombreArchivo = inputArea.val().split('\\').pop();

    // // Al finalizar, verifica si hay archivos no soportados para informar al usuario
    // if (archivosNoSoportados.length > 0) {
    //     var listaArchivosNoSoportados = "Archivos no soportados:\n" + archivosNoSoportados.join('\n');
    //     alert(listaArchivosNoSoportados);
    // }


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