$('#btn-interpretacionPrequi').on('click', function () {
    $('#MostrarCapturaPrequirurjico').modal('show');
})



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