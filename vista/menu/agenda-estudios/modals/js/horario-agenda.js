$(document).on('submit', '#fromAjusteHora', function (event) {
    event.preventDefault();

    alertMensajeConfirm({
        title: '¿Deseas cambiar la configuración?',
        text: 'Cambiaras el horario para los proximas agendas.',
        icon: 'warning',
    }, () => {
        ajaxAwaitFormData({
            api: 5,
            area_id: localStorage.getItem('areaActual')
        }, 'agenda_api', 'fromAjusteHora', { callbackAfter: true }, false, () => {
            alertToast('¡Horario actualizado!', 'success', 4000)
        })
    }, 1)
})