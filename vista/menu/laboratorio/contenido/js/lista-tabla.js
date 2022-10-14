tablaListaPaciente = $('#TablaLaboratorio').DataTable({
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
      url: '../../../api/pacientes_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){ loader("Out") },
      dataSrc:''
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
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})
loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');
$('#TablaLaboratorio tbody').on('click', 'tr', function () {
   if ($(this).hasClass('selected')) {
       $(this).removeClass('selected');
       array_selected = null;
       getPanelLab('Out', 0)
   } else {
       tablaListaPaciente.$('tr.selected').removeClass('selected');
       $(this).addClass('selected');
       array_selected = tablaListaPaciente.row( this ).data();
       getPanelLab('In', array_selected[0])
   }
});

$("#BuscarTablaListaLaboratorio").keyup(function () {
  tablaListaPaciente.search($(this).val()).draw();
});

async function getPanelLab(fade, id){
  switch (fade) {
    case 'Out':
        loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');
        $('.informacion-labo').fadeOut()
      break;
    case 'In':
        loaderDiv("In", null, "#loader-Lab", '#loaderDivLab');
        obtenerPanelInformacion(id, 'pacientes_api', 'paciente')
        await generarHistorialResultados(id)
        await generarFormularioPaciente(id)
        $('.informacion-labo').fadeIn()
    break;
    default:

  }
}

function generarHistorialResultados(id){ return new Promise(resolve => {
    // $('#accordionResultadosAnteriores').html('')
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/segmentos_api.php",
      type: "POST",
      dataType: 'json',
      data: { id: id, api: 6 },
      success: function (data) {



        
      },
      complete: function(){
        resolve(1);
      }
    });
  });
}

function generarFormularioPaciente(id){ return new Promise(resolve => {
    // $('#accordionResultadosAnteriores').html('')
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/segmentos_api.php",
      type: "POST",
      dataType: 'json',
      data: { id: id, api: 6 },
      success: function (data) {

      },
      complete: function(){
        loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');
        resolve(1);
      }
    });
  });
}
