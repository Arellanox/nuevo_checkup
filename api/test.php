<?php
include_once "../clases/master_class.php";
echo "hopla";
$data = array(
    array(6,74),
array(16,34),
array(17,34),
array(18,34),
array(33,18),
array(34,18),
array(45,34),
array(46,34),
array(51,74),
array(52,74),
array(53,74),
array(60,34),
array(61,34),
array(62,34),
array(64,34),
array(65,34),
array(66,51),
array(67,62),
array(68,128),
array(69,62),
array(70,41),
array(71,62),
array(72,62),
array(73,62),
array(74,62),
array(75,62),
array(76,62),
array(77,62),
array(78,62),
array(79,62),
array(80,41),
array(81,80),
array(82,145),
array(83,121),
array(84,121),
array(85,75),
array(86,74),
array(87,111),
array(88,111),
array(89,111),
array(90,51),
array(92,77),
array(93,22),
array(94,74),
array(95,74),
array(96,74),
array(98,34),
array(100,113),
array(103,34),
array(104,34),
array(105,34),
array(106,34),
array(107,34),
array(108,34),
array(109,34),
array(110,34),
array(111,34),
array(112,34),
array(113,74),
array(114,34),
array(115,34),
array(116,34),
array(117,34),
array(118,34),
array(119,34),
array(120,34),
array(121,34),
array(122,34),
array(123,51),
array(124,51),
array(126,111),
array(127,74),
array(128,74),
array(129,74),
array(130,74),
array(131,74),
array(133,86),
array(134,86),
array(135,86),
array(136,74),
array(137,74),
array(138,74),
array(140,74),
array(144,62),
array(146,111),
array(147,111),
array(179,74),
array(216,93),
array(217,64)    
);

echo "Total";
$master = new Master();

foreach($data as $current){
    $conn = $master->connectDb();

    $sql = "update servicios set MEDIDA_ID = ? WHERE ID_SERVICIO=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $current[1]);
    $stmt->bindParam(2, $current[0]);
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