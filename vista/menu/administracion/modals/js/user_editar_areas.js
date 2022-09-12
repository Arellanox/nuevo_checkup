const modalEditarVistaUsuario = document.getElementById('modalEditarVistaUsuario')
modalEditarVistaUsuario.addEventListener('show.bs.modal', event => {
  $.ajax({
    url: "../../../api/areas_api.php",
    type: "POST",
    data:{api:2},
    success: function(data) {
      data = jQuery.parseJSON(data);
      if (mensajeAjax(data)) {
        var checkboxarea = "";
        for (var i = 0; i < data['response']['data'].length; i++) {
          // alert();
          checkboxarea += '<div class="col-auto"> <div class="input-group mb-3"> <div class="input-group-text">'+
                                      '<input class="form-check-input mt-0 areasUsuarios" value="'+data['response']['data'][i]['ID_AREA']+'" type="checkbox" aria-label="Checkbox for following text input" id="CheckAreaUsuarios'+data['response']['data'][i]['ID_AREA']+'">'+
                                      '<label class="d-flex justify-content-center" for="CheckAreaUsuarios'+data['response']['data'][i]['ID_AREA']+'">'+data['response']['data'][i]['DESCRIPCION']+'</label>'+
                              '</div></div></div>';
        }
        // // console.log(checkboxarea);
        document.getElementById("checkboxarea").innerHTML = checkboxarea;
      }
    }
  })

  $('.areasUsuarios').prop('checked', false);
  $.ajax({
    url: "../../../api/usuarios_areas_api.php",
    type: "POST",
    data:{id: array_selected['ID_USUARIO'],api:6},
    success: function(data) {
      data = jQuery.parseJSON(data);
      if (mensajeAjax(data)) {
        for (var i = 0; i < data['response']['data'].length; i++) {
          $('#CheckAreaUsuarios'+data['response']['data'][i]['AREA_ID']).prop('checked', true);
          // document.getElementById("CheckAreaUsuarios"").checked = true;
        }
      }
    }
  })
})


$( document ).on( 'click', '.areasUsuarios', function(){
let val = $(this).val();
  //Revisa en que status está el checkbox y controlalo según lo //desees
  if( $( this ).is( ':checked' ) ){
    $.ajax({
      url: "../../../api/usuarios_areas_api.php",
      type: "POST",
      data:{id: array_selected['ID_USUARIO'],val: val, api:1},
      success: function(data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {

        }
      }
    })
  }else{
    $.ajax({
      url: "../../../api/usuarios_areas_api.php",
      type: "POST",
      data:{id: array_selected['ID_USUARIO'], val: val, a: 0, api:5},
      success: function(data) {
        data = jQuery.parseJSON(data);
        if (mensajeAjax(data)) {

        }
      }
    })
  }
});
