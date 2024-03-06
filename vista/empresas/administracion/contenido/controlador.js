obtenerAdministracionEmpresasMain()

let tablaFacturas, dataFacturas = {api: 14}
let tablaListaFacturas, dataListaFacturas = {api: 7, cliente_id: session.id_cliente}
let saldo_actual

async function obtenerAdministracionEmpresasMain() {
  await obtenerTitulo('Administracion de empresas');
  $.post("contenido/administracionEmpresas_main.html", function (html) {

    $("#body-js").html(html) // Rellenar la plantilla de consulta
  }).done(function () {

    // btn de administracion
    $.getScript("contenido/js/btn-empresas_administracion.js");

    saldoActual()
  });
}



function saldoActual() {
    ajaxAwait({ api: 13 }, 'maquilas_api', { callbackAfter: true, WithoutResponseData: true }, false, function (data) {
      saldo_actual = data[0]['DEUDA_ACTUAL']
      $('#saldoActual').html(`$${saldo_actual}`)
      loader("Out")
    })

}

