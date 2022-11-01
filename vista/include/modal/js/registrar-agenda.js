//Formulario de registro de pruebas
// $('#formDIV *').prop('disabled',true);
$("#formDIV").fadeOut(400);
$('#btn-formregistrar-agenda').prop('disabled',true);
$('#eliminarForm').prop('disabled',true);
$('#curp-paciente').prop('readonly', false);

// Registrar agenda del paciente
$("#formRegistrarAgenda").submit(function(event){
    event.preventDefault();
    alert("form formAntecedentes-paciente")
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formRegistrarAgenda");
    var formData = new FormData(form);
    var formAntecedentes = document.getElementById('formAntecedentes');
    var formDataAntecedentes = new FormData(formAntecedentes)
    // console.log(formData.get('estudiosLab[]'))
    // if (formData.get('estudiosLab[]') == null) {
    //   Swal.fire({
    //      icon: 'error',
    //      title: 'Oops...',
    //      text: 'No ha seleccionado ninguna prueba!',
    //   })
    //   return
    // }
    // formData.set('antecedentes', json);
    formDataAntecedentes.set('curp', $('#curp-paciente').val())
    formDataAntecedentes.set('cliente_id', 1)
    // formDataAntecedentes.set('segmento_id', null) //$('#selectSegmentos').val()
    formDataAntecedentes.set('fechaAgenda', $('#fecha-agenda').val())
    formDataAntecedentes.set('api', 1);
    // console.log(formData);
    Swal.fire({
       title: '¿Está seguro que todos sus datos son correctos?',
       text: "¡No podrá volver a registrarse con su CURP hasta terminar la solicitud de registro anterior!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Sí, regístrame',
       cancelButtonText: "Cancelar"
     }).then((result) => {
       if (result.isConfirmed) {
         $("#btn-formregistrar-agenda").prop('disabled', true);

         $.ajax({
           data: formDataAntecedentes,
           url: http + servidor + "/nuevo_checkup/api/prerregistro_api.php",
           type: "POST",
           processData: false,
           contentType: false,
           beforeSend: function(){
             alertMensaje('info', '¡Se están cargando sus datos!', 'El sistema está guardando su agenda., Se enviará un correo de confirmación con su prefolio.')
           },
           success: function(data) {
             data = jQuery.parseJSON(data);
             if (mensajeAjax(data)) {
               if (data.response.code == 1) {
                 Toast.fire({
                   icon: 'success',
                   title: 'Su información a sido registrada :)',
                   timer: 2000
                 });
                 // Autocompletar el campo de prefolio y CURP en consulta de resultado

                 document.getElementById("formAntecedentes").reset();
                 if (session.user != null) {
                   $("#ModalRegistrarPrueba").modal('hide');
                   $("#btn-formregistrar-agenda").prop('disabled', false);
                 }
               }else{
                 alertMensaje('error', 'Agenda no registrada', 'Hubo un error, comuniquese con el personal.');
               }
             }
           },
         });
       }
     })
})

var tipoPaciente = "0"; //Particular por defecto

$('#actualizarForm').click(function(){

  //Solicitar si la curp existe
  // window.location.hash = "formDIV";

  // document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                //    'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                // '</div>';
  // $('#formDIV *').prop('disabled',false);

  // $('#btn-formregistrar-agenda').prop('disabled',false);
  curp = $('#curp-paciente').val();
  $.ajax({
    data: {curp:curp, api:2},
    url:  http + servidor + "/nuevo_checkup/api/pacientes_api.php",
    type: "POST",
    beforeSend: function(){
      $('#actualizarForm').prop('disabled',true);
    },
    success: function(data) {
      data = jQuery.parseJSON(data);
      if (mensajeAjax(data)) {
        if (data['response']['data'].length > 0) {
          Toast.fire({
            icon: 'success',
            title: 'CURP valida...',
            timer: 2000
          });
          $("#formDIV").fadeIn(400);
          $('#curp-paciente').prop('readonly', true);
          $('#eliminarForm').prop('disabled',false);
          document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                           'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                        '</div>';
          $('#paciente-registro').html(data.response.data[0].NOMBRE_COMPLETO);
          $('#curp-registro').html(data.response.data[0].CURP);
          $('#sexo-registro').html(data.response.data[0].GENERO);
          $('#procedencia-registro').html(data.response.data[0].PROCEDENCIA);
          // $('#formDIV *').prop('disabled',false);
          $('#btn-formregistrar-agenda').prop('disabled',false);
          obtenerSignosVitales('#antecedentes-registro')
        }else{
          $('#actualizarForm').prop('disabled',false);
          alertMensaje('error', 'Identificador invalido', 'Asegurese que que este usando correctamente su CURP o pasaporte');
        }
      }
    },
    error: function(){
      $('#actualizarForm').prop('disabled',false);
    }
  });

  // obtenerSignosVitales('#antecedentes-registro')
})

$('#eliminarForm').click(function(){
  $('#curp-paciente').prop('readonly', false);
  $('#eliminarForm').prop('disabled',true);
  $('#actualizarForm').prop('disabled',false);
  // $('#formDIV *').prop('disabled',true);
  $("#formDIV").fadeOut(400);
  $('#btn-formregistrar-agenda').prop('disabled',true);
  // window.location.hash = "curp-paciente";
  // $('##antecedentes-registro').html('')
})



// $('#btn-formregistrar-agenda').on('click', function(){
//   if ($('input[type="radio"]:not(:checked)').length != 126 ) {
//     alert($('input[type="radio"]:not(:checked)').length)
//     console.log($('input[type="radio"]:not(:checked)'))
//     $('input[type="radio"]').prop("checked", true);
//   }else{
//     var form = document.getElementById("formAntecedentes-paciente");
//     var formData = new FormData(form);
//     formData.set('curp', $('#curp-paciente').val())
//     formData.set('procedencia', tipoPaciente)
//     console.log(formData.getAll);
//   }
// })

$(document).on("change ,  keyup" , "input[type='radio']" ,function(){
     var parent_element = $(this).closest("div[class='row']");
    if (this.value == true) {
        var collapID = $(parent_element).children("div[class='collapse']").attr("id");
        $('#'+collapID).collapse("show")
        // $('#'+collapID).find(':input').prop('required', true);
    }else{
        var collapID = $(parent_element).children("div[class='collapse show']").attr("id");
        $('#'+collapID).collapse("hide")
        $('#'+collapID).find(':input').val('')
        // $('#'+collapID).find(':input').prop('required', false);
    }
});

if (registroAgendaProcedencia == 1) {
  $('#procedencia-agenda').html('<select class="form-control input-form" id="selectProcedencia"></select>')
}
// else{
//   $('#procedencia-agenda').html('<p id="procedencia-registro">PARTICULAR</p>')
// }




function obtenerSignosVitales(div){
  $.post(http + servidor + "/nuevo_checkup/vista/include/acordion/antecedentes-paciente.php", function (html) {
    setTimeout(function () {
      $(div).html(html);
      if (clienteRegistro) {
        switch (clienteRegistro) {
          case 1:
            $('#onlyProcedencia').fadeOut(0);
            $('#onlyMedico').fadeOut(0);
            break;
          default:
            $('#onlyMedico').fadeOut(0);
        }
      }
    }, 100);
  });
}

 // $("#formDIV").addClass("disable-div");
