InputDragDrop('#dropReporteCitologia', (inputArea, salidaInput) => {

    ajaxAwaitFormData({
        turno_id: dataSelect.array['turno'], api: 10
    }, 'citologia_api', 'subirReporteCitologia', { callbackAfter: true }, false, function (data) {
        console.log(data)
        salidaInput();

    })
})