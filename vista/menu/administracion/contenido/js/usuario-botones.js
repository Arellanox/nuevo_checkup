
$("#btn-usuario-vista").click(function(){
  if (array_selected !=null) {
    $("#modalEditarVistaUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-usuario-permisos").click(function(){
  if (array_selected !=null) {
    $("#modalEditarPermisosUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-usuario-editar").click(function(){
  if (array_selected !=null) {
    $("#ModalEditarRegistroUsuario").modal('show');
  }else{
    alertSelectTable();
  }
})

$("#btn-usuario-estado").click(function(){
  if (array_selected !=null) {
    estadoUsuarioAlert(array_selected['ACTIVO']);
  }else{
    alertSelectTable();
  }
})

$("#btn-eliminar-usuario").click(function(){
  if (array_selected !=null) {
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
          data: {id: array_selected['ID_USUARIO'], api: 5},
          url: "../../../api/usuarios_api.php",
          type: "POST",
          success: function(data) {
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
  }else{
    alertSelectTable();
  }
})


function estadoUsuarioAlert(modo){
  if (modo == "ACTIVO") {
    title = "¿Desea desactivar este usuario?";
    text = "¡El usuario no podrá iniciar sesión la proxima vez!";
    confirmButtonText = "Si, desactivalo!";
    estado = 1;
    alertActivo = "Desactivado!";
    alertText = "Ya no tendrá acceso este usuario!";
    alertIcon = "success";
  }else{
    title = "¿Desea activar este usuario?";
    text = "¡El usuario podrá entrar al sistema!";
    confirmButtonText = "Si, activalo!";
    estado = 0;
    alertActivo = "Activado!";
    alertText = "Tiene acceso al sistema nuevamente!";
    alertIcon = "warning";
  }

  Swal.fire({
    title: title,
    text: text,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: confirmButtonText
  }).then((result) => {
    if (result.isConfirmed) {
      $.ajax({
        data: {id: array_selected['ID_USUARIO'], estado: estado, api: 7},
        url: "../../../api/usuarios_api.php",
        type: "POST",
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Swal.fire({
               icon: alertIcon,
               title: alertActivo,
               text: alertText
            })
            tablaUsuarios.ajax.reload()
          }
        },
      });
    }
  })

}
