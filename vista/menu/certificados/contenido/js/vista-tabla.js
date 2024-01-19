console.log(dataListaPaciente)
TablaContenidoPaciCertificados = $('#TablaContenidoPaciCertificados').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: false,
  paging: false,
  // searching: false,
  scrollY: "53vh",
  scrollCollapse: true,
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataListaPaciente);
    },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/certificados_api.php`,
    beforeSend: function () {
      loader("In")
    },
    complete: function () {
      loader("Out")
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PREFOLIO' },
    { data: 'CLIENTE' },
    { data: 'SEGMENTO' },
    { data: 'turno' },
    { data: 'GENERO' },
    { data: 'EXPEDIENTE' },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})

setTimeout(function () {
  inputBusquedaTable('TablaContenidoPaciCertificados', TablaContenidoPaciCertificados, [{
    msj: 'Una vez cargado o confirmado el reporte de un registro de esta area, aparecerán en verde',
    place: 'top'
  }], [], 'col-12')
}, 250)

selectTable('#TablaContenidoPaciCertificados', TablaContenidoPaciCertificados, { movil: true, reload: ['col-xl-7'] },
  async function (selectTR, array, callback) {

    datalist = array


    if (selectTR == 1) {

      dataSelect = new GuardarArreglo({
        select: true,
        // nombre_paciente: datalist['NOMBRE_COMPLETO'],
        turno: datalist['ID_TURNO']
      }, ifnull(datalist['CONFIRMADO'] == 1 ? 2 : false, datalist['GUARDADO']))

      $(`#${'nombre_paciente_certificado'}`).html(datalist['NOMBRE_COMPLETO']);

      await obtenerPanelInformacion(datalist['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab',)
      await obtenerPanelInformacion(datalist['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')

      // $('#accordinSignosSomatometria').callapse('show')
      // Abrir el acordion de resultados
      $("#accordinSignosSomatometria .accordion-button:first").removeClass('collapsed');
      $("#accordinSignosSomatometria .accordion-collapse:first").addClass('show');

      $('#btn-vistaPrevia').attr('turno_actual', datalist['ID_TURNO'])

      await btnCertificados({
        cliente: datalist['CLIENTE_ID'],
        cliente_label: datalist['CLIENTE'],
        genero: datalist['GENERO'],
        edad: datalist['EDAD'],
        turno: datalist['ID_TURNO'],
      }) //<- Funcion que alamacena la procedencia del paciente parta ir a global-botones.js

      // Mostrar caratula de POE
      // $('#')

      // Formato de estatus del formulario
      estadoFormulario(datalist['GUARDADO'], datalist['CONFIRMADO'])
      callback('In')
    }
    else {
      callback('Out')
    }
  })
