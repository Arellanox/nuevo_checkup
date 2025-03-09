<?php
    //Intentar mover a js y que se inporte de manera automatica ahi mismo??????
    include_once __DIR__.'/../app.php'; // Obtenemos las variables de referencia del servidor al incluir el archivo
    $user_id = $_SESSION['id'];
    $audio = "{$URL_SERVER}/helpers/assets/notification.mp3";
    $server = "{$URL_SERVER}/helpers/notification/server.php?user_id={$user_id}";
?>
<script>
    let ultimoId = 0;
    let sonidoHabilitado = false;
    const audioNotificacion = new Audio("<?= $audio ?>");
    const eventSource = new EventSource(`<?= $server ?>&ultimo_id=${ultimoId}`);

    document.addEventListener("click", habilitarSonidoNotificaion, { once: true });
    eventSource.onmessage = manejarNotificacion;

    function manejarNotificacion(event) {
        const data = JSON.parse(event.data);
        const notificaciones = data?.response?.data[0];

        if (Array.isArray(notificaciones) && notificaciones.length > 0) {
            const nuevoUltimoId = notificaciones[notificaciones.length - 1]?.ID_NOTIFICACION ?? 0;

            if (nuevoUltimoId > ultimoId) {
                reproducirSonidoNotificaion();
                actualizarNotificaciones(notificaciones);
                document.querySelector(".bi-bell-fill").classList.add("vibrating");
                ultimoId = nuevoUltimoId;
            }
        }
    }

    function reproducirSonidoNotificaion() {
        if (sonidoHabilitado) {
            audioNotificacion.play().catch(error => console.log("Error al reproducir sonido:", error));
        }
    }

    function habilitarSonidoNotificaion() {
        if (!sonidoHabilitado) {
            audioNotificacion.play().then(() => {
                audioNotificacion.pause();
                audioNotificacion.currentTime = 0;
                sonidoHabilitado = true;
            }).catch(error => console.log("No se pudo activar el sonido:", error));
        }
    }

    function actualizarNotificaciones(notificaciones) {
        const notificationBody = document.querySelector("#notifications-content .body");
        notificationBody.innerHTML = generarHTMLNotificaciones(notificaciones);
    }

    function generarHTMLNotificaciones(notificaciones) {
        return notificaciones.map(notification => `
            <a href="${notification.VINCULO}" class="notification-item">
                <p class="date">${notification.FECHA_SOLICITADO}</p>
                <p class="message">${notification.MENSAJE}</p>
                <p class="author">${notification.REMITENTE_NOMBRE}</p>
            </a>
        `).join("");
    }
</script>