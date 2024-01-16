




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

    const galleria = new CargadorProgresivo({
      contenedor: 'galeria_prmociones',
      datos: data.response.data,
      itemsIniciales: 10,
      itemsPorCarga: 50,
      detalles: true
    });
    // if (ifnull(data, false, { 'response': 'data' })) {
    // }

  })
}