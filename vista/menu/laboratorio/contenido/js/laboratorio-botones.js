$('#formAnalisisLaboratorio').submit(function (event) {
  event.preventDefault();

  if (selectListaLab['CONFIRMADO'] == 0) {
    let confirmar = 0;
    var form = document.getElementById("formAnalisisLaboratorio");
    var formData = new FormData(form);
    formData.set('id_turno', selectListaLab['ID_TURNO']);
    formData.set('id_area', areaActiva)
    formData.set('api', 9);
    // console.log(formData);
    if ($('.subir-resultado-lab:focus').attr('data-attribute') == 'confirmar') {
      formData.set('confirmar', 1);
      title = "¿Está seguro de confirmar los resultados?";
      text = "¡No podrá revertir esta acción!";
      alertmeensj = 'Cerrando y generando formato de laboratorio';
      alertoas = '¡Resultados listos!';
      confirmar = 1;
    } else {
      title = "¿Estás seguro de guardar los resultados?";
      text = "Use su contraseña de su sesión para guardar/actualizar los resultados";
      alertmeensj = 'Guardando resultado de laboratorio';
      alertoas = '¡Resultados guardados!'
      confirmar = 0;

    }

    Swal.fire({
      title: title,
      text: text,
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
        return fetch(`${http}${servidor}/${appname}/api/usuarios_api.php?api=9&password=${password}`)
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
          });
      },
      allowOutsideClick: () => !Swal.isLoading()
    }).then((result) => {
      if (result.isConfirmed) {
        if (result.value.status == 1) {
          $.ajax({
            data: formData,
            url: "../../../api/turnos_api.php",
            type: "POST",
            processData: false,
            contentType: false,
            beforeSend: function () {
              alertMensaje('info', 'Espere un momento', alertmeensj)
            },
            success: function (data) {
              data = jQuery.parseJSON(data);
              if (mensajeAjax(data)) {
                alertSelectTable(alertoas, 'success')
                // dataListaPaciente = {api:5, fecha_busqueda: $('#fechaListadoLaboratorio').val(), area_id: 6}
                if (confirmar) {
                  tablaListaPaciente.ajax.reload();
                  getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
                }
              }
            },
          });
        } else {
          alertSelectTable('¡Contraseña incorrecta!', 'error')
        }
      }
    })
  }
})

$('.subir-resultado-lab').click(function () {
  if ($('.subir-resultado-lab:focus').attr('data-attribute') == 'confirmar') {
    $('.inputFormRequired').prop('required', true);
  } else {
    $('.inputFormRequired').prop('required', false);
  }
  $("#btnConfirmarResultados").click();
})

$('#btn-confirmar-formulario').click(function (e) {

})

// $('#btn-guardar-resultados').click(function(){
//   alert("button guardar")
//   console.log($(this))
//   $('#formAnalisisLaboratorio').submit()
//
// })

// $('#btn-confirmar-resultados').click(function(){
//   alert("button confirmar")
//   console.log($(this))
//   // enviarInformacion(1)
//   $('#formAnalisisLaboratorio').submit()
// })
//
//
// $('#formAnalisisLaboratorio').on('submit')

function enviarInformacion(tip) {

}




function formpassword() {
  //No submit form with enter
}

// cambiar fecha de la Lista
$('#fechaListadoLaboratorio').change(function () {
  recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
  if ($(this).is(':checked')) {
    recargarVistaLab(0)
    $('#fechaListadoLaboratorio').prop('disabled', true)
  } else {
    recargarVistaLab();
    $('#fechaListadoLaboratorio').prop('disabled', false)
  }
})

function recargarVistaLab(fecha = 1) {
  dataListaPaciente = {
    api: 5,
    area_id: areaActiva
  }
  if (fecha) dataListaPaciente['fecha_busqueda'] = $('#fechaListadoLaboratorio').val();

  tablaListaPaciente.ajax.reload();
  getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
}

// obtenerPDF
$(document).on('click', '.obtenerPDF', function (event) {
  // alert('si')
  event.stopPropagation();
  event.stopImmediatePropagation();
  let id = $(this).attr('data-bs-id');
  $.ajax({
    url: `${http}${servidor}/${appname}/api/servicios_api.php`,
    type: "POST",
    // dataType: 'json',
    data: {
      id_turno: id,
      api: 13
    },
    beforeSend: function () {
      alertMensaje('info', 'Espere un momento', 'Generando')
    },
    success: function (data) {
      console.log(data);
      alertMensaje(null, null, null, null,
        `<div class="d-flex justify-content-center"> <a href="` + data + `" class="btn btn-borrar" target="_blank" style="width: 50%"> <i class="bi bi-image"></i> Descargar</a></div></div>`
      )

    }
  })
})


// imprimr lista de trabajo con codigo de barras
$('#btn-lista-trabajo-barras').click(function(){
  api = encodeURIComponent(window.btoa('lista-barras'));
  turno = encodeURIComponent(window.btoa($('#fechaListadoLaboratorio').val()));
  area = encodeURIComponent(window.btoa(areaActiva));

  window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
})

//marcar un estuio como pendiente
$(document).on('click', '.btn-estudios-pendientes', async function(event){

  event.preventDefault();
  var servicio_id = $(this).attr('data-bs-id');
  var servicio = $(this).attr('data-bs-text');
  var pending = $(this).attr('data-bs-pending');
  

  var msh;
  var msh2;

  if (parseInt(pending) == 1){
    msh = "¿Quieres completar este estudio?";
    pending = 0;
    msh2 = `${servicio} COMPLETADO!`;
  } else {
    msh = "¿Quieres marcar este estudio como PENDIENTE?";
    pending = 1;
    msh2 = `${servicio} está PENDIENTE!`;
  }

  // volver a la posicion del estudio
  $('html, body').animate({ scrollTop: 0 }, 'slow');

  // enviar la solicitud
  alertMensajeConfirm({
        title: msh,
        text: servicio,
        icon: 'warning',
        confirmButtonText: 'Sí'
    }, function () {
        //envio de datos
        ajaxAwait({
          api: 5,
          turno_id: selectListaLab.ID_TURNO,
          id_servicio: servicio_id,
          pendiente: pending
        }, 'laboratorio_servicios_api', { callbackAfter: true }, false, function (data) {
          alertToast(msh2, 'success', 4000);
          // recargarVistaLab();
          
          // cambiar atributo checked
          if(parseInt(pending)==1){
            $(`#lbl${servicio_id}`).removeClass('btn-outline-danger');
            $(`#lbl${servicio_id}`).addClass('btn-danger');

            $(`#check${servicio_id}`).prop('checked', true);
          } else {
            $(`#lbl${servicio_id}`).removeClass('btn-danger');
            $(`#lbl${servicio_id}`).addClass('btn-outline-danger');

            $(`#check${servicio_id}`).prop('checked', false);
          }
      });

      // actualizar la notificacion de estudios pendientes
      ajaxAwait({
        api: 6
      }, 'laboratorio_servicios_api', { callbackAfter: true }, false, function (data) {
        $('#estudios-pendientes-notificacion').text(data.response.data);
      });

      tableEstudiosPendientes.ajax.reload();

    }, 
    1,
    function () {
      // en caso de que nieguen la accion
      alert("has negado la accion");
      $('html, body').animate({ scrollTop: 0 }, 'slow');
    },
    function (event) {
      // volver a la posicion del estudio
      // en caso de que cancelen la accion la accion
      if (event) event.preventDefault();
      setTimeout(() => {
        document.documentElement.scrollTop = 0; // Para navegadores modernos
        document.body.scrollTop = 0; // Para navegadores antiguos
        return false; // Asegúrate de que la función no continúe
        
      }, 1500);
    }
  );
  

});


//mostrar modal de estudios pendientes
$('#btn-estudios-pendientes-notificacion').click(function(){
  $('#modalEstudiosPendientes').modal("show");
});