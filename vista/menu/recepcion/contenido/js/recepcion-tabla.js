tablaRecepcionPacientes = $('#TablaRecepcionPacientes').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
      dataType: 'json',
      data: function (d) {
        return $.extend(d, dataRecepcion);
      },
      method: 'POST',
      url: '../../../api/recepcion_api.php',
      beforeSend: function() { loader("In"), array_selected = null },
      complete: function(){ loader("Out") },
      dataSrc:'response.data'
  },
  columns:[
      {data: 'COUNT'},
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO'},
      {data: 'NOMBRE_COMERCIAL'},
      {data: 'DESCRIPCION_SEGMENTO'},
      {data: 'FECHA_AGENDA'},
      {data: 'GENERO'}
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "5px", "targets": 0 },
  ],

})



selectDatatable("TablaRecepcionPacientes", tablaRecepcionPacientes, 1, "pacientes_api", 'paciente')
