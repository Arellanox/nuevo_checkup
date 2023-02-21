<?php
require_once("lib/libmergpdf/vendor/autoload.php");
use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
$merger = new Merger;

$merger->addFile("electro_img/Brochure Empresarial TGC.pdf");
$merger->addFile("electro_img/CONSTANCIA BLANCA E. BARRERA FIGUEROA.pdf");
$merger->addFile("electro_img/nery_20230201104901.pdf");

$createpdf = $merger->merge();

// echo $_SERVER['DOCUMENT_ROOT'];


// $path.= file_get_contents('bimo.pdf');
// $path.= file_get_contents('nery.pdf');



//==============================================================================
// $dir ="examples";
// if(!mkdir($dir)){
//     echo "no se pudo crear el directorio";
// }else {
//     echo "todo bien ";
// }

// #crear y escribir algo en un archivo.
// $fh = fopen('test.zip', 'a');
// // fwrite($fh, '<h1>Hello world!</h1>');
// fclose($fh);

// # eliminar un archivo.
// unlink("examples/test.html");

// # copiar un archivo.
// $file = "checkup.sql";
// $newfile = "$dir/checkup.sql.bak";

// if(!copy($file,$newfile)){
//     echo "Error al copiar un archivo.";
// }

// //zipping archives.
// $zip = new ZipArchive;
// if ($zip->open('test.zip') === TRUE) {
//     $zip->addFile('examples/checkup.sql.bak', 'new.sql');
//     $zip->close();
//     echo 'ok';
// } else {
//     echo 'failed';
// }



// echo $_SERVER['SERVER_NAME'];
// $arr1 = array("hoola"=>1,2,3);
// $arr2 = array(4,5,6);

// $arr = array_merge($arr1, $arr2);

// print_r($arr);

// echo date("dmY_His");
// class Dice {
//     public $num_sides;

//     function Dice(){
//         $this->num_sides = 6;
//     }

//     function setNumSides($sides){
//         $this->num_sides = $sides;
//     }

//     function getNumSides(){
//         return $this->num_sides;
//     }

//     function roll($sides){
//         $roll = rand(1,$sides);
        
//         return $roll;
//     }
// }

// $dados = array();

// for ($i=0; $i < 3; $i++) { 
//     $dados[] = new Dice();
// }


// foreach($dados as $dado){
//     $dado->setNumSides(12);
// }

// $acumulador = 0;

// foreach($dados as $dado){
//     $resultado = $dado->roll($dado->getNumSides());
//     echo "Este dado cayó en : ".$resultado;
//     echo "<br>";
//     $acumulador = $acumulador + $resultado;
// }

// if($acumulador==36){
//     echo "<h1>¡Ganaste!</h1>";
// }else{
//     echo "<h1>Intenta de nuevo</h1>";
// }

// print_r($dados);

?>