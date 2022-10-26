

function informacionConsulta(id, dataConsulta){

}






//Seccion para anamnesis por aparatos
$(document).on("change ,  keyup" , "input[type='radio']" ,function(){
     var parent_element = $(this).closest("div[class='row']");
    if (this.value == true) {
        var collapID = $(parent_element).children("div[class='collapse']").attr("id");
        $('#'+collapID).collapse("show")
        $('#'+collapID).find(':input').prop('required', true);
    }else{
        var collapID = $(parent_element).children("div[class='collapse show']").attr("id");
        $('#'+collapID).collapse("hide")
        $('#'+collapID).find(':input').val('')
        $('#'+collapID).find(':input').prop('required', false);
    }
});
