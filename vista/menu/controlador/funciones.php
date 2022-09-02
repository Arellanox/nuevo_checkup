<script type="text/javascript">


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


$( window ).on( 'hashchange', function( e ) {
    var hash = window.location.hash.substring(1);
    switch (hash) {
      case "Usuarios": obtenerContenidoUsuarios('administracion.php', 'Administración | Usuarios'); break;
      case "Clientes": obtenerContenidoClientes('clientes.php', 'Clientes'); break;
      case "Servicios": obtenerContenidoServicios('servicios.php', 'Servicios'); break;
      case "Segmentos": obtenerContenidoSegmentos('servicios.php', 'Servicios'); break;
      default: obtenerContenido('administracion.php', 'Administración | Usuarios'); break;
    }
} );

function loader(fade){
  if (fade == 'Out') {
    $("#ContenidoHTML").fadeToggle(1);
    $("#loader").removeClass("noloader");
    $("#loader").addClass("loader");
    $("#preloader").removeClass("preloader");
    $("#preloader").addClass("preloader");
  }else if (fade == 'In') {
    $("#loader").removeClass("loader");
    $("#loader").addClass("noloader");
    $("#preloader").addClass("preloader");
    $("#preloader").removeClass("preloader");
    $("#ContenidoHTML").fadeToggle(100);
  }
}

</script>
