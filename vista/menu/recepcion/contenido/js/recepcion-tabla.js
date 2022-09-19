var TablaRecepcionPacientes = $('#TablaRecepcionPacientes').DataTable({
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
      url: '../../../api/pacientes_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out") },
      dataSrc:''
  },
  columns:[
      {data: 'COUNT'},
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO'},
      {data: 'PROCEDENCIA'},
      {data: 'SEGMENTO'},
      {data: 'INGRESO'},
      {data: 'GENERO'}
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "5px", "targets": 0 },
  ],

})
selectDatatable("TablaRecepcionPacientes", TablaRecepcionPacientes, 1, "pacientes_api", 'paciente')
