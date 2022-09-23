const ModalRegistrarEquipo = document.getElementById("ModalRegistrarEquipo");
ModalRegistrarEquipo.addEventListener("show.bs.modal", (event) => {
  // rellenarSelect('#registrar-clasificacion-examen','Api', 2,0,1);
  // rellenarSelect('#registrar-metodos-examen','laboratorio_metodos_api', 2,0,1);
  // rellenarSelect('#registrar-medidas-examen','Api', 2,0,1);
  // rellenarSelect('#registrar-concepto-facturacion','Api', 2,0,1);
});

//Formulario de Preregistro
$("#formAgregarEquipo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formAgregarEquipo");
  var formData = new FormData(form);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "¡Verifique las Caracteristicas antes de Continuar!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      // $('#submit-registrarEstudio').prop('disabled', true);
      // Esto va dentro del AJAX
      $.ajax({
        data: formData,
        url: "?",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "Equipo registrado!",
              timer: 2000,
            });
            document.getElementById("formAgregarEquipo").reset();
            $("#ModalRegistrarEquipo").modal("hide");
            tablaServicio.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

select2("#registrar-clasificacion-examen", "ModalRegistrarEquipo");
select2("#registrar-metodos-examen", "ModalRegistrarEquipo");
select2("#registrar-medidas-examen", "ModalRegistrarEquipo");
select2("#registrar-concepto-facturacion", "ModalRegistrarEquipo");
select2("#registrar-grupo-examen", "ModalRegistrarEquipo");
select2("#registrar-area-estudio", "ModalRegistrarEquipo");
