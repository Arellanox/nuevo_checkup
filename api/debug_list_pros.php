<?php
// Debug script for Professionals List
error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "Changing CWD to clases folder for includes resolution...\n";
chdir(__DIR__ . "/../clases");

echo "Loading Master Class...\n";
if (file_exists("master_class.php")) {
    require_once "master_class.php";
} else {
    die("Master Class not found in " . getcwd());
}

echo "Instantiating Master...\n";
$master = new Master();

echo "Calling sp_tracking_profesionales_listado_v2 with empty search...\n";
try {
    $res = $master->getByProcedureWithFecthAssoc('sp_tracking_profesionales_listado_v2', ['']);
    echo "Result Count: " . count($res) . "\n";
    print_r($res);
} catch (Exception $e) {
    echo "Error calling SP: " . $e->getMessage() . "\n";
}

echo "\nDone.\n";
