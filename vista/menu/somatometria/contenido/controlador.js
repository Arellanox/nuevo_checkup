
let pacienteActual = new GuardarArreglo()
var turno;

// ObtenerTabla o cambiar

if (validarVista('SOMATOMETRIA')){
  obtenerContenidoMeso();
}

function obtenerContenidoMeso(){
  obtenerTitulo('Somatometría'); //Aqui mandar el nombre de la area
  $.post("contenido/mesometria.php", function(html){
    var idrow;
     $("#body-js").html(html);
  }).done(function(){
    
    // Regresar si el paciente ya ha sido trabajado o no
    buscarPaciente(2, function(data){
      pacienteActual = new GuardarArreglo(data);//Mandar si el paciente ya tiene signos vitales
      console.log(pacienteActual.array)
      // cargarDatosPaciente(pacienteActual.array['ID_TURNO'], pacienteActual.array['ID_PACIENTE']);
      turno = 60;
      // Botones
      $.getScript("contenido/js/somatometria-botones.js");
      // Si el paciente ya ha sido trabajado, preguntar si desea omitir
      if (true) {
        cargarDatosPaciente(turno,35)
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




async function cargarDatosPaciente(turno, id){
  //Mandar area y luego el callback;
  await obtenerPanelInformacion(id, "pacientes_api", 'paciente');

  loader('Out')
}
