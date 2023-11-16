<?php
include "../clases/dividir_sql_class.php";


$sqlObject = new SQLFileDivider("./archivos/sql/mibase.sql","archivos/splittedSql/",15);

$sqlObject->divideSQLFile();

?>