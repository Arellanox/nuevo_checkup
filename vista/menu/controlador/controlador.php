<?php include "../../variables.php"; ?>

<!-- HTML -->
<header id="header-js">
</header>
<div id="titulo-js">
</div>
<div class="container-fluid " id="body-js">
  <div class="col-12 loader" id="loader">
    <div class="preloader" id="preloader"></div>
  </div>
</div>
<div id="modals-js"></div>
<!-- HTML -->

<?php include __DIR__. "/../../../core/includes/menu_includes.php"; ?>
<?php include __DIR__. "/../../../core/includes/inputs_includes.php"; ?>

<?php if ($menu != 'procedencia' && $_SESSION['id_cliente'] == 15): ?>
    <?php include __DIR__. "/../../../core/services/notifications/notifications.php "; ?>
<?php endif; ?>