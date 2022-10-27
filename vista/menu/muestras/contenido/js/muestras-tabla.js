tablaMuestras = $('#TablaMuestras').DataTable({
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
  },
  lengthChange: false,
  info: false,
  paging: false,
  scrollY: "55vh",
  scrollCollapse: true,
  // ajax: {
  //     dataType: 'json',
  //     data: function (d) {
  //       return $.extend(d, dataListaPaciente);
  //     },
  //     method: 'POST',
  //     url: '../../../api/turnos_api.php',
  //     beforeSend: function() { loader("In") },
  //     complete: function(){
  //       loader("Out")
  //       loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
  //       $('.informacion-muestras').fadeOut()
  //     },
  //     dataSrc:'response.data'
  // },
  // createdRow: function( row, data, dataIndex ){
  //     if ( data.EDAD == 31 )
  //     {
  //         $(row).addClass('bg-warning');
  //     }
  // },
  // columns:[
  //     {
  //       data: 'ID_PACIENTE', render: function(data){
  //         return '';
  //       }
  //     },
  //     {data: 'NOMBRE_COMPLETO'},
  //     {data: 'PREFOLIO', render: function (data, type, full, meta) {
  //         return "20221014JMC412";
  //       },
  //     },
  //     {data: 'EDAD'},
  //     {data: 'EDAD'},
  //     // {defaultContent: 'En progreso...'}
  // ],
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})

async function getPanelLab(fade, id, id_paciente){
  switch (fade) {
    case 'Out':
        if ($('.informacion-muestras').is(':visible')) {
          if (selectListaLab == null) {
            loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
            $('.informacion-muestras').fadeOut()
            // console.log('Invisible!')
          }
        }else{
          // console.log('Todavia visible!')
          setTimeout(function(){
            return getPanelLab('Out', 0)
          }, 100);

        }
      break;
    case 'In':
        $('.informacion-muestras').fadeOut(0)
        loaderDiv("In", null, "#loader-Lab", '#loaderDivLab', 0);
        obtenerPanelInformacion(3, "pacientes_api", 'paciente');
        // await obtenerPanelInformacion(id_paciente, 'pacientes_api', 'paciente_lab')
        await generarHistorialResultados(id)
        $('.informacion-muestras').fadeIn(100)
    break;
    default:
    return 0
  }
  return 1
}

function obtenerListaEstudiosContenedores(idturno){

}
