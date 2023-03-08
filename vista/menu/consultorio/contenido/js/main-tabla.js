tablaMain = $('#TablaListaConsultorio').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: autoHeightDiv(0, 400),
  lengthChange: false,
  scrollCollapse: true,
  paging: false,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
    dataType: 'json',
    data: { api: 5, area_id: 1 },
    method: 'POST',
    url: '../../../api/turnos_api.php',
    beforeSend: function () { loader("In") },
    complete: function () { loader("Out") },
    dataSrc: 'response.data'
  },
  createdRow: function (row, data, dataIndex) {
    if (data.CONFIRMADO_HISTORIA == 1) {
      $(row).addClass('bg-success text-white');
    }
    // $(row).addClass('text-white');

  },
  columns: [
    { data: 'COUNT' },
    { data: 'NOMBRE_COMPLETO' },
    { data: 'PREFOLIO' },
    { data: 'CLIENTE' },
    {
      data: 'FECHA_AGENDA',
      render: function (data) {
        return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
      }
    },
    { data: 'GENERO' },
    { data: 'SEGMENTO' },
    // {defaultContent: 'En progreso...'}
  ]
  // columnDefs: [
  //   { "width": "3px", "targets": 0 },
  // ],


})

//Buscador
$("#BuscarTablaLista").keyup(function () {
  tablaMain.search($(this).val()).draw();
});


//Seleccion del paciente
// selectDatatable('TablaListaConsultorio', tablaMain, 1, "pacientes_api", 'paciente',)
selectDatatable('TablaListaConsultorio', tablaMain, 0, 0, 0, 0, function (selectTR = null, data = null) {
  if (selectTR == 1) {
    obtenerPanelInformacion(data['ID_PACIENTE'], 'pacientes_api', 'paciente')
    obtenerPanelInformacion(data['ID_TURNO'], "signos-vitales_api", 'signos-vitales', '#signos-vitales');

  } else {
    obtenerPanelInformacion(0, 'pacientes_api', 'paciente')
    obtenerPanelInformacion(0, "signos-vitales_api", 'signos-vitales', '#signos-vitales');
    // console.log('rechazado')
    // getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
    // getPanelLab('Out', 0, 0)
  }
  //DobleClik para funcionalidad
}, function (data) {
  obtenerContenidoAntecedentes(data);
})

// //DobleClik para funcionalidad
// dblclickDatatable('#TablaListaConsultorio', tablaMain, function (data) {
//   // console.log(data);

// })


