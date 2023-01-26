
//Controlar modals
const ModalFormUsuario = document.getElementById('ModalFormUsuario')
ModalFormUsuario.addEventListener('show.bs.modal', event => {
    //Resetear modal
    $('#formFormUsuario')[0].reset();
    $('#especialidades-usuario').html('');

    //Conocer el boton seleccionado
    let button = event.relatedTarget
    // Extract info from data-bs-* attributes
    selectFormUsuario = button.getAttribute('data-bs-select');

    //Cargar formulario de formadinamica
    getInfo(selectFormUsuario)

})

async function getInfo(tip) {

    //Cargar selects 
    await rellenarSelect('#cargo-usuario', 'cargos_api', 2, 'ID_CARGO', 'DESCRIPCION');
    await rellenarSelect('#tipo-usuario', 'tipos_usuarios_api', 2, 'ID_TIPO', 'DESCRIPCION');
    await rellenarSelect('#universidad-usuario', 'universidades_api', 2, 'ID_UNIVERSIDAD', 'DESCRIPCION')
    await rellenarSelect('#titulo-usuario', 'titulos_api', 2, 'ID_U_TITULO', 'DESCRIPCION')


    switch (tip) {
        case 'new':

            break;
        case 'edit':

            break;

        default:
            break;
    }



}


//Registrar o actualizar
$("#formFormUsuario").submit(function (event) {
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formFormUsuario");
    var formData = new FormData(form);
    formData.set('api', 1);


    alertMensajeConfirm({
        title: '¿Está seguro que todos los datos están correctos?',
        text: "¡Guarde o recuerde la contraseña!",
        icon: 'warning',
    }, function () {
        $.ajax({
            data: formData,
            url: http + servidor + "/nuevo_checkup/api/usuarios_api.php",
            type: "POST",
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (data) {
                if (mensajeAjax(data)) {
                    alertToast('Usuario registrado', 'success')
                    document.getElementById("formFormUsuario").reset();
                    $("#ModalFormUsuario").modal('hide');
                    tablaUsuarios.ajax.reload()
                }
            },
        });
    }, 1);
    event.preventDefault();
});
















$('#nueva-especialidad').click(function () {
    setContenido('#especialidades-usuario')
})






function setContenido(div) {

    let html = '<div class="row" id="contenedor"> <hr>' +
        '<p>Nueva especialidad</p>' +
        '<div class="col-6">' +
        '<label for="universidad" class="form-label">Especialidad cursada</label>' +
        '<input type="text" name="especialidad[]especialidad[]" class="form-control input-form"' +
        'required>' +
        '</div>' +
        '<div class="col-6">' +
        '<label for="titulo_id" class="form-label">Universidad de la especialidad' +
        '</label>' +
        '<input type="text" name="titulo_id" class="form-control input-form"' +
        'required>' +
        '</div>' +
        '<div class="col-6">' +
        '<label for="cedula" class="form-label">Cédula profesional de la' +
        'especialidad</label >' +
        '<input type="text" name="cedula" class="form-control input-form"' +
        'required>' +
        '</div>' +
        '<div class="col-6">' +
        '<label for="profesion" class="form-label">Certificado por</label>' +
        '<input type="text" name="profesion" class="form-control input-form"' +
        'placeholder="Consejo que corresponda" required>' +
        '</div>' +
        '<div class="col-6">' +
        '<label for="profesion" class="form-label">Numero de cerfiticado' +
        'por</label>' +
        '<input type="text" name="profesion" class="form-control input-form"' +
        'placeholder="Consejo que corresponda" required>' +
        '</div>' +
        '<div class="col-6 d-flex justify-content-end align-items-end">' +
        '<button type="button" class="btn btn-hover me-2 eliminarEspecialidad" data-bs-id="1"> <i class="bi bi-trash"></i> </button>' +
        '</div>' +
        '</div>';

    $(div).append(html);
}

$(document).on('click', '.eliminarEspecialidad', function () {
    // detectar ID y eliminar registro
    // let id = $(this).attr('data-bs-id');
    // eliminarElementoArray(id);

    //Remover de html
    var parent_element = $(this).closest("div[class='row']");
    $(parent_element).remove()

});
