

function obtenerInformacionConsulta(id){ return new Promise(resolve => {
    $.ajax({
        url: http + servidor + "/nuevo_checkup/api/consulta_api.php",
        type: "POST",
        dataType: "json",
        data: {id_consulta: id, api: 2},
        success: function (data) {
            if (mensajeAjax(data)) {
                let row = data.response.data[0]
                console.log(row)
                $('#motivo-consulta').html(row.MOTIVO_CONSULTA)
                $('#fechaConsulta-consulta').html(formatoFecha2(row.FECHA_CONSULTA, [0,1,2,2,0,0,0]))
                $('#nota-notas-padecimiento').val(row.NOTAS_PADECIMIENTO)
                $('#diagnostico-consultas').val(row.DIAGNOSTICO)
            }
        },
        complete: function(){
            resolve(1);
        }
    })
  })
}

function obtenerInformacionPaciente(data){ return new Promise(resolve => {
    $('#nombre-paciente-consulta').html(data.NOMBRE_COMPLETO);
    $('#nacimiento-paciente-consulta').html(formatoFecha2(data.NACIMIENTO, [3,1,2,2,0,0,0]))
    $("#edad-paciente-consulta").html(data.EDAD)
    $('#genero-paciente-consulta').html(data.GENERO)
    $('#correo-paciente-consulta').html(data.CORREO)
    $('#curp-paciente-consulta').html(data.CURP)
    resolve(1)
  });
}

function obtenerNotaPadecimiento(id){

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
