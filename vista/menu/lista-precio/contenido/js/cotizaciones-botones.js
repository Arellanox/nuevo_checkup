select2('#seleccion-paquete', 'form-select-paquetes')
select2('#seleccion-estudio', 'form-select-paquetes')
select2('#select-presupuestos', 'form-select-paquetes')

//Declarar variable para la clase
var selectEstudio;

$('#agregar-estudio-paquete').click(function () {
  // console.log(selectEstudio.array)
  // console.log($("#seleccion-estudio").prop('selectedIndex'))
  // console.log(selectData)
  selectData = selectEstudio.array[$("#seleccion-estudio").prop('selectedIndex')]
  meterDato(selectData['SERVICIO'], selectData['ABREVIATURA'], selectData['COSTO'], selectData['PRECIO_VENTA'], 1, null, selectData['ID_SERVICIO'], selectData['ABREVIATURA'], tablaContenidoPaquete);
})


// $('#agregar-estudio-paquete').click(function() {
//   $.ajax({
//     url: http + servidor + "/nuevo_checkup/api/servicios_api.php",
//     type: "POST",
//       dataType: 'json',
//       data: { id: $('#seleccion-estudio').val(), api: 3},
//       success: function (data) {
//             data = data.response.data[0];
//             meterDato(data.SERVICIO, data.ABREVIATURA, data.COSTO, data.PRECIO_VENTA, data.ID_SERVICIO, data.ABREVIATURA, tablaPaquete);
//         }
//       }
//     );
// })

// Controlar el formulario
$("#formPaqueteBotonesArea").addClass("disable-element");
$("#formPaqueteSelectEstudio").addClass("disable-element");
$("#informacionPaquete").addClass("disable-element");

$('#UsarPaquete').on('click', function () {

  if ($('input[type=radio][name=selectPaquete]:checked').val() == 2) {
    if (!$('#select-presupuestos').val()) {
      alertToast('Necesitas seleccionar un presupuesto de este cliente', 'error', '5000')
      return false;
    }
    rellenarSelect("#select-presupuestos", "xxx", 0, 'ID_PRESUPUESTO', 'PRESUPUESTO', {
      cliente_id: $('#seleccion-paquete').val()
    });
  }

  $('#seleccion-paquete').prop('disabled', true);
  $("#selectDisabled").addClass("disable-element");
  // $('.formContenidoPaquete').prop('disabled', false);
  $("#formPaqueteBotonesArea").removeClass("disable-element");
  $("#formPaqueteSelectEstudio").removeClass("disable-element");
  $("#informacionPaquete").removeClass("disable-element");




  switch ($('input[type=radio][name=selectPaquete]:checked').val()) {
    case '2': //Lista de precios para clientes
      tablaContenido();
      $.ajax({
        url: http + servidor + "/nuevo_checkup/api/paquetes_api.php",
        type: "POST",
        dataType: 'json',
        data: {
          id_paquete: $('#seleccion-paquete').val(),
          api: 9
        },
        success: function (data) {
          console.log(data);
          row = data.response.data;
          for (var i = 0; i < row.length; i++) {
            meterDato(row[i]['SERVICIO'], row[i].ABREVIATURA, row[i].COSTO_UNITARIO, row[i].COSTO_TOTAL, row[i].CANTIDAD, null, row[i].ID_SERVICIO, row[i].ABREVIATURA, tablaContenidoPaquete)
          }
        }
      })
      break;
  }
})
//
$('#CambiarPaquete').on('click', function () {
  $('#seleccion-paquete').prop('disabled', false);
  $("#selectDisabled").removeClass("disable-element");
  $("#formPaqueteBotonesArea").addClass("disable-element");
  $("#formPaqueteSelectEstudio").addClass("disable-element");
  $("#informacionPaquete").addClass("disable-element");

  $('input[type=radio][name=selectChecko]:checked').prop('checked', false);
  $("#seleccion-estudio").find('option').remove().end()
  tablaContenido()
  // $('.formContenidoPaquete').prop('disabled', true);
})
//

$('input[type="radio"][name="selectPaquete"]').change(function () {
  switch ($(this).val()) {
    case '1':
      contenidoPaquete();
      break;
    case '2':
      mantenimientoPaquete();
      break;

  }
});

$('input[type=radio][name=selectChecko]').change(function () {

  if ($(this).val() != 0) {
    // selectData = null;
    rellenarSelect("#seleccion-estudio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
      area_id: this.value,
      cliente_id: $('#seleccion-paquete').val()
    }, function (listaEstudios) {
      selectEstudio = new GuardarArreglo(listaEstudios);
    }); //Mandar cliente para lista personalizada
  } else {
    rellenarSelect("#seleccion-estudio", "precios_api", 7, 'ID_SERVICIO', 'ABREVIATURA.SERVICIO', {
      area_id: this.value,
      cliente_id: $('#seleccion-paquete').val()
    }, function (listaEstudios) {
      selectEstudio = new GuardarArreglo(listaEstudios);
    });
  }
});

$('#guardar-contenido-paquete').on('click', function () {
  let dataAjax = calcularFilasTR();
  let tableData = tablaContenidoPaquete.rows().data().toArray();
  if (tableData.length > 0) {

    Swal.fire({
      title: '¿Estás guardar el contenido de este paquete?',
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
        return fetch(http + servidor + "/nuevo_checkup/api/usuarios_api.php?api=9&password=" + password)
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
          if ($('input[type=radio][name=selectPaquete]:checked').val() == 1) {
            ajaxDataSend = {
              api: 6,
              paquete_detalle: dataAjax
            };
          } else {
            ajaxDataSend = {
              api: 6,
              paquete_detalle: dataAjax,
              eliminados: dataEliminados
            };
          }
          console.log(dataEliminados);
          $.ajax({
            url: http + servidor + "/nuevo_checkup/api/paquetes_api.php",
            data: ajaxDataSend,
            type: "POST",
            datatype: 'json',
            beforeSend: function () {
              alertMensaje('info', 'Espere un momento', 'Guardando contenido del paquete en el servidor');
            },
            success: function (data) {
              data = jQuery.parseJSON(data);
              if (mensajeAjax(data)) {
                tablaContenidoPaquete.clear().draw();
                dataEliminados = new Array()
                alertMensaje('success', 'Contenido registrado', 'El contenido se a registrado correctamente :)')
              }
            }
          })
        } else {
          alertSelectTable('¡Contraseña incorrecta!', 'error')
        }
      }
    })
  } else {
    alertMensaje('error', '¡Faltan datos!', 'Necesita rellenar la tabla de estudios para continuar')
  }

  // console.log()
})

function formpassword() {
  //No submit form with enter
}

$(document).on("change ,  keyup", "input[name='cantidad-paquete'], input[name='descuento-paquete']", function () {
  calcularFilasTR()
});