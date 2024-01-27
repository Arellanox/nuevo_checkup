TablaMedicos = $('#TablaMedicos').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: true,
  paging: false,
  scrollY: autoHeightDiv(0, 384),
  scrollCollapse: true,
  ajax: {
    dataType: 'json',
    data: function (d) {
      return $.extend(d, dataListaPaciente);
    },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
    beforeSend: function () { loader("In") },
    complete: function () {
      loader("Out", 'bottom')

      //Para ocultar segunda columna
      reloadSelectTable()
    },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT', },
    { data: 'MEDICO' },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { targets: 0, title: '#', className: "all", width: "10px" },
    { targets: 1, title: 'Médico', className: "all" },
  ],

})

//new selectDatatable:
selectTable('#TablaMedicos', TablaMedicos, { unSelect: true, movil: true, reload: ['col-xl-9'] },
  async function (select, data, callback) {
    selectListaMuestras = data;
    if (select == 1) {
      //Procesos
      await obtenerPanelInformacion(selectListaMuestras['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')
      //Muestra las columnas
      callback('In')
    } else {
      // Oculta las columnas
      callback('Out')
      selectListaMuestras = null;
    }
  }
)



inputBusquedaTable('TablaMedicos', TablaMedicos, [{
  msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
  place: 'top'
}], [], 'col-12')
