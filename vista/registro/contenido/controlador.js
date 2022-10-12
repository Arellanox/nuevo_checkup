// obtenerContenido o cambiar
obtenerContenido("registro.php");
function obtenerContenido(tabla){
  $.post("contenido/"+tabla, function(html){
     $("#body-js").html(html);
  });
}

function obtenerSignosVitales(div){
  $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/antecedentes-paciente.php", function (html) {
    setTimeout(function () {
      $(div).html(html);
    }, 100);

  });
}
