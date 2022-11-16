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
      complete: function(){
        loader("Out")
        loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
        $('.informacion-labo').fadeOut()
      },
      dataSrc:'response.data'
  },
  createdRow: function( row, data, dataIndex ){
      if ( data.CONFIRMADO == 1 ){
        $(row).addClass('bg-success text-white');
      }else{
        $(row).addClass('bg-warning');
      }
  },
  columns:[
      {
        data: 'ID_PACIENTE', render: function(data){
          return '';
        }
      },
      {data: 'NOMBRE_COMPLETO'},
      {data: 'PREFOLIO', render: function (data, type, full, meta) {
          return "20221014JMC412";
        },
      },
      {data: 'EDAD'},
      {data: 'EDAD'},
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "10px", "targets": 0 },
  ],

})
loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');

selectDatatable('TablaLaboratorio', tablaListaPaciente, 0, 0, 0, 0, function(selectTR = null, array = null){
  selectListaLab = array;
  if (selectTR == 1) {
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'In', async function(divClass){
        await obtenerPanelInformacion(selectListaLab['ID_PACIENTE'], 'pacientes_api', 'paciente_lab')
        await generarHistorialResultados(selectListaLab['ID_PACIENTE'])
        await generarFormularioPaciente(selectListaLab['ID_TURNO'])

        if (selectListaLab.CONFIRMADO == 1) {
          $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', true)
          $('#formAnalisisLaboratorio :input').prop('disabled', true)
        }else {
          $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', false)
          $('#formAnalisisLaboratorio :input').prop('disabled', false)
        }

        while (!$(divClass).is(':visible')) {
          if (!$(divClass).is(':visible')) {
            setTimeout(function(){
              $(divClass).fadeIn(0)
              console.log("Visible!")
            }, 100)
          }
          $(divClass).fadeIn(0)
        }
      });
    // getPanelLab('In', selectListaLab['ID_TURNO'], selectListaLab['ID_PACIENTE'])
  }else{
    // console.log('rechazado')
    getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab',selectListaLab, 'Out')
    // getPanelLab('Out', 0, 0)
  }
})

$("#BuscarTablaListaLaboratorio").keyup(function () {
  tablaListaPaciente.search($(this).val()).draw();
});

function generarHistorialResultados(id){ return new Promise(resolve => {
    // $('#accordionResultadosAnteriores').html('')
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      type: "POST",
      dataType: 'json',
      data: { id_paciente: id, api: 6, id_area: 6 },
      success: function (data) {
        row = data.response.data;
        console.log("Haciendo el historial de resultados")
        console.log(data.response.data)
        console.log(row)
        let itemStart = '<div class="accordion-item bg-acordion">';
        let itemEnd = '</div>';

        let bodyStart = '<div class="accordion-body">'+
                          '<div class="row">';
        let bodyEnd =     '</div>'+
                        '</div>';
        let html = '';

        for (var i = 0; i < row.length; i++) {
          html += itemStart;
          html += '<h2 class="accordion-header" id="collap-historial-estudios'+i+'">'+
                    '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio'+i+'-Target" aria-expanded="false" aria-controls="accordionEstudios">'+
                      '<div class="row">'+
                        '<div class="col-12">'+
                          '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>'+row[i]['FECHA_RESULTADO']+'</strong> '+ //<strong>12:00 '+i+'</strong>
                        '</div>'+
                        '<div class="col-12">'+
                          '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>@Usuario que confirmó '+i+'</strong>'+
                        '</div>'+
                      '</div>'+
                    '</button>'+
                  '</h2>'+
                  '<div id="collapse-estudio'+i+'-Target" class="accordion-collapse collapse overflow-auto" aria-labelledby="collap-historial-estudios'+i+'" style="max-height: 70vh"> ';
          html += '<p class="none-p" style="margin: 12px 0px 0px 15px;">Ver <a href="' + row[i]['servicios']['URL']+'">RESULTADO</a> aquí</p>';
          html += bodyStart;
          for (var l = 0; l < row[i]['servicios'].length; l++) {
            html += '<div class="col-8 text-start info-detalle"><p>'+row[i]['servicios'][l]['SERVICIO']+':</p></div><div class="col-4 text-start d-flex align-items-center">'+row[i]['servicios'][l]['RESULTADO']+' '+row[i]['servicios'][l]['MEDIDA_ABREVIATURA']+'</div> <hr style="margin: 3px"/>'; //
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
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      type: "POST",
      dataType: 'json',
      data: { id_turno: id, api: 8, id_area: 6},
      success: function (data) {
        data = data.response.data;

        let colStart = '<div class="col-auto col-lg-6">';
        let endDiv = '</div>';
        let colreStart = '<div class="col-auto col-lg-6 d-flex justify-content-end align-items-center">';
        let html = '';

        for (var i = 0; i < data.length; i++) {
          html += '<li class="list-group-item">';
          html += '<div class="row d-flex align-items-center">';
          html += colStart;
          html += '<p><i class="bi bi-box-arrow-in-right" style=""></i> '+data[i]['DESCRIPCION_SERVICIO']+'</p>';
          html += endDiv;
          html += colreStart;
          html += '<div class="input-group">';
          if (data[i]['RESULTADO'] == null) {
            html += '<input type="number" class="form-control input-form" name="servicios['+data[i]['ID_SERVICIO']+']" required autocomplete="off">';
          }else{
            html += '<input type="number" class="form-control input-form" name="servicios['+data[i]['ID_SERVICIO']+']" required value="'+data[i]['RESULTADO']+'" autocomplete="off">';
          }
          html += '<span class="input-span">'+data[i]['DESCRIPCION_MEDIDA']+'</span>';
          html += '</div>';
          html += endDiv;
          html += endDiv;
          html += '</li>';
          // idsEstudios.push[data[i]['ID_SERVICIO']]
        }
        $('#list-group-form-resultado-laboro').html(html);
      },
      complete: function(){
        loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
        resolve(1);
      }
    });
  });
}
