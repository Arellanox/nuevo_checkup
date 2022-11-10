// console.log(dataListaPaciente)
// tablaContenido = $('#TablaContenidoResultados').DataTable({
//   language: {
//     url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
//   },
//   lengthChange: false,
//   info: false,
//   paging: false,
//   scrollY: "55vh",
//   scrollCollapse: true,
//   ajax: {
//       dataType: 'json',
//       data: function (d) {
//         return $.extend(d, dataListaPaciente);
//       },
//       method: 'POST',
//       url: '../../../api/turnos_api.php',
//       beforeSend: function() { loader("In"), obtenerPanelInformacion(0, 'pacientes_api', 'paciente'), selectListaLab = null; },
//       complete: function(){ loader("Out") },
//       dataSrc:'response.data'
//   },
//   columns:[
//       // {
//       //   data: 'EDAD', render: function(){
//       //     return '';
//       //   }
//       // },
//       {data: 'NOMBRE_COMPLETO'},
//       {data: 'PREFOLIO', render: function (data, type, full, meta) {
//           return "20221014JMC412";
//         },
//       },
//       {data: 'EDAD'},
//       {data: 'GENERO'},
//       {data: 'GENERO'},
//       // {defaultContent: 'En progreso...'}
//   ],
//   // columnDefs: [
//   //   { "width": "10px", "targets": 0 },
//   // ],
//
// })


function tablaVistaMaster(data) {
  tablaContenido.destroy();
  $('#TablaContenidoResultados').empty();
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
        data: data,
        method: 'POST',
        url: '../../../api/turnos_api.php',
        beforeSend: function() { loader("In"), obtenerPanelInformacion(0, 'pacientes_api', 'paciente'), selectListaLab = null; },
        complete: function(){ loader("Out") },
        dataSrc:'response.data'
    },
    columns:[
        // {
        //   data: 'EDAD', render: function(){
        //     return '';
        //   }
        // },
        {data: 'COUNT'},
        {data: 'NOMBRE_COMPLETO'},
        {data: 'PREFOLIO', render: function (data, type, full, meta) {
            return "20221014JMC412";
          },
        },
        {data: 'EDAD'},
        {data: 'GENERO'},
        {data: 'GENERO'},
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
      { width: "5%", title: "#", targets: 0 },
      { title: "Nombre", targets: 1 },
      { title: "Prefolio", targets: 2 },
      { title: "Costo", targets: 3 },
      { title: "Procedencia", targets: 4},
      { title: "Edad", targets: 5 },
      { title: "Sexo", targets: 6 }
    ]
    // columnDefs: [
    //   { "width": "10px", "targets": 0 },
    // ],

  })

  selectDatatable('TablaContenidoResultados', tablaContenido, 0, 0, 0, 0, function(selectTR = null, array = null){
    selectPacienteArea = array;
    console.log(selectPacienteArea)
    if (selectTR == 1) {
      obtenerPanelInformacion(selectPacienteArea['ID_PACIENTE'], 'pacientes_api', 'paciente')
      $.ajax({
        url: http + servidor + "/nuevo_checkup/api/servicios_api.php",
        data: { api: 11, id_turno: selectPacienteArea['ID_TURNO'], id_area: areaActiva},
        type: "POST",
        datatype: 'json',
        success: function (data) {
          data = jQuery.parseJSON(data)
          console.log(data);
          selectEstudio = new GuardarArreglo(data.response.data);
          panelResultadoPaciente(data.response.data);
        },
        complete: function(){

        }
      })
    }else{
      obtenerPanelInformacion(0, 0, 'paciente')
    }

  })
}


function recargartabla(){
  dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoAreaMaster').val(), area_id: areaActiva}
  tablaVistaMaster(dataListaPaciente)
  // tablaContenido.ajax.reload();
  return 1;
}

// $('#TablaContenidoResultadosa tbody').on('click', 'tr', function () {
//   alert('oajnsdnji')
//    if ($(this).hasClass('selected')) {
//        $(this).removeClass('selected');
//        selectListaLab = null;
//        obtenerPanelInformacion(0, 'pacientes_api', 'paciente')
//        // getPanelLab('Out', 0)
//    } else {
//        tablaContenido.$('tr.selected').removeClass('selected');
//        $(this).addClass('selected');
//        selectListaLab = tablaContenido.row( this ).data();
//        obtenerPanelInformacion(selectListaLab['ID_PACIENTE'], 'pacientes_api', 'paciente')
//    }
// });



async function panelResultadoPaciente(row, area = areaActiva){
  switch (area) {
    case 7:

    break;
    case 8:

    break;
    case 5:

    break;
    case 4:

    break;
    case 3:

    break;
    default:

  }
  await obtenerPanelInformacion(1, null, 'resultados-areaMaster', '#panel-resultadosMaster')

  setTimeout(function(){
    for (var i = 0; i < row.length; i++) {
      console.log(row)
      if (row[i]['INTERPRETACION']) {
        let html =  '<hr> <div class="row" style="padding-left: 15px;padding-right: 15px;">'+
                    '<p style="padding-bottom: 10px">'+row[i]['SERVICIO']+':</p>'+
                    '<div class="col-7 d-flex justify-content-center">'+
                      '<a type="button" class="btn btn-borrar me-2" style="margin-bottom:4px" id="btn-analisis-pdf">'+
                        '<i class="bi bi-file-earmark-pdf"></i> Interpretación'+
                      '</a>'+
                    '</div>'+
                    '<div class="col-5 d-flex justify-content-center">'+
                      '<button type="button" class="btn btn-primary me-2" style="margin-bottom:4px" id="btn-analisis-pdf">'+
                        '<i class="bi bi-images"></i> Capturas'+
                      '</button>'+
                    '</div> </div> <hr>';
        $('#resultadosServicios-areas').append(html);
      }
    }
  }, 100);




}



// selectDatatable("TablaContenidoResultados", tablaContenido, 1, "pacientes_api", 'paciente')
