<?php
require_once "../clases/master_class.php";
$master = new Master();

$datos = json_decode(file_get_contents('php://input'), true);

if (isset($datos['dispositivo']) && $datos['datos']) {


    switch ($datos['dispositivo']) {

        case 'Maglumi':

            $data = getValuesExelEquipos($datos, 1, 2, 5);
            $response = $master->insertByProcedure('sp_pseudo_interface', [json_encode($data)]);


            break;

        case 'I-SmartPro':

            $data = getValuesExelEquipos($datos, 1, 2, 3);

            $response = $master->insertByProcedure('sp_pseudo_interface', [json_encode($data)]);


            break;

        case 'SelectraProS':

            $data = getValuesTxtEquipos($datos, 2, 7, 8);
            $response = $master->insertByProcedure('sp_pseudo_interface', [json_encode($data)]);

            $fh = fopen("algo.txt", 'a');
            fwrite($fh, json_encode($data));
            fclose($fh);


            break;

        default:

            $response = 'No hay equipo definido';
    }


    echo $master->returnApi($response);
}




//FUNCION PARA EQUIPOS QUE DAN ARCHIVOS XLS
function getValuesExelEquipos($datos, $getVal1, $getVal2, $getVal3)
{

    $data = json_decode($datos['datos'], true);

    #Validamos si existe algun error con el los datos recibidos
    if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
        $errorMessage = json_last_error_msg();
        $error = "Error al decodificar JSON: " . $errorMessage;

        // $fh = fopen("algo.txt", 'a');
        // fwrite($fh, $error);
        // fclose($fh);

        exit;
    }

    $datos = json_decode($data['datos'], true);
    $arreglo  = [];

    // Acceder a los valores de los datos y los guardamos en la variable de datos
    foreach ($data as $fila) {

        $arreglo[] = ['PREFOLIO' => $fila[$getVal1], 'ESTUDIO' => $fila[$getVal2], 'RESULTADO' =>       $fila[$getVal3]];
    }

    // $fh = fopen("algo.txt", 'a');
    // fwrite($fh, json_encode($arreglo));
    // fclose($fh);

    //Retornamos el arreglo de los datos
    return $arreglo;
}


//FUNCION PARA EQUIPOS QUE DAN ARCHIVOS TXT
function getValuesTxtEquipos($datos, $getVal1, $getVal2, $getVal3)
{
    // Definimos nuestro JSON que contiene los datos recibidos y los decodificamos

    $datos = json_decode($datos['datos'], true); //El parámetro true se utiliza para obtener un         arreglo asociativo en lugar de un objeto.

    $resultado = array();

    // Recorrer el arreglo
    foreach ($datos as $i => $fila) {
        $keys = array_keys($fila); //Extraemos las key de la fila actual que se recorre
        $values = array_values($fila); //Extraemos los valores de la fila actual que se recorre

        $nuevoArreglo = array(); //Creamos un arreglo vacio que almacenara los valores de cada fila

        //Separamos la fila de los valores por subvalores que seran ordenados respectivamente
        $colum2 = explode("\t", $values[0])[$getVal1];
        $colum7 = explode("\t", $values[0])[$getVal2];
        $colum8 = explode("\t", $values[0])[$getVal3];


        //Agregamos los valores anteriores a el arreglo vacio creado para almacenar nuestro nuevo array
        $nuevoArreglo["PREFOLIO"] = $colum2;
        $nuevoArreglo["ESTUDIO"] = $colum7;
        $nuevoArreglo["RESULTADO"] = $colum8;

        // Agregamos las datos de nuevoArreglo a el arreglo final que es resultado
        $resultado[] = $nuevoArreglo;
    }


    return $resultado;
}
