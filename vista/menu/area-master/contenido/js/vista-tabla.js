// console.log(dataListaPaciente)
tablaContenido = $('#TablaEstudiosContenido').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "55vh",
  scrollCollapse: true,
  ajax: {
      dataType: 'json',
      data: function (d) {
        return $.extend(d, dataListaPaciente);
      },
      method: 'POST',

      url: '../../../api/turnos_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out") },
      dataSrc:'response.data'
  },
  columns:[
      {data: 'COUNT'},
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO', render: function (data, type, full, meta) {
          return "20221014JMC412";
        },
      },
      {data: 'PROCEDENCIA'},
      {data: 'EDAD'},
      // {defaultContent: 'En progreso...'}
  ],
  // columnDefs: [
  //   { "width": "10px", "targets": 0 },
  // ],

})
