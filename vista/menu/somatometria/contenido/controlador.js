
let pacienteActual = new GuardarArreglo()

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
    

    // Regresar si el paciente ya ha sido trabajado o no
    buscarPaciente(2, function(data){
      pacienteActual = new GuardarArreglo(data);
      console.log(pacienteActual.array)
      // cargarDatosPaciente(pacienteActual.array['ID_TURNO'], pacienteActual.array['ID_PACIENTE']);
      
      // Si el paciente ya ha sido trabajado, preguntar si desea omitir
      if (true) {
        cargarDatosPaciente(1,3)
      }else{
        pasarPacienteTurno(1, 3, 1, function (data){
          console.log(data);
          // Devolver el paciente a trabajar, para cargar:
          cargarDatosPaciente(1,3)
        })
      }
    })


  });
}




function cargarDatosPaciente(turno, id){
  //Mandar area y luego el callback;
  buscarPaciente(2, async function(data){
    await obtenerPanelInformacion(id, "pacientes_api", 'paciente');

    loader('Out')
  })
}
