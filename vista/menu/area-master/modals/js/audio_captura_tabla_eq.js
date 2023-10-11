$(document).on('submit', '#formCapturaResultados', function (e) {
    e.preventDefault()
    alertMensajeConfirm({
        title: '¿Está seguro de guardar esta capturas?',
        text: "Podrá visualizar la captura en su reporte de audiometría.",
        icon: 'warning',
        showCancelButton: true,
    }, function () {

        let jsonData = {} // <- Json vacio
        jsonData['id_turno'] = dataSelect.array['turno'] // <- se llama el turno (revisar si asi se llama)
        jsonData['id_area'] = areaActiva // <- revisar de donde viene
        jsonData['api'] = 8

        let capturasArraya = []
        let audiometria_tablas = '#captures img'
        $(audiometria_tablas).each(function () {
            capturasArraya.push($(this).attr('src'))
        })
        jsonData['tabla_reporte'] = JSON.stringify(capturasArraya)

        ajaxAwaitFormData(jsonData, 'audiometria_api', 'formCapturaResultados', { callbackAfter: true }, false,
            (data) => {
                alertToast('Su captura se ha guardado correctamente', 'success', 4000)
            })
    }, 1)

})


function SubirCapturasAudiometria() {
    console.log(1)
    let jsonData = {} // <- Json vacio
    jsonData['id_turno'] = dataSelect.array['turno'] // <- se llama el turno (revisar si asi se llama)
    jsonData['id_area'] = areaActiva // <- revisar de donde viene
    jsonData['api'] = 8

    let capturasArray = []
    let audiometria_tablas = '#captures img'
    $(audiometria_tablas).each(function () {
        capturasArray.push($(this).attr('src'))
    })
    console.log(capturasArray)
    jsonData['tabla_reporte'] = JSON.stringify(capturasArray)

    // ajaxAwaitFormData(jsonData, 'audiometria_api', 'formCapturaResultados', { callbackAfter: true }, false,
    //     (data) => {
    //         // alertToast('Su captura se ha guardado correctamente', 'success', 4000)
    //     })
}

$(document).on('click', '#RegresarModalCapturarTablas', function () {
    CapturarTablaModalConfig("hide");
})