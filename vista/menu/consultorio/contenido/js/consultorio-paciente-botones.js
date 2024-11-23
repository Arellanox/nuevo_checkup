$('#agregar-nota-historial').on('click', function () {
  var event = new Date();
  var options = {
    hours: 'numeric',
    minutes: 'numeric',
    weekday: 'long',
    year: 'numeric',
    month: 'short',
    day: 'numeric'
  };

  $.ajax({
    url: `${http}${servidor}/${appname}/api/notas_historia_api.php`,
    type: "POST",
    dataType: "json",
    data: {
      api: 1,
      id_turno: pacienteActivo.array['ID_TURNO'],
      notas: $('#nota-historial-paciente').val()
    },
    success: function (data) {
      if (mensajeAjax(data)) {
        // console.log(data);
        agregarNotaConsulta(session.nombre + " " + session.apellidos, event.toLocaleDateString('es-ES', options), $('#nota-historial-paciente').val(), '#notas-historial', data.response.data, 'eliminarNota');
      }
    }
  });
})

$(document).on('click', '.eliminarNota', function () {
  let id = $(this).attr('data-bs-id');
  let button = $(this);
  button.prop('disabled', true);
  $.ajax({
    url: `${http}${servidor}/${appname}/api/notas_historia_api.php`,
    type: "POST",
    dataType: "json",
    data: {
      api: 4,
      id_nota: id,
    },
    success: function (data) {
      if (mensajeAjax(data)) {
        button.prop("disabled", false)
        $('#nota-historial-paciente').val('')
        var parent_element = button.closest("div");
        $(parent_element).remove()
      }
    }
  });
});

$('#btn-regresar-vista').click(function () {
  alertMensajeConfirm({
    title: "¿Está seguro de regresar?",
    text: "Asegurese de guardar los cambios",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar",
  }, function () {
    obtenerConsultorioMain();
  })
})

$(document).on('click', '.guardarHistoriaFam', function(event){
  event.stopPropagation();
  event.stopImmediatePropagation();
  button = $(this);
  button.prop('disabled', true);
  var parent_element = button.closest('form').attr('id');
  console.log(parent_element);
  let formData = new FormData(document.getElementById(parent_element));
  formData.set('api', 4);
  formData.set('turno_id', pacienteActivo.array['ID_TURNO']);
  $.ajax({
    data: formData,
    url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
    type: 'POST',
    processData: false, 
    contentType: false,
    dataType: 'json',
    beforeSend: function(){
      alertToast('Guardando...', 'info')
    },
    success: function(data){
      button.prop('disabled', false);
      alertToast('Guardado con éxito!', 'success');
    }
  })
})

// Nutricion alimentos, nutAlimentos
$(document).on('click', '.guardarNutAlimentos', function(event){
  event.stopPropagation();
  event.stopImmediatePropagation();
  button= $(this);
  button.prop('disabled', true);
  var parent_element = button.closest('form').attr('id');
  let formData = new FormData(document.getElementById(parent_element));
  formData.set('api', 6);
  formData.set('turno_id', pacienteActivo.array['ID_TURNO']);

  $.ajax({
    data: formData,
    url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
    type: 'POST',
    processData: false,
    contentType: false,
    dataType: 'json',
    beforeSend: function(){
      alertToast('Guardando...Espere por favor', 'info')
    },
    success: function(){
      button.prop('disabled', false);
      alertToast('Guardado con éxito!', 'success')
    }
  })
})


// $('.').on
$(document).on('click', '.guardarAnt ', function (event) {
  event.stopPropagation();
  event.stopImmediatePropagation();
  button = $(this)
  button.prop('disabled', true);
  var parent_element = button.closest("form").attr('id');
  // console.log(parent_element);
  let formData = new FormData(document.getElementById(parent_element));
  // console.log(formData);
  formData.set('api', 16);
  formData.set('turno_id', pacienteActivo.array['ID_TURNO']);

  $.ajax({
    data: formData,
    url: `${http}${servidor}/${appname}/api/consulta_api.php`,
    type: "POST",
    processData: false,
    contentType: false,
    dataType: 'json',
    beforeSend: function () {
      // alert('Enviando')
      alertToast('Guardando...', 'info')
    },
    success: function (data) {
      button.prop('disabled', false);
      alertToast('Guardado con éxito', 'success');
    },
  });
  // eliminarElementoArray(id);
  // console.log(id);

});

