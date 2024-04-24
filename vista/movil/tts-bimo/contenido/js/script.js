



// Creacion de espectograma
const wavesurfer = WaveSurfer.create({
  container: '#waveContainer',
  waveColor: '#4F4A85',
  progressColor: '#383351',
  // url: '/audio.mp3',
})

let key_api_openAI = '';
ajaxAwait({}, 'tts_api', { callbackAfter: true }, true, (data) => {
  key_api_openAI = data.response.data.openAI;
})

let text = '';
$(document).on('submit', '#formSpeekText', function (e) {
  e.preventDefault();



  if (text != $('#text_area_tts').val()) {

    // Muestra el spinner y actualiza el texto del botón
    var $button = $('#generateAudioButton');
    $button.prop('disabled', true);
    $button.find('.bi-mic-fill').hide(); // Oculta el ícono del micrófono
    $button.find('.spinner-border').show(); // Muestra el spinner

    text = $('#text_area_tts').val();
    getAudio($('#text_area_tts').val(), key_api_openAI, () => {
      // Oculta el spinner y restaura el ícono y el texto del botón
      $button.prop('disabled', false);
      $button.find('.spinner-border').hide(); // Oculta el spinner
      $button.find('.bi-mic-fill').show(); // Muestra el ícono del micrófono
    })
  } else {
    if (text != '')
      wavesurfer.play();
  }
})



function getAudio(text, keyApi, callback) {

  // Define tus variables
  const apiKey = keyApi; // Reemplaza esto con tu clave API real
  const model = 'tts-1';
  const inputText = text;
  const voice = 'shimmer';

  // Configura los detalles de la solicitud
  const data = {
    model: model,
    input: inputText,
    voice: voice
  };

  // Realiza la solicitud a la API de OpenAI
  fetch('https://api.openai.com/v1/audio/speech', {
    method: 'POST',
    headers: {
      'Authorization': `Bearer ${apiKey}`,
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  }).then(response => response.blob()) // Obtiene la respuesta como un blob
    .then(blob => {

      const url = URL.createObjectURL(blob);

      // Carga el audio de la URL generada y lo reproduce
      wavesurfer.load(url);
      wavesurfer.on('ready', function () {
        wavesurfer.play();

        if (typeof callback === 'function') {
          callback();
        }
      });

      // Asegúrate de manejar los errores también
      wavesurfer.on('error', function () {
        if (typeof callback === 'function') {
          callback();
        }
      });


    }).catch((error) => {

      alertMensaje('warning', 'ha ocurrido un error al procesar el texto o audio', 'Revisa consola')

      callback();

      console.error('Error:', error)
    });
}