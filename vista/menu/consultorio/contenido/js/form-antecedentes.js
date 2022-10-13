
function setValues(id){


  $('#collapse-Patologicos-Target').find("div[class='row']").each(function(){
    console.log($(this).find("input[value='1']").val())
  })

  let frutas = [[2, "asdasd"]]

  for (var i = 0; i < 16; i++) {

    frutas.push([1, 'ajsndj'])
  }
  console.log(frutas)

  var divPatologicos = $('#collapse-Patologicos-Target').find("div[class='row']")
  for (var i = 0; i < divPatologicos.length; i++) {
    console.log(i)
    console.log('CHECK: '+frutas[i][0])
    switch (frutas[i][0]) {
      case 1:
        $(divPatologicos[i]).find("input[value='1']").prop("checked", true);
        var collapID = $(divPatologicos[i]).find("div[class='collapse']").attr("id");
        console.log(collapID)
        $('#'+collapID).collapse("show")
      break;

      case 2:
        $(divPatologicos[i]).find("input[value='2']").prop("checked", true);
        var collapID = $(divPatologicos[i]).find("div[class='collapse']").attr("id");
        $('#'+collapID).collapse("hide")
      break;
      default:
    }
    // console.log($(divPatologicos[i]).find("input[value='1']").val());

    console.log('textarea: '+frutas[i][1])
    console.log($(divPatologicos[i]).find("textarea[class='form-control input-form']"))
    $(divPatologicos[i]).find("textarea[class='form-control input-form']").val(frutas[i][1])

    // console.log(divPatologicos[i].find("input[value='1']").val())
  }
  // console.log(patologicos);


  // $("form#formID :input").each(function(){
  //  var input = $(this); // This is the jquery object of the input, do what you will
  //
  // });
  //
  // for (var i = 0; i < array.length; i++) {
  //   if (Number.isInteger(array[i])) {
  //
  //   }else{
  //
  //   }
  // }
}
