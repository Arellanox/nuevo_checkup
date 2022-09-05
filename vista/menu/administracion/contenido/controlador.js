//Menu predeterminado
// window.location.hash = 'Usuarios';
// Variables globales
var array_paciente;
// ObtenerTabla o cambiar
obtenerContenidoUsuarios();
function obtenerContenidoUsuarios(){
  obtenerTitulo("Usuarios"); //Aqui mandar el nombre de la area
  obtenerTablaUsuarios()
}

function obtenerTablaUsuarios(){
  $.post("contenido/usuarios.php", function(html){
    var idrow;
     $("#body-js").html(html);
     // Datatable
     $.getScript("contenido/js/usuario-tabla.js");
     // Botones
     $.getScript("contenido/js/usuario-botones.js");

  });
}

function obtenerContenidoServicios(tabla, titulo){
  obtenerTitulo(titulo); //Aqui mandar el nombre de la area
  obtenerTablaServicios()
}

function obtenerTablaServicios(){
  $.post("contenido/servicios.php", function(html){
    var idrow;
     $("#body-js").html(html);
     // Datatable
     $.getScript("contenido/js/servicios-tabla.js");
     // Botones

  });
}
