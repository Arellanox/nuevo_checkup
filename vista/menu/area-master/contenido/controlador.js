var tablaContenido, areaActiva = 1;
var dataListaPaciente = {api:7};
var selectPacienteArea, hash;
//Variable para guardar los servicios de un paciente seleccionado
var selectEstudio = new GuardarArreglo();
var selectrue = 0;

hasLocation();
$(window).on("hashchange", function (e) {
  hasLocation();
});

function hasLocation() {
  hash = window.location.hash.substring(1);
  // $("a").removeClass("navlinkactive");
  // $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
       if (sessionVista(hash) == true){
         switch (hash) {
          case "IMAGENOLOGIA":
            obtenerContenidoVistaMaster(7, 'Resultados de Imagenología');
          break;
          case "RX":
            obtenerContenidoVistaMaster(8, 'Resultados de Rayos X');
          break;
          case "ESPIROMETRIA":
            obtenerContenidoVistaMaster(5, 'Resultados de Espirometría');
          break;
          case "AUDIOMETRIA":
            obtenerContenidoVistaMaster(4, 'Resultados de Audiometría');
          break;
          case "OFTALMOLOGIA":
            obtenerContenidoVistaMaster(3, 'Resultados de Oftalmología');
          break;
          default:
            obtenerContenidoVistaMaster(7, 'Resultados de Imagenología');
            break;
        }
       }else{
         window.location.href = http + servidor + '/nuevo_checkup/vista/login/';
       }

}

function obtenerContenidoVistaMaster(area, titulo) {
  areaActiva = area;
  $.post("contenido/contenido.php", async function (html) {
    $("#body-js").html(html);
    await obtenerTitulo(titulo)
    dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: areaActiva}
  }).done(function(){
      // Datatable
      $.getScript("contenido/js/vista-tabla.js")
      // Botones
      $.getScript("contenido/js/area-botones.js")
  });
}

// obtenerContenidoRX()
function sessionVista(areaVista) {
  let vista = session.vista;
  return vista[areaVista] == 1 ? true:false;
}
