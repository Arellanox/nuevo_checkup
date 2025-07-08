<ul class="dropdown-menu bg-navbar-drop dropdown-menu-lg-end" aria-labelledby="dropNotifications" style="padding: 0px; width: 300px;">
    <div id="notifications-content">
        <!--Head-->
        <div class="header">
            <span>Mis Notificaciones</span>
            <span class="checked-notification-marked" role="button" onclick="onLimpiarBandejaNotificaciones()">
                Marcar Lectura
            </span>
        </div>
        <!-- Body -->
        <div class="body">
            <?php if (isset($notifications)): ?>

            <?php else: ?>
                <p class="not-found">Sin notificaciónes disponibles</p>
            <?php endif; ?>
        </div>
        <!-- Footer -->
        <div class="footer" style="overflow: hidden">
        </div>
    </div>
</ul>
<style>
    .user-profile-navbar{
        min-width: max-content;
    }
    .toggle-notification-header{
        position: relative;
        user-select: none;
    }
    .notification-bell-display{
        position: absolute;
        background-color: #d58512;
        border-radius: 100%;
        color: white;
        font-size: 12px;
        font-weight: 600;
        padding: 1px;
        width: 18px;
        height: 18px;
        top: -4px;
        right: -5px;
        text-align: center;
    }

    .notification-bell-display.hidden{
        display: none;
    }

    .vibrating {
        display: inline-block;
        animation: vibrate 0.3s infinite alternate;
        color: #d58512;
    }

    @keyframes vibrate {
        0% { transform: rotate(0deg); }
        25% { transform: rotate(-10deg); }
        50% { transform: rotate(10deg); }
        75% { transform: rotate(-5deg); }
        100% { transform: rotate(5deg); }
    }

    #notifications-content .header{
        display: flex;
        justify-content: space-between;
        align-content: center;
        padding: 8px 10px;
        font-size: 13px;
        font-weight: bolder;
        background-color: #004e59;
        color: white;
        letter-spacing: 1.5px;
        user-select: none;
    }
    #notifications-content .header span:last-child{
        font-size: 12px;
        font-weight: normal;
    }
    #notifications-content .header span:last-child:hover{
        color: #d58512;
    }
    #notifications-content .body{
        display: flex;
        flex-direction: column;
        gap: 4px;
        padding: 6px 0;
        overflow-y: auto;
        overflow-x: hidden;
        max-height: 700px;
    }
    #notifications-content .body .notification-item:hover{
        background-color: rgba(213, 133, 18, 0.1);
    }
    #notifications-content .body .date{
        text-align: right;
        font-size: 11px;
        color: #6e7d88;
        font-weight: normal;
        letter-spacing: normal;
        margin-bottom: -4px;
    }
    #notifications-content .body .message{
        text-align: left;
        font-size: 14px;
        color: #18343e;
        font-weight: normal;
        letter-spacing: normal;
    }
    #notifications-content .body .author{
        text-align: left;
        font-size: 12px;
        color: #6e7d88;
        font-weight: normal;
        letter-spacing: normal;
    }

    #notifications-content .body .not-found{
        text-align: center;
        font-size: 14px;
        color: #6e7d88;
        font-weight: normal;
        padding-top: 20px;
        padding-bottom: 20px;
    }
    #notifications-content .footer{
        background-color: #004e59;
        padding: 8px 10px;
    }
</style>