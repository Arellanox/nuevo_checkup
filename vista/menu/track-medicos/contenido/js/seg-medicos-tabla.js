TablaMedicos = $('#TablaMedicos').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: true,
  paging: false,
  scrollY: '61vh',
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
    { targets: 2, title: 'Pacientes', className: "desktop", type: 'natural' },
    { targets: 3, title: 'Ultimo paciente:', className: 'none', type: 'natural' }
  ],

})

//new selectDatatable:
selectTable('#TablaMedicos', TablaMedicos, { unSelect: true, movil: true, reload: ['col-xl-8'] },
  async function (select, data, callback) {
    selectListaMuestras = data;
    tablaPacientesMedicos.clear().draw()
    if (select == 1) {

      // Información adicional
      $('#nombre-medico').html(data.NOMBRE_MEDICO);
      $('#correo-medico').html(data.EMAIL);
      let enviados = ifnull(data, 0, ['PACIENTES_ENVIADO']);
      $('#enviados-medico').html(enviados == 1 ? '1 paciente' : `${enviados} pacientes`)

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
  scrollY: '54vh',
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
      data: 'ID_TURNO', render: () => {
        return `<button type="button" class="btn-vizu-reporte btn btn-pantone-325" style="font-size: 20px;margin: 0px;padding: 1px 8px 1px 8px;">
                    <i class="bi bi-clipboard2-pulse-fill btn-vizu-reporte"></i>
                </button>`
      }
    },

    // Para las columnas del excel
    { data: 'FECHA_INGRESO' },
    { data: 'HORA_INGRESO' },
    { data: 'CORREO_MEDICO' },
    { data: 'CURP' },
    { data: 'DIRECCION' },
    { data: 'DIAGNOSTICO' },
    { data: 'GENERO' },

    {
      data: 'SUBTOTAL', render: function (data) {
        return `$${parseFloat(data).toFixed(2)}`;
      }
    },
    {
      data: 'IVA', render: function (data) {
        return `$${parseFloat(data).toFixed(2)}`;
      }
    },
    {
      data: 'TOTAL_CON_IVA', render: function (data) {
        return `$${parseFloat(data).toFixed(2)}`;
      }
    },

  ],
  columnDefs: [
    { targets: 0, title: '#', className: "all", width: "10px" },
    { targets: 1, title: 'Paciente', className: "all" },
    { targets: 2, title: 'Prefolio', className: "none" },
    { targets: 3, title: 'Procedencia', className: "desktop" },
    { targets: 4, title: 'Recepción', className: "all" },
    { targets: 5, title: 'Médico', className: "none" },
    { targets: 6, title: '#', className: "all" },

    // Para extraer en excel
    { targets: 7, title: 'Fecha de ingreso', className: "none", visible: false },
    { targets: 8, title: 'Hora de ingreso', className: "none", visible: false },
    { targets: 9, title: 'Correo médico', className: "none", visible: false },
    // { targets: 10, title: 'Correo', className: "none", visible: false },
    { targets: 10, title: 'CURP', className: "none", visible: false },
    { targets: 11, title: 'Dirección', className: "none", visible: false },
    { targets: 12, title: 'Diagnóstico', className: "none", visible: false },
    { targets: 13, title: 'Sexo', className: "none", visible: false },
    { targets: 14, title: 'Subtotal', className: "none", visible: false },
    { targets: 15, title: 'IVA', className: "none", visible: false },
    { targets: 16, title: 'Total', className: "none", visible: false },
  ],
  dom: 'Bl<"dataTables_toolbar">frtip',
  buttons: [
    {
      extend: 'excelHtml5',
      text: '<i class="fa fa-file-excel-o"></i> Excel',
      className: 'btn btn-success',
      titleAttr: 'Excel',
      attr: {
        'data-bs-toggle': "tooltip",
        'data-bs-placement': "top",
        title: "Genere el formato por toda la tabla de pacientes o filtrado (Filtrado por: Fecha, Procedencia...)"
      },
      exportOptions: {
        // Especifica las columnas que deseas exportar
        columns: [0, 1, 3, 2, 13, 10, 11, 12, 7, 8, 5, 9, 14, 15, 16]
      }

    },
  ],
})



//new selectDatatable:
selectTable('#tablaPacientesMedicos', tablaPacientesMedicos, {
  unSelect: true, noColumns: true,
  tabs: [
    {
      title: 'Pacientes',
      element: '#tab-paciente',
      class: 'active',
    },
    {
      title: 'Pacientes',
      element: '#tab-reporte',
      class: 'disabled tab-select'
    },
    {
      title: 'Información',
      element: '#tab-informacion',
      class: 'disabled tab-select'
    },
  ],
  "tab-default": 'Pacientes',
  ClickClass: [
    {
      class: 'btn-vizu-reporte',
      callback: function (data) {
        //  la id, y actualizar la tabla
        let id_turno = data.ID_TURNO

        // Los datos que recoge para poner en la tabla se ponen con el id_turno que se trae de la pestaña anterior
        dataDetallePacientesReportes = { api: 3, id_turno: id_turno }
        // Se recarga la vista cada vez que entra a un nuevo paciente
        TablaDetallePacientesReportes.clear().draw()
        TablaDetallePacientesReportes.ajax.reload()

        $('#adobe-dc-view').html("")

        // Se abre el molda una vez que se haya cargado todos los datos
        $('#ModalVisualizarDetallePacientes').modal('show');

        setTimeout(() => {
          TablaDetallePacientesReportes.columns.adjust().draw()
        }, 300);
      },
      selected: true,
    },
  ]
},
  async function (select, data, callback) {
    if (select) {
      obtenerPanelInformacion(data['ID_TURNO'], 'toma_de_muestra_api', 'estudios_muestras', '#panel-muestras-estudios')
      obtenerPanelInformacion(data['ID_TURNO'], 'paciente_api', 'paciente')
    } else {
      obtenerPanelInformacion(0, 'paciente_api', 'paciente')
      selectListaMuestras = null;
    }
  }
)

inputBusquedaTable('tablaPacientesMedicos', tablaPacientesMedicos, [
], [], 'col-18')