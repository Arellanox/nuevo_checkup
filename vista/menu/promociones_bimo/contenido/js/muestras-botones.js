






// Drag and drop
InputDragDrop('#dropCertificadoMedico', (inputArea, salidaInput) => {

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