let rellenoGrupoSelect, rellenoMetodoSelect, rellenoEquipoSelect;

const ModalRegistrarEstudio = document.getElementById("ModalRegistrarEstudio");
ModalRegistrarEstudio.addEventListener("show.bs.modal", (event) => {
  rellenarSelect("#registrar-clasificacion-estudio", "laboratorio_clasificacion_api", 2, 0, 1);
  // rellenarSelect("#registrar-metodos-estudio", "laboratorio_metodos_api", 2, 0, 1);
  rellenarSelect("#registrar-medidas-estudio", "laboratorio_medidas_api", 2, 0, 1);
  // rellenarSelect("#registrar-grupo-estudio", "servicios_api", 7, 0, 'DESCRIPCION');
  // rellenarSelect("#registrar-area-estudio", "areas_api", 2, 0, 2);
  rellenarSelect('#registrar-concepto-facturacion', 'sat_catalogo_api', 2, 0, 'COMPLETO');

  rellenarSelect('.select-contenedor-Método', 'laboratorio_metodos_api', 2, 'ID_METODO', 'DESCRIPCION', {}, function (data, o) {
    rellenoMetodoSelect = o
  })

  rellenarSelect('.select-contenedor-grupo', 'servicios_api', 7, 0, 'DESCRIPCION', {}, function (data, o) {
    rellenoGrupoSelect = o
  })

  rellenarSelect('.select-contenedor-equipo', 'laboratorio_equipos_api', 2, 'ID_EQUIPO', 'DESCRIPCION.MODELO.MARCA', {}, function (data, o) {
    rellenoEquipoSelect = o
  })


})

//Formulario de Preregistro
$("#formRegistrarEstudio").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formRegistrarEstudio");
  var formData = new FormData(form);

  if ($('#sin_clasificacion').is(":checked"))
    formData.delete('clasificacion_id')

  if ($('#sin_medida').is(":checked"))
    formData.delete('medida_id')





  // var padre = formData.get("grupo");
  // formData.delete("grupo");
  // formData.set("padre", padre);
  formData.set("grupos", 0);
  formData.set("producto", 1);
  formData.set("area", 6);


  formData.set("seleccionable", 1);
  formData.set("para", 3);
  formData.set("costos", 1);
  // formData.set("utilidad", null);
  // formData.set("venta", null);
  formData.set("api", 0);

  Swal.fire({
    title: "¿Está seguro que todos los datos del estudio están correctos?",
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
        cache: false,
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
        error: function (jqXHR, exception, data) {
          alertErrorAJAX(jqXHR, exception, data)
        },
      });
    }
  });
  event.preventDefault();
});


function getValueCheck(tip, val) {
  switch (key) {
    case 'clasexamen':
      if ($('#sin_clasificacion').is(":checked"))
        return val;
      return
      break;

    default:
      break;
  }
}


// Nuevo contenedores
$('#nuevo-contenedor-muestra').on('click', function () {
  numberContenedor += 1;
  agregarContenedorMuestra('#div-select-contenedores', numberContenedor, 1);
})

// Nuevo grupo
$(document).on('click', '#nuevo-select-grupo', function (event) {
  event.preventDefault();
  agregarHTMLSelector('#div-select-grupo', 'Grupo', rellenoGrupoSelect)
})

// Nuevo metodo
$(document).on('click', '#nuevo-select-metodo', function (event) {
  event.preventDefault();
  agregarHTMLSelector('#div-select-metodo', 'Método', rellenoMetodoSelect)
})

// Nuevo equipo
$(document).on('click', '#nuevo-select-equipo', function (event) {
  event.preventDefault();
  agregarHTMLSelector('#div-select-equipo', 'Equipo', rellenoEquipoSelect)
})

$(document).on('click', '.eliminarContenerMuestra1', function () {
  var parent_element = $(this).closest("div[class='row']");
  // console.log(parent_element)
  // numberContenedor -= 1;
  parent_element.remove();
});

$('input[type=radio][name=local]').change(function () {
  if (this.value == '1') {
    $('#div-maquila').fadeIn()
  }
  else if (this.value == '0') {
    $('#div-maquila').fadeOut()
  }
});

// $('.eliminarContenerMuestra').on('click', function(event){
//   event.stopPropagation();
//   event.stopImmediatePropagation();
//   var parent_element = $(this).closest("div[class='row']");
//   console.log(parent_element)
//   parent_element.remove();
// })







select2("#registrar-clasificacion-estudio", "ModalRegistrarEstudio");

select2("#registrar-medidas-estudio", "ModalRegistrarEstudio");
select2("#registrar-concepto-facturacion", "ModalRegistrarEstudio");

select2("#registrar-contenedor1-estudio", "ModalRegistrarEstudio");
select2("#registrar-muestraCont1-estudio", "ModalRegistrarEstudio");

// select2('.select-contenedor-equipo', 'ModalRegistrarEstudio');
// select2('.select-contenedor-Método', 'ModalRegistrarEstudio');
// select2('.select-contenedor-grupo', 'ModalRegistrarEstudio');
