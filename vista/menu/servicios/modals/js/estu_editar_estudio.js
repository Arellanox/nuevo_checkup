<<<<<<< Updated upstream
const modalEditarEstudio = document.getElementById('modalEditarEstudio')
modalEditarEstudio.addEventListener('show.bs.modal', event => {
    cargarDatosEstuEdit()
})
=======
const modalEditarEstudio = document.getElementById("modalEditarEstudio");
modalEditarEstudio.addEventListener("show.bs.modal", (event) => {
  console.log("Modal abierto");
  rellenarSelect(".clasificacionExamenes", "Api", 2, 0, 1);
  rellenarSelect(".metodoExamenes", "Api", 2, 0, 1);
  rellenarSelect(".medidasExamenes", "Api", 2, 0, 1);
  rellenarSelect(".conceptoFactu", "Api", 2, 0, 1);
});
>>>>>>> Stashed changes

async function cargarDatosEstuEdit(){
  await rellenarSelect('#edit-clasificacion-estudio','Api', 2,0,1)
  await rellenarSelect('#edit-metodos-estudio','Api', 2,0,1)
  await rellenarSelect('#edit-medidas-estudio','Api', 2,0,1)
  await rellenarSelect('#edit-concepto-facturacion','Api', 2,0,1)
  await rellenarSelect('#edit-grupo-estudio','Api', 2,0,1)
  if (await rellenarSelect('#edit-area-estudio','Api', 2,0,1)) {
    console.log(array_selected)
    // $('#edit-nombre-estudio').val(array_selected['NOMBRE']);
    // $('#edit-grupo-estudio').val(array_selected['NOMBRE']);
    // $('#edit-area-estudio').val(array_selected['NOMBRE']);
    // $('#edit-clasificacion-estudio').val(array_selected['NOMBRE']);
    // $('#edit-medidas-estudio').val(array_selected['NOMBRE']);
    // $('#edit-concepto-estudio').val(array_selected['NOMBRE']);
    // $('#edit-indicaciones-estudio').val(array_selected['NOMBRE']);
    // Check Valor referencia
    // if(array_selected['NOMBRE'] =='Si'){
    //   $('#edit-checkValSi-estudio').attr('checked', true);
    // }  else{
    //   $('#edit-checkValNo-estudio').attr('checked', true);
    // }
    // Check Subroga
    // if(array_selected['NOMBRE'] =='Si'){
    //   $('#edit-checkRogaSi-estudio').attr('checked', true);
    // }  else{
    //   $('#edit-checkRogaNo-estudio').attr('checked', true);
    // }
  }

}

//Formulario de Preregistro
<<<<<<< Updated upstream
$("#formEditarEstudio").submit(function(event){
   event.preventDefault();
   /*DATOS Y VALIDACION DEL REGISTRO*/
   var form = document.getElementById("formEditarEstudio");
   var formData = new FormData(form);
    formData.set('grupos', 0);
    formData.set('producto', 1);
    formData.set('seleccionable', null);
    formData.set('para', 3);
    formData.set('costos', null);
    formData.set('utilidad', null);
    formData.set('venta', null);
    formData.set('api', 1);

   Swal.fire({
      title: '¿Está seguro que todos los datos están correctos?',
      text: "¡Guarde o recuerde la contraseña!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Aceptar',
      cancelButtonText: "Cancelar"
    }).then((result) => {
      if (result.isConfirmed) {
        //$("#btn-registrarse").prop('disabled', true);
        // Esto va dentro del AJAX

      }
    })
   event.preventDefault();
 });

 select2("#edit-clasificacion-estudio", 'ModalRegistrarEstudio')
 select2("#edit-metodos-estudio", 'ModalRegistrarEstudio')
 select2("#edit-medidas-estudio", 'ModalRegistrarEstudio');
 select2("#edit-concepto-facturacion", 'ModalRegistrarEstudio')
 select2("#edit-grupo-estudio", 'ModalRegistrarEstudio')
 select2("#edit-area-estudio", 'ModalRegistrarEstudio')
=======
$("#formEditarEstudio").submit(function (event) {
  event.preventDefault();
  /*DATOS Y VALIDACION DEL REGISTRO*/
  var form = document.getElementById("formEditarEstudio");
  var formData = new FormData(form);
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
      //$("#btn-registrarse").prop('disabled', true);
      // Esto va dentro del AJAX
    }
  });
  event.preventDefault();
});

select2(".medidasExamenes", "modalEditarEstudio");
select2(".conceptoFactu", "modalEditarEstudio");
select2(".metodoExamenes", "modalEditarEstudio");
select2(".clasificacionExamenes", "modalEditarEstudio");
>>>>>>> Stashed changes
