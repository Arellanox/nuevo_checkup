//Formulario de registro de pruebas
$('#formDIV *').prop('disabled',true);
$("#formDIV").fadeToggle(400);
$('#btnFormRegistrarPruba').prop('disabled',true);
$('#eliminarForm').prop('disabled',true);
$('#curp-paciente').prop('readonly', false);

var tipoPaciente = "0"; //Particular por defecto

$('#actualizarForm').click(function(){
  //Solicitar si la curp existe
  // window.location.hash = "formDIV";

  // document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                //    'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                // '</div>';
  // $('#formDIV *').prop('disabled',false);

  // $('#btnFormRegistrarPruba').prop('disabled',false);
  curp = document.getElementById("curp-paciente").value;
  $.ajax({
    data: {curp:curp, api:2},
    url: "../../api/pacientes_api.php",
    type: "POST",
    success: function(data) {
      data = jQuery.parseJSON(data);
      if (mensajeAjax(data)) {
        if (data.response.data != null) {
          Toast.fire({
            icon: 'success',
            title: 'CURP valida...',
            timer: 2000
          });
          $("#formDIV").fadeToggle(400);
          $('#curp-paciente').prop('readonly', true);
          $('#eliminarForm').prop('disabled',false);
          $('#actualizarForm').prop('disabled',true);
          document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                           'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                        '</div>';
          $('#paciente-registro').html(data.response.data[0].NOMBRE_COMPLETO);
          $('#curp-registro').html(data.response.data[0].CURP);
          $('#sexo-registro').html(data.response.data[0].GENERO);
          $('#procedencia-registro').html(data.response.data[0].PROCEDENCIA);
          $('#formDIV *').prop('disabled',false);
          $('#btnFormRegistrarPruba').prop('disabled',false);
          obtenerSignosVitales('#antecedentes-registro')
        }else{
          alertMensaje('error', 'Identificador invalido', 'Asegurese que que este usando correctamente su CURP o pasaporte');
        }
      }
    },
  });

  // obtenerSignosVitales('#antecedentes-registro')
})

$('#eliminarForm').click(function(){
  $('#curp-paciente').prop('readonly', false);
  $('#eliminarForm').prop('disabled',true);
  $('#actualizarForm').prop('disabled',false);
  // $('#formDIV *').prop('disabled',true);
  $("#formDIV").fadeToggle(400);
  $('#btnFormRegistrarPruba').prop('disabled',true);
  // window.location.hash = "curp-paciente";
  // $('##antecedentes-registro').html('')
})

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
    formDataAntecedentes.set('procedencia', 'Particular')
    formDataAntecedentes.set('segmento', $('#selectSegmentos').val())
    formDataAntecedentes.set('fechaAgenda', $('#fecha-agenda').val())
    formDataAntecedentes.set('api', 1);
    // console.log(formData);
    Swal.fire({
       title: '¿Está seguro de haber seleccionado todo?',
       text: "¡No podrá volverse a regisrtrar con su CURP hasta terminar la solicitud de registro anterior!",
       icon: 'warning',
       showCancelButton: true,
       confirmButtonColor: '#3085d6',
       cancelButtonColor: '#d33',
       confirmButtonText: 'Si, registrame',
       cancelButtonText: "Cancelar"
     }).then((result) => {
       if (result.isConfirmed) {
         $("#btn-registrarse").prop('disabled', true);

         $.ajax({
           data: formDataAntecedentes,
           url: "../../api/prerregistro_api.php",
           type: "POST",
           processData: false,
           contentType: false,
           success: function(data) {
             data = jQuery.parseJSON(data);
             switch (data['codigo'] == 1) {
               case 1:
                 Toast.fire({
                   icon: 'success',
                   title: 'Su información a sido registrada :)',
                   timer: 2000
                 });
                 // Autocompletar el campo de prefolio y CURP en consulta de resultado

                 document.getElementById("formAntecedentes-paciente").reset();
                 $("#ModalRegistrarPrueba").modal('hide');
               break;
               default:
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Hubo un problema!',
                    footer: 'Reporte este error con el personal :)'
                 })
             }
           },
         });
       }
     })
})


$('#btnFormRegistrarPruba').on('click', function(){
  if ($('input[type="radio"]:not(:checked)').length != 126 ) {
    alert($('input[type="radio"]:not(:checked)').length)
    console.log($('input[type="radio"]:not(:checked)'))
    $('input[type="radio"]').prop("checked", true);
  }else{
    var form = document.getElementById("formAntecedentes-paciente");
    var formData = new FormData(form);
    formData.set('curp', $('#curp-paciente').val())
    formData.set('procedencia', tipoPaciente)
    console.log(formData.getAll);
  }
})


jQuery(document).on("change ,  keyup" , "input[type='radio']" ,function(){
     var parent_element = jQuery(this).closest("div[class='row']");
    if (this.value == true) {
        var collapID = jQuery(parent_element).children("div[class='collapse']").attr("id");
        $('#'+collapID).collapse("show")
        // $('#'+collapID).find(':input').prop('required', true);
    }else{
        var collapID = jQuery(parent_element).children("div[class='collapse show']").attr("id");
        $('#'+collapID).collapse("hide")
        $('#'+collapID).find(':input').val('')
        // $('#'+collapID).find(':input').prop('required', false);
    }
});
 // $("#formDIV").addClass("disable-div");
