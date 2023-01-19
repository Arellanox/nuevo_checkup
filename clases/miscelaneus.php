<?php
require_once('../php/phpqrcode/qrlib.php');
include_once "Pdf.php";
date_default_timezone_set('America/Mexico_City');

class Miscelaneus
{

    function getFormValues($values)
    {
        $form = array();

        foreach ($values as $clave => $valor) {

            # Convierte el valor null tomado como string en un valor booleano
            if (is_string($valor)) {
                if (strtoupper($valor) == "NULL") {

                    $form[] = null;
                } else {

                    $form[] = $valor;
                }
            } else {

                $form[] = $valor;
            }
        }

        return $form;
    }

    function escaparDatos($datos, $conexion)
    {
        //global $conexion;

        $array_escaped = array();

        foreach ($datos as $dato) {
            // if(!is_numeric($dato)){
            //     $array_escaped[] = $conexion->real_escape_string($dato);
            // }else{
            //     $array_escaped[] = $dato;
            // }
            $array_escaped[] = $conexion->real_escape_string($dato);
        }

        return $array_escaped;
    }

    //$datos = datos a comprobar
    //$intergers = posiciones del arreglo $datos que deben ser enteros
    //$strings = posiciones del arreglo $datos que deben ser cadenas de texto
    //$doubles = posiciones del arreglo $datos que deben ser numeros con decimales
    function validarDatos($datos, $intergers, $strings, $doubles, $nulls = array())
    {
        $errors = array();

        $count = 0;
        foreach ($datos as $dato) {
            if (in_array($count, $intergers)) {
                // echo "este es el dato: ".$dato." esta en interger";
                // echo "<br>";
                if (!is_numeric($dato)) {
                    if (in_array($count, $nulls)) {
                        //si esta dentro de los nulls
                        // no es un error, por tanto no hace nada
                    } else {
                        $errors[] = $count;
                    }
                }
            }

            if (in_array($count, $strings)) {
                // echo "este es el dato: ".$dato." esta en string";
                // echo "<br>";
                if (!is_string($dato)) {
                    if (in_array($count, $nulls)) {
                        //si esta dentro de los nulls
                        // no es un error, por tanto no hace nada
                    } else {
                        $errors[] = $count;
                    }
                }
            }

            if (in_array($count, $doubles)) {
                // echo "este es el dato: ".$dato." esta en doubles";
                // echo "<br>";
                if (!is_float($dato)) {
                    if (in_array($count, $nulls)) {
                        //si esta dentro de los nulls
                        // no es un error, por tanto no hace nada
                    } else {
                        $errors[] = $count;
                    }
                }
            }

            $count = $count + 1;
        }

        return $errors;
    }

    function splitArray($source, $split)
    {
        $splitted = array();
        $counter = 0;
        $position = 0;
        $aux = 0;
        $position_split = 0;

        $splitted[$position] = array();

        foreach ($source as  $value) {

            if (isset($split[$position_split])) {
                if (count($splitted[$position]) < $split[$position_split]) {
                    $splitted[$position][] = $source[$counter];
                } else {
                    $position_split = $position_split + 1;
                    if (isset($split[$position_split])) {
                        $position = $position + 1;
                        $splitted[$position] = array();
                        $splitted[$position][] = $source[$counter];
                    } else {
                        $splitted[$position][] = $source[$counter];
                    }
                }
            } else {
                $splitted[$position][] = $source[$counter];
            }

            $counter = $counter + 1;
        }

        return $splitted;
    }

    function initValueNull($values)
    {
        $initedArray = array();

        foreach ($values as $value) {
            if (!isset($value)) {
                $initedArray[] = null;
            } else {
                $initedArray[] = $value;
            }
        }

        return $initedArray;
    }

    function setLog($message, $sp)
    {
        $file = "log.txt";
        $fp = fopen($file, 'a');
        $log = date("d/m/y H:i:s") . " " . $sp . " " . $message . "\n";
        fwrite($fp, $log);
        fclose($fp);
    }

    function returnApi($response)
    {

        if (is_array($response) || is_numeric($response)) {
            $json = json_encode(
                array("response" => array(
                    'code' => 1,
                    'data' => $response
                ))
            );
        } else {
            $json = json_encode(
                array("response" => array(
                    'code' => 2,
                    'msj' => $response
                ))
            );
        }

        return $json;
    }

    function sayHello()
    {
        echo "Hello World!";
    }

