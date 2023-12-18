$(document).on('click', '#btn-capturas-microscopio', async function (event) {
    event.preventDefault();

    // await getCapturas();

    $('#modalCapturasMicroscopio').modal('show');

})


async function getCapturas() {
    return new Promise(async function (resolve, reject) {
        await ajaxAwait({}, 'api', { callbackBefore: true }, false, () => {



            // Retorna que esta listo
            resolve(1)
        })

    })
}

InputDragDrop('#dropMicroscopio', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
      turno_id: selectListaLab['ID_TURNO'], api: 1
    }, 'laboratorio_api', 'subirCapturaMicroscopio', { callbackAfter: true }, false, function () {
    //   obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')
  
      // Siempre se ejecuta al final del proceso
      salidaInput();
  
    })
  })