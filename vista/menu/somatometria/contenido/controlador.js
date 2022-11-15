// ObtenerTabla o cambiar
obtenerContenidoMeso();
function obtenerContenidoMeso(){
  obtenerTitulo('Somatometría'); //Aqui mandar el nombre de la area
  $.post("contenido/mesometria.php", function(html){
    var idrow;
     $("#body-js").html(html);
  }).done(function(){
    // Botones
    $.getScript("contenido/js/somatometria-botones.js");
    cargarDatosPaciente(3);
  });
}




function cargarDatosPaciente(id){
  //Mandar area y luego el callback;
  buscarPaciente(2, async function(data){
    await obtenerPanelInformacion(id, "pacientes_api", 'paciente');
    loader('Out')
  })
}