    function generarQRURL($tipo, $codeContents, $nombre, $frame = QR_ECLEVEL_M, $size = 3)
    {
        # URL carpeta
        $tempDir = 'archivos/sistema/temp/qr/' . $tipo . '/';

        # Enviar la url o codigo necesario desde antes
        QRcode::png($codeContents, '../' . $tempDir . $nombre . '.png', $frame, $size, 2);

        # retorna la URL donde se ubica el archivo
        return 'https://bimo-lab.com/nuevo_checkup/' . $tempDir . $nombre . '.png';
    }

    function guardarFiles($files, $posicion = 'default', $dir/*, $carpetas = ['temp/']*/, $nombre)
    {

        $urlArray = array();
        if (!empty($files[$posicion]['name'])) {

            $next = 0;
            foreach ($files[$posicion]['name'] as $key => $value) {
                $extension = pathinfo($files[$posicion]['name'][$key], PATHINFO_EXTENSION);
                # obtenemos la ruta temporal del archivo
                $tmp_name = $files[$posicion]['tmp_name'][$key];

                # Nueva ubicacion del archivo.
                $ubicacion = $dir . $nombre . "_$next." . $extension;

                #cambiamos de lugar el archivo
                try {
                    move_uploaded_file($tmp_name, $ubicacion);
                    $urlArray[] = array('url' => $ubicacion, 'tipo' => $extension);
                } catch (\Throwable $th) {
                    $this->setLog("No se movieron los archivos $th", "{guardarfiles}");
                    return "Algunos archivos no se lograron mover, intentelo nuevamente.";
                    # si no se puede subir el archivo, desactivamos el resultado que se guardo en la base de datos
                    // $e = $master->deleteByProcedure('sp_resultados_reportes_e',[$response[0]['LAST_ID']]);
                }
                $next++;
            }
            return $urlArray;
        } else {
            $this->setLog("El archivo esta vacio, error al subir archivo.", "[function guardarFiles][$posicion]");
            return array();
        }
    }

    function createDir($dir)
    {
        if (!is_dir($dir)) {
            # si no existe el directorio, intenta crearlo
            if (!mkdir($dir, 0777, true)) {
                # si no puede ejecutar la linea del if, envia un mensaje de error al log
                $this->setLog("no pudo crear el directorio. $dir", $dir);
            } else {
                # si puede crearlo, enviar mensaje de exito [1]
                return 1;
            }
        } else {
            # si el directorio ya existe, envia codigo de exito [1]
            return 1;
        }
        # si no puede crearlo, envia mensaje de error [0]
        return 0;
    } //fin createDir