//Guardar las exploraciones de sigma
$(document).on('click', '.guardar-form-exploracion', function(event){
  event.stopPropagation();
  event.stopImmediatePropagation();
  button = $(this)
  button.prop('disabled', true);
  var parent_element = button.closest("form").attr('id');
  let formData = new FormData(document.getElementById(parent_element));
  formData.set('api', 8);
  formData.set('turno_id', pacienteActivo.array['ID_TURNO']);

  $.ajax({
    data: formData,
    url: `${http}${servidor}/${appname}/api/ficha_admision_api.php`,
    type: "POST",
    processData: false,
    contentType: false,
    dataType: 'json',
    beforeSend: function () {
      // alert('Enviando')
      alertToast('Guardando...', 'info')
    },
    success: function (data) {
      button.prop('disabled', false);
      alertToast('Guardado con éxito', 'success');
    },
    completed: function(){
      button.prop('disable', false);
    }
  })

  
})

//botones de pdf de vista previa
//busca y muestra lso botones solo si tiene ya una receta y solicitud mientrtas que las url esten vacias no las mostrara
// ajaxAwait({ api: 2, turno_id: pacienteActivo.array['ID_TURNO'] }, 'consultorio2_api', { callbackAfter: true }, false, function (data) {
//   let row = data.response.data[0]


//   if (row['RUTA_RECETAS'] == null) {
//     //oculta el boton
//     $('#btn-ver-receta-consultorio2').hide()
//   } else {
//     //lo muestra
//     $('#btn-ver-receta-consultorio2').show()

//     //vista previa de recetas
//     $('#btn-ver-receta-consultorio2').click(function () {
//       area_nombre = 'receta'

//       api = encodeURIComponent(window.btoa(area_nombre));
//       turno = encodeURIComponent(window.btoa(pacienteActivo.array['ID_TURNO']));
//       area = encodeURIComponent(window.btoa(-2));

//       window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
//     })
//   }

//   if (row['RUTA_SOLICITUDES'] == null) {
//     //lo oculta
//     $('#btn-ver-solicitud-estudios-consultorio2').hide()
//   } else {
//     //lo muestra
//     $('#btn-ver-solicitud-estudios-consultorio2').show()

//     //Vista previa de solicitud de estudios
//     $('#btn-ver-solicitud-estudios-consultorio2').click(function () {
//       area_nombre = 'solicitud_estudios'

//       api = encodeURIComponent(window.btoa(area_nombre));
//       turno = encodeURIComponent(window.btoa(pacienteActivo.array['ID_TURNO']));
//       area = encodeURIComponent(window.btoa(-3));


//       window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
//     })
//   }
// })



// <div id="notas-historial" class="mt-3">
//   <h4 class="m-3">INGLES: </h4>
//   <div style="margin: -1px 30px 20px 30px;">
//     <p class="none-p"><p>
//   </div>
// </div>
//
// <div id="notas-historial" class="card mt-3">
//   <h4 class="m-3">@Usuario actual <p style="font-size: 14px;margin-left: 5px;">xx:xx Septiembre dia, año</p></h4>
//   <div style="margin: -1px 30px 20px 30px;">
//     <p class="none-p">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
//   </div>
// </div>



// $('#btn-subir-certificado-medico').on('click', function () {
//   alertMensajeConfirm({
//     title: '¿Está seguro de guardar este certificado?',
//     text: 'Solo hay un espacio para guardar los certificados, se guardará o reemplazará si hay uno anterior.',
//     textButtonConfirm: 'Si, acepto',
//     icon: 'warning',
//   }, () => {
// ajaxAwaitFormData({
//   turno_id: pacienteActivo.array['ID_TURNO'], api: 1
// }, 'certificado_medico_api', 'subirResultadosCertificadoMedico', { callbackAfter: true }, false, function () {
//   alertToast('El certificado medico ya ha sido guardado', 'success', 4000);
//   obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')
//   $('#modalCertificadoMedico').modal('hide');
// })
//   }, 1)
// })

InputDragDrop('#dropCertificadoMedico', (inputArea, salidaInput) => {

  ajaxAwaitFormData({
    turno_id: pacienteActivo.array['ID_TURNO'], api: 1
  }, 'certificado_medico_api', 'subirResultadosCertificadoMedico', { callbackAfter: true }, false, function () {
    obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')

    // Siempre se ejecuta al final del proceso
    salidaInput();

  })
})

// Subir certificado para POE
InputDragDrop('#dropCertificadoPOE', (inputArea, salidaInput) => {
  ajaxAwaitFormData({
    turno_id: pacienteActivo.array['ID_TURNO'], api: 1
  }, 'certificado_poe_api', 'subirResultadosCertificadoPOE', { callbackAfter: true }, false, function () {
    obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')

    salidaInput();

  })
})

// Subir certificado bimo

