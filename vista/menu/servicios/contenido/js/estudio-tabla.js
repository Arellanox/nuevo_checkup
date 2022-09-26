var tablaServicio = $('#TablaEstudioServicio').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
      dataType: 'json',
      data: {api: 2},
      method: 'POST',
      url: '../../../api/servicios_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out") },
      dataSrc:''
  },
  columns:[
      {data: 'COUNT'},
      {data: 'DESCRIPCION'},
      {data: 'CLASIFICACION_EXAMEN'},
      {data: 'DESCRIPCION_AREA'},
      {data: 'ACTIVO'},
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "3px", "targets": 0 },
  ],

})

selectDatatable("TablaEstudioServicio", tablaServicio, 1, 'servicios_api', 'estudio')
