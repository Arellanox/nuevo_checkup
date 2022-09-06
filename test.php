<?php
include "clases/pacientes.php";

$mis = new Miscelaneus();

$a  = array("1"=>6,"2"=>,"3"=>"alog");

$b = $mis->splitArray($a,array(2));

print_r($b);



// $array = array(5,"JOSH","DE LA CRUZ","ARELLANO",30,"1992-07-03","CUAJ920703HTCRRS09",9932243652,
// "arellanox0392@gmail.com","cerrada del mango",0,null,"JOSE MARIA PINO SUAREZ",86029,NULL,"mexicana","añlsdkfj0293",1,"PIZER",
// "NINGUNA","PRIMERA",NULL,1);
// $paciente = new Pacientes();
// $segmento = new Segmentos();


// $result = $paciente->getById(1);
// $segmento->setSegmento($result[0][1]);
// $sub = $segmento->getSegmento();
// echo " esto es el segmento id ".$result[0][1];
// echo "<br>";
// echo $sub;
// echo "<br>";
// print_r($result);

// PARA OBTENER EL SEGMENTO DE LOS PACIENTES
// $segmento->setSegmento(5);
// $label = $segmento->getSegmento();

// echo $label;


// $result = mysqli_query($conexion,"select sha1(id_cargo), descripcion, activo from cargos;");

// while($row=$result->fetch_all(MYSQLI_ASSOC)){
//     print_r($row);
//     echo "<br>";
// }


// $seg = new Segmentos();

// $result = $seg->delete(4);//(array(3,"Primer hijo"));

// echo json_encode($result);
// include "clases/cargos_class.php";
// $cargo = new Cargos();
// $result = $cargo->delete(2);

// resultado de la api para eliminar
// if(is_numeric($result)){
//     echo "Eliminado.";
// }else{
//     echo $result;
// }

//resultado de la api para actualizar
// if(is_numeric($result)){
//     echo "registro actualizado. Filas Afectadas ".$result;
// }else{
//     echo $result;
// }

//resultado de la api para recuperar todos los valores de la tabla y por id
// if(is_array($result)){
//     echo json_encode($result);
// }else{
//     echo "ha ocurrido un terrible desastre";
// }

//resultado de la api para insertar
// if (is_numeric($result)){
//     echo "insertado";
// }else{
//     echo $result;
// }
?>