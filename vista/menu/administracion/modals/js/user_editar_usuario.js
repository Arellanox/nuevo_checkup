const modalEditarRegistroUsuario = document.getElementById('ModalEditarRegistroUsuario');

modalEditarRegistroUsuario.addEventListener('show.bs.modal', event => {
  document.getElementById("formEditarUsuario").reset();
  $("#Input-Constraseña-Edit").hide();
  $("#edit-usuario-contraseña").removeAttr("name");

  // Llenar selects
  let promises = [
    rellenarSelect('#usuario-cargos-edit', 'tipos_usuarios_api', 2, 0, 1),
    rellenarSelect('#usuario-tipo-edit', 'tipos_usuarios_api', 2, 0, 1),
    rellenarSelect('#cliente-edit', 'clientes_api', 2, 'ID_CLIENTE', 'NOMBRE_COMERCIAL')
  ];

  // Esperar a que los selects estén listos antes de asignar valores
  Promise.all(promises).then(() => {
    $.ajax({
      url: "../../../api/usuarios_api.php",
      type: "POST",
      data: { id: array_selected['ID_USUARIO'], api: 2 },
      success: function (data) {
        data = jQuery.parseJSON(data);

        if (mensajeAjax(data)) {
          let usuario = data['response']['data'][0];
          console.log(usuario)

          $('#usuario-cargos-edit').val(usuario['CARGO_ID']).trigger('change');
          $('#usuario-tipo-edit').val(usuario['TIPO_ID']).trigger('change');
          $('#edit-usuario-nombre').val(usuario['NOMBRE']);
          $('#edit-usuario-paterno').val(usuario['PATERNO']);
          $('#edit-usuario-materno').val(usuario['MATERNO']);
          $('#edit-usuario-usuario').val(usuario['USUARIO']);
          $('#edit-usuario-Profesión').val(usuario['PROFESION']);
          $('#edit-usuario-cedula').val(usuario['CEDULA']);
          $('#edit-usuario-telefono').val(usuario['TELEFONO']);
          $('#edit-usuario-correo').val(usuario['CORREO']);

          // Asignar cliente después de que el select esté cargado
          $('#cliente-edit').val(usuario['CLIENTE_ID']).trigger('change');
        }
      }
    });
  });
});



//Formulario de Preregistro
$("#formEditarUsuario").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarUsuario");
  var formData = new FormData(form);
  formData.set('id', array_selected['ID_USUARIO']);
  formData.set('api', 4);

  $.ajax({
    data: formData,
    url: "../../../api/usuarios_api.php",
    type: "POST",
    processData: false,
    contentType: false,
    success: function (data) {
      data = jQuery.parseJSON(data);
      // console.log(data);
      if (mensajeAjax(data)) {
        Toast.fire({
          icon: 'success',
          title: '¡Usuario actualizado!',
          timer: 2000
        });
        document.getElementById("formEditarUsuario").reset();
        $("#ModalEditarRegistroUsuario").modal('hide');
        tablaUsuarios.ajax.reload()
      }
    },
  });
  event.preventDefault();
});


$("#btn-eliminar-usuario").click(function () {
  if (array_selected != null) {
    Swal.fire({
      title: "¿Está seguro que desea eliminar este usuario?",
      text: "¡Este usuario no podrá recuperarse!",
      icon: 'warning',
      showCancelButton: true,
      cancelButtonColor: '#3085d6',
      confirmButtonColor: '#d33',
      confirmButtonText: 'ELIMINAR',
      cancelButtonText: 'Cancelar'
    }).then((result) => {
      if (result.isConfirmed) {
        $.ajax({
          data: { id: array_selected['ID_USUARIO'], api: 5 },
          url: "../../../api/usuarios_api.php",
          type: "POST",
          success: function (data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              Toast.fire({
                icon: 'success',
                title: '¡Usuario Eliminado!',
                timer: 2000
              });
              $("#ModalEditarRegistroUsuario").modal('hide');
              tablaUsuarios.ajax.reload()
            }
          },
        });
      }
    })
  } else {
    alertSelectTable();
  }
})