const modalRegistrarPaciente = document.getElementById('ModalRegistrarPaciente')
modalRegistrarPaciente.addEventListener('show.bs.modal', event => {
  getProcedencias("listProcedencia");
  var procedencia = $("#listProcedencia option:selected").val();
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias-menu");
})
// Lista de segmentos dinamico
$('#listProcedencia').on('change', function() {
  var procedencia = $("#listProcedencia option:selected").val();
  getSegmentoByProcedencia(procedencia, "segmentos_procedencias-menu");
});

//Formulario de Preregistro
$("#formRegistrarPaciente").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formRegistrarPaciente");
   var formData = new FormData(form);
   formData.set('api', 3);
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
          url: "??",
          type: "POST",
          processData: false,
          contentType: false,
          success: function(data) {
            data = jQuery.parseJSON(data);
            if (mensajeAjax(data)) {
              Toast.fire({
                icon: 'success',
                title: 'Su información a sido registrada :)',
                timer: 2000
              });
              document.getElementById("formRegistrarPaciente").reset();
              $("#ModalRegistrarPaciente").modal('hide');
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
