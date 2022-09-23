const ModalRegistrarEstudio = document.getElementById("ModalRegistrarEstudio");
ModalRegistrarEstudio.addEventListener("show.bs.modal", (event) => {
  // rellenarSelect('#registrar-clasificacion-examen','Api', 2,0,1);
  rellenarSelect('#registrar-metodos-examen','laboratorio_metodos_api', 2,0,1);
  // rellenarSelect('#registrar-medidas-examen','Api', 2,0,1);
  // rellenarSelect('#registrar-concepto-facturacion','Api', 2,0,1);
});

//Formulario de Preregistro
$("#formRegistrarEstudio").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarEstudio");
  var formData = new FormData(form);
  formData.set("grupos", 0);
  formData.set("producto", 1);
  formData.set("seleccionable", null);
  formData.set("para", 3);
  formData.set("costos", null);
  formData.set("utilidad", null);
  formData.set("venta", null);
  formData.set("api", 1);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "Verifique la Informacion antes de Continuar!",
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
        url: "../../../api/servicios_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "¡Estudio registrado!",
              timer: 2000,
            });
            document.getElementById("formRegistrarEstudio").reset();
            $("#ModalRegistrarEstudio").modal("hide");
            tablaServicio.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

select2("#registrar-clasificacion-examen", "ModalRegistrarEstudio");
select2("#registrar-metodos-examen", "ModalRegistrarEstudio");
select2("#registrar-medidas-examen", "ModalRegistrarEstudio");
select2("#registrar-concepto-facturacion", "ModalRegistrarEstudio");
select2("#registrar-grupo-examen", "ModalRegistrarEstudio");
select2("#registrar-area-estudio", "ModalRegistrarEstudio");
