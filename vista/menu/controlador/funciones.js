
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
  $.ajax({
    url: "",
      type: "POST",
      data:{
        procedencia:id
      },
    success: function(data) {
      var selectoption = document.getElementById(select);
      for (var i = 0; i < data.length; i++) {
        var content = data[i]['procedencia'];
        var value = data[i]['id'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        selectoption.appendChild(el);
      }
    }
  });
}

// Obtener procedencias en select
function getProcedencias(select){
  $.ajax({
    url: "https://bimo-lab.com/antigeno/php/consulta_segmentos.php",
    type: "POST",
    success: function(data) {
      var data = jQuery.parseJSON(data);
      //Equipo Utilizado
      // console.log(data);
      var selectoption = document.getElementById(select);
      for (var i = 0; i < data.length; i++) {
        var content = data[i]['procedencia'];
        var value = data[i]['id'];
        var el = document.createElement("option");
        el.textContent = content;
        el.value = value;
        selectoption.appendChild(el);
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
}


// $( window ).on( 'hashchange', function( e ) {
//     var hash = window.location.hash.substring(1);
//     switch (hash) {
//       default:  break;
//     }
// } );

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
    default:
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'Hubo un problema!',
         footer: 'Reporte este error con el personal :)'
      })
  }
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
