const modalCapturaOdios = document.getElementById('modalCapturaOdios')

// modalCapturaOdios.addEventListener('shown.bs.modal', () => {

//Subir captura del oido izquierdo
InputDragDrop('#dropOidoIzquierdo', (inputArea, labelArea, divCarga, salidaInput) => {

    labelArea.html('Cargando...')
    divCarga.css({ 'display': 'inline-block' })

    // ajaxAwaitFormData({
    //     turno_id: pacienteActivo.array['ID_TURNO'], api: 1
    // }, 'certificado_medico_api', 'subirResultadosCertificadoMedico', { callbackAfter: true }, false, function () {
    //     obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')
    //     labelArea.html('Se ha subido su archivo')
    //     divCarga.css({ 'display': 'none' })

    // })

    salidaInput();
})

//Subir captura del oido derecho
InputDragDrop('#dropOidoDerecho', (inputArea, labelArea, divCarga, salidaInput) => {

    labelArea.html('Cargando...')
    divCarga.css({ 'display': 'inline-block' })

    // ajaxAwaitFormData({
    //     turno_id: pacienteActivo.array['ID_TURNO'], api: 1
    // }, 'certificado_medico_api', 'subirResultadosCertificadoMedico', { callbackAfter: true }, false, function () {
    //     obtenerPanelInformacion(pacienteActivo.array['ID_TURNO'], 'consulta_api', 'listado_resultados', '#listado-resultados')
    //     labelArea.html('Se ha subido su archivo')
    //     divCarga.css({ 'display': 'none' })

    // })

    salidaInput();
})
// })

//carga-captura-oido