    // comprueba si un arreglo esta realmente vacio
    public function checkArray($array, $isFile = 0)
    {
        $newArray = array();
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                if (!empty($this->checkArray($value))) {
                    $newArray[$key] = $this->checkArray($value);
                }
            } else {
                if (!empty($value)) {
                    $newArray[$key] = $value;
                }
            }
        } // fin del foreach

        if ($isFile == 1) {
            $aux = array();
            foreach ($newArray as $key => $value) {
                if (count($value) > 1) {
                    $aux[$key] = $value;
                }
            } // fin foreach
            $newArray = $aux;
        }
        return $newArray;
    } // fin de checkArray


    public function reportador($master, $turno_id, $area_id, $reporte, $tipo = 'url', $preview = 0, $retorno = 0)
    {
        #Recupera la información personal del paciente
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$turno_id]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];

        $nombre_paciente = $infoPaciente[0]['NOMBRE'];


        #Recuperamos el cuerpo y asignamos titulo si es necesario
        switch ($area_id) {
            case 6:
            case '6':
                $arregloPaciente = $this->getBodyInfoLab($master, $turno_id);
                $infoPaciente[0]['CLAVE_IMAGEN'] = $arregloPaciente['clave'];
                $arregloPaciente = $arregloPaciente['global'];
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA'];
                $carpeta_guardado = 'lab';
                $datos_medicos = array(); #Mandar vacio
                break;
            case 8:
            case '8':
                $arregloPaciente = $this->getBodyInfoImg($master, $turno_id, $area_id);
                $datos_medicos = array();
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_IMAGEN'];
                $infoPaciente[0]['TITULO'] = 'Reporte de Rayos X';
                $carpeta_guardado = 'ultrasonido';
                break;
            case 11:
            case '11':
                $arregloPaciente = $this->getBodyInfoImg($master, $turno_id, $area_id);
                $datos_medicos = array();
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_IMAGEN'];
                $infoPaciente[0]['TITULO'] = 'Reporte de Ultrasonido';
                $carpeta_guardado = 'rayosx';
                break;
            case 3:
            case '3':
                $arregloPaciente = $this->getBodyInfoOftal($master, $turno_id);
                $datos_medicos = array();
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_OFTALMO'];
                $carpeta_guardado = 'oftalmologia';
                break;
        }
        $infoPaciente[0]['SUBTITULO'] = 'Datos del paciente';

        #Crear directorio
        $nombre = str_replace(
            " ",
            "_",
            $nombre_paciente
        );

        $ruta_saved = "reportes/modulo/$carpeta_guardado/$fecha_resultado/$turno_id/";

        # Crear el directorio si no existe
        $r = $master->createDir("../" . $ruta_saved);
        $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . "-" . $infoPaciente[0]['ETIQUETA_TURNO'] . '-' . $fecha_resultado);
        $pie_pagina = array("clave" => $infoPaciente[0]['CLAVE_IMAGEN'], "folio" => $infoPaciente[0]['FOLIO_IMAGEN'], "modulo" => 11, "datos_medicos" => $datos_medicos);
        // echo 1;
        // print_r([json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, $reporte, $tipo, $preview]);
        $pdf = new Reporte(json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, $reporte, $tipo, $preview);

        switch ($retorno) {
            case 1:
                return array(json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, $reporte, $tipo, $preview);
            default:
                return $pdf->build();
        }
    }

    private function getBodyInfoImg($master, $turno_id, $area_id)
    {
        #recuperar la informacion del Reporte de interpretacion de ultrasonido y rayosx
        # recuperar los resultados de ultrasonido y rayosx
        // $area_id = $area_id; #11 es el id para ultrasonido y rayosx.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [null, $turno_id, $area_id]);

        $arrayimg = [];

        for ($i = 0; $i < count($response1[1]); $i++) {

            $servicio = $response1[1][$i]['SERVICIO'];
            $hallazgo = $response1[1][$i]['HALLAZGO'];
            $interpretacion = $response1[1][$i]['INTERPRETACION_DETALLE'];
            $comentario = $response1[1][$i]['COMENTARIO'];
            $tecnica = $response1[1][$i]['TECNICA'];
            $array1 = array(
                "ESTUDIO" => $servicio,
                "HALLAZGO" => $hallazgo,
                "INTERPRETACION" => $interpretacion,
                "COMENTARIO" => $comentario,
                "TECNICA" => $tecnica

            );
            array_push($arrayimg, $array1);
        }

        return array(
            'ESTUDIOS' => $arrayimg
        );
    }

    private function getBodyInfoOftal($master, $turno_id)
    {
        #recuperar la informacion del Reporte de interpretacion de oftalmología
        # recuperar los resultados de oftalmología
        $response1 = $master->getByProcedure('sp_oftalmo_resultados_b', [null, $turno_id]);

        $arrayoftalmo = [];

        for ($i = 0; $i < count($response1[1]); $i++) {

            $antecedentes_personales = $response1[$i]['ANTECEDENTES_PERSONALES'];
            $antecedentes_oftalmologicos = $response1[$i]['ANTECEDENTES_OFTALMOLOGICOS'];
            $pacedimiento_actual = $response1[$i]['PADECIMIENTO_ACTUAL'];
            $agudeza_visual = $response1[$i]['AGUDEZA_VISUAL_SIN_CORRECCION'];
            $od = $response1[$i]['OD'];
            $oi = $response1[$i]['OI'];
            $jaeger = $response1[$i]['JAEGER'];
            $refraccion = $response1[$i]['REFRACCION'];
            $prueba = $response1[$i]['PRUEBA'];
            $exploracion_oftalmologica = $response1[$i]['EXPLORACION_OFTALMOLOGICA'];
            $forias = $response1[$i]['FORIAS'];
            $campimetria = $response1[$i]['CAMPIMETRIA'];
            $presion_intraocular_od = $response1[$i]['PRESION_INTRAOCULAR_OD'];
            $presion_intraocular_oi = $response1[$i]['PRESION_INTRAOCULAR_OI'];
            $diagnostico = $response1[$i]['DIAGNOSTICO'];
            $plan = $response1[$i]['PLAN'];
            $observaciones = $response1[$i]['OBSERVACIONES'];
            $array1 = array(
                "ANTECEDENTES_PERSONALES" => $antecedentes_personales,
                "ANTECEDENTE_OFTALMOLOGICOS" => $antecedentes_oftalmologicos,
                "PADECIMIENTO_ACTUAL" => $pacedimiento_actual,
                "AGUDEZA_VISUAL" => $agudeza_visual,
                "OD" => $od,
                "OI" => $oi,
                "JAEGER" => $jaeger,
                "REFRACCION" =>  $refraccion,
                "PRUEBA" => $prueba,
                "EXPLORACION_OFTALMOLOGICA" => $exploracion_oftalmologica,
                "FORIAS" => $forias,
                "CAMPIMETRIA" => $campimetria,
                "PRESION_INTRAOCULAR_OD" => $presion_intraocular_od,
                "PRESION_INTRAOCULAR_OI" => $presion_intraocular_oi,
                "DIAGNOSTICO" => $diagnostico,
                "PLAN" => $plan,
                "OBSERVACIONES" => $observaciones
            );
            array_push($arrayoftalmo, $array1);
        }

        return array(
            'ESTUDIOS' => $arrayoftalmo
        );
    }

    private function getBodyInfoLab($master, $id_turno)
    {
        #Creamos el folio
        # dar de alta primero el folio en la tabla de reportes_areas
        $folio = $master->insertByProcedure('sp_generar_folio_laboratorio', []);

        $res = $master->insertByProcedure('sp_reportes_areas_g', [null, $id_turno, 6, null, null, $folio]);
        # informacion general del paciente

        #Estudios solicitados por el paciente
        $clasificaciones = $master->getByProcedure('sp_laboratorio_clasificacion_examen_b', [null, 6]);
        $response = $master->getByProcedure("sp_cargar_estudios", [$id_turno, 6]);

        #Generar clave de resultado
        $clave = $master->getByProcedure("sp_generar_clave", []);

        $arrayGlobal = array(
            'areas' => array()
        );

        # filtramos el arreglo principal y obtenemos aquellos estudios
        # que tienen valor absoluto.
        $serv_var_abs_obj = array_filter($response, function ($obj) {
            $return = $obj['TIENE_VALOR_ABSOLUTO'] == 1;
            return $return;
        });

        $serv_var_abs = $this->ordernarBodyLab($serv_var_abs_obj, "VALORES ABSOLUTOS", $id_turno);
        $valores_absolutos = $serv_var_abs['estudios'][0]['analitos'];

        for ($i = 0; $i < count($clasificaciones); $i++) {
            $clasificacion_id = $clasificaciones[$i]['ID_CLASIFICACION'];
            # sacamos arrays individuales por clasificacion de examen
            $servicios = array_filter($response, function ($obj) use ($clasificacion_id) {
                $return = $obj['CLASIFICACION_ID'] == $clasificacion_id;
                return $return;
            });

            # como no estamos seguros que de que se encuentren todas las clasificaciones 
            # en un paciente, evaluamos que el array no este vacio.

            if (!empty($servicios)) {

                $aux = $this->ordernarBodyLab($servicios, $clasificaciones[$i]['DESCRIPCION'], $id_turno);

                $arrayGlobal['areas'][] = $aux;
            }
        }
        // echo "================================================================";
        // echo "<br>";


        # habra estudios que no tengan clasificacion, esos el servidor las regresa con id 0
        # como el id 0 no existe dentro de la tabla de clasificaciones, el algoritmo de arriba los ignora
        # por tanto se tiene que realizar un algoritmo similar pero con el filtro en 0.
        $servicios = array_filter($response, function ($obj) {
            $return = $obj['CLASIFICACION_ID'] == 0;
            return $return;
        });

        if (!empty($servicios)) {

            $aux = $this->ordernarBodyLab($servicios, "NINGUNA", $id_turno);
            $arrayGlobal['areas'][] = $aux;
        }

        return array('global' => $arrayGlobal, 'clave' => $clave);
    }

    private function ordernarBodyLab($servicios, $clasificacion, $turno)
    {
        #obtener los valores absolutos
        $absoluto_array = array();
        $in_array = 0;
        #estamos buscandor el id 1 que corresponde a la biometria hematica
        foreach ($servicios as $current) {
            if (in_array(1, $current) || in_array(35, $current)) {
                $in_array++;
            }
        }

        #si existe la biometria hematica [id 1] o perfil reumatico [id 35], obtenemos los valores absolutos y creamos un array
        if ($in_array > 0) {
            $bh = array_filter($servicios, function ($obj) {
                $r = $obj['GRUPO_ID'] == 1 || 35;
                return $r;
            });

            $abs = array_filter($bh, function ($obj) {
                $r = $obj['TIENE_VALOR_ABSOLUTO'] == 1;
                return $r;
            });

            foreach ($abs as $current) {
                $absoluto_array[] = array(
                    "analito" => $current['DESCRIPCION_SERVICIO'],
                    "valor_abosluto" => $current['VALOR_ABSOLUTO'],
                    "referencia" => $current['VALOR_REFERENCIA_ABS'],
                    "unidad" => $current['MEDIDA_ABS']
                );
            }
        }

        $master = new Master();
        $grupos = $master->getByProcedure('sp_cargar_grupos', [$turno, 6]);
        $estudios = array();
        $analitos = array();
        for ($i = 0; $i < count($grupos); $i++) {
            $nombre_grupo = $grupos[$i]['GRUPO'];
            $contenido_grupo = array_filter($servicios, function ($obj) use ($nombre_grupo) {
                $r = $obj['GRUPO'] == $nombre_grupo;
                return $r;
            });

            if (!empty($contenido_grupo)) {

                # llenado de los analitos del grupo
                foreach ($contenido_grupo as $current) {
                    $nombre_grupo = $current['GRUPO'];
                    $observacionnes_generales = $current['OBSERVACIONES'];
                    $id_grupo = $current['GRUPO_ID'];
                    $metodo_grupo = $current['METODOS_GRUPO'];
                    $equipo_grupo = $current['EQUIPOS_GRUPO'];
                    $clasificacion_id = $current['CLASIFICACION_ID'];

                    $item = array(
                        "nombre"            => $current['DESCRIPCION_SERVICIO'],
                        "unidad"            => $current['MEDIDA'],
                        "resultado"         => $current['RESULTADO'],
                        "referencia"        => $current['VALOR_DE_REFERENCIA'],
                        # "observaciones"     => isset($id_grupo) ? null : $current['OBSERVACIONES'],
                        "observaciones"     => $nombre_grupo != "OTROS SERVICIOS" ? null : $current['OBSERVACIONES'],
                        "metodo"     => $nombre_grupo != "OTROS SERVICIOS" ? null : $current['METODOS_ESTUDIO'],
                        "equipo"     => $nombre_grupo != "OTROS SERVICIOS" ? null : $current['EQUIPOS_ESTUDIO'],
                        #"metodo"            => isset($metodo_grupo) ? null : $current['METODOS_ESTUDIO'],
                        #"equipo"            => isset($equipo_grupo) ? null : $current['EQUIPOS_ESTUDIO']
                    );

                    $analitos[] = $item;
                }

                # para los valorse absolutos
                switch ($id_grupo) {
                        #biometria hematica
                    case 1:
                        $last_position = count($analitos) - 1;
                        $aux = $analitos[$last_position];
                        $analitos[$last_position] = $absoluto_array;
                        $analitos[] = $aux;
                        break;
                        #perfil reumatico
                    case 35:
                        if ($clasificacion_id == 1) {
                            # 1 para la clasificacion de hematologia. 
                            # Solo la hematoloigia debe mandar los valores absolutos                        
                            $last_position = count($analitos) - 2;
                            $aux = $analitos[$last_position];
                            $analitos[$last_position] = $absoluto_array;

                            $last_position++;
                            while (!empty($analitos[$last_position])) {
                                $auxc = $analitos[$last_position];
                                $analitos[$last_position] = $aux;
                                $aux = $auxc;
                                $last_position++;
                            }

                            $analitos[$last_position] = $aux;
                        }
                        break;
                }

                # llenar arreglo estudios
                $estudios[] = array(
                    "estudio"        => $nombre_grupo,
                    "analitos"       => $analitos,
                    "metodo"         => $metodo_grupo,
                    "equipo"         => $equipo_grupo,
                    "observaciones"  => isset($id_grupo) ? $observacionnes_generales : null
                );
                $analitos = array();
            }
        }

        # ARREGLO DE AREAS

        $response = array(
            "area" => $clasificacion,
            "estudios" => $estudios
        );

        return $response;
    }
}
