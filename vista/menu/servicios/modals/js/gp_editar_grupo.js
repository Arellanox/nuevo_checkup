const ModalEditarGrupo = document.getElementById("ModalEditarGrupo");
ModalEditarGrupo.addEventListener("show.bs.modal", (event) => {
rellenarSelect('#registrar-clasificacion-grupo','laboratorio_clasificacion_api', 2,0,1);
rellenarSelect('#registrar-metodos-grupo','laboratorio_metodos_api', 2,0,1);
rellenarSelect('#registrar-medidas-grupo','laboratorio_medidas_api', 2,0,1);
rellenarSelect('#registrar-area-grupo','areas_api',2,0,2);
rellenarSelect('#registrar-concepto-facturacion-grupo','sat_catalogo_api', 2,0,'COMPLETO');
});

//Formulario de Preregistro
$("#formEditarGrupo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarGrupo");
  var formData = new FormData(form);
  formData.set("padre", 1);
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
    text: "¡Guarde o recuerde la contraseña!",
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
            document.getElementById("formEditarGrupo").reset();
            $("#ModalEditarGrupo").modal("hide");
            tablaServicio.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});

select2("#edit-area-grupo", "ModalEditarGrupo");
select2("#edit-metodos-grupo", "ModalEditarGrupo");
select2("#edit-medidas-grupo", "ModalEditarGrupo");
select2("#edit-concepto-facturacion-grupo", "ModalEditarGrupo");
select2("#edit-clasificacion-grupo", "ModalEditarGrupo");
select2("#edit-area-estudio", "ModalEditarGrupo");
