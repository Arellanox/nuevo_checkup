<div class="dropdown toggle-notification-header">
    <?php if ($_SESSION['permisos']['VisualizarNotificaciones'] == 1): ?>
        <?php include __DIR__ . '/../modals/modal-notifications-user.php'; ?>

        <a class="dropdown-toggle dropdownNotBorder" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-bell-fill"></i> Notificaciones
        </a>
        <span class="notification-bell-display hidden"></span>
    <?php endif; ?>
</div>
<div class="dropdown">
    <a class="dropdown-toggle dropdownNotBorder" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-telephone-fill"></i> Ext.
    </a>
    <?php if ($menu != 'procedencia' && $_SESSION['id_cliente'] == 15): ?>
        <?php include __DIR__ . '/../modals/modal-extensiones-telefonicas.php'; ?>
    <?php endif; ?>
</div>
