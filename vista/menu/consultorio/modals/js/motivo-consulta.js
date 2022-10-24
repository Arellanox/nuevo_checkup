select2('#select-cita-subsecuente', 'modalMotivoConsulta')
$('#formMotivoConsulta').submit(function(event){
  event.preventDefault();
  var form = document.getElementById("formMotivoConsulta");
  var formData = new FormData(form);
  formData.set('api', 7)
  Swal.fire({
    title: "¿Está seguro de continuar?",
    text: "¡La consulta necesita terminarla!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX
      $.ajax({
        data: formData,
        url: "../../../api/turnos_api.php",
        type: "POST",
        datatype: "json",
        processData: false,
        contentType: false,
        success: function (data) {
          // Llamar la vista de consulta
          document.getElementById("formMotivoConsulta").reset();
          $("#modalMotivoConsulta").modal("hide");
          obtenerContenidoConsulta()
        },
      });
    }
  });
})
