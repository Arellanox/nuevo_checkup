function setValues(id){
  return new Promise(resolve => {
    let arrayDivs = new Array;
    var divPatologicos = $('#collapse-Patologicos-Target').find("div[class='row']")


    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      data: {id: 1},
      type: "POST",
      success: function (data) {
        checkbox = data;
        for (var i = 0; i < checkbox.length; i++) {
          setValuesAntecedentesMetodo(arrayDivs[i], checkbox[i])
        }
      },
      complete: function(){
        resolve(1);
      }
    })
  });
  // $('#collapse-Patologicos-Target').find("div[class='row']").each(function(){
  //   console.log($(this).find("input[value='1']").val())
  // })
}

function setValuesAntecedentesMetodo(DIV, array){
  if (DIV.length == array.length) {
    for (var i = 0; i < DIV.length; i++) {
      // console.log(i)
      // console.log('CHECK: '+array[i][0])

      switch (array[i][0]) {
        case 1:
          $(DIV[i]).find("input[value='1']").prop("checked", true);
          var collapID = $(DIV[i]).find("div[class='collapse']").attr("id");
          // console.log(collapID)
          $('#'+collapID).collapse("show")
        break;
        case 2:
          $(DIV[i]).find("input[value='2']").prop("checked", true);
          var collapID = $(DIV[i]).find("div[class='collapse']").attr("id");
          $('#'+collapID).collapse("hide")
        break;
        default:
      }
      // console.log($(DIV[i]).find("input[value='1']").val());
      // console.log('textarea: '+array[i][1])
      // console.log($(DIV[i]).find("textarea[class='form-control input-form']"))
      if (array[i][0] == 1) {
        $(DIV[i]).find("textarea[class='form-control input-form']").val(array[i][1])
      }else{
        $(DIV[i]).find("textarea[class='form-control input-form']").val('')
      }

      // console.log(DIV[i].find("input[value='1']").val())
    }
  }else{
    alertSelectTable('No se pudo recuperar algunos datos...')
  }
}









// Metodos para rellenar el DOM


function obtenerAntecedentes(div){
  return new Promise(resolve => {
    $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/antecedentes-paciente.php", function (html) {
      $(div).html(html);
    }).done(function(){
      // alert("Done post")
      resolve(1);
    });

  });
}

function obtenerNotasHistorial(id){
  return new Promise(resolve => {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/notas_historia_api.php",
      type: "POST",
      dataType: "json",
      data: { id_paciente: id, api: 2 },
      success: function (data) {
        console.log(data);
        // agregarNotaConsulta('@Usuario actual', event.toLocaleDateString('es-ES', options), $('#nota-historial-paciente').val(), '#notas-historial')
      },
      complete:function(){
        resolve(1);
      }
    });
  });

}

function consultarConsulta(id){ return new Promise(resolve => {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
      type: "POST",
      data: { turno_id: id, api: 2 },
      dataType: "json",
      success: function (data) {
        console.log(data);
      },
      complete:function(){
        resolve(1);
      }
    });
  })
}

function obtenerHistorialConsultas(id){
  return new Promise(resolve => {
    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/turnos_api.php",
      type: "POST",
      dataType: "json",
      data: { id: id, api: 7 },
      success: function (data) {
        $('#historial-consultas-paciente').html('')
        let fecha = '01 Sep 2022';
        let nombre = 'Nombre medico';
        let motivo = 'motivo consulta';


        for (var i = 0; i < 5; i++) {
          $('#historial-consultas-paciente').append('<div class="row line-top" style="margin:0px">'+
                                                    '<div class="col-3 line-right">'+ fecha +'</div>'+
                                                    '<div class="col-9"><p>'+ nombre +'</p> <p>'+ motivo +'</p>'+
                                                    '</div> </div>')
        }



      },
      complete:function(){
        resolve(1);
      }
    });
  });
}
