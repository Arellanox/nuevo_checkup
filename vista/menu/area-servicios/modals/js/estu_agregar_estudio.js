const ModalRegistrarEstudio = document.getElementById("ModalRegistrarEstudio");
ModalRegistrarEstudio.addEventListener("show.bs.modal", (event) => {
  rellenarSelect("#registrar-area-estudio", "areas_api", 2, 0, 2);
  rellenarSelect('#registrar-concepto-facturacion', 'sat_catalogo_api', 2, 0, 'COMPLETO');
  setTimeout(() => {
    if (areaActiva != 'todos') {
      $('#cont-area-estudios').fadeOut(0);
    } else {
      $('#cont-area-estudios').fadeIn(0);
    }
  }, 150);
})



// //Formulario de Preregistro
$("formRegistrarEstudio").submit(function (event) {
  event.preventDefault();

  let dataajax = {
    api: 1, producto: 1, local: 1
  }

  if (areaActiva != 'todos')
    dataajax.push('area_id', areaActiva)

  let data = ajaxAwait(dataajax, 'servicios_api');

  if (data) {
    let row = data.response.data;
  }
})



// $("#formRegistrarEstudio").submit(function (event) {
//   event.preventDefault();
//   /*DATOS Y VALIDACION DEL REGISTRO*/
//   var form = document.getElementById("formRegistrarEstudio");
//   var formData = new FormData(form);

//   if ($('#sin_clasificacion').is(":checked"))
//     formData.delete('clasificacion_id')
//   if ($('#sin_metodo').is(":checked"))
//     formData.delete('metodo_id')
//   if ($('#sin_medida').is(":checked"))
//     formData.delete('medida_id')





//   // var padre = formData.get("grupo");
//   // formData.delete("grupo");
//   // formData.set("padre", padre);
//   formData.set("grupos", 0);
//   formData.set("producto", 1);
//   // formData.set("seleccionable", null);
//   // formData.set("para", 3);
//   // formData.set("costos", null);
//   // formData.set("utilidad", null);
//   // formData.set("venta", null);
//   formData.set("api", 1);

//   Swal.fire({
//     title: "¿Está seguro que todos los datos están correctos?",
//     text: "Verifique la Informacion antes de Continuar!",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonColor: "#d33",
//     confirmButtonText: "Aceptar",
//     cancelButtonText: "Cancelar",
//   }).then((result) => {
//     if (result.isConfirmed) {
//       // $('#submit-registrarEstudio').prop('disabled', true);
//       // Esto va dentro del AJAX
//       $.ajax({
//         data: formData,
//         url: "../../../api/servicios_api.php",
//         type: "POST",
//         processData: false,
//         contentType: false,
//         success: function (data) {
//           data = jQuery.parseJSON(data);
//           if (mensajeAjax(data)) {
//             Toast.fire({
//               icon: "success",
//               title: "¡Estudio registrado!",
//               timer: 2000,
//             });
//             document.getElementById("formRegistrarEstudio").reset();
//             $('##div-select-contenedores').empty();
//             $("#ModalRegistrarEstudio").modal("hide");
//             tablaServicio.ajax.reload();
//           }
//         },
//       });
//     }
//   });
//   event.preventDefault();
// });


// function getValueCheck(tip, val) {
//   switch (key) {
//     case 'clasexamen':
//       if ($('#sin_clasificacion').is(":checked"))
//         return val;
//       return
//       break;

//     default:
//       break;
//   }
// }


// // Nuevo contenedores
// $('#nuevo-contenedor').on('click', function () {
//   numberContenedor += 1;
//   agregarContenedorMuestra('#div-select-contenedores', numberContenedor, 1);
// })

// $(document).on('click', '.eliminarContenerMuestra1', function () {
//   var parent_element = $(this).closest("div[class='row']");
//   // console.log(parent_element)
//   // numberContenedor -= 1;
//   parent_element.remove();
// });

// // $('.eliminarContenerMuestra').on('click', function(event){
// //   event.stopPropagation();
// //   event.stopImmediatePropagation();
// //   var parent_element = $(this).closest("div[class='row']");
// //   console.log(parent_element)
// //   parent_element.remove();
// // })






