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
    estadoUsuarioAlert(array_selected[5]);
  }else{
    alertSelectTable();
  }
})


function estadoUsuarioAlert(modo){
  if (modo == "ACTIVO") {
    title = "¿Desea desactivar este usuario?";
    text = "¡El usuario no podrá iniciar sesión la proxima vez!";
    confirmButtonText = "Si, desactivalo!";
    ajaxData = 0;
    alertActivo = "Desactivado!";
    alertText = "Ya no tendrá acceso este usuario!";
    alertIcon = "success";
  }else{
    title = "¿Desea activar este usuario?";
    text = "¡El usuario podrá entrar al sistema!";
    confirmButtonText = "Si, activalo!";
    ajaxData = 1;
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
        data: ajaxData,
        url: "../../../api/??.php",
        type: "POST",
        success: function(data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Swal.fire(
              alertActivo,
              alertText,
              alertIcon
            )
          }
        },
      });
    }
  })

}
