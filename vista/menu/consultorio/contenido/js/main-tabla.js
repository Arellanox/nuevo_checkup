var tablaMain = $('#TablaListaConsultorio').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
      dataType: 'json',
      data: {api: 2},
      method: 'POST',
      url: '../../../api/pacientes_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out") },
      dataSrc:'response.data'
  },
  columns:[
      {data: 'COUNT'},
      {data: 'NOMBRE_COMPLETO'},
      {data: 'CLASIFICACION_EXAMEN'},
      {data: 'PREFOLIO'},
      {data: 'ACTIVO'},
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "3px", "targets": 0 },
  ],

})
