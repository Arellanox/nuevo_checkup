<?php
$arrFiles = array();
$api = $_POST['api'];
switch ($api) {
  case '1':
    $dir = '../../vista/menu/recepcion/identificacion';
    $handle = opendir($dir);

    if ($handle) {
        while (($entry = readdir($handle)) !== FALSE) {
            $arrFiles[] = $entry;
        }
    }
    echo json_encode($dir.'/'.$arrFiles[count($arrFiles)-1]);
  break;

  default:
    echo "No api";
    break;
}
?>
