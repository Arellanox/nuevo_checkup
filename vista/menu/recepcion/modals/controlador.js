
$.post("modals/rechazados.php", function(html){
   $("#modals-js").html(html);

    //Rechazados
   $("#formRechazados").submit(function(event){
       event.preventDefault();
       /*DATOS Y VALIDACION DEL REGISTRO*/
       var form = document.getElementById("formRechazados");
       var formData = new FormData(form);
       formData.set('api', 3);
       console.log(formData);
       // $.ajax({
       //   data: formData,
       //   url: "php/api/cursos_conferencia_api.php",
       //   type: "POST",
       //   processData: false,
       //   contentType: false,
       //   success: function(data) {
       //     data = jQuery.parseJSON(data);
       //     if (data['codigo'] == 1) {
       //       Toast.fire({
       //         icon: 'success',
       //         title: 'Ponente Registrado :)',
       //         timer: 2000
       //       });
       //       tablaConferencia();
       //       $('#nuevo_modal').modal('hide');
       //      }else {
       //        Swal.fire({
       //          icon: 'error',
       //          title: 'Oops...',
       //          text: 'Hubo un error, comunique el error al encargado',
       //          showCloseButton: true,
       //        });
       //      }
       //   }
       // });
       event.preventDefault();
     });
});
