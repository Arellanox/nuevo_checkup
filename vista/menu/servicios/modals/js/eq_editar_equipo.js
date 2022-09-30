const ModalEditarEquipo = document.getElementById("ModalEditarEquipo");
ModalEditarEquipo.addEventListener("show.bs.modal", (event) => {

  console.log(array_selected);

  $("#edit-claveInv-equipo").val(array_selected["CVE_INVENTARIO"]);
  $("#edit-uso-equipo").val(array_selected["USO"]);
  $("#edit-serie-equipo").val(array_selected["NUMERO_SERIE"]);
  $("#edit-freMante-equipo").val(array_selected["FRECUENCIA_MANTENIMIENTO"]);
  $("#edit-npruebasMante-equipo").val(array_selected["NUMERO_PRUEBAS"]);
  $("#edit-cali-equipo").val(array_selected["CALUBRACION"]);
  $("#edit-npruebasCali-equipo").val(array_selected["NUMERO_PRUEBAS_CALIBRACION"]);
  $("#edit-fechaIngreso-equipo").val(array_selected["FECHA_INGRESO_EQUIPO"]);
  $("#edit-fechaInicio-equipo").val(array_selected["FECHA_INICIO_USO"]);
  $("#edit-valorEquipo-equipo").val(array_selected["VALOR_DEL_EQUIPO"]);
  $("#edit-descripcion-equipo").val(array_selected["DESCRIPCION"]);
  $("#edit-marca-equipo").val(array_selected["MARCA"]);
  $("#edit-modelo-equipo").val(array_selected["MODELO"]);
  //$("#edit-foto-equipo").val(array_selected["NOMBRE"]);
});

//Formulario de Preregistro
$("#formEditarEquipo").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarEquipo");
  var formData = new FormData(form);
  formData.set('status',array_selected["STATUS"]);
  formData.set('id', array_selected['ID_EQUIPO']);
  formData.set("api", 1);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "Verifique la Nueva Informacion antes de Continuar!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
          $.ajax({
        data: formData,
         url: "../../../api/laboratorio_equipos_api.php",
        type: "POST",
        processData: false,
        contentType: false,
        success: function (data) {
          data = jQuery.parseJSON(data);
          if (mensajeAjax(data)) {
            Toast.fire({
              icon: "success",
              title: "Informacion del Equipo Actualizada Correctamente!",
              timer: 2000,
            });
            document.getElementById("formEditarEquipo").reset();
            $("#modalEditarEquipo").modal("hide");
            tablaServicio.ajax.reload();
          }
        },
      });
      //$("#btn-registrarse").prop('disabled', true);
      // Esto va dentro del AJAX
    }
  });
  event.preventDefault();
});
