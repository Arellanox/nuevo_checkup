var tablaGrupos = $('#TablaGruposServicios').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: '58vh', //347px  scrollCollapse: true,
  scrollCollapse: true,
  lengthMenu: [[15, 20, 25, 30, 35, 40, 45, 50, -1], [15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
    dataType: 'json',
    data: { api: 7 },
    method: 'POST',
    url: '../../../api/servicios_api.php',
    beforeSend: function () { loader("In") },
    complete: function () { loader("Out") },
    dataSrc: 'response.data'
  },
  columns: [
    { data: 'COUNT' },
    { data: 'DESCRIPCION' },
    { data: 'ABREVIATURA' },
    { data: 'CLASIFICACION_EXAMEN' },
    { data: 'ES_PARA' },
    { data: 'DESCRIPCION_AREA' },
    {
      data: 'LABORATORIO', render: function (data, row, type) {
        if (row.LABORATORIO_ID == null) {
          return ''
        } else {
          return data
        }
      }
    },
    {
      data: 'SE_MAQUILA', render: function (data) {
        if (data === '0') {
          return ''
        } else {
          return 'Maquilado'
        }
      }
    },
    { data: 'INDICACIONES' },
    // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    // { "width": "3px", "targets": [0, 4] },
    { target: 0, title: '#', className: 'all' },
    { target: 1, title: 'Descripción', className: 'all' },
    { target: 2, title: 'Abreviatura', className: 'all' },
    { target: 3, title: 'Clasificación', className: 'min-tablet' },
    { target: 4, title: 'Dirigido', className: 'min-tablet' },
    { target: 5, title: 'Area', className: 'desktop' },
    { target: 6, title: 'Maquilado', className: 'all' },
    { target: 7, title: 'Subrogado', className: 'all' },
    { target: 8, title: 'Indicaciones', className: 'none' }
  ],

  dom: 'Blfrtip',
  buttons: [
    {
      text: '<i class="bi bi-pencil-square"></i> Editar',
      className: 'btn btn-pantone-7408',
      action: function () {
        if (array_selected != null) {
          getDataFirst(1, array_selected['ID_SERVICIO'])
        } else {
          alertSelectTable()
        }
      }
    },
    {
      text: '<i class="bi bi-box-seam"></i> Rellenar Grupo',
      className: 'btn btn-pantone-7408',
      action: function () {
        if (array_selected != null) {
          firstDataModal();
          alertToast('Espere un momento..', 'info', 2500)
        } else {
          alertSelectTable();
        }
      }
    },
    {
      extend: 'excelHtml5',
      text: '<i class="fa fa-file-excel-o"></i> Excel',
      className: 'btn btn-success',
      titleAttr: 'Excel',
      attr: {
        'data-bs-toggle': "tooltip",
        'data-bs-placement': "top",
        title: "Genere el formato por toda la tabla de pacientes o filtrado (Filtrado por: Fecha, Procedencia...)"
      }
      // exportOptions: {
      //   // Especifica las columnas que deseas exportar
      //   columns: [0, 1, 8, 3, 2, 4, 6, 7, 5, 9, 10, 11]
      // }

    }
  ],

})

inputBusquedaTable('TablaGruposServicios', tablaGrupos, [], [], '_', '_')

selectDatatable("TablaGruposServicios", tablaGrupos, 1, 'servicios_api', 'estudio')
