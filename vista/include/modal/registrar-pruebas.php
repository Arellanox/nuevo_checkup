<div class="modal fade" id="ModalRegistrarPrueba" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header header-modal">
        <h5 class="modal-title">Crear registro de laboratorio</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formRegistrarAgenda">
          <?php include "formRegistrarAgenda.php"; ?>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i> Cancelar</button>
        <button type="submit" form="formRegistrarAgenda" class="btn btn-confirmar" id="btn-formregistrar-agenda">
          <i class="bi bi-send-plus"></i> Registrar
        </button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

// const modalRegistrarPrueba = document.getElementById('ModalRegistrarPrueba')
// modalRegistrarPrueba.addEventListener('show.bs.modal', event => {
//   // Colocar ajax
//   var select = document.getElementById("selectCURPPaciente"),
//       length = select.options.length;
//   while(length--){
//     select.remove(length);
//   }
//   // If necessary, you could initiate an AJAX request here
//   $.ajax({
//     url: "https://bimo-lab.com/includeHTML/formularios/php/consulta-paciente-ingreso.php",
//     type: "POST",
//     success: function(data) {
//       var data = jQuery.parseJSON(data);
//       //Equipo Utilizado
//       console.log(data);
//       var select = document.getElementById("selectCURPPaciente");
//       for (var i = 0; i < data.length; i++) {
//         var content = data[i]['nombre']+" - "+ data[i]['curp']+" - "+data[i]['prefolio'];
//         var value = data[i]['id_paciente'];
//         var el = document.createElement("option");
//         el.textContent = content;
//         el.value = value;
//         select.appendChild(el);
//       }
//     }
//   })
// })
//
//
// //Formulario de registro de pruebas
// $('#formDIV *').prop('disabled',true);
// $('#btnFormRegistrarPruba').prop('disabled',true);
//
// $('#actualizarForm').click(function(){
//   //Solicitar si la curp existe
//   document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
//                                                    'CURP aceptada, concluya su registro seleccionando el estudio a realizar.'+
//                                                 '</div>';
//   $('#formDIV *').prop('disabled',false);
//   $('#btnFormRegistrarPruba').prop('disabled',false);
//   curp = document.getElementById("selectCURPPaciente").value;
//   $.ajax({
//     data: {curp:curp},
//     url: "??",
//     type: "POST",
//     processData: false,
//     contentType: false,
//     success: function(data) {
//       data = jQuery.parseJSON(data);
//       switch (data['codigo'] == 1) {
//         case 1:
//           Toast.fire({
//             icon: 'success',
//             title: 'CURP valida...',
//             timer: 2000
//           });
//           document.getElementById("mensaje").innerHTML='<div class="alert alert-success" role="alert">'+
//                                                            'CURP aceptada, concluya el registro seleccionando el estudio a realizar.'+
//                                                         '</div>';
//           document.getElementById("paciente-registro").innerHTML = "Paciente";
//           document.getElementById("cupr-registro").innerHTML = "CURP";
//           document.getElementById("sexo-registro").innerHTML = "sexo";
//
//           $('#formDIV *').prop('disabled',false);
//           $('#btnFormRegistrarPruba').prop('disabled',false);
//         break;
//         case "error":
//          document.getElementById("mensaje").innerHTML = data['error']; //Mensaje desde api o funcion
//         break
//         default:
//           Swal.fire({
//              icon: 'error',
//              title: 'Oops...',
//              text: 'Hubo un problema!',
//              footer: 'Reporte este error con el personal :)'
//           })
//       }
//     },
//   });
// })
//
// $("#formRegistrarAgenda").submit(function(event){
//     event.preventDefault();
//     /*DATOS Y VALIDACION DEL REGISTRO*/
//     var form = document.getElementById("formRegistrarPrueba");
//     var formData = new FormData(form);
//     console.log(formData.get('estudiosLab[]'))
//     if (formData.get('estudiosLab[]') == null) {
//       Swal.fire({
//          icon: 'error',
//          title: 'Oops...',
//          text: 'No ha seleccionado ninguna prueba!',
//       })
//       return
//     }
//     formData.set('api', 3);
//     // console.log(formData);
//     Swal.fire({
//        title: '¿Está seguro de haber seleccionado todo?',
//        text: "¡No podrá volverse a regisrtrar con su CURP hasta terminar la solicitud de registro anterior!",
//        icon: 'warning',
//        showCancelButton: true,
//        confirmButtonColor: '#3085d6',
//        cancelButtonColor: '#d33',
//        confirmButtonText: 'Si, registrame',
//        cancelButtonText: "Cancelar"
//      }).then((result) => {
//        if (result.isConfirmed) {
//          $("#btn-registrarse").prop('disabled', true);
//
//          $.ajax({
//            data: formData,
//            url: "??",
//            type: "POST",
//            processData: false,
//            contentType: false,
//            success: function(data) {
//              data = jQuery.parseJSON(data);
//              switch (data['codigo'] == 1) {
//                case 1:
//                  Toast.fire({
//                    icon: 'success',
//                    title: 'Su información a sido registrada :)',
//                    timer: 2000
//                  });
//                  // Autocompletar el campo de prefolio y CURP en consulta de resultado
//
//                  document.getElementById("formRegistrarPrueba").reset();
//                  $("#ModalRegistrarPrueba").modal('hide');
//                break;
//                default:
//                  Swal.fire({
//                     icon: 'error',
//                     title: 'Oops...',
//                     text: 'Hubo un problema!',
//                     footer: 'Reporte este error con el personal :)'
//                  })
//              }
//            },
//          });
//        }
//      })
// })
//  // $("#formDIV").addClass("disable-div");
//
//  $('#selectCURPPaciente').select2({
//    dropdownParent: $('#ModalRegistrarPrueba'),
//    tags: false,
//    placeholder: 'Selecciona un paciente'
//  });
</script>
