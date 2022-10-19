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
        if ($('.informacion-labo').is(':visible')) {
          loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
          $('.informacion-labo').fadeOut()
          // console.log('Invisible!')
        }else{
          // console.log('Todavia visible!')
          setTimeout(function(){
            return getPanelLab('Out', 0)
          }, 100);

        }
      break;
    case 'In':
        $('.informacion-labo').fadeOut(0)
        loaderDiv("In", null, "#loader-Lab", '#loaderDivLab', 0);
        obtenerPanelInformacion(id, 'pacientes_api', 'paciente')
        await generarHistorialResultados(id)
        await generarFormularioPaciente(id)
        $('.informacion-labo').fadeIn(100)
    break;
    default:
    return 0
  }
  return 1
}

function generarHistorialResultados(id){ return new Promise(resolve => {
    // $('#accordionResultadosAnteriores').html('')
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/servicio_api.php",
      type: "POST",
      dataType: 'json',
      data: { id: id, api: 6 },
      success: function (data) {
        let itemStart = '<div class="accordion-item bg-acordion">';
        let itemEnd = '</div>';

        let bodyStart = '<div class="accordion-body">'+
                          '<div class="row">';
        let bodyEnd =     '</div>'+
                        '</div>';
        let html = '';

        for (var i = 0; i < 5; i++) {
          html += itemStart;
          html += '<h2 class="accordion-header" id="collap-historial-estudios'+i+'">'+
                    '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio'+i+'-Target" aria-expanded="false" aria-controls="accordionEstudios">'+
                      '<div class="row">'+
                        '<div class="col-12">'+
                          '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha'+i+': <strong>xx/xx/2000 '+i+'</strong> <strong>12:00 '+i+'</strong>'+
                        '</div>'+
                        '<div class="col-12">'+
                          '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado '+i+': <strong>@Usuario que confirmó '+i+'</strong>'+
                        '</div>'+
                      '</div>'+
                    '</button>'+
                  '</h2>'+
                  '<div id="collapse-estudio'+i+'-Target" class="accordion-collapse collapse" aria-labelledby="collap-historial-estudios'+i+'">';
          html += bodyStart;
          for (var e = 0; e < 5; e++) {
            html += '<div class="col-6 text-end info-detalle"><p>Estudio '+e+':</p></div><div class="col-6">*Resultado '+e+'*</div>';
          }
          html += bodyEnd + '</div>';
          html += itemEnd;
        }
        $('#accordionResultadosAnteriores').html(html);

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
      url: http + servidor + "/nuevo_checkup/api/servicio_api.php",
      type: "POST",
      dataType: 'json',
      data: { id: id, api: 0 },
      success: function (data) {
        let colStart = '<div class="col-auto col-lg-6">';
        let endDiv = '</div>';
        let colreStart = '<div class="col-auto col-lg-6 d-flex justify-content-end align-items-center">';
        let html = '';

        for (var i = 0; i < 5; i++) {
          html += '<li class="list-group-item">';
          html += '<div class="row d-flex align-items-center">';
          html += colStart;
          html += '<p><i class="bi bi-box-arrow-in-right" style=""></i> Estudio</p>';
          html += endDiv;
          html += colreStart;
          html += '<div class="input-group">';
          html += '<input type="text" class="form-control input-form" name="estudio'+i+'" placeholder="valor de resultado" required>';
          html += '<span class="input-span">Medida</span>';
          html += '</div>';
          html += endDiv;
          html += endDiv;
          html += '</li>';
        }
        $('#list-group-form-resultado-laboro').html(html);


        idsEstudios = [1,2,3,4,5];
      },
      complete: function(){
        loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
        resolve(1);
      }
    });
  });
}
