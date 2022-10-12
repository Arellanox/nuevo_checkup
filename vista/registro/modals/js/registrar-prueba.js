//Formulario de registro de pruebas
$('#formDIV *').prop('disabled',true);
$("#formDIV").fadeToggle(400);
$('#btnFormRegistrarPruba').prop('disabled',true);
$('#eliminarForm').prop('disabled',true);
$('#curp-paciente').prop('readonly', false);

var tipoPaciente = "0"; //Particular por defecto

$('#actualizarForm').click(function(){
  //Solicitar si la curp existe
  window.location.hash = "formDIV";
  $('#curp-paciente').prop('readonly', true);
  $('#eliminarForm').prop('disabled',false);
  $('#actualizarForm').prop('disabled',true);
  document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                   'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                '</div>';
  $('#formDIV *').prop('disabled',false);
  $("#formDIV").fadeToggle(400);
  $('#btnFormRegistrarPruba').prop('disabled',false);
  curp = document.getElementById("curp-paciente").value;
  // $.ajax({
  //   data: {curp:curp},
  //   url: "??",
  //   type: "POST",
  //   processData: false,
  //   contentType: false,
  //   success: function(data) {
  //     data = jQuery.parseJSON(data);
  //     switch (data['codigo'] == 1) {
  //       case 1:
  //         Toast.fire({
  //           icon: 'success',
  //           title: 'CURP valida...',
  //           timer: 2000
  //         });
  //         document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
  //                                                          'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
  //                                                       '</div>';
  //         document.getElementById("paciente-registro").innerHTML = "Paciente";
  //         document.getElementById("cupr-registro").innerHTML = "CURP";
  //         document.getElementById("sexo-registro").innerHTML = "sexo";
  //         $('#formDIV *').prop('disabled',false);
  //         $('#btnFormRegistrarPruba').prop('disabled',false);
  //       break;
  //       case "error":
  //        document.getElementById("mensaje").innerHTML = data['error']; //Mensaje desde api o funcion
  //       break
  //       default:
  //         Swal.fire({
  //            icon: 'error',
  //            title: 'Oops...',
  //            text: 'Hubo un problema!',
  //            footer: 'Reporte este error con el personal :)'
  //         })
  //     }
  //   },
  // });

  obtenerSignosVitales('#antecedentes-registro')
})

$('#eliminarForm').click(function(){
  $('#curp-paciente').prop('readonly', false);
  $('#eliminarForm').prop('disabled',true);
  $('#actualizarForm').prop('disabled',false);
  $('#formDIV *').prop('disabled',true);
  $("#formDIV").fadeToggle(400);
  $('#btnFormRegistrarPruba').prop('disabled',true);
  window.location.hash = "curp-paciente";
  $('##antecedentes-registro').html('')
})

$("#formAntecedentes-paciente2").submit(function(event){
    event.preventDefault();
    alert("form formAntecedentes-paciente")
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formAntecedentes-paciente");
    var formData = new FormData(form);
    console.log(formData.get('estudiosLab[]'))
    if (formData.get('estudiosLab[]') == null) {
      Swal.fire({
         icon: 'error',
         title: 'Oops...',
         text: 'No ha seleccionado ninguna prueba!',
      })
      return
    }
    formData.set('api', 3);
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
           data: formData,
           url: "??",
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
