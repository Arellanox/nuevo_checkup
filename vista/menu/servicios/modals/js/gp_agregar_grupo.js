const ModalRegistrarGrupo = document.getElementById("ModalRegistrarGrupo");
ModalRegistrarGrupo.addEventListener("show.bs.modal", (event) => {
  rellenarSelect('#registrar-metodos-grupo','laboratorio_metodos_api', 2,0,1);
  rellenarSelect("#registrar-clasificacion-grupo","laboratorio_clasificacion_api",2,0,1);
  rellenarSelect('#registrar-medidas-grupo','laboratorio_medidas_api', 2,0,1);
  rellenarSelect('#registrar-concepto-facturacion-grupo','sat_catalogo_api', 2,0,'COMPLETO');
  rellenarSelect("#registrar-area-grupo", "areas_api", 2, 0, 2);
});




//Formulario de Preregistro
$("#formRegistrarGrupo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarGrupo");
  var formData = new FormData(form);
  formData.set("padre", null);
  formData.set("grupos", 1);
  formData.set("producto", 1);
  formData.set("seleccionable", null);
  formData.set("para", 3);
  formData.set("costos", null);
  formData.set("utilidad", null);
  formData.set("venta", null);
  formData.set("api", 1);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "Verifique los datos antes de continuar!",
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
            document.getElementById("formRegistrarGrupo").reset();
            $("#ModalRegistrarGrupo").modal("hide");
            tablaGrupos.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

select2("#registrar-area-grupo", "ModalRegistrarGrupo");
select2("#registrar-metodos-grupo", "ModalRegistrarGrupo");
select2("#registrar-medidas-grupo", "ModalRegistrarGrupo");
select2("#registrar-concepto-facturacion-grupo", "ModalRegistrarGrupo");
select2("#registrar-clasificacion-grupo", "ModalRegistrarGrupo");
select2("#registrar-area-grupo", "ModalRegistrarGrupo");
