<?php
$arrFiles = array();
$api = $_POST['api'];
switch ($api) {
  case '1':

    $handle = opendir('../../vista/menu/recepcion/identificacion');

    if ($handle) {
        while (($entry = readdir($handle)) !== FALSE) {
            $arrFiles[] = $entry;
        }
    }
    echo json_encode($arrFiles);
  break;

  default:
    echo "No api";
    break;
}
?>
