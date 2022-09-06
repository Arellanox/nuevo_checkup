$.post("modals/a_modals.php", function(html){
   $("#modals-js").html(html);
   // Modal para registrar usuario
   $.getScript('modals/js/user_agregar_usuario.js');
   // Modal para registrar usuario
   $.getScript('modals/js/user_editar_usuario.js');
   // Modal para editar permisos
   $.getScript('modals/js/user_editar_permisos.js');
   // Modal para registrar cargo
   $.getScript('modals/js/cargo_crear.js');
});




// $('input[type=checkbox]').click(function() {
//   if (!$(this).is(':checked')) {
//     return confirm("Are you sure?");
//   }
// });

function cambioPermisos(id, permiso){
  alert(id);
  // $.ajax({
  //   url: '../../../api/??',
  //   data:{api: 0},
  //   type: "POST",
  //   success: function(data) {
  //
  //     }
  //   }
  // })
}
