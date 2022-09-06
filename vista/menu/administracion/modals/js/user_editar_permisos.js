const modalEditarPermisosUsuario = document.getElementById('modalEditarPermisosUsuario')
modalEditarPermisosUsuario.addEventListener('show.bs.modal', event => {
  var checkboxPermisos = "";
  for (var i = 0; i < 10; i++) {
    // alert();
    checkboxPermisos += '<div class="col-auto"> <div class="input-group mb-3"> <div class="input-group-text">'+
                                '<input class="form-check-input mt-0 permisosUsuario" value="'+i+'" type="checkbox" aria-label="Checkbox for following text input" id="checkClinica'+i+'">'+
                                '<label class="d-flex justify-content-center" for="checkClinica'+i+'">Historia Clinica Laboral</label>'+
                        '</div></div></div>';
  }
  // console.log(checkboxPermisos);
  document.getElementById("checkboxPermisos").innerHTML = checkboxPermisos;
  // $.ajax({
  //   url: "../../../api/permisos_api.php",
  //   type: "POST",
  //   data:{id:array_paciente['DT_RowId']},
  //   success: function(data) {
          // var checkboxPermisos = "";
          // for (var i = 0; i < 10; i++) {
          //   // alert();
          //   checkboxPermisos += '<div class="col-auto"> <div class="input-group mb-3"> <div class="input-group-text">'+
          //                               '<input class="form-check-input mt-0 permisosUsuario" value="'+i+'" type="checkbox" aria-label="Checkbox for following text input" id="checkClinica'+i+'">'+
          //                               '<label class="d-flex justify-content-center" for="checkClinica'+i+'">Historia Clinica Laboral</label>'+
          //                       '</div></div></div>';
          // }
          // // console.log(checkboxPermisos);
          // document.getElementById("checkboxPermisos").innerHTML = checkboxPermisos;
  //   }
  // })
})
$( document ).on( 'click', '.permisosUsuario', function(){
let val = $(this).val();
  //Revisa en que status está el checkbox y controlalo según lo //desees
  if( $( this ).is( ':checked' ) ){
    alert( 'Guardando información de '+ val +'...' );
  }

  else{
    alert( 'Desguardando información de ' + val + '...' );
  }
});


function permisosUsuario(value){
  alert(value);
}
