const modalEditarEstudio = document.getElementById("modalEditarEstudio");
modalEditarEstudio.addEventListener("show.bs.modal", (event) => {
  cargarDatosEstuEdit();
});

async function cargarDatosEstuEdit() {
  await rellenarSelect("#edit-grupo-estudio", 'servicios_api',7,0,2);
  await rellenarSelect("#edit-area-estudio", "areas_api", 2,0,2);
  await rellenarSelect('#edit-clasificacion-estudio','laboratorio_clasificacion_api', 2,0,1);
  await rellenarSelect('#edit-metodos-estudio','laboratorio_metodos_api', 2,0,1)
  //await rellenarSelect('#edit-metodos-estudio','laboratorio_metodos_api', 2,0,1);
  //await rellenarSelect("#edit-concepto-facturacion", "Api", 2, 0, 1);
  if (  await rellenarSelect("#edit-medidas-estudio", "laboratorio_medidas_api", 2, 0, 1) ) {

    console.log(array_selected)
    $('#edit-nombre-estudio').val(array_selected['DESCRIPCION']);
    $('#edit-grupo-estudio').val(array_selected['']);
    $('#edit-area-estudio').val(array_selected['DESCRIPCION_AREA']);
    $("#edit-clasificacion-estudio").select2(array_selected['CLASIFICACION_EXAMEN'], array_selected['CLASIFICACION_EXAMEN']);
    //$('#edit-clasificacion-estudio').select2('data', {id: array_selected['ID_CLASIFICACION'], a_key: 'CLASIFICACION_EXAMEN'});
    $('#edit-medidas-estudio').val(array_selected['NOMBRE']);
    $('#edit-concepto-estudio').val(array_selected['NOMBRE']);
    $('#edit-indicaciones-estudio').val(array_selected['NOMBRE']);
    // Check Valor referencia
     if(array_selected['NOMBRE'] =='Si'){
       $('#edit-checkValSi-estudio').attr('checked', true);
     }  else{
       $('#edit-checkValNo-estudio').attr('checked', true);
     }
    // Check Subroga
     if(array_selected['NOMBRE'] =='Si'){
       $('#edit-checkRogaSi-estudio').attr('checked', true);
     }  else{
       $('#edit-checkRogaNo-estudio').attr('checked', true);
     }
  }
}

//Formulario de Preregistro
$("#formEditarEstudio").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarEstudio");
  var formData = new FormData(form);
  formData.set("grupos", 0);
  formData.set("producto", 1);
  formData.set("seleccionable", null);
  formData.set("para", 3);
  formData.set("costos", null);
  formData.set("utilidad", null);
  formData.set("venta", null);
  formData.set("id", array_selected['ID_SERVICIO']);
  formData.set("api", 1);

  Swal.fire({
    title: "¿Está seguro que todos los datos están correctos?",
    text: "Verifique la nueva información antes de actualizar",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }).then((result) => {
    if (result.isConfirmed) {
      //$("#btn-registrarse").prop('disabled', true);
      // Esto va dentro del AJAX
    }
  });
  event.preventDefault();
});

select2("#edit-clasificacion-estudio", "modalEditarEstudio");
select2("#edit-metodos-estudio", "modalEditarEstudio");
select2("#edit-medidas-estudio", "modalEditarEstudio");
select2("#edit-concepto-facturacion", "modalEditarEstudio");
select2("#edit-grupo-estudio", "modalEditarEstudio");
select2("#edit-area-estudio", "modalEditarEstudio");
