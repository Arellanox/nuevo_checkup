<!-- Cambiarlo dinamicamente a proximo... -->
<?php
$tipPanel = $_POST['tip'];
 ?>
<div class="m-2" id="info-php">
  <?php
    include "tip/".$tipPanel.".php";
  ?>
</div>
