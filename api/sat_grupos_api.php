<?php 
include "../clases/master_class.php";

$master = new Master();
$api = $_POST['api'];

switch ($api) {
    case 1:
        # insert
        $values = $master->mis->getFormValues(array_slice($_POST,0,2));
        echo $master->mis->returnApi($master)
        break;
    
    default:
        # code...
        break;
}
?>