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
    url: `${http}${servidor}/${appname}/api/tracking_medicos_api.php`,
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
    { data: 'NOMBRE_MEDICO' },
    {
      data: 'PACIENTES_ENVIADO', render: function (data, type) {
        if (type === 'sort') {
          return data;
        } else {
          return `${data} enviado${data > 1 ? 's' : ''}`
        }
      }
    }
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { targets: 0, title: '#', className: "all", width: "10px" },
    { targets: 1, title: 'Médico', className: "all" },
    {
      targets: 2, title: 'Pacientes', className: "all",
      // type: 'num', // Establece el tipo de la columna como numérico
      // render: function (data, type, row) {
      //   // Para ordenamiento y tipo, devuelve solo el número
      //   if (type === 'sort' || type === 'type') {
      //     return data.replace(/\D/g, ''); // Esto eliminará todos los caracteres no dígitos
      //   }
      //   // Para otros tipos (display, filter, etc.), devuelve el formato original
      //   return data;
      // }
    },
  ],

})

//new selectDatatable:
selectTable('#TablaMedicos', TablaMedicos, { unSelect: true, movil: true, reload: ['col-xl-8'] },
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
