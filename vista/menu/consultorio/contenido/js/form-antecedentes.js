function setValues(id){
  return new Promise(resolve => {
    let arrayDivs = new Array;
    var divPatologicos = $('#collapse-Patologicos-Target').find("div[class='row']")


    $.ajax({
      url: http + servidor + "/nuevo_checkup/api/pacientes.php",
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
