//Formulario de registro de pruebas
$('#formDIV *').prop('disabled',true);
$("#formDIV").fadeToggle(400);
$('#btnFormRegistrarPruba').prop('disabled',true);
$('#eliminarForm').prop('disabled',true);
$('#curp-paciente').prop('readonly', false);

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
  $.ajax({
    data: {curp:curp},
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
            title: 'CURP valida...',
            timer: 2000
          });
          document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
                                                           'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
                                                        '</div>';
          document.getElementById("paciente-registro").innerHTML = "Paciente";
          document.getElementById("cupr-registro").innerHTML = "CURP";
          document.getElementById("sexo-registro").innerHTML = "sexo";
          $('#formDIV *').prop('disabled',false);
          $('#btnFormRegistrarPruba').prop('disabled',false);
        break;
        case "error":
         document.getElementById("mensaje").innerHTML = data['error']; //Mensaje desde api o funcion
        break
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
})

$('#eliminarForm').click(function(){
  $('#curp-paciente').prop('readonly', false);
  $('#eliminarForm').prop('disabled',true);
  $('#actualizarForm').prop('disabled',false);
  $('#formDIV *').prop('disabled',true);
  $("#formDIV").fadeToggle(400);
  $('#btnFormRegistrarPruba').prop('disabled',true);
  window.location.hash = "curp-paciente";
})

$("#formRegistrarPrueba").submit(function(event){
    event.preventDefault();
    /*DATOS Y VALIDACION DEL REGISTRO*/
    var form = document.getElementById("formRegistrarPrueba");
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

                 document.getElementById("formRegistrarPrueba").reset();
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
 // $("#formDIV").addClass("disable-div");
