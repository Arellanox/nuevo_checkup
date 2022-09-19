

// ObtenerTabla o cambiar
obtenerContenidoRecepcion();
function obtenerContenidoRecepcion(tabla){
  obtenerTitulo('Recepción'); //Aqui mandar el nombre de la area
  $.post("contenido/recepcion.php", function(html){
    var idrow;
     $("#body-js").html(html);
     // Datatable
     $.getScript("contenido/js/recepcion-tabla.js");
     // Botones
     $.getScript("contenido/js/recepcion-botones.js");
  });
}

function recepciónPaciente(estatus, id){
  Swal.fire({
    title: '¿Estás seguro de '+estatus+' este paciente?',
    text: "",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Aceptar',
    cancelButtonText: 'Cancelar'
  }).then((result) => {
    if (result.isConfirmed) {
      switch (estatus) {
        case 'aceptar':
          Swal.fire({
             icon: 'success',
             title: 'Aceptado!',
             text: 'El pase del paciente se está generando...'
          })
          // Ajax para generar TURNO y generar pase
        break;
        case 'rechazar':
          Swal.fire(
            'Rechazado!',
            'El paciente a sido rechazado.',
            'error'
          )
          // Ajax para cancelar registro del paciente
          break;
        default:

      }
    }
  })
}

obtenerPanelInformacion(0, 0, 0)
