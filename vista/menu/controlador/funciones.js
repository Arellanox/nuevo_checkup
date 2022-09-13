
// login
// verificarLogin(session['id']);



//Para el campo de preregistro
function deshabilitarVacunaExtra(vacuna, div){
  if(vacuna!="OTRA"){
    $("#"+div).fadeOut(400);
  }else{
    $("#"+div).fadeIn(400);
  }
}

// Notifiació  movil
if (window.innerWidth <= 768) {
  position = 'top';
}else{
  position = 'top-start';
}

const Toast = Swal.mixin({
  toast: true,
  position: position,
  showConfirmButton: false,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer)
    toast.addEventListener('mouseleave', Swal.resumeTimer)
  }
});


// Obtener segmentos por procedencia en select
function getSegmentoByProcedencia(id, select){
  var select = document.getElementById(select),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  $.ajax({
    url: "http://localhost/nuevo_checkup/api/segmentos_api.php",
      type: "POST",
      data:{id: id,api:6},
    success: function(data) {
      var data = jQuery.parseJSON(data);
      // console.log(data);
      if (mensajeAjax(data)) {
        if (data['response']['data'].length >0) {
          for (var i = 0; i < data['response']['data'].length; i++) {
            var content = data['response']['data'][i]['segmento'];
            var value = data['response']['data'][i]['id'];
            var el = document.createElement("option");
            el.textContent = content;
            el.value = value;
            select.appendChild(el);
          }
        }else{
          var content = "No contiene segmentos";
          var value = "";
          var el = document.createElement("option");
          el.textContent = content;
          el.value = value;
          select.appendChild(el);
        }
      }
    }
  });

  return 1;
}

// Obtener procedencias en select
function getProcedencias(select){
  var select = document.getElementById(select),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  $.ajax({
    url: http+servidor+"/nuevo_checkup/api/clientes_api.php",
    type: "POST",
    data:{api:2},
    success: function(data) {
      var data = jQuery.parseJSON(data);
      for (var i = 0; i < data['response']['data'].length; i++) {
        var content = data['response']['data'][i]['NOMBRE_COMERCIAL'];
        var value = data['response']['data'][i]['ID_CLIENTE'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        select.appendChild(el);
      }
    }
  })
}

// Obtener cargo y tipos de usuarios
function rellenarSelect(select, api, num){
  var select = document.getElementById(select),
      length = select.options.length;
  while(length--){
    select.remove(length);
  }
  ajaxSelect(select, api, num);
  return 1;
}

function ajaxSelect(select, api, num){
  $.ajax({
    url: api,
    data:{api: num},
    type: "POST",
    success: function(data) {
      var data = jQuery.parseJSON(data);
      //Equipo Utilizado
      // console.log(data);
      for (var i = 0; i < data['response']['data'].length; i++) {
        var content = data['response']['data'][i]['1'];
        var value = data['response']['data'][i]['0'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        select.append(el);
      }
    }
  })
  return 1;
}


$( window ).on( 'hashchange', function( e ) {
    var hash = window.location.hash.substring(1);
    switch (hash) {
      case 'LogOut':
        window.location.hash = '';
        window.location.href = 'http://localhost/nuevo_checkup/vista/login/?page='+window.location;
      break;
      default:  break;
    }
} );

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
    results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}


function loader(fade){
  if (fade == 'Out') {
    $("#loader").fadeOut(100);
    // alert("salir");
  }else if (fade == 'In') {
    $("#loader").fadeIn(100);
    // alert("entrar");
  }
}

function alertSelectTable(){
    Toast.fire({
      icon: 'error',
      title: 'No ha seleccionado ningún registro',
      timer: 4000
    });
}

function mensajeAjax(data){
  switch (data['response']['code']) {
    case 1:
      return 1;
    break;
    case 2:
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: '¡Ha ocurrido un error!',
         footer: 'Codigo: '+data['response']['msj']
      })
    break;
    case "repetido":
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: '¡Usted ya está registrado!',
         footer: 'Utilice su CURP para registrarse en una nueva prueba'
      })
    break;
    case "login":
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'Codigo: '+data['response']['msj']
      })
    break;
    default:
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'Hubo un problema!',
         footer: 'Reporte este error con el personal :)'
      })
  }
  return 0;
}

function selectDatatable(tablename, datatable){
  $('#'+tablename+' tbody').on('click', 'tr', function () {
     if ($(this).hasClass('selected')) {
         $(this).removeClass('selected');
         array_selected = null;
     } else {
         datatable.$('tr.selected').removeClass('selected');
         $(this).addClass('selected');
         array_selected = datatable.row( this ).data();
     }
  });
}
