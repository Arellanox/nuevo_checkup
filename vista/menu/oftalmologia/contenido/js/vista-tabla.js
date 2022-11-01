
// console.log(dataListaPaciente)
tablaContenido = $('#TablaContenidoResultados').DataTable({
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
      // {
      //   data: 'EDAD', render: function(){
      //     return '';
      //   }
      // },
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO', render: function (data, type, full, meta) {
          return "20221014JMC412";
        },
      },
      {data: 'EDAD'},
      {data: 'GENERO'},
      {data: 'EDAD'},
      // {defaultContent: 'En progreso...'}
  ],
  // columnDefs: [
  //   { "width": "10px", "targets": 0 },
  // ],

})


selectDatatable("TablaContenidoResultados", tablaContenido, 2, {0:"pacientes_api"}, {0:"paciente"}, {0:"#panel-informacion"})
