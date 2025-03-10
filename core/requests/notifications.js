async function marcarNotificaciones(idsNotificaciones, usuarioId){
    await ajaxAwait({
        api: 2,
        notificacion_id: idsNotificaciones,
        user_id: usuarioId
    }, 'notificaciones_api', { callbackAfter: true }, false, function (data) {
        alertToast('Notificación marcada exitosamente.', 'success', 4000);
    });
}

async function crearNotificacion(usuarioId, mensaje, vinculo, cargos_id){
    await ajaxAwait({
        api: 3,
        user_id: usuarioId,
        mensaje: mensaje,
        vinculo: vinculo,
        cargos: cargos_id
    }, 'notificaciones_api', { callbackAfter: true }, false, () => {

    });
}
