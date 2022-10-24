$('#agregar-nota-historial').on('click', function(){
  var event = new Date();
  var options = { hours: 'numeric', minutes: 'numeric', weekday: 'long', year: 'numeric', month: 'short', day: 'numeric'};

  agregarNotaConsulta(session.user, event.toLocaleDateString('es-ES', options), $('#nota-historial-paciente').val(), '#notas-historial');
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
