let id_documentos

// Formulario para agregar direccion
$(document).on('click', '.btn-subir-documentos', function (e) {
    id_documentos = $(this).attr('data-bs-id')

    // Reinicia y abre nuevo modalw
    // document.getElementById('form-proveedores').reset();

    // Buscamos las direcciones guardadas de ese proveedor
    // recargarDireccion(id_direccion)

    // Formulario y vista de contactos
    $('#modalVistaDocumentos').modal('show');

})