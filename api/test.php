<?php
include_once "../clases/master_class.php";
echo "hopla";
$data = array(
    array(48,184,1),
    array(48,191,2),
    array(48,185,3),
    array(48,186,4),
    array(48,188,5),
    array(48,190,6),
    array(48,192,7),
    array(48,148,8),
    array(48,189,9),
    array(48,193,10),
    array(48,194,11),
    array(48,195,12),
    array(48,196,13),
    array(48,199,14),
    array(48,198,15),
    array(48,197,16),
    array(48,200,17),
    array(49,56,1),
    array(49,232,2),
    array(49,56,3),
    array(49,232,4),
    array(49,56,5),
    array(49,232,6),
    array(343,56,1),
    array(343,232,2),
    array(343,56,3),
    array(343,232,4),
    array(343,56,5),
    array(343,232,6),
    array(343,56,7),
    array(343,232,8),
    array(343,56,9),
    array(343,232,10),
    array(47,215,1),
    array(345,347,1),
    array(345,348,2),
    array(345,349,3),
    array(345,350,4),
    array(345,351,5),
    array(346,347,1),
    array(346,348,2),
    array(346,349,3),
    array(346,350,4),
    array(346,351,5),
    array(346,352,6),
    array(346,353,7)
    
);

echo "Total";
$master = new Master();

foreach($data as $current){
    $conn = $master->connectDb();

    $sql = "update detalle_grupo set ORDEN = ? WHERE GRUPO_ID=? AND ESTUDIO_ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $current[2]);
    $stmt->bindParam(2, $current[0]);
    $stmt->bindParam(3, $current[1]);
    if($stmt->execute()){
        echo "bien";
        echo "<br>";
    } else {
        echo "  ERROR ". implode(" ", $stmt->errorInfo());
        echo "<br>";
    }
    $stmt->closeCursor();

}




?>