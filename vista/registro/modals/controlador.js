$.post("modals/registro.php", function(html){
   $("#modals-js").html(html);
   //Formulario de Preregistro
   $("#formRegistrarPaciente").submit(function(event){
      event.preventDefault();
      /*DATOS Y VALIDACION DEL REGISTRO*/
      var form = document.getElementById("formRegistrarPaciente");
      var formData = new FormData(form);
      formData.set('foto', null);
      formData.set('api', 1);
      console.log(formData);

      Swal.fire({
         title: '¿Está seguro que todos sus datos estén correctos?',
         text: "¡No podrá editar o volverse a registrar!",
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Si, registrame',
         cancelButtonText: "Cancelar"
       }).then((result) => {
         if (result.isConfirmed) {
           $("#btn-registrarse").prop('disabled', true);

           // Esto va dentro del AJAX
           $.ajax({
             data: formData,
             url: "../../api/pacientes_api.php",
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
                   document.getElementById("formRegistrarPaciente").reset();
                   $("#ModalRegistrarPaciente").modal('hide');
                 break;
                 case "repetido":
                   Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: '¡Usted ya está registrado!',
                      footer: 'Utilice su CURP para registrarse en una nueva prueba'
                   })
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
      event.preventDefault();
    });

   deshabilitarVacunaExtra($("#inputVacuna").val(), 'vacunaExtra');
   $("#inputVacuna").change(function(){
    //alert($(this).val());
    deshabilitarVacunaExtra($(this).val(), 'vacunaExtra');
   });

});
