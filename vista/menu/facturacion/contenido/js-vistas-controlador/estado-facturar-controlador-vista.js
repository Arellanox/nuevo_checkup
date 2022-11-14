$(document).on('click', '.vistaFacturar', function () {
  $('.vistaFacturar').removeClass('active')
  $('.vistaFacturar').removeClass('disabled')
  $(this).addClass('active');
  $(this).addClass('disabled');
  obtenerContenidoInfo(parseInt($(this).attr('data-ds')))
});

function obtenerContenidoInfo(number = 1, info = null){
  if(info != null){ //Para ejecutar una sola vez, desde botones.js
    // id = selectCuenta.array['ID_PACIENTE']; //Obtener id_paciente del estado de cuenta consultado
    obtenerPanelInformacion(3, "pacientes_api", 'paciente', '#panel-informacion', 'drop'); //Obtener reemplazar id
    cambiarVistaEstadoCuenta('In')
  }
  switch (number) {
    case 1:
      obtenerCargosPaciente(selectCuenta.array)
    break;
    case 2:
      obtenerFormFacturarPaciente(selectCuenta.array)
    break;
    case 3:
      obtenerFormFacturarGrupos(selectCuenta.array)
    break;
  
    default:
      break;
  }
}

function obtenerCargosPaciente(estadoCuenta){ //Arreglo de la informacion del estado de cuenta buscado

  $('#vistaCargosFacturar').fadeIn(0)
  dataAjaxCargos = {api: 7, params: 2}
  tablaCargosCuenta.ajax.reload()
}

function obtenerFormFacturarPaciente(estadoCuenta){
  // $('#FormularioFacturarPaciente').fadeIn(0);
}

function obtenerFormFacturarGrupos(estadoCuenta){
  // $('#FormularioFacturarCliente').fadeIn(0);
}

