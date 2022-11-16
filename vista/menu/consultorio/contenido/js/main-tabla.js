tablaMain = $('#TablaListaConsultorio').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
      dataType: 'json',
      data: {api: 5, area_id: 1},
      method: 'POST',
      url: '../../../api/turnos_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out") },
      dataSrc:'response.data'
  },
  columns:[
      {data: 'COUNT'},
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO'},
      {data: 'PROCEDENCIA'},
      {data: 'FECHA_AGENDA'},
      {data: 'GENERO'},
      {data: 'SEGMENTO'},
      // {defaultContent: 'En progreso...'}
  ]
  // columnDefs: [
  //   { "width": "3px", "targets": 0 },
  // ],

})


//Seleccion del paciente
selectDatatable('TablaListaConsultorio', tablaMain, 1, "pacientes_api", 'paciente')

//DobleClik para funcionalidad
dblclickDatatable('#TablaListaConsultorio', tablaMain, function(data){
  console.log(data);
  obtenerContenidoAntecedentes(data.ID_PACIENTE, data.ID_TURNO);
})


