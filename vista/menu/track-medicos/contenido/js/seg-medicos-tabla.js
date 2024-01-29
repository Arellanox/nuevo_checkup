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
        return `${data} enviado${data > 1 ? 's' : ''}`
      }
    },
    {
      data: 'FECHA_RECEPCION', render: function (data) {
        return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0], null);
      }
    }
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { targets: 0, title: '#', className: "all", width: "10px" },
    { targets: 1, title: 'Médico', className: "all" },
    { targets: 2, title: 'Pacientes', className: "all", type: 'natural' },
    { targets: 3, title: 'Ultimo paciente:', className: 'none', type: 'natural' }
  ],

})

//new selectDatatable:
selectTable('#TablaMedicos', TablaMedicos, { unSelect: true, movil: true, reload: ['col-xl-8'] },
  async function (select, data, callback) {
    selectListaMuestras = data;
    if (select == 1) {

      // Información adicional
      $('#nombre_medico').html(data.NOMBRE_MEDICO);
      dataPacientes['id_medico'] = data.ID_MEDICO;
      tablaPacientesMedicos.ajax.reload();
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
  msj: 'Listado con los médicos más recientes',
  place: 'top'
}], [], 'col-12')






let dataPacientes = { api: 2 }
tablaPacientesMedicos = $('#tablaPacientesMedicos').DataTable({
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
      return $.extend(d, dataPacientes);
    },
    method: 'POST',
    url: `${http}${servidor}/${appname}/api/tracking_medicos_api.php`,
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT', },
    { data: 'PX' },
    { data: 'PREFOLIO' },
    { data: 'PROCEDENCIA' },
    {
      data: 'FECHA_RECEPCION', render: (data) => {


        const formattedDate = formatoFecha2(data, [0, 1, 5, 2, 2, 2, 0], null);

        // Separar la fecha y la hora basado en la coma
        const parts = formattedDate.split(', ');
        const datePart = parts[0];
        const timePart = parts[1];

        // Retornar la fecha y la hora envueltas en spans con las clases correspondientes
        return `
            <span class="d-block">${datePart}</span>
            <span class="d-block">${timePart}</span>
        `;

      }
    },
    { data: 'NOMBRE_MEDICO' },
    {
      data: 'ID_TURNO', render: (data) => {
        return `<button type="button" data-bs-id="${data}" class="btn-vizu-reporte btn btn-pantone-325" style="font-size: 20px;margin: 0px;padding: 1px 8px 1px 8px;">
                    <i class="bi bi-clipboard2-pulse-fill btn-vizu-reporte"></i>
                </button>`
      }
    }
  ],
  columnDefs: [
    { targets: 0, title: '#', className: "all", width: "10px" },
    { targets: 1, title: 'Paciente', className: "all" },
    { targets: 2, title: 'Prefolio', className: "max-tablet" },
    { targets: 3, title: 'Procedencia', className: "min-tablet" },
    { targets: 4, title: 'Recepción', className: "all" },
    { targets: 5, title: 'Médico', className: "none" },
    { targets: 6, title: '#', className: "all" },

  ],

})
