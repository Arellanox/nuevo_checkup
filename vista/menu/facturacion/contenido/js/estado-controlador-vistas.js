//Primer menu
$(document).on('click', '.VistaEstadoCuenta', function () {
  $('.VistaEstadoCuenta').removeClass('active')
  $('.VistaEstadoCuenta').removeClass('disabled')
  $(this).addClass('active');
  $(this).addClass('disabled');
  $('.vistaArea').fadeOut(0)
  switch ($(this).attr('data-ds')) {
    case "1":
        obtenerVistaFacturarCuenta()
      break;
    case "2":
        obtenerVistaGrupos()
      break;
    default:
  }
});

obtenerVistaFacturarCuenta()


let dataAjaxCargos = {api: 7}, selectCuenta = new GuardarArreglo();
// Obtener de primer vista el estado de cuenta


function obtenerVistaFacturarCuenta(){
  $('#VistaFacturarEstadoCuenta').fadeIn(0)
}

function obtenerVistaGrupos(){
  $('#vistaFacturarGrupoCuenta').fadeIn(0)
}

async function menu(vista) {
  $('.vistaFacturarSeccion').fadeOut(200)
  setTimeout(function(){
    switch (parseInt(vista)) {
      case 1:
        $('#TablaCargosVista').fadeIn(200)
        break;
      case 2:
        $('#FormularioFacturarPaciente').fadeIn(200)
        break;
      case 3:
        $('#FormularioFacturarCliente').fadeIn(200)
        break;
  
      default:
        console.log(vista)
        alert('Ningun menú seleccionado')
        break;
    }

  }, 200)

}



async function cargarDatosCuenta(data){ //Las 3 vistas
  getPanel('#vistaCargosFacturar', '#loader-estadoCuenta', '#loaderDivestadoCuenta', 1, 'In', async function(divClass){
    await obtenerPanelInformacion(34, 'pacientes_api', 'paciente', '#panel-informacion', '_facturar')

    menu(1)
    bugGetPanel('#vistaCargosFacturar', '#loader-estadoCuenta', '#loaderDivestadoCuenta') // <-- Soluciona el problema de mostrar el panel y quita el loaderDiv
  })
}


// cargarTabla
function obtenerTablaListaCargos(){
  
}



