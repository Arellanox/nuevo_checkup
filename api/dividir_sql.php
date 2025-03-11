<?php
include "../clases/dividir_sql_class.php";


$sqlObject = new SQLFileDivider("./archivos/sql/copia_local.sql","archivos/splittedSql/",15);

$sqlObject->divideSQLFile();

?>