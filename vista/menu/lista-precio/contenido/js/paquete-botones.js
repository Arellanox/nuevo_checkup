$('#agregar-estudio-paquete').click(function() {
  $.ajax({
    url: http + servidor + "/nuevo_checkup/api/servicios_api.php",
    type: "POST",
      dataType: 'json',
      data: { id: $('#seleccion-estudio').val(),api: 3 },
      success: function (data) {
            data = data.response.data[0];
            meterDato(data.DESCRIPCION, data.ABREVIATURA, data.COSTO, data.PRECIO_VENTA, data.ID_SERVICIO, data.ABREVIATURA, tablaPaquete);
        }
      }
    );
})

$('input[type="radio"][name="selectPaquete"]').change(function() {
switch ($(this).val()) {
  case '1':
    contenidoPaquete();
  break;
  case '2':
    mantenimientoPaquete();
  break;

    }
});

$('input[type=radio][name=selectChecko]').change(function() {
  if ($(this).val() != 0) {
    rellenarSelect("#seleccion-estudio", "servicios_api", 8, 0, 'ABREVIATURA.DESCRIPCION', {'id_area' : this.value});
  }else{
    rellenarSelect("#seleccion-estudio", "servicios_api", 8, 0, 'ABREVIATURA.DESCRIPCION', {'otros_servicios' : 1});
  }
});

$('#guardar-contenido-paquete').on('click', function(){
  let dataAjax = calcularFilasTR();
  let tableData = tablaPaquete.rows().data().toArray();
  if (tableData.length > 0) {
    Swal.fire({
     title: '¿Estás seguro de guardar el contenido?',
     showCancelButton: true,
     confirmButtonText: 'Confirmar',
     cancelButtonText: 'Cancelar',
     showLoaderOnConfirm: true,
     html: '<p>Use su contraseña para continuar</p><input type="text" id="password-confirmar" class="swal2-input" name="confirm-password" autocomplete="off" placeholder="">',
     confirmButtonText: 'Sign in',
     focusConfirm: false,
     preConfirm: () => {
       const password = Swal.getPopup().querySelector('#password-confirmar').value
       return fetch(http+servidor+"/nuevo_checkup/api/usuarios_api.php?api=9&password="+password)
         .then(response => {
           if (!response.ok) {
             throw new Error(response.statusText)
           }
           return response.json()
         })
         .catch(error => {
           Swal.showValidationMessage(
             `Request failed: ${error}`
           )
         })
     },
     allowOutsideClick: () => !Swal.isLoading()
   }).then((result) => {
     if (result.isConfirmed) {
       if (result.value.status == 1) {
         $.ajax({
           url: http + servidor + "/nuevo_checkup/api/paquetes_api.php",
           data: { api: 6, paquete_detalle: dataAjax },
           type: "POST",
           datatype: 'json',
           success: function (data) {
             if (mensajeAjax(data)) {
               alertMensaje('success', 'Contenido registrado', 'El contenido se a registrado correctamente :)')
             }
           }
         })
       }else{
         alertMensaje('error', 'Usuario incorrecto', '¡Su contraseña no es correcta!')
       }
     }
   })
 }else{
   alertMensaje('error', '¡Faltan datos!', 'Necesita rellenar la tabla de estudios para continuar')
 }

  console.log()
})

$(document).on("change ,  keyup" , "input[name='cantidad-paquete']" ,function(){
    calcularFilasTR()
});
