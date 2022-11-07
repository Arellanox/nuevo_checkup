select2('#seleccion-paquete', 'form-select-paquetes')
select2('#seleccion-estudio','form-select-paquetes')

//Declarar variable para la clase
var selectEstudio;

$('#agregar-estudio-paquete').click(function() {
    console.log(selectEstudio.array)
    console.log($("#seleccion-estudio").prop('selectedIndex'))
    // console.log(selectData)
    selectData = selectEstudio.array[$("#seleccion-estudio").prop('selectedIndex')]
    console.log(selectData)
    meterDato(selectData.DESCRIPCION, selectData.ABREVIATURA, selectData.COSTO, selectData.PRECIO_VENTA, selectData.ID_SERVICIO, selectData.ABREVIATURA, tablaContenidoPaquete);
})


// $('#agregar-estudio-paquete').click(function() {
//   $.ajax({
//     url: http + servidor + "/nuevo_checkup/api/servicios_api.php",
//     type: "POST",
//       dataType: 'json',
//       data: { id: $('#seleccion-estudio').val(), api: 3},
//       success: function (data) {
//             data = data.response.data[0];
//             meterDato(data.DESCRIPCION, data.ABREVIATURA, data.COSTO, data.PRECIO_VENTA, data.ID_SERVICIO, data.ABREVIATURA, tablaPaquete);
//         }
//       }
//     );
// })

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
    // selectData = null;
    rellenarSelect("#seleccion-estudio", "servicios_api", 9, 0, 'ABREVIATURA.DESCRIPCION', {id_area : this.value, paquete_id: $('#seleccion-paquete').val()}, function(listaEstudios){
        selectEstudio = new GuardarArreglo(listaEstudios);
    }); //Mandar cliente para lista personalizada
  }else{
    rellenarSelect("#seleccion-estudio", "servicios_api", 9, 0, 'ABREVIATURA.DESCRIPCION', {paquete_id: $('#seleccion-paquete').val()}, function(listaEstudios){
        selectEstudio = new GuardarArreglo(listaEstudios);
    });
  }
});

$('#guardar-contenido-paquete').on('click', function(){
  let dataAjax = calcularFilasTR();
  let tableData = tablaContenidoPaquete.rows().data().toArray();
  if (tableData.length > 0) {

   Swal.fire({
    title: '¿Estás seguro de guardar los resultados?',
    text: 'Use su contraseña para confirmar',
    showCancelButton: true,
    confirmButtonText: 'Confirmar',
    cancelButtonText: 'Cancelar',
    showLoaderOnConfirm: true,
    // inputAttributes: {
    //   autocomplete: false
    // },
    // input: 'password',
    html: '<form autocomplete="off" onsubmit="formpassword(); return false;"><input type="password" id="password-confirmar" class="form-control input-color" autocomplete="off" placeholder=""></form>',
    // confirmButtonText: 'Sign in',
    focusConfirm: false,
    preConfirm: () => {
      const password = Swal.getPopup().querySelector('#password-confirmar').value;
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
              data = jQuery.parseJSON(data);
              if (mensajeAjax(data)) {
                tablaPaquete.clear().draw();
                alertMensaje('success', 'Contenido registrado', 'El contenido se a registrado correctamente :)')
              }
            }
          })
        }else{
          alertSelectTable('¡Contraseña incorrecta!', 'error')
        }
      }
    })
 }else{
   alertMensaje('error', '¡Faltan datos!', 'Necesita rellenar la tabla de estudios para continuar')
 }

  console.log()
})

function formpassword(){
  //No submit form with enter
}

$(document).on("change ,  keyup" , "input[name='cantidad-paquete']" ,function(){
    calcularFilasTR()
});
