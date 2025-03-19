<?php
    $user_id = $_SESSION['id'];
    $audio_file = $current_url."/core/assets/notification.mp3";
    $server_file = $current_url."/core/services/notifications/server.php?user_id={$user_id}";
    $request_file = $current_url."/core/requests/notifications.js";
?>
<script src="<?=$request_file?>"></script>
<script>
    let ultimoId = 0;
    let sonidoHabilitado = false;
    let notificationsIds = [];
    const audioNotificacion = new Audio("<?= $audio_file ?>");
    const eventSource = new EventSource(`<?= $server_file ?>&ultimo_id=${ultimoId}`);

    document.addEventListener("click", habilitarSonidoNotificaciones, { once: true });
    eventSource.onmessage = manejarNotificacion;
    eventSource.onopen = () => { console.log('🚀 Server is ready 🚀') }
    
    function manejarNotificacion(event)
    {
        const data = JSON.parse(event.data);
        const notificaciones = data?.response?.data[0];

        if (Array.isArray(notificaciones) && notificaciones.length > 0) {
            const nuevoUltimoId = notificaciones[notificaciones.length - 1]?.ID_NOTIFICACION ?? 0;

            if (nuevoUltimoId > ultimoId) {
                reproducirSonidoNotificaciones();
                actualizarNotificaciones(notificaciones);
                obtenerNotificacionesIds(notificaciones)
                mostrarConteoNotificaciones(notificaciones.length);
                manejarVibracionCapana(true);
                ultimoId = nuevoUltimoId;
            }
        } else {
            mostrarConteoNotificaciones(0);
            manejarVibracionCapana(false);
        }
    }

    function manejarVibracionCapana(activar){
        let bell = document.querySelector(".bi-bell-fill");

        if(bell){
            if(activar){
                bell.classList.add("vibrating");
            } else bell.classList.remove("vibrating");
        }
    }

    function mostrarConteoNotificaciones(count)
    {
        const bell = document.querySelector(".notification-bell-display");

        if(count > 0 && bell) {
            bell.classList.remove('hidden');
            bell.textContent = count;
        } else bell.classList.add('hidden');
    }

    function reproducirSonidoNotificaciones()
    {
        if (sonidoHabilitado) {
            audioNotificacion.play().catch(error => console.log("Error al reproducir sonido:", error));
        }
    }

    function habilitarSonidoNotificaciones()
    {
        if (!sonidoHabilitado) {
            audioNotificacion.play().then(() => {
                audioNotificacion.pause();
                audioNotificacion.currentTime = 0;
                sonidoHabilitado = true;
            }).catch(error => console.log("No se pudo activar el sonido:", error));
        }
    }

    function actualizarNotificaciones(notificaciones)
    {
        const notificationBody = document.querySelector("#notifications-content .body");
        notificationBody.innerHTML = generarHTMLNotificaciones(notificaciones);
    }

    function obtenerNotificacionesIds(notificaciones)
    {
        notificationsIds = notificaciones.map(notificacion => Number(notificacion.ID_NOTIFICACION));
    }

    function generarHTMLNotificaciones(notificaciones)
    {
        return notificaciones.map(notification => `
            <a href="${notification.VINCULO}"
                onclick="onMarcarNotificacion([${notification.ID_NOTIFICACION}])" class="notification-item">
                <p class="date">${notification.FECHA_SOLICITADO}</p>
                <p class="message">${notification.MENSAJE}</p>
                <p class="author">${notification.REMITENTE_NOMBRE}</p>
            </a>
        `).join("");
    }

    function onLimpiarBandejaNotificaciones(){
        marcarNotificaciones(notificationsIds, <?= $user_id ?>);
    }

    function onMarcarNotificacion(id){
        marcarNotificaciones(id, <?= $user_id ?>);
    }

    function onCrearNotificacion(mensaje, cargos_id, vinculo = ""){
        crearNotificacion(<?= $user_id ?>, mensaje, vinculo, cargos_id)
    }
</script>