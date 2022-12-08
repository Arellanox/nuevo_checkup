const ModalRegistrarEstudio = document.getElementById("ModalRegistrarEstudio");
ModalRegistrarEstudio.addEventListener("show.bs.modal", (event) => {
  rellenarSelect("#registrar-clasificacion-estudio", "laboratorio_clasificacion_api", 2, 0, 1);
  rellenarSelect("#registrar-metodos-estudio", "laboratorio_metodos_api", 2, 0, 1);
  rellenarSelect("#registrar-medidas-estudio", "laboratorio_medidas_api", 2, 0, 1);
  rellenarSelect("#registrar-grupo-estudio", "servicios_api", 7, 0, 'DESCRIPCION');
  // rellenarSelect("#registrar-area-estudio", "areas_api", 2, 0, 2);
  rellenarSelect('#registrar-concepto-facturacion', 'sat_catalogo_api', 2, 0, 'COMPLETO');
})

//Formulario de Preregistro
$("#formRegistrarEstudio").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarEstudio");
  var formData = new FormData(form);
  var padre = formData.get("grupo");
  formData.delete("grupo");
  formData.set("padre", padre);
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
            $('##div-select-contenedores').empty();
            $("#ModalRegistrarEstudio").modal("hide");
            tablaServicio.ajax.reload();
          }
        },
      });
    }
  });
  event.preventDefault();
});


// Nuevo contenedores
$('#nuevo-contenedor').on('click', function () {
  numberContenedor += 1;
  agregarContenedorMuestra('#div-select-contenedores', numberContenedor, 1);
})

$(document).on('click', '.eliminarContenerMuestra1', function () {
  var parent_element = $(this).closest("div[class='row']");
  // console.log(parent_element)
  // numberContenedor -= 1;
  parent_element.remove();
});

// $('.eliminarContenerMuestra').on('click', function(event){
//   event.stopPropagation();
//   event.stopImmediatePropagation();
//   var parent_element = $(this).closest("div[class='row']");
//   console.log(parent_element)
//   parent_element.remove();
// })







select2("#registrar-clasificacion-estudio", "ModalRegistrarEstudio");
select2("#registrar-metodos-estudio", "ModalRegistrarEstudio");
select2("#registrar-medidas-estudio", "ModalRegistrarEstudio");
select2("#registrar-concepto-facturacion", "ModalRegistrarEstudio");
select2("#registrar-grupo-estudio", "ModalRegistrarEstudio");
select2("#registrar-area-estudio", "ModalRegistrarEstudio");

select2("#registrar-contenedor1-estudio", "ModalRegistrarEstudio");
select2("#registrar-muestraCont1-estudio", "ModalRegistrarEstudio");