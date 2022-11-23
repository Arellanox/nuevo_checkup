

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

function nuevoMedicamentoReceta(div){   
    html = '<div class="col-12 d-flex justify-content-end">'+
                '<div class="card m-3">'+
                '<div class="d-flex justify-content-end" style="margin-bottom: -36px;position: sticky;"> <button type="button" class="btn btn-hover m-2 eliminarRecetaActual" data-bs-id="id"> <i class="bi bi-trash"></i> </button> </div>'+
                '<div class="row m-2">'+
                    '<div class="col-4"><label for="estado" class="form-label">Nombre</label>                   <input type="text" class="form-control input-form" name="medicamentos[]" placeholder=""> </div>'+
'                    <div class="col-2"><label for="estado" class="form-label">Forma farmacéutica</label>       <input type="text" class="form-control input-form" name="medicamentos[]" placeholder=""> </div>'+
'                    <div class="col-2"><label for="estado" class="form-label">Dosis</label>                    <input type="text" class="form-control input-form" name="medicamentos[]" placeholder="" ></div>'+
                    '<div class="col-4"><label for="estado" class="form-label">Presentación</label>             <input type="text" class="form-control input-form" name="medicamentos[]" placeholder="" ></div>'+
                    '<div class="col-4"><label for="estado" class="form-label">Frecuencia</label>               <input type="text" class="form-control input-form" name="medicamentos[]" placeholder="" ></div>'+
                    '<div class="col-2"><label for="estado" class="form-label">Vía de administración</label>    <input type="text" class="form-control input-form" name="medicamentos[]" placeholder="" ></div>'+
                    '<div class="col-2"><label for="estado" class="form-label">Duración de tratamiento</label>  <input type="text" class="form-control input-form" name="medicamentos[]" placeholder="" ></div>'+
                    '<div class="col-4"><label for="estado" class="form-label">Indicaciones</label>             <input type="text" class="form-control input-form" name="medicamentos[]" placeholder="" ></div>'+
                '</div> </div> </div>';
    $(div).append(html);
}
