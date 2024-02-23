




// Agrega automatizamente un alto a los textareas
autosize(document.querySelectorAll('textarea'))
// Drag and drop
InputDragDrop('#dropPromocionalesBimo', (inputArea, salidaInput) => {

  // Siempre se ejecuta al final del proceso
  salidaInput({
    msj: { pregunta: 'Carga otro arrastrándolo' },
    dropArea_css: {
      background: 'rgb(200 254 216)', // Indicativo que hay algo cargado
    },
    strong: {
      class: 'none-p',
      borderBottom: '1px solid'
    }
  });
})

// Guarda nuevas promociones
$('#cargarPromocionalBimo').on('submit', function (e) {
  e.preventDefault();
  alertMensajeConfirm({
    title: '¿Deseas publicar esta nueva promoción?',
    text: 'No podrás actualizar la imagen'
  }, () => {
    ajaxAwaitFormData({
      api: 1
    }, 'promociones_api', 'cargarPromocionalBimo', { callbackAfter: true, resetForm: true }, false, (data) => {
      alertToast('Promocion publicada', 'success', 4000)
      getGalleryPromociones();
    })
  }, 1)
})


// Carga la galeria nuevamente
getGalleryPromociones();
function getGalleryPromociones() {
  ajaxAwait({
    api: 2
  }, 'promociones_api', { callbackAfter: true }, false, (data) => {

    new CargadorProgresivo({
      contenedor: 'galeria_prmociones',
      datos: data.response.data,
      itemsIniciales: 6,
      itemsPorCarga: 3,
      detalles: true,
      html_case: 'PROMOCIONES_BIMO', // Elije el formato a usar
    });
    // if (ifnull(data, false, { 'response': 'data' })) {
    // }

  })
}

let fdButtons = (estatus, formulario) => {
  if (estatus === 1) {
    // Esta editando
    formulario.find($('button.edit-button')).fadeOut(0);
    formulario.find($('button.cancel-button, button.save-button')).fadeIn(400);
  } else if (estatus === 0) {
    // Ha vuelto a su forma base
    formulario.find($('button.cancel-button, button.save-button')).fadeOut(0);
    formulario.find($('button.edit-button')).fadeIn(400);
  }
}

$(document).on('click', '.edit-button', function (e) {
  e.preventDefault();

  $btn = $(this); // boton que da click

  const formulario = $btn.closest('form.formEditarGalleria');
  fdButtons(1, formulario);

  formulario.find('.edit_format').each(function () {
    let elemento = $(this);
    // Guardar el HTML original
    elemento.attr('data-original-html', elemento.html());

    let info = {
      inputName: elemento.attr('input-name'),
      typeInput: elemento.attr('type-input'),
      valueSave: elemento.attr('value-save'),
      width: ifnull(elemento.attr('data-width'), '100%'), // Le da una relacion especifica, sino 100%
    };
    switch (info.typeInput) {
      case 'select':
        // Solo funcionando para el activo
        // elemento.html(`
        //   <select 
        //     name="${info.inputName}" 
        //     value-after="${info.valueSave}"
        //     value="-1"
        //     class="input-form">

        //     <option value="1">Activo</option>
        //     <option value="0">Pausar</option>
        //   </select>
        // `)

        // elemento.find('select').val(info.valueSave);
        break;

      default:
        // Inputs generados
        elemento.html(`
          <input class="form-control input-form edit-input-text"
            name="${info.inputName}"
            type="${info.typeInput}"
            value="${info.valueSave}"
            value-after="${info.valueSave}"
            style="width: ${info.width};margin: 0px;">
        `)
        break;
    }

  });
})


$(document).on('click', '.cancel-button', function (e) {
  e.preventDefault();

  const formulario = $(this).closest('form.formEditarGalleria');
  fdButtons(0, formulario);

  formulario.find('.edit_format').each(function () {
    let elemento = $(this);

    // Recuperar y reestablecer el HTML original
    let originalHtml = elemento.attr('data-original-html');
    elemento.html(originalHtml);
  });
});


$(document).on('click', '.save-button', function (e) {
  e.preventDefault();

  const formulario = $(this).closest('form.formEditarGalleria');


  alertMensajeConfirm({
    title: '¿Deseas actualizar la promoción?',
    text: '¡Si esta activa la promoción, todos prodan verlo!'
  }, () => {
    ajaxAwaitFormData({
      api: 1, id_promocion: $(this).attr('data-bs-id_promocion'),
    }, 'promociones_api', null, { callbackAfter: true, resetForm: true, formJquery: formulario }, false, (data) => {
      alertToast('¡Promocion guardada!', 'success', 4000)

      // Cambiamos de estado el formulario
      fdButtons(0, formulario);
      // Generamos y devolvemos los valores como estaban
      formulario.find('.edit_format').each(function () {
        let elemento = $(this);
        let inputElement = elemento.find('input, select');

        // Verificar si realmente hay un input (por seguridad)
        if (inputElement.length > 0) {
          let nuevoValor = inputElement.val();

          // Actualizar el valor guardado y el HTML original
          elemento.attr('value-save', nuevoValor);

          if (inputElement.type == 'number') {
            nuevoValor = formatoFecha2(nuevoValor, [0, 1, 5, 2, 0, 0, 0]);
          }

          if (inputElement.is('select')) {
            console.log(nuevoValor, inputElement)
            nuevoValor = nuevoValor === "1" ? 'Si' : 'No';
          }

          elemento.attr('data-original-html', nuevoValor);

          // Cambiar el input de vuelta a texto normal
          elemento.html(nuevoValor);
        }
      });

    })
  }, 1)


});
