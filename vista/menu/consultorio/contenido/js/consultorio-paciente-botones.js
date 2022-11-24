$('#agregar-nota-historial').on('click', function(){
  var event = new Date();
  var options = { hours: 'numeric', minutes: 'numeric', weekday: 'long', year: 'numeric', month: 'short', day: 'numeric'};

  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/notas_historia_api.php",
    type: "POST",
    dataType: "json",
    data: { 
      api: 1,
      id_turno: pacienteActivo.array['ID_TURNO'],
      notas: $('#nota-historial-paciente').val()
    },
    success: function (data) {
      console.log(data);
      agregarNotaConsulta(session.nombre+" "+session.apellidos, event.toLocaleDateString('es-ES', options), $('#nota-historial-paciente').val(), '#notas-historial');
    }
  });
})

$('#btn-regresar-vista').click(function(){
  alertMensajeConfirm({
    title: "¿Está seguro de regresar?",
    text: "Asegurese de guardar los cambios",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }, function(){
    obtenerConsultorioMain();
  })
})




//
// <div id="notas-historial" class="mt-3">
//   <h4 class="m-3">INGLES: </h4>
//   <div style="margin: -1px 30px 20px 30px;">
//     <p class="none-p"><p>
//   </div>
// </div>
//
// <div id="notas-historial" class="card mt-3">
//   <h4 class="m-3">@Usuario actual <p style="font-size: 14px;margin-left: 5px;">xx:xx Septiembre dia, año</p></h4>
//   <div style="margin: -1px 30px 20px 30px;">
//     <p class="none-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
//   </div>
// </div>
