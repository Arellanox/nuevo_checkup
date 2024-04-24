<?php
require_once "../clases/master_class.php";
$master = new Master();

$datos = json_decode(file_get_contents('php://input'), true);

if (isset($datos['dispositivo']) && $datos['datos']) {


    $equipo =  $datos['dispositivo'];


    // $resultadosFinales = $equipo == "SelectraProS" ? getValuesTxtEquipos($datos['datos']) : $datos['datos'];

    #INSERTAMOS LOS GRUPOS DE PREFOLIOS
    $response = $master->insertByProcedure('sp_pseudo_interface', [json_encode($datos['datos'])]);

    echo $master->returnApi(json_decode($response));
}

#============================================================== FUNCIONES DE ORDENAMINETO DE DATOS



//FUNCION PARA EQUIPOS QUE DAN ARCHIVOS TXT (SELECTRA)
function getValuesTxtEquipos($datos)
{


    $resultado = array();
    $resultadoFinal = array();
    $nuevoArreglo = array(); //Creamos un arreglo vacio que almacenara los valores de cada fila


    // Recorrer el arreglo
    foreach ($datos as $i => $fila) {

        //Separamos la fila de los valores por subvalores que seran ordenados respectivamente
        $colum2 = $fila['PREFOLIO'];
        $colum7 = $fila['ESTUDIO'];
        $colum8 = $fila['RESULTADO'];


        //Agregamos los valores anteriores a el arreglo vacio creado para almacenar nuestro nuevo array
        $nuevoArreglo["PREFOLIO"] = $colum2;
        $nuevoArreglo["ESTUDIO"] = $colum7;
        $nuevoArreglo["RESULTADO"] = $colum8;

        // Agregamos las datos de nuevoArreglo a el arreglo final que es resultado
        $resultado[] = $nuevoArreglo;

        #Calculamos el BUN
        if ($colum7 == 'URSL') {

            $nuevoArreglo["PREFOLIO"] = $colum2;
            $nuevoArreglo["ESTUDIO"] = 'BUN';
            $nuevoArreglo["RESULTADO"] = round($colum8 / 2.14, 2);
            $resultado[] = $nuevoArreglo;
        }

        #Calculamos el VLDL
        if ($colum7 == 'TGML') {

            $nuevoArreglo["PREFOLIO"] = $colum2;
            $nuevoArreglo["ESTUDIO"] = 'VLDL';
            $nuevoArreglo["RESULTADO"] = round($colum8 / 5, 2);
            $resultado[] = $nuevoArreglo;
        }
    }

    $arregloAlbu = [];
    $relAG = [];
    foreach ($resultado as $item) {

        #Calculamos la BI dependiendo de BIDN y BITN 
        if ($item["ESTUDIO"] === "BIDN" || $item["ESTUDIO"] === "BITN") {
            $nuevoArreglo["PREFOLIO"] = $item["PREFOLIO"];
            $nuevoArreglo["ESTUDIO"] = 'BI';

            if ($item["ESTUDIO"] === "BIDN") {
                $bidn = $item["RESULTADO"];
            } else {
                $bitn = $item["RESULTADO"];
            }

            if (isset($bidn) && isset($bitn)) {
                $nuevoArreglo["RESULTADO"] = round($bitn - $bidn, 2);
                $resultado[] = $nuevoArreglo;
                unset($bidn, $bitn);
            }
        }

        #Calculamos la GLO dependiendo de PROB y ALBU
        if ($item["ESTUDIO"] === "PROB" || $item["ESTUDIO"] === "ALBU") {
            $nuevoArreglo["PREFOLIO"] = $item["PREFOLIO"];
            $nuevoArreglo["ESTUDIO"] = "GLO";

            if ($item["ESTUDIO"] === "PROB") {
                $prob = $item["RESULTADO"];
            } else {
                $albu = $item["RESULTADO"];

                #Guardamos todos los datos del estudio de ALBU para usarlos despues para sacar la REL A-G
                $arregloAlbu["PREFOLIO"] = $item["PREFOLIO"];
                $arregloAlbu["ESTUDIO"] = $item["ESTUDIO"];
                $arregloAlbu["RESULTADO"] = $item["RESULTADO"];
                $relAG[] = $arregloAlbu;
            }

            if (isset($prob) && isset($albu)) {
                $nuevoArreglo["RESULTADO"] = round($prob - $albu, 2);
                $resultado[] = $nuevoArreglo;
                unset($prob, $albu);
            }
        }

        #Calculamos la Relacion COL/HDL dependiendo de CHSL y HDL
        if ($item["ESTUDIO"] === "CHSL" || $item["ESTUDIO"] === "HDL") {
            $nuevoArreglo["PREFOLIO"] = $item["PREFOLIO"];
            $nuevoArreglo["ESTUDIO"] = 'REL';

            if ($item["ESTUDIO"] === "CHSL") {
                $col = $item["RESULTADO"];
            } else {
                $hdl = $item["RESULTADO"];
            }

            if (isset($col) && isset($hdl)) {
                $nuevoArreglo["RESULTADO"] = round($col / $hdl, 2);
                $resultado[] = $nuevoArreglo;
                unset($col, $hdl);
            }
        }
    }


    #Guardamops el PREFOLIO, ESTUDIO y RESULTADO de GLO para sacar la REL A-G
    $arregloGlo  = [];
    foreach ($resultado as $item) {
        if ($item["ESTUDIO"] === "GLO") {
            $arregloGlo["PREFOLIO"] = $item["PREFOLIO"];
            $arregloGlo["ESTUDIO"] = $item["ESTUDIO"];
            $arregloGlo["RESULTADO"] = $item["RESULTADO"];
            $relAG[] = $arregloGlo;
        }
    }

    #Validamos si nuestro arreglo del relAG tiene contenido
    if (count($relAG) > 0) {
        $rel = calcularRelAG($relAG);
        $resultado = array_merge($resultado, $rel); #Si hay resultados de REL A-G combinamos el resultado con la REL A-G
    }



    return $resultado;
}


#FUNCION PARA CALCULAR LA REL A-G YA QUE ESTABA DIFICIL EN EL MISMO FOREACH 
function calcularRelAG($datos)
{
    #Declaramos nuestras variables de almacenamiento de datos
    $resultadosGLO = array();
    $resultadosALBU = array();
    $resultadoRelAG = array();

    #Recorremos el arreglo que nos llega y sacamos los resultados de GLO y ALBU tomando como clave asociativa el PREFOLIO
    foreach ($datos as $dato) {
        if ($dato["ESTUDIO"] === "GLO") {
            $resultadosGLO[$dato["PREFOLIO"]] = $dato["RESULTADO"];
        } elseif ($dato["ESTUDIO"] === "ALBU") {
            $resultadosALBU[$dato["PREFOLIO"]] = $dato["RESULTADO"];
        }
    }

    #Recorremos el arreglo de GLO que contienen los resultados de dicho ESTUDIO
    foreach ($resultadosGLO as $prefolio => $resultadoGLO) {
        if (isset($resultadosALBU[$prefolio])) { #Preguntamos si existe un resultado de ALBU con el mismo PREFOLIO que estamos usando
            $resultadoRelAG[] = array(
                "PREFOLIO" => $prefolio, #Asignamos el PREFOLIO actual 
                "ESTUDIO" => "REL A-G",  #Asignamos el nombre del ESTUDIO
                "RESULTADO" => round($resultadosALBU[$prefolio] / $resultadosGLO[$prefolio], 2) #Calculamos el resultado con el resultado de ALBU y GLO 
            );
        }
    }

    return $resultadoRelAG; #Retornamos el resultado general
}
