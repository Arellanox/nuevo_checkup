// Abrir el model de formulario
$('#btn-interpretacionPrequi').on('click', function () {
    $('#MostrarCapturaPrequirurjico').modal('show');
})

// Obtener el reporte previo
$('#btn-ver-reporte').click(function () {
    area_nombre = ''
    api = encodeURIComponent(window.btoa(area_nombre));
    turno = encodeURIComponent(window.btoa(dataSelect.array['turno']));
    area = encodeURIComponent(window.btoa(areaActiva));


    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
})







// Enviar interpretacion a back
$(`#formInterpretacion`).submit(function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        tittle: '¿Estás seguro de guardar la interpretacion',
        text: 'Los cambios previos serán reemplazados al guardar',
        icon: 'question'
    }, function () {
        ajaxAwaitFormData({
            api: 2,
        }, 'prequirurgico_api', 'formInterpretacion', { callbackAfter: true }, false, () => {
            alert(1);
        })
    }, 1)
})