InputDragDrop('#dropCertificadoBimo', (inputArea, salidaInput) => {
  ajaxAwaitFormData({
    turno_id: pacienteActivo.array['ID_TURNO'], api: 3
  }, 'certificado_poe_api', 'subirResultadosCertificadoBimo', { callbackAfter: true }, false, function () {
    obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')

    salidaInput();

  })
})


// $(document).ready(function () {
//   dropArea = $('#dropCertificadoMedico');
//   fileInput = $('#file-certificado-medico');

//   // // Prevenir comportamiento predeterminado en eventos de arrastrar y soltar

//   // ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
//   //   dropArea.on(eventName, function (e) {
//   //     e.preventDefault();
//   //     e.stopPropagation();
//   //   });
//   // });


//   // Agregar y quitar clase 'hover' para resaltar la zona de soltar
//   ['dragenter', 'dragover'].forEach(eventName => {
//     dropArea.on(eventName, function () {
//       dropArea.addClass('hover');
//     });
//   });


//   ['dragleave', 'drop'].forEach(eventName => {
//     dropArea.on(eventName, function () {
//       dropArea.removeClass('hover');
//     });
//   });

//   // Manejar el evento de soltar
//   dropArea.on('drop', function (e) {
//     e.preventDefault();
//     e.stopPropagation();

//     let dt = e.originalEvent.dataTransfer;
//     let files = dt.files;

//     handleFiles(files);
//   });

//   // Manejar clic en el botón para seleccionar archivos
//   fileInput.on('change', function () {
//     let files = fileInput[0].files;

//     // let files_input = fileInput;
//     // console.log(files_input);

//     if (handleFiles(files)) {
//       ajaxAwaitFormData({
//         turno_id: pacienteActivo.array['ID_TURNO'], api: 1
//       }, 'certificado_medico_api', 'subirResultadosCertificadoMedico', { callbackAfter: true }, false, function () {
//         alertToast('El certificado medico ya ha sido guardado', 'success', 4000);
//         obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')
//         // $('#modalCertificadoMedico').modal('hide');
//       })
//     } else {

//     }


//     // alertMensajeConfirm({
//     //   title: '¿Está seguro de guardar este certificado?',
//     //   text: 'Solo hay un espacio para guardar los certificados, se guardará o reemplazará si hay uno anterior.',
//     //   textButtonConfirm: 'Si, acepto',
//     //   icon: 'warning',
//     // }, () => {

//     // }, 1)



//   });

//   // Manejar archivos soltados o seleccionados
//   function handleFiles(files) {

//   }
// });

// ajaxAwait({ turno_id: pacienteActivo.array['ID_TURNO'], ruta_certificado: urlFile, api: 1 },
//   'certificado_medico_api', { callbackAfter: true }, false, function () {
//     alertToast('El certificado medico ya ha sido guardado', 'success', 4000)
//   })

// Aquí 'file' ya es de tipo 'File', no necesitas convertirlo en una URL blob
// Realiza las acciones necesarias con el archivo 'file' aquí mismo



// Variables globales para el dragAndDrop
// $(document).ready(function () {
//   const dropArea = $('#dropCertificadoMedico');
//   const fileInput = $('#file-certificado-medico');

//   // Prevenir comportamiento predeterminado en eventos de arrastrar y soltar
//   ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
//     dropArea.on(eventName, preventDefault);
//   });

//   // Agregar y quitar clase 'hover' para resaltar la zona de soltar
//   ['dragenter', 'dragover'].forEach(eventName => {
//     dropArea.on(eventName, () => dropArea.addClass('hover'));
//   });

//   ['dragleave', 'drop'].forEach(eventName => {
//     dropArea.on(eventName, () => dropArea.removeClass('hover'));
//   });

//   // Manejar el evento de soltar y el cambio de archivo de entrada
//   dropArea.on('drop', handleDrop);
//   fileInput.on('change', handleInputChange);

//   // Manejar archivos soltados o seleccionados
//   function handleDrop(e) {
//     e.preventDefault();
  
//     handleFiles(files);
//   }

//   function handleInputChange() {
//     const files = fileInput[0].files;
//     handleFiles(files);
//   }

//   function handleFiles(files) {
//     for (const file of files) {
//       if (file.type.startsWith('image/')) {
//         const imageUrl = URL.createObjectURL(file);
//         console.log(imageUrl);
//       }
//     }
//   }

//   function preventDefault(e) {
//     e.preventDefault();
//     e.stopPropagation();
//   }
// });



        // ajaxAwait({ turno_id: pacienteActivo.array['ID_TURNO'], ruta_certificado: imageUrl, api: 1 },
        //   'certificado_medico_api', { callbackAfter: true }, false, function () {
        //     alertToast('El certificado medico ya ha sido guardado', 'success', 4000)
        //   })




