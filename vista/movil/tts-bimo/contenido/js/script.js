



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


$(document).on('submit', '#formSpeekText', function (e) {
  e.preventDefault();

  getAudio($('#text_area_tts').val(), key_api_openAI)
})



function getAudio(text, keyApi) {

  // Define tus variables
  const apiKey = keyApi; // Reemplaza esto con tu clave API real
  const model = 'tts-1';
  const inputText = text;
  const voice = 'alloy';

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
      });


    }).catch((error) => {

      alertMensaje('warning', 'ha ocurrido un error al procesar el texto o audio', 'Revisa consola')

      console.error('Error:', error)
    });
}