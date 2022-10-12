<!-- Cambiarlo dinamicamente a proximo... -->
<?php
$tipPanel = $_POST['tip'];
 ?>
<div class="m-2">
  <?php
    include "tip/".$tipPanel.".php";
  ?>
</div>
