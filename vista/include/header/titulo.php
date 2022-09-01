<?php $menu = $_POST['menu']; ?>
<div class="px-3 py-2 border-bottom">
  <div class="container d-flex flex-wrap">
    <div class="col-12 col-lg-auto mb-2 mb-lg-0 me-lg-auto">
      <h2 class="text-center"><?php echo $menu; ?></h2> <!-- Dinamico -->
    </div>
    <div class="col-12 col-lg-auto text-center" id="botones-menu-js">
      <?php include "botones.php" ?>
    </div>
  </div>
</div>
