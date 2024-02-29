

let ketApi;

ttsContent();
async function ttsContent() {
  // await obtenerTitulo("Toma de muestras");
  $.post("contenido/tts-menu.html", function (html) {
    $("#body-js").html(html);
  }).done(function () {

    // Incrementa el textarea automaticamente
    autosize($('textarea'));

    // DataTable
    $.getScript('contenido/js/script.js')
  })
}
