<?php


# Excel

$abc = [
    'A',
    'B',
    'C',
    'D',
    'E',
    'F',
    'G',
    'H',
    'I',
    'J',
    'K',
    'L',
    'M',
    'N',
    'O',
    'P',
    'Q',
    'R',
    'S',
    'T',
    'U',
    'V',
    'W',
    'X',
    'Y',
    'Z'
];

$i = 0;
$countColumna = -1;

function getColumnABC($recorrido = 0)
{
    global $abc;
    global $i;
    global $countColumna;
    // echo $abc[25];
    if ($i < 26 && $countColumna < 0) {
        return $abc[$recorrido];
    } else {
        #$recorrido = 26;  <-- 'AA'
        if ($i == 26 || $countColumna == -1) {
            $i = 0;
            $countColumna++;
        }
        // echo $recorrido;
        // echo "<br>";
        // $cabezaA = $abc[intval($recorrido / 25) - 1]; #<-- 1
        // // echo intval($recorrido / 25);
        // $cabezaB = $abc[($recorrido - 25 * intval($recorrido / 25)) - 1];
        // echo ($recorrido - 25 * intval($recorrido / 25)) - 1;
        // // echo ($recorrido - 25 * intval($recorrido / 25)) - 1;
        echo $i;
        return "$abc[$countColumna]$abc[$i]";
    }
}

$columnas = [
    'NUM_PROVEEDOR' => [1],
    'FACTURA' => [1],
    'CLAVE_BENEFICIARIO' => [1],
    'PACIENTE' => [1],
    'PARENTESCO' => [1],
    'NUM_PASE' => [1],
    'SERVICIOS' => [1],
    'CANTIDAD' => [1],
    'PRECIO UNITARIO' => [1],
    'SUBTOTAL' => [1],
    'IVA' => [1],
    'TOTAL' => [1],
    'FECHA_RECEPCION' => [1],
    'PROCEDENCIA' => [1],
    'TRABAJADOR' => [1],
    'VERIFICACION' => [1],
    'CATEGORIA' => [1],
    'URES' => [1],
    'DIAGNOSTICO' => [1]
];


#Columnas
foreach ($columnas as $key => $value) {
    $columna = getColumnABC($i);
    echo "$key - $columna";

    // $hojaActiva->setCellValue($columna . '1', "");
    $i++;
    // echo $columna;
    echo '<br>';
}

// for ($i = 0; $i < count($encabezados); $i++) {
//     # code...
//     $columna = getColumnABC($i);
//     echo $columna;
//     echo '<br>';
// };







// require_once("lib/libmergpdf/vendor/autoload.php");
// use iio\libmergepdf\Merger;
// use iio\libmergepdf\Pages;
// use iio\libmergepdf\Driver\TcpdiDriver;
// use iio\libmergepdf\Driver\Fpdi2Driver;
// use iio\libmergepdf\Source\FileSource;

// $merger = new Merger;
// $files = ["electro_img/bimo_20230202141033.pdf","electro_img/nery_20230201104901.pdf"];
// // $merger->addFile();
// // $merger->addFile("electro_img/bimo_20230202141033.pd    f");
// $merger->addIterator($files);

// try{
//     $createpdf = $merger->merge();
//     $fh = fopen('test.pdf', 'a');
//     if(fwrite($fh, $createpdf)){
//         echo "combinado";
//     } else {
//         echo "error. probablemente esta siendo usado";
//     }
//     fclose($fh);


// }catch(Exception $e){
//     echo $e;
// }

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
