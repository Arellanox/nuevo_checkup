<?php
require_once('../php/phpqrcode/qrlib.php');
require_once("../lib/libmergpdf/vendor/autoload.php");

use iio\libmergepdf\Merger;
use iio\libmergepdf\Pages;
use iio\libmergepdf\Driver\TcpdiDriver;
use iio\libmergepdf\Driver\Fpdi2Driver;
use iio\libmergepdf\Source\FileSource;

include "numero_a_texto_class.php";
include_once "Pdf.php";
date_default_timezone_set('America/Mexico_City');

class Miscelaneus
{
    public $ruta_reporte;
    public $arrowUp = '<span style="display: inline-block; position: relative; width: 0; height: 0;">
    <span style="border-left: 5px solid transparent; border-right: 5px solid transparent; border-bottom: 7px solid black; position: absolute; top: -7px;"></span>
  </span>';
    public $arrowDown = '<span style="display: inline-block; position: relative; width: 0; height: 0;">
    <span style="border-left: 5px solid transparent; border-right: 5px solid transparent; border-top: 7px solid black; position: absolute; bottom: 1px;"></span>
  </span>';
    public $asterisk = '<span style="font-size:15px">*</span>';

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

    function setRutaReporte($ruta)
    {
        $this->ruta_reporte = $ruta;
    }

    function getRutaReporte()
    {
        return $this->ruta_reporte;
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

    function returnApi($response, $specialCode = null)
    {

        if (is_array($response) || is_numeric($response) || is_object($response) && !isset($specialCode)) {
            $json = json_encode(
                array("response" => array(
                    'code' => 1,
                    'data' => $response
                ))
            );
        } else if (!isset($specialCode)) {
            $json = json_encode(
                array("response" => array(
                    'code' => 2,
                    'msj' => $response
                ))
            );
        } else {
            $json = json_encode(
                array("response" => array(
                    'code' => 'turnero',
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

    function generarQRURL($tipo, $codeContents, $nombre, $frame = QR_ECLEVEL_H, $size = 10): string
    {
        # URL carpeta
        $tempDir = 'archivos/sistema/temp/qr/' . $tipo . '/';

        $this->createDir('../' . $tempDir);

        # Enviar la url o codigo necesario desde antes
        QRcode::png($codeContents, '../' . $tempDir . $nombre . '.png', $frame, $size, 2);

        $http = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $servidor = $_SERVER['HTTP_HOST'];
        $current_url = "{$http}{$servidor}/nuevo_checkup/";

        # retorna la URL donde se ubica el archivo
        return $current_url . $tempDir . $nombre . '.png';
    }

    function guardarFiles($files, $posicion = 'default', $dir/*, $carpetas = ['temp/']*/, $nombre)
    {

        $urlArray = array();
        // var_dump($files[$posicion]['name']);

        // var_dump($files);
        if (!empty($files[$posicion]['name'])) {

            if (empty($files[$posicion]['name'][0])) {
                // echo "haz algo";
                $this->setLog("El archivo esta vacio o dañado, error al subir archivo.", "[function guardarFiles][$posicion], [$nombre]");
                return array();
            }

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
            $this->setLog("El archivo esta vacio o dañado, error al subir archivo.", "[function guardarFiles][$posicion]");
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


    public function reportador($master, $turno_id, $area_id, $reporte, $tipo = 'url', $preview = 0, $lab = 0, $id_consulta = 0, $cliente_id = 1, $id_cotizacion = 8, $params = [])
    {
        #Recupera la información personal del paciente
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$turno_id]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];
        $nombre_paciente = $infoPaciente[0]['NOMBRE'];

        #Recuperamos el cuerpo y asignamos titulo si es necesario
        switch ($area_id) {
            case 0:
                # para las etiquetas
                $arregloPaciente = $this->getBodyInfoLabels2($master, $turno_id);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA'];
                $carpeta_guardado = "etiquetas";
                $datos_medicos = array();
                break;
            case 6:
            case '6':
            case 12:
            case '12': //<-- Biomolecular
                $arregloPaciente = $this->getBodyInfoLab($master, $turno_id, $area_id);
                $clave = $master->getByProcedure("sp_generar_clave", []);
                $infoPaciente[0]['CLAVE_IMAGEN'] = $clave[0]['TOKEN'];
                $arregloPaciente = $arregloPaciente['global'];
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA'];
                $carpeta_guardado = 'lab';
                $datos_medicos = array(); #Mandar vacio
                $folio = $infoPaciente[0]['FOLIO'];

                if ($area_id == 12 || $area_id == '12') {
                    $carpeta_guardado = 'lab-molecular';
                    $folio = $infoPaciente[0]['FOLIO_BIOMOLECULAR'];
                }
                break;
            case 8:
            case '8':
                $arregloPaciente = $this->getBodyInfoImg($master, $turno_id, $area_id);
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, $area_id]);
                $datos_medicos = $this->getMedicalCarrier($info);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_IMAGEN'];
                $infoPaciente[0]['TITULO'] = 'Reporte de Rayos X';
                $carpeta_guardado = 'rayosx';

                //Folio
                $infoPaciente[0]['FOLIO_IMAGEN'] = $infoPaciente[0]['FOLIO_IMAGEN_US'];
                $folio = $infoPaciente[0]['FOLIO_IMAGEN'];
                break;
            case 11:
            case '11':
                $arregloPaciente = $this->getBodyInfoImg($master, $turno_id, $area_id);
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, $area_id]);
                $datos_medicos = $this->getMedicalCarrier($info);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_IMAGEN'];
                $infoPaciente[0]['TITULO'] = 'Reporte de Ultrasonido';
                $carpeta_guardado = 'ultrasonido';

                //Folio
                $infoPaciente[0]['FOLIO_IMAGEN'] = $infoPaciente[0]['FOLIO_IMAGEN_RX'];
                $folio = $infoPaciente[0]['FOLIO_IMAGEN'];
                break;
            case 3:
            case '3': #Oftalmologia
                $arregloPaciente = $this->getBodyInfoOftal($master, $turno_id);
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, $area_id]);
                $infoPaciente[0]['CLAVE_IMAGEN'] = $arregloPaciente['CLAVE'];
                $datos_medicos = $this->getMedicalCarrier($info);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_OFTALMO'];
                $carpeta_guardado = 'oftalmologia';
                $folio = $infoPaciente[0]['FOLIO_OFTALMO'];
                break;
            case 1:
            case '1':
                # CONSULTORIO
                $cliente_id = $master->insertByProcedure('sp_get_cliente', [$turno_id]);
                if ($cliente_id == 51) { # 51 es sigma
                    $reporte = 'sigma_consultorio';
                    $arregloPaciente = $this->getSigmaHistoria($master, $turno_id);
                    //$arregloOftalmoResultados = $master->getByProcedure("sp_sigma_historia_b", [$turno_id]);
                    $filteredArregloPaciente = [];
                    $allowedKeys = [
                        'ID_PACIENTE',
                        'nombre_cliente',
                        'EDAD',
                        'NACIMIENTO',
                        'CELULAR',
                        'CORREO',
                        'POSTAL',
                        'MUNICIPIO',
                        'COLONIA',
                        'EXTERIOR',
                        'INTERIOR',
                        'CALLE',
                        'domicilio_cliente',
                        'GENERO'
                    ];

                    if (isset($arregloPaciente[0][0])) {
                        $arregloPaciente = $arregloPaciente[0][0];
                    }

                    foreach ($arregloPaciente as $key => $value) {
                        if (in_array($key, $allowedKeys) && is_string($key)) {
                            $filteredArregloPaciente[$key] = $value;
                        }
                    }

                    $result = $filteredArregloPaciente;

                    //obtener los antecedentes del paciente
                    $infoConsultorioAntecedentes = $master->getByProcedure("sp_consultorio_antecedentes_b", [$turno_id, null]);
                    $infoHistoFam = $master->getByProcedure("sp_sigma_histofam_b", [$turno_id]);
                    $infoAntecedentesNutri = $master->getByProcedure("sp_antecedentes_nutricion_alimentos_respuestas_b", [$turno_id]);
                    $infoConsultorioAparatos = $master->getByProcedure("sp_consultorio_anamnesis_aparatos_b", [$turno_id]);
                    $infoFichAdmi = $master->getByProcedure("sp_sigma_ficha_admision_b", [$turno_id, null, null]);
                    $infoSignosVital = $master->getByProcedure("sp_mesometria_signos_vitales_b", [$turno_id]);
                    $infoSigmaExploracion = $master->getByProcedure("sp_sigma_exploracion_b", [$turno_id]);
                    $infoSigmaInterpretaciones = $master->getByProcedure("sp_sigma_interpretaciones_b", [$turno_id]);
                    $infoOftalmoResultados = $master->getByProcedure("sp_oftalmo_resultados_b", [NULL, $turno_id]);
                    $infoConsultorioConsulta = $master->getByProcedure("sp_consultorio_consulta_b", [NULL, $turno_id, NULL]);
                    $infoSigmaLesiones = $master->getByProcedure("sp_sigma_lesiones_b", [$turno_id]);
                    $infoSigmaValoraviones = $master->getByProcedure("sp_sigma_valoraciones_b", [$turno_id]);

                    $arregloAntecedentes = [];
                    foreach ($infoConsultorioAntecedentes as $key => $value) {
                        if (isset($value['ID_SUBTIPO'])) {
                            $arregloAntecedentes[$value['ID_SUBTIPO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['NOTAS', 'RESPUESTA', 'SUBTIPO'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloHistofam = [];
                    foreach ($infoHistoFam as $key => $value) {
                        if (isset($value['ID_FAMILIAR'], $value['ID_PREGUNTA'])) {
                            if (!isset($arregloHistofam[$value['ID_FAMILIAR']])) {
                                $arregloHistofam[$value['ID_FAMILIAR']] = [
                                    'FAMILIAR' => $value['FAMILIAR'], //cambiar familiar nombre
                                    'PREGUNTAS' => []
                                ];
                            }
                            $arregloHistofam[$value['ID_FAMILIAR']]['PREGUNTAS'][$value['ID_PREGUNTA']] = [
                                'PREGUNTA' => $value['PREGUNTA'],
                                'RESPUESTA' => $value['RESPUESTA']
                            ];
                        }
                    }

                    $arregloAntecedentesNutri = [];
                    foreach ($infoAntecedentesNutri as $key => $value) {
                        if (isset($value['ALIMENTO_ID'])) {
                            $arregloAntecedentesNutri[$value['ALIMENTO_ID']] = array_filter($value, function ($k) {
                                $allowedKeys = ['ALIMENTO'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloConsultorioAparatos = [];
                    foreach ($infoConsultorioAparatos as $key => $value) {
                        if (isset($value['ID_SUBTIPO'])) {
                            $arregloConsultorioAparatos[$value['ID_SUBTIPO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['NOTAS', 'RESPUESTA', 'SUBTIPO'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloInfoFichAdmi = [];
                    foreach ($infoFichAdmi as $key => $value) {
                        if (isset($value['ID_ADMISION'])) {
                            $arregloInfoFichAdmi = array_filter($value, function ($k) {
                                $allowedKeys = ['FECHA_ADMISION', 'RELIGION', 'LUGAR_NACIMIENTO', 'ESTADO_CIVIL', 'TELEFONO_PACIENTE', 'PUESTO_SOLICITA', 'AREA_DEPTO', 'NO_IMSS', 'PROFESION', 'ESCOLARIDAD', 'UMF', 'ACCIDENTE_AVISAR', 'PARENTESCO', 'TELEFONO1', 'TELEFONO2', 'ACTIVO', 'COLONIA', 'CALLE', 'CELULAR', 'ESTADO', 'EXTERIOR', 'INTERIOR', 'POSTAL', 'MUNICIPIO', 'PX', 'EDAD'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSignosVital = [];
                    foreach ($infoSignosVital as $key => $value) {
                        if (isset($value['ID_TIPO_MESO'])) {
                            $arregloSignosVital[$value['ID_TIPO_MESO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['TIPO_SIGNO', 'VALOR', 'UNIDAD_MEDIDA'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSigmaExploracion = [];
                    foreach ($infoSigmaExploracion as $key => $value) {
                        if (isset($value['ID_TIPO'])) {
                            $arregloSigmaExploracion[$value['ID_CUERPO'] . $value['ID_TIPO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['PARTE_CUERPO', 'RESPUESTA', 'PARTE_CUERPO', 'OBSERVACIONES', 'TIPO_EXPLORACION'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSigmaInterpretaciones = [];
                    foreach ($infoSigmaInterpretaciones as $key => $value) {
                        if (isset($value['ID_INTERPRETACION'])) {
                            $arregloSigmaInterpretaciones = array_filter($value, function ($k) {
                                $allowedKeys = ['CUENTA_ROJA', 'GENERAL_ORINA', 'QUIMICA_SANGUINEA', 'RADIOGRAFIA_TORAX', 'VIH', 'ANTIDOPING', 'TIPO_SANGRE', 'REACCIONES_FEBRILES', 'VDRL', 'COPRO', 'EXUDADO_FARINGEO', 'AUDIOMETRIA', 'OTROS'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloOftalmoResultados = [];
                    foreach ($infoOftalmoResultados as $key => $value) {
                        $arregloOftalmoResultados = array_filter($value, function ($k) {
                            $allowedKeys = ['OD', 'OI', 'CON_OD', 'CON_OI'];
                            return in_array($k, $allowedKeys, true);
                        }, ARRAY_FILTER_USE_KEY);
                    }

                    $arregloConsultorioConsulta = [];
                    foreach ($infoConsultorioConsulta as $key => $value) {
                        $arregloConsultorioConsulta = array_filter($value, function ($k) {
                            $allowedKeys = ['NOTAS_PADECIMIENTO', 'DIAGNOSTICO', 'OBSERVACIONES'];
                            return in_array($k, $allowedKeys, true);
                        }, ARRAY_FILTER_USE_KEY);
                    }

                    $arregloSigmaLesiones = [];
                    foreach ($infoSigmaLesiones as $key => $value) {
                        if (isset($value['CUERPO_ID'])) {
                            $arregloSigmaLesiones[$value['CUERPO_ID']] = array_filter($value, function ($k) {
                                $allowedKeys = ['DESCRIPCION', 'DETALLE_LESION'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSigmaValoraciones = [];
                    foreach ($infoSigmaValoraviones as $key => $value) {
                        if (isset($value['ID_VALORACION'])) {
                            $arregloSigmaValoraciones = array_filter($value, function ($k) {
                                $allowedKeys = ['VALORACION_MESES', 'VALORACION', 'OBSERVACIONES'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloPaciente = [
                        $result, $arregloAntecedentes, $arregloHistofam, $arregloAntecedentesNutri,
                        $arregloConsultorioAparatos, $arregloInfoFichAdmi, $arregloSignosVital,
                        $arregloSigmaExploracion, $arregloSigmaInterpretaciones, $arregloOftalmoResultados,
                        $arregloConsultorioConsulta, $arregloSigmaLesiones, $arregloSigmaValoraciones
                    ];
                } else {
                    $arregloPaciente = $this->getBodyInfoConsultorio($master, $turno_id, $id_consulta);
                }

                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, $area_id]);
                $datos_medicos = $this->getMedicalCarrier($info);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_CONSULTA'];
                $infoPaciente[0]['FECHA_RESULTADO'] =
                    $infoPaciente[0]['FECHA_CONSULTA_HISTORIA'];
                $carpeta_guardado = 'consultorio';
                $folio = $infoPaciente[0]['FOLIO_CONSULTA'];
                $infoPaciente[0]['CLAVE_IMAGEN'] = $infoPaciente[0]['CLAVE_CONSULTA'];

                break;
            case 10: case '10':
                # ELECTROCARDIOGRAMA
                $arregloPaciente = $this->getBodyInfoElectro($master, $turno_id);
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, $area_id]);
                $datos_medicos = $this->getMedicalCarrier($info);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_ELECTRO'];
                $carpeta_guardado = "electro";
                $folio = $infoPaciente[0]['FOLIO_ELECTRO'];
                $infoPaciente[0]['CLAVE_IMAGEN'] = $infoPaciente[0]['CLAVE_ELECTRO'];
                $infoPaciente[0]['TITULO'] = 'Reporte de Electrocardiograma';

                break;
            case 2: case "2":
                # SOMATOMETRIA
                $arregloPaciente = $this->getBodyInfoSoma($master, $turno_id);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_MESO'];
                $carpeta_guardado = "somatometria";
                $folio = $infoPaciente[0]['FOLIO_SOMA'];
                $infoPaciente[0]['CLAVE_IMAGEN'] = $infoPaciente[0]['CLAVE_SOMA'];
                break;
            case 15: case "15":
                # COTIZACIONES
                $carpeta_guardado = "cotizacion";
                $arregloPaciente = $this->getBodyInfoCotizacion($master, $id_cotizacion, $cliente_id);

                if($_SESSION['franquiciario']){
                    $getDatosFiscales = $master->getByProcedure('sp_datos_fiscales_franquicia', [
                        $_SESSION['id_cliente']]
                    );

                    $arregloPaciente['franquicia'] = $getDatosFiscales;
                }

                $fecha_resultado = $arregloPaciente['FECHA_CREACION'];
                $fecha_resultado = date('dmY', strtotime($fecha_resultado));

                $folio = $arregloPaciente['FOLIO'];
                $nombre_paciente = 'COT_' . $folio . '_' . $arregloPaciente['ABREVIATURA'] ;
                break;
            case 16: case "16":
                # TICKET
                $arregloPaciente = $this->getBodyInfoTicket($master, $turno_id);
                $fecha_resultado = $infoPaciente[0]['FECHA_TICKET'];
                $carpeta_guardado = "ticket";
                $folio = $infoPaciente[0]['FOLIO_TICKET'];
                break;
            case 17:
                #FAST CHECKUP
                $arregloPaciente = $this->getBodyInfoFast($master, $turno_id);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_FASTCK'];
                $carpeta_guardado = "fast_checkup";
                $folio = $infoPaciente[0]['FOLIO_FASTCK'];
                break;
            case 18:
                #FAST CHECKUP
                $arregloPaciente = $this->getBodyInfoCorte($master, $turno_id);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_FASTCK'];
                $carpeta_guardado = "fast_checkup";
                $folio = $infoPaciente[0]['FOLIO_FASTCK'];
                break;
            case 4: case "4":
                #AUDIOMETRIA
                $arregloPaciente = $this->getBodyAudio($master, $turno_id);
                $fecha_resultado = $infoPaciente[0]['FECHA_CARPETA_AUDIO'];
                $infoPaciente[0]['FECHA_RESULTADO'] =
                    $infoPaciente[0]['FECHA_RESULTADO_AUDIO'];
                // print_r($infoPaciente);
                // exit;
                $carpeta_guardado = "audiometria";
                $folio = $infoPaciente[0]['FOLIO_AUDIO'];
                $infoPaciente[0]['CLAVE_IMAGEN'] = $infoPaciente[0]['CLAVE_AUDIO'];
                break;
            case 5: case "5":
                #ESPIROMETRIA
                $datos_medicos = array();
                $arregloPaciente = $this->getBodyEspiro($master, $turno_id);
                $fecha_resultado = $infoPaciente[array_key_last($infoPaciente)]['FECHA_CARPETA_ESPIRO'];
                $carpeta_guardado = "espirometria";
                $folio = $infoPaciente[array_key_last($infoPaciente)]['FOLIO_ESPIRO'];
                $infoPaciente[0]['CLAVE_IMAGEN'] = $infoPaciente[array_key_last($infoPaciente)]['CLAVE_ESPIRO'];

                break;
            case 19: case "19":
                #CONSULTORIO2
                $arregloPaciente = $this->getBodyInfoConsultorio2($master, $turno_id);
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, $area_id]);
                $datos_medicos = $this->getMedicalCarrier($info);
                $folio = $infoPaciente[array_key_last($infoPaciente)]['FOLIO_CONSULTA2'];
                $fecha_resultado = $infoPaciente[array_key_last($infoPaciente)]['FECHA_CARPETA_CONSULTA2'];
                $carpeta_guardado = "consulta_medica";

                break;

            case -1:
                #Formato de temperatura de equipos
                $arregloPaciente = $this->getBodyTemperatura($master, $turno_id);
                break;
            case -2:
                #RECETA
                $arregloPaciente = $this->getBodyRecetas($master, $turno_id);
                $folio = $infoPaciente[array_key_last($infoPaciente)]['FOLIO_CONSULTA2'];
                $fecha_resultado = $infoPaciente[array_key_last($infoPaciente)]['FECHA_CARPETA_CONSULTA2'];
                $carpeta_guardado = "recetas";
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, -2]);
                $datos_medicos = $this->getMedicalCarrier($info);
                break;
            case -3:
                #SOLICITUD DE ESTUDIOS
                $arregloPaciente = $this->getBodySoliEstudios($master, $turno_id);
                $info = $master->getByProcedure("sp_info_medicos", [$turno_id, 19]);
                $datos_medicos = $this->getMedicalCarrier($info);
                $folio = $infoPaciente[array_key_last($infoPaciente)]['FOLIO_SOLICITUD_ESTUDIOS'];
                $fecha_resultado = $infoPaciente[array_key_last($infoPaciente)]['FECHA_CARPETA_CONSULTA2'];
                $carpeta_guardado = "solicitud_estudios";
                break;
            case -4:
                #Corte de caja
                $arregloPaciente = $this->getBodyCorteCaja($master, $turno_id);
                break;
            case -5:
                # Envio de Muestas
                # reporte de lotes.
                # pacientes que son enviado por maquila.
                $carpeta_guardado = "envio_de_muestras";
                $fecha_resultado = date("Ymd");
                $nombre_paciente = "envio_muestras_$turno_id";  # $turno_id es el id de lote que se quiere generar.

                $arregloPaciente = $this->getBodyFormatoEnvioLotesMaquila($master, $turno_id);
                break;
            case -6:
                # $turno_id para este caso seria el equivalente a ID_PACIENTE
                $arregloPaciente = $this->getBodyFormDatos($master, $turno_id);
                break;
            case -7:
                # $turno_id corresponde a la fecha de la lista de trabajo que se quiere imprimir
                $arregloPaciente = $master->getByProcedure("sp_lista_de_trabajo_barras", [$turno_id, 6, null, null, null]);
                break;
            case -8:
                $laboratorio_id = $_POST['laboratorio_id'];
                $fecha_inicio = $_POST['fecha_inicio'];
                $fecha_fin = $_POST['fecha_fin'];

                $maquilas = $master->getByProcedure("sp_laboratorio_estudios_maquila_b", [
                    NULL, NULL, $laboratorio_id, 1, $fecha_inicio, $fecha_fin
                ]);

                if (is_array($maquilas)) {
                    foreach ($maquilas as $index => $maquila) {
                        $data_estudios_filtrados = [];
                        $decode_lista_estudios = json_decode($maquila['LISTA_ESTUDIOS'], true);
                        $data_estudios = $master->getByProcedure('sp_obtener_estudios_de_servicio', [
                            $maquila['ID_SERVICIO']
                        ]);

                        if (is_array($decode_lista_estudios) and is_array($data_estudios)) {
                            $data_estudios_filtrados = array_filter($data_estudios, function ($estudio) use ($decode_lista_estudios) {
                                return in_array($estudio['ID_ESTUDIO'], $decode_lista_estudios);
                            });
                        }

                        $maquilas[$index]['DETALLES_ESTUDIOS'] = array_values($data_estudios_filtrados);
                        $maquilas[$index]['LISTA_ESTUDIOS'] = $decode_lista_estudios;
                    }
                }

                $arregloPaciente = $maquilas;
                break;
            case -9:
                $ujat_inicial = $_POST['fecha_inicial'];
                $ujat_final = $_POST['fecha_final'];
                $id_cliente = $_POST['id_cliente'];
                $area_id    = $_POST['area_id'];
                $tipo_cliente = $_POST['tipo_cliente']; # 1 contado, 2 credito
                $tiene_factura = $_POST['tiene_factura'];
                $detallado = $_POST['detallado']; # indica el tipo de reporte que quieren ver

                $params = $master->setToNull([
                    $ujat_inicial,
                    $ujat_final,
                    $id_cliente,
                    $area_id,
                    $tipo_cliente,
                    $tiene_factura,
                    'es_franquiciario' => $_SESSION['franquiciario'] ? $_SESSION['id'] : null
                ]);

                $arregloPaciente['reporte'] = ($detallado == 1)
                    ? $master->getByProcedure("sp_reporte_ujat", $params)
                    : $master->getByProcedure("sp_reporte_ujat_prueba", $params);

                $arregloPaciente['franquicia'] = $_SESSION['franquiciario']
                    ? $master->getByProcedure("sp_datos_fiscales_franquicia", [$_SESSION['id_cliente']])
                    : null;

                $carpeta_guardado = 'pacientes';
                $fecha_resultado = date('Y-m-d');
                $turno_id = $_SESSION['id'];
                $nombre_paciente = 'Reporte-de';
                $infoPaciente[0]['ETIQUETA_TURNO'] = 'Pacientes';
            break;
            case -10:
                #Recuperar certificado medico
                $servicios = $master->getByProcedure("sp_paciente_servicios_cargados", [$turno_id, null]);
                $paciente = $master->getByProcedure("sp_consultorio_certificado_b", [$turno_id, null]);
                $medicos = $master->getByProcedure("sp_info_medicos", [$turno_id, 1]);
                $consulta = $master->getByProcedure("sp_consultorio2_consulta_b", [$turno_id, null]);

                $arregloPaciente = [
                    'SERVICIOS' => $servicios,
                    'PACIENTE' => $paciente,
                    'MEDICOS' => $medicos,
                    'CONSULTA' => $consulta
                ];
                break;
            case -11:
                $carpeta_guardado = 'requisicion_maquilas';
                $cliente_id = $master->insertByProcedure('sp_get_cliente', [$turno_id]);

                if ($cliente_id == 51) { # 51 es sigma
                    $arregloPaciente = $this->getSigmaHistoria($master, $turno_id);
                    $filteredArregloPaciente = [];
                    $allowedKeys = [
                        'ID_PACIENTE',
                        'nombre_cliente',
                        'EDAD',
                        'NACIMIENTO',
                        'CELULAR',
                        'CORREO',
                        'POSTAL',
                        'MUNICIPIO',
                        'COLONIA',
                        'EXTERIOR',
                        'INTERIOR',
                        'CALLE',
                        'domicilio_cliente',
                        'GENERO'
                    ];

                    if (isset($arregloPaciente[0][0])) {
                        $arregloPaciente = $arregloPaciente[0][0];
                    }
                    foreach ($arregloPaciente as $key => $value) {
                        if (in_array($key, $allowedKeys) && is_string($key)) {
                            $filteredArregloPaciente[$key] = $value;
                        }
                    }

                    $result = $filteredArregloPaciente;

                    //obtener los antecedentes del paciente
                    $infoConsultorioAntecedentes = $master->getByProcedure("sp_consultorio_antecedentes_b", [$turno_id, null]);
                    $infoHistoFam = $master->getByProcedure("sp_sigma_histofam_b", [$turno_id]);
                    $infoAntecedentesNutri = $master->getByProcedure("sp_antecedentes_nutricion_alimentos_respuestas_b", [$turno_id]);
                    $infoConsultorioAparatos = $master->getByProcedure("sp_consultorio_anamnesis_aparatos_b", [$turno_id]);
                    $infoFichAdmi = $master->getByProcedure("sp_sigma_ficha_admision_b", [$turno_id, null, null]);
                    $infoSignosVital = $master->getByProcedure("sp_mesometria_signos_vitales_b", [$turno_id]);
                    $infoSigmaExploracion = $master->getByProcedure("sp_sigma_exploracion_b", [$turno_id]);
                    $infoSigmaInterpretaciones = $master->getByProcedure("sp_sigma_interpretaciones_b", [$turno_id]);
                    $infoOftalmoResultados = $master->getByProcedure("sp_oftalmo_resultados_b", [NULL, $turno_id]);
                    $infoConsultorioConsulta = $master->getByProcedure("sp_consultorio_consulta_b", [NULL, $turno_id, NULL]);
                    $infoSigmaLesiones = $master->getByProcedure("sp_sigma_lesiones_b", [$turno_id]);
                    $infoSigmaValoraviones = $master->getByProcedure("sp_sigma_valoraciones_b", [$turno_id]);

                    $arregloAntecedentes = [];
                    foreach ($infoConsultorioAntecedentes as $key => $value) {
                        if (isset($value['ID_SUBTIPO'])) {
                            $arregloAntecedentes[$value['ID_SUBTIPO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['NOTAS', 'RESPUESTA', 'SUBTIPO'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloHistofam = [];
                    foreach ($infoHistoFam as $key => $value) {
                        if (isset($value['ID_FAMILIAR'], $value['ID_PREGUNTA'])) {
                            if (!isset($arregloHistofam[$value['ID_FAMILIAR']])) {
                                $arregloHistofam[$value['ID_FAMILIAR']] = [
                                    'FAMILIAR' => $value['FAMILIAR'], //cambiar familiar nombre
                                    'PREGUNTAS' => []
                                ];
                            }
                            $arregloHistofam[$value['ID_FAMILIAR']]['PREGUNTAS'][$value['ID_PREGUNTA']] = [
                                'PREGUNTA' => $value['PREGUNTA'],
                                'RESPUESTA' => $value['RESPUESTA']
                            ];
                        }
                    }

                    $arregloAntecedentesNutri = [];
                    foreach ($infoAntecedentesNutri as $key => $value) {
                        if (isset($value['ALIMENTO_ID'])) {
                            $arregloAntecedentesNutri[$value['ALIMENTO_ID']] = array_filter($value, function ($k) {
                                $allowedKeys = ['ALIMENTO'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloConsultorioAparatos = [];
                    foreach ($infoConsultorioAparatos as $key => $value) {
                        if (isset($value['ID_SUBTIPO'])) {
                            $arregloConsultorioAparatos[$value['ID_SUBTIPO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['NOTAS', 'RESPUESTA', 'SUBTIPO'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloInfoFichAdmi = [];
                    foreach ($infoFichAdmi as $key => $value) {
                        if (isset($value['ID_ADMISION'])) {
                            $arregloInfoFichAdmi = array_filter($value, function ($k) {
                                $allowedKeys = ['FECHA_ADMISION', 'RELIGION', 'LUGAR_NACIMIENTO', 'ESTADO_CIVIL', 'TELEFONO_PACIENTE', 'PUESTO_SOLICITA', 'AREA_DEPTO', 'NO_IMSS', 'PROFESION', 'ESCOLARIDAD', 'UMF', 'ACCIDENTE_AVISAR', 'PARENTESCO', 'TELEFONO1', 'TELEFONO2', 'ACTIVO', 'COLONIA', 'CALLE', 'CELULAR', 'ESTADO', 'EXTERIOR', 'INTERIOR', 'POSTAL', 'MUNICIPIO', 'PX', 'EDAD'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSignosVital = [];
                    foreach ($infoSignosVital as $key => $value) {
                        if (isset($value['ID_TIPO_MESO'])) {
                            $arregloSignosVital[$value['ID_TIPO_MESO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['TIPO_SIGNO', 'VALOR', 'UNIDAD_MEDIDA'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSigmaExploracion = [];
                    foreach ($infoSigmaExploracion as $key => $value) {
                        if (isset($value['ID_TIPO'])) {
                            $arregloSigmaExploracion[$value['ID_CUERPO'] . $value['ID_TIPO']] = array_filter($value, function ($k) {
                                $allowedKeys = ['PARTE_CUERPO', 'RESPUESTA', 'PARTE_CUERPO', 'OBSERVACIONES', 'TIPO_EXPLORACION'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSigmaInterpretaciones = [];
                    foreach ($infoSigmaInterpretaciones as $key => $value) {
                        if (isset($value['ID_INTERPRETACION'])) {
                            $arregloSigmaInterpretaciones = array_filter($value, function ($k) {
                                $allowedKeys = ['CUENTA_ROJA', 'GENERAL_ORINA', 'QUIMICA_SANGUINEA', 'RADIOGRAFIA_TORAX', 'VIH', 'ANTIDOPING', 'TIPO_SANGRE', 'REACCIONES_FEBRILES', 'VDRL', 'COPRO', 'EXUDADO_FARINGEO', 'AUDIOMETRIA', 'OTROS'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloOftalmoResultados = [];
                    foreach ($infoOftalmoResultados as $key => $value) {
                        $arregloOftalmoResultados = array_filter($value, function ($k) {
                            $allowedKeys = ['OD', 'OI', 'CON_OD', 'CON_OI'];
                            return in_array($k, $allowedKeys, true);
                        }, ARRAY_FILTER_USE_KEY);
                    }

                    $arregloConsultorioConsulta = [];
                    foreach ($infoConsultorioConsulta as $key => $value) {
                        $arregloConsultorioConsulta = array_filter($value, function ($k) {
                            $allowedKeys = ['NOTAS_PADECIMIENTO', 'DIAGNOSTICO', 'OBSERVACIONES'];
                            return in_array($k, $allowedKeys, true);
                        }, ARRAY_FILTER_USE_KEY);
                    }

                    $arregloSigmaLesiones = [];
                    foreach ($infoSigmaLesiones as $key => $value) {
                        if (isset($value['CUERPO_ID'])) {
                            $arregloSigmaLesiones[$value['CUERPO_ID']] = array_filter($value, function ($k) {
                                $allowedKeys = ['DESCRIPCION', 'DETALLE_LESION'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloSigmaValoraciones = [];
                    foreach ($infoSigmaValoraviones as $key => $value) {
                        if (isset($value['ID_VALORACION'])) {
                            $arregloSigmaValoraciones = array_filter($value, function ($k) {
                                $allowedKeys = ['VALORACION_MESES', 'VALORACION', 'OBSERVACIONES'];
                                return in_array($k, $allowedKeys, true);
                            }, ARRAY_FILTER_USE_KEY);
                        }
                    }

                    $arregloPaciente = [
                        $result, $arregloAntecedentes, $arregloHistofam, $arregloAntecedentesNutri,
                        $arregloConsultorioAparatos, $arregloInfoFichAdmi, $arregloSignosVital,
                        $arregloSigmaExploracion, $arregloSigmaInterpretaciones, $arregloOftalmoResultados,
                        $arregloConsultorioConsulta, $arregloSigmaLesiones, $arregloSigmaValoraciones
                    ];
                }
                break;
            case -12:
                $carpeta_guardado = 'reporte_ventas';
                $soloNuevos = $_POST['solo_nuevos'];
                $fechaInicio = $_POST['fecha_inicio'];
	            $fechaFin = $_POST['fecha_fin'];

                $arregloPaciente = $master->getByProcedure("sp_obtener_reporte_ventas", [
                    $soloNuevos, $fechaInicio, $fechaFin
                ]);
                break;
        }

        if ($area_id == 0) $area_id = 6;

        $infoPaciente[0]['SUBTITULO'] = 'Datos del paciente';
        $nombre = str_replace(" ", "_", $nombre_paciente);  #Crear directorio

        switch ($area_id) { #CERTIFICADOS
            case -10:
                $fecha_resultado = date("Ymd");
                $nombre = "CertificadoMedico";
                $ruta_saved = "reportes/certificados/$turno_id/$fecha_resultado/";
                break;
            case 15:
                $ruta_saved = "reportes/modulo/$carpeta_guardado/$fecha_resultado/";
                $this->setRutaReporte($ruta_saved);

                $r = $master->createDir("../" . $ruta_saved);

                if ($r === 1) {
                    $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre_paciente);
                    $pie_pagina = array("clave" => $infoPaciente[0]['CLAVE_IMAGEN'], "folio" => $folio, "modulo" => $area_id, "datos_medicos" => $datos_medicos);
                } else {
                    $this->setLog("Imposible crear la ruta del archivo", "[cotizaciones, reportador]");
                    exit;
                }
                break;
            case -8:
                $fecha_resultado = date("Ymd");
                $nombre = "Solicitud_Laboratorio_Maquilas";
                $ruta_saved = "reportes/modulo/laboratorio/solicitud_laboratorio_maquila/$fecha_resultado/";

                $this->setRutaReporte($ruta_saved);
                $master->createDir("../" . $ruta_saved);

                $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . '-' . $fecha_resultado);
                $pie_pagina = array("folio" => $folio, "modulo" => $area_id);

                $pdf = new Reporte(json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, $reporte, $tipo, $preview, $area_id);
                return $pdf->build();
            default:
                $ruta_saved = "reportes/modulo/$carpeta_guardado/$fecha_resultado/$turno_id/";

                # Seteamos la ruta del reporte para poder recuperarla despues con el atributo $ruta_reporte.
                $this->setRutaReporte($ruta_saved);

                # Crear el directorio si no existe
                $r = $master->createDir("../" . $ruta_saved);
                $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . "-" . $infoPaciente[0]['ETIQUETA_TURNO'] . '-' . $fecha_resultado);
                $pie_pagina = array("clave" => $infoPaciente[0]['CLAVE_IMAGEN'], "folio" => $folio, "modulo" => $area_id, "datos_medicos" => $datos_medicos);
                break;
        }

        # Seteamos la ruta del reporte para poder recuperarla despues con el atributo $ruta_reporte.
        $this->setRutaReporte($ruta_saved);

        # Crear el directorio si no existe
        $master->createDir("../" . $ruta_saved);
        $archivo = array("ruta" => $ruta_saved, "nombre_archivo" => $nombre . "-" . $infoPaciente[0]['ETIQUETA_TURNO'] . '-' . $fecha_resultado);
        $pie_pagina = array("clave" => $infoPaciente[0]['CLAVE_IMAGEN'], "folio" => $folio, "modulo" => $area_id, "datos_medicos" => $datos_medicos);

        $pdf = new Reporte(json_encode($arregloPaciente), json_encode($infoPaciente[0]), $pie_pagina, $archivo, $reporte, $tipo, $preview, $area_id);
        $renderpdf = $pdf->build();

        if ($lab == 1 && $tipo == 'url') {
            $master->insertByProcedure('sp_reportes_areas_g', [null, $turno_id, $area_id, $infoPaciente[0]['CLAVE_IMAGEN'], $renderpdf, null]);
        }

        return $renderpdf;
    }

    private function getBodyFormDatos($master, $id_paciente)
    {
        $response = $master->getByProcedure('sp_pacientes_b', [$id_paciente, null, null, null]);
        return $response[0];
    }

    private function getSigmaHistoria($master, $id_turno)
    {
        return $master->getByNext('sp_sigma_historia_b', [$id_turno]);
    }

    private function getBodyInfoSoma($master, $id_turno): array
    {
        # recuperamos los datos del paciente
        $response = $master->getByProcedure("sp_mesometria_signos_vitales_b", [$id_turno]);

        # declaramos el array final 
        $arregloPaciente = array();

        # convertimos los tipo de signos en claves y su resultado en el valor del arreglo
        foreach ($response as $sign) {
            $clave = str_replace(" ", "_", $sign['TIPO_SIGNO']);
            $arregloPaciente[$clave] = $sign['VALOR'];
        }
        $arregloPaciente['FECHA_REGISTRO'] = $response[0]['FECHA_REGISTRO'];


        return $arregloPaciente;
    }

    private function getBodyInfoElectro($master, $id_turno): array
    {
        $response = $master->getByProcedure("sp_electro_resultados_b", [null, $id_turno, null]);
        $arregloPaciente = array(
            "ESTUDIO" => "ELECTROCARDIOGRAMA",
            "TECNICA" => $response[array_key_first($response)]["TECNICA"],
            "HALLAZGO" => $response[array_key_first($response)]['HALLAZGO'],
            "INTERPRETACION" => $response[array_key_first($response)]['INTERPRETACION'],
            "COMENTARIO" => $response[array_key_first($response)]['COMENTARIO']
        );

        return $arregloPaciente;
    }

    private function getBodyInfoCotizacion($master, $id_cotizacion, $cliente_id): array
    {
        $infoCliente = $master->getByProcedure('sp_cotizaciones_b', [$id_cotizacion, $cliente_id]);
        $response = $master->getByNext("sp_cotizaciones_b", [$id_cotizacion, $cliente_id]);
        $arrayDetalle = [];

        $subTotalCal = 0;
        for ($i = 0; $i < count($response[1]); $i++) {

            $cargosDetalle = [
                "PRODUCTO" => $response[1][$i]['PRODUCTO'],
                "PAQUETE" => $response[1][$i]['PAQUETE'],
                "PRECIO_UNITARIO" => $response[1][$i]['SUBTOTAL_BASE'],
                "CANTIDAD" => $response[1][$i]['CANTIDAD'],
                "TOTAL" => $response[1][$i]['SUBTOTAL'],
                'TOTAL_ORIGINAL' => $response[1][$i]['SUBTOTAL_SIN_DESCUENTO'],
                'DESCUENTO_PORCENTAJE' => $response[1][$i]['DESCUENTO_PORCENTAJE']
            ];

            array_push($arrayDetalle, $cargosDetalle);
        }

        #Calculamos el subtotal
        foreach ($arrayDetalle as $detalle) {
            $subTotalCal += $detalle['TOTAL'];
        }

        #Carlulamos el IVA y el total
        $ivaCalculado = $subTotalCal * 0.16;
        $totalCal = $subTotalCal + $ivaCalculado;
        $descuentoSubtotal = $subTotalCal * $cargosDetalle['DESCUENTO_PORCENTAJE'];

        $NumbersToLetters = new NumbersToLetters($infoCliente[0]['TOTAL']);
        $cantidad = $NumbersToLetters->letters;

        return array(
            'ESTUDIOS_DETALLE' => $arrayDetalle,
            'CLIENTE' => $infoCliente[0]['CLIENTE'],
            "RAZON_SOCIAL" => $infoCliente[0]['RAZON_SOCIAL'],
            "OBSERVACIONES" => $infoCliente[0]['OBSERVACIONES'],
            "DOMICILIO_FISCAL" => $infoCliente[0]['DOMICILIO_FISCAL'],
            'TELEFONO' => $infoCliente[0]['TELEFONO'],
            'RFC' => $infoCliente[0]['RFC'],
            'CREADO_POR' => $infoCliente[0]['CREADO_POR'],
            'SUBTOTAL' => $infoCliente[0]['SUBTOTAL'],
            'SUBTOTAL_SIN_DESCUENTO' => $infoCliente[0]['SUBTOTAL_SIN_DESCUENTO'],
            'DESCUENTO' => $response[0][0]['DESCUENTO'],
            'IVA' => $infoCliente[0]['IVA'],
            'TOTAL_DETALLE' => $infoCliente[0]['TOTAL'],
            'FECHA_CREACION' => $response[0][0]['FECHA_CREACION'],
            'FECHA_VENCIMIENTO' => $response[0][0]['FECHA_VENCIMIENTO'],
            'FOLIO' => $infoCliente[0]['FOLIO'],
            'ABREVIATURA' => $infoCliente[0]['ABREVIATURA'],
            'CANTIDAD' => $cantidad,
            'PORCENTAJE_DESCUENTO' => $infoCliente[0]['PORCENTAJE_DESCUENTO']
        );
    }

    //Consultorio 2
    private function getBodyInfoConsultorio2($master, $turno_id)
    {
        $response = $master->getByNext('sp_consultorio2', [$turno_id]);
        $recetas = $master->getByNext('sp_recetas', [$turno_id]);

        return array_merge($response, $recetas);
    }


    private function getBodyRecetas($master, $turno_id)
    {
        return $master->getByNext('sp_recetas', [$turno_id]);
    }

    private function getBodySoliEstudios($master, $turno_id)
    {
        return $master->getByNext('sp_consultorio2', [$turno_id]);
    }

    private function getBodyInfoTicket($master, $id_turno): array
    {
        # recuperamos los datos del paciente
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$id_turno]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];
        $response = $master->getByNext("sp_cargos_turnos_b", [$id_turno, $_SESSION['id_cliente']]);

        $arregloTicket = array(
            'NOMBRE' => $infoPaciente[0]['NOMBRE'],
            "FOLIO" => $infoPaciente[0]['FOLIO_TICKET'],
            "FECHA_TICKET" => $response[1][0]['FECHA_IMPRESION'],
            "FECHA_NACIMIENTO" => $infoPaciente[0]['NACIMIENTO'],
            'CELULAR' => $infoPaciente[0]['CELULAR'],
            'RFC' => $infoPaciente[0]['RFC'],
            'ESTUDIOS_DETALLE' => $response[0],
            "SUBTOTAL" => $response[1][0]['SUBTOTAL'],
            "DESCUENTO" => $response[1][0]['DESCUENTO'],
            "IVA" => $response[1][0]['IVA'],
            "TOTAL_DETALLE" => $response[1][0]['TOTAL'],
            "USUARIO" => $response[1][0]['USUARIO'],
            'FOLIO_TICKET' => $infoPaciente[0][0]['FOLIO_TICKET']
        );

        return $arregloTicket;
    }

    private function getBodyInfoFast($master, $id_turno): array
    {
        # recuperamos los datos del paciente
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$id_turno]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];
        $response = $master->getByProcedure('sp_fastck_tipo_riesgo', [$id_turno]);

        $arregloFast = array(
            'NOMBRE' => $infoPaciente[0]['NOMBRE'],
            "FOLIO" => $infoPaciente[0]['FOLIO_FASTCK'],
            "EDAD" => $infoPaciente[0]['EDAD'],
            "SEXO" => $infoPaciente[0]['SEXO'],
            "FECHA_RESULTADO" => $infoPaciente[0]["FECHA_RESULTADO_FASTCK"],
            'TIPO_RIESGO' => $response[0]['TIPO_RIESGO'],
            "SCORE" => $response[0]['SCORE']
        );

        return $arregloFast;
    }

    private function getBodyInfoCorte($master, $id_turno): array
    {
        # recuperamos los datos del paciente
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$id_turno]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];
        $response = $master->getByProcedure('sp_fastck_tipo_riesgo', [$id_turno]);

        $arregloFast = array(
            'NOMBRE' => $infoPaciente[0]['NOMBRE'],
            "FOLIO" => $infoPaciente[0]['FOLIO_FASTCK'],
            "EDAD" => $infoPaciente[0]['EDAD'],
            "SEXO" => $infoPaciente[0]['SEXO'],
            "FECHA_RESULTADO" => $infoPaciente[0]["FECHA_RESULTADO_FASTCK"],
            'TIPO_RIESGO' => $response[0]['TIPO_RIESGO'],
            "SCORE" => $response[0]['SCORE']
        );

        return $arregloFast;
    }

    private function getBodyInfoConsultorio($master, $id_turno, $id_consulta): array
    {
        # json reporte consultorio.
        $response = $master->getByNext('sp_reporte_consultorio', [$id_turno, $id_consulta]);

        $productoFinal = [];
        if (is_array($response)) {
            # recorremos el arreglo de las consultas [6 queries]
            for ($i = 0; $i < count($response); $i++) {
                switch ($i) {
                    case 0:
                        # DATOS DE CONSULTA
                        foreach ($response[$i][0] as $key => $value) {
                            if (is_string($key)) {
                                $productoFinal[$key] = $value;
                            }
                        }
                        break;
                    case 1:
                        # ANTECEDENTES
                        # $productoFinal['ANTECEDENTES'] = $master->checkArray($response[$i]);
                        $antecedentes = $master->checkArray($response[$i]);
                        $tipos = array();

                        # obtenemos el nombre del tipo de antecedente principal
                        foreach ($antecedentes as $item) {
                            $tipos[] = $item['TIPO'];
                        }

                        # eliminamos las duplicidades
                        $tipos = array_unique($tipos);


                        # filtramos los subtipos dado el nuevo arreglo $tipo.
                        $productoFinal['ANTECEDENTES'] = array();
                        foreach ($tipos as $tipo) {
                            $productoFinal['ANTECEDENTES'][$tipo] = array_filter($antecedentes, function ($obj) use ($tipo) {
                                return $obj['TIPO'] === $tipo;
                            });
                        }
                        break;
                    case 2:
                        # ANAMNESIS
                        #$productoFinal['ANAMNESIS'] = $master->checkArray($response[$i]);
                        $anamnesis = $master->checkArray($response[$i]);

                        #Orden deseado
                        $ordenDeseado = [
                            'SISTEMA CARDIOVASCULAR',
                            'APARATO RESPIRATORIO',
                            'APARATO DIGESTIVO',
                            'APARATO GENITOURINARIO',
                            'SISTEMA NERVIOSO',
                            'ENDOCRINOLOGIA Y METABOLISMO',
                            'APARATO LOCOMOTOR',
                            'TERMOREGULACION'
                        ];


                        #obtenenmos la clase
                        $clase = array();
                        foreach ($anamnesis as $current) {
                            $clase[] = $current['CLASE'];
                        }
                        # quitmos la duplicidad de las clases
                        $clase = array_unique($clase);

                        $newAnamnesis = array();
                        foreach ($clase as $current) {
                            $replace = str_replace(" ", "_", $current);
                            $newAnamnesis[$replace] = array_filter($anamnesis, function ($obj) use ($current) {
                                return $obj['CLASE'] == $current;
                            });
                        }

                        #Reordenar la consulta y arreglo
                        $newAnamnesisOrdenado = array();
                        foreach ($ordenDeseado as $claseOrdenada) {
                            $claseConGuion = str_replace(" ", "_", $claseOrdenada);
                            if (array_key_exists($claseConGuion, $newAnamnesis)) {
                                $newAnamnesisOrdenado[$claseConGuion] = $newAnamnesis[$claseConGuion];
                            }
                        }

                        $productoFinal['ANAMNESIS'] = $newAnamnesisOrdenado;
                        # $productoFinal['ANAMNESIS'] = $newAnamnesis;
                        break;
                    case 3:
                        # ODONTOGRAMA
                        $productoFinal['ODONTOGRAMA'] = $master->checkArray($response[$i]);
                        break;
                    case 4:
                        # NUTRICION
                        $productoFinal['NUTRICION'] = $master->checkArray($response[$i][0]);
                        break;
                    case 5:
                        # EXPLORACION FISICA
                        $productoFinal['EXPLORACION_FISICA'] = $master->checkArray($response[$i]);
                        break;
                }
            }
        }

        return $productoFinal;
    }

    private function setLabels($infoPaciente, $infoEtiqueta): array
    {
        $arrayEtiqueta = [];
        $arrayEtiquetaEstudios = [];
        $content = "";
        $muestra = "";

        for ($i = 0; $i < count($infoEtiqueta); $i++) {

            for ($e = 0; $e < count($infoEtiqueta); $e++) {

                if ($infoEtiqueta[$i]['CONTENEDOR'] == $infoEtiqueta[$e]['CONTENEDOR'] && $infoEtiqueta[$i]['MUESTRA'] == $infoEtiqueta[$e]['MUESTRA']) {
                    $arregloEtiqueta = array('ABREVIATURA' => $infoEtiqueta[$e]['ABR']);
                    array_push($arrayEtiquetaEstudios, $arregloEtiqueta);
                }
            }


            if ($content !== $infoEtiqueta[$i]['CONTENEDOR']) {
                $content = $infoEtiqueta[$i]['CONTENEDOR'];
                $muestra = $infoEtiqueta[$i]['MUESTRA'];
                $maquila = $infoEtiqueta[$i]['MAQUILA_ABR'];
                $array1 = array(
                    'CONTENEDOR' => $infoEtiqueta[$i]['CONTENEDOR'],
                    'MUESTRA' => $infoEtiqueta[$i]['MUESTRA'],
                    'ESTUDIOS' => $arrayEtiquetaEstudios,
                    'MAQUILA_ABR' => $maquila

                );
                array_push($arrayEtiqueta, $array1);
            } else if ($muestra !== $infoEtiqueta[$i]['MUESTRA']) {
                $content = $infoEtiqueta[$i]['CONTENEDOR'];
                $muestra = $infoEtiqueta[$i]['MUESTRA'];
                $maquila = $infoEtiqueta[$i]['MAQUILA_ABR'];
                $array1 = array(
                    'CONTENEDOR' => $infoEtiqueta[$i]['CONTENEDOR'],
                    'MUESTRA' => $infoEtiqueta[$i]['MUESTRA'],
                    'ESTUDIOS' => $arrayEtiquetaEstudios,
                    'MAQUILA_ABR' => $maquila

                );
                array_push($arrayEtiqueta, $array1);
            }
            $arrayEtiquetaEstudios = [];
        }



        return $arrayEtiqueta;
    }

    private function getBodyInfoLabels2($master, $id_turno): array
    {
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$id_turno]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];
        $infoEtiqueta = $master->getByNext('sp_toma_de_muestra_servicios_b', [null, 6, $id_turno]);

        $locales = $this->setLabels($infoPaciente, $infoEtiqueta[0]);
        $subroga = $this->setLabels($infoPaciente, $infoEtiqueta[1]);


        $arrayEtiqueta = array_merge($locales, $subroga);
        $arregloPaciente = array(
            'NOMBRE' => $infoPaciente[0]['NOMBRE'],
            'FECHA_TOMA' => $infoPaciente[0]['FECHA_TOMA'],
            "FOLIO" => $infoPaciente[0]['FOLIO'],
            "EDAD" => $infoPaciente[0]['EDAD'],
            'SEXO' => $infoPaciente[0]['SEXO'],
            'PREFOLIO' => $infoPaciente[0]['PREFOLIO'],
            'BARRAS' => $infoPaciente[0]['CODIGO_BARRAS'],
            'CONTENEDORES' => $arrayEtiqueta,

        );

        return $arregloPaciente;
    }

    private function getBodyInfoLabels($master, $id_turno)
    {
        $infoPaciente = $master->getByProcedure('sp_informacion_paciente', [$id_turno]);
        $infoPaciente = [$infoPaciente[count($infoPaciente) - 1]];
        $infoEtiqueta = $master->getByProcedure('sp_toma_de_muestra_servicios_b', [null, 6, $id_turno]);

        $arrayEtiqueta = [];
        $arrayEtiquetaEstudios = [];
        $content = "";
        $muestra = "";
        $local = "";
        $maquila = "";
        for ($i = 0; $i < count($infoEtiqueta); $i++) {

            for ($e = 0; $e < count($infoEtiqueta); $e++) {

                if ($infoEtiqueta[$i]['CONTENEDOR'] == $infoEtiqueta[$e]['CONTENEDOR'] && $infoEtiqueta[$i]['MUESTRA'] == $infoEtiqueta[$e]['MUESTRA']) {
                    $arregloEtiqueta = array('ABREVIATURA' => $infoEtiqueta[$e]['ABR'], 'LOCAL' => $infoEtiqueta[$e]['LOCAL']);
                    array_push($arrayEtiquetaEstudios, $arregloEtiqueta);
                }
            }


            if ($content !== $infoEtiqueta[$i]['CONTENEDOR']) {
                $content = $infoEtiqueta[$i]['CONTENEDOR'];
                $muestra = $infoEtiqueta[$i]['MUESTRA'];
                $local = $infoEtiqueta[$i]['LOCAL'];
                $maquila = $infoEtiqueta[$i]['MAQUILA_ABR'];
                $array1 = array(
                    'CONTENEDOR' => $infoEtiqueta[$i]['CONTENEDOR'],
                    'MUESTRA' => $infoEtiqueta[$i]['MUESTRA'],
                    'MAQUILA_ABR' => $maquila,
                    'ESTUDIOS' => $arrayEtiquetaEstudios

                );
                array_push($arrayEtiqueta, $array1);
                if ($local == 0) {
                    $array1 = array(
                        'CONTENEDOR' => $infoEtiqueta[$i]['CONTENEDOR'],
                        'MUESTRA' => $infoEtiqueta[$i]['MUESTRA'],
                        'MAQUILA_ABR' => $maquila,
                        'ESTUDIOS' => $arrayEtiquetaEstudios

                    );
                    array_push($arrayEtiqueta, $array1);
                }
            } else if ($muestra !== $infoEtiqueta[$i]['MUESTRA']) {
                $content = $infoEtiqueta[$i]['CONTENEDOR'];
                $muestra = $infoEtiqueta[$i]['MUESTRA'];
                $local = $infoEtiqueta[$i]['LOCAL'];
                $maquila = $infoEtiqueta[$i]['MAQUILA_ABR'];
                $array1 = array(
                    'CONTENEDOR' => $infoEtiqueta[$i]['CONTENEDOR'],
                    'MUESTRA' => $infoEtiqueta[$i]['MUESTRA'],
                    'MAQUILA_ABR' => $maquila,
                    'ESTUDIOS' => $arrayEtiquetaEstudios

                );
                array_push($arrayEtiqueta, $array1);
                if ($local == 0) {
                    $array1 = array(
                        'CONTENEDOR' => $infoEtiqueta[$i]['CONTENEDOR'],
                        'MUESTRA' => $infoEtiqueta[$i]['MUESTRA'],
                        'MAQUILA_ABR' => $maquila,
                        'ESTUDIOS' => $arrayEtiquetaEstudios,

                    );
                    array_push($arrayEtiqueta, $array1);
                }
            }
            $arrayEtiquetaEstudios = [];
        }

        $arregloPaciente = array(
            'NOMBRE' => $infoPaciente[0]['NOMBRE'],
            'FECHA_TOMA' => $infoPaciente[0]['FECHA_TOMA'],
            "FOLIO" => $infoPaciente[0]['FOLIO'],
            "EDAD" => $infoPaciente[0]['EDAD'],
            'SEXO' => $infoPaciente[0]['SEXO'],
            'BARRAS' => $infoPaciente[0]['CODIGO_BARRAS'],
            'CONTENEDORES' => $arrayEtiqueta,

        );

        return $arregloPaciente;
    }

    private function getBodyInfoImg($master, $turno_id, $area_id): array
    {
        #recuperar la informacion del Reporte de interpretacion de ultrasonido y rayosx
        # recuperar los resultados de ultrasonido y rayosx
        // $area_id = $area_id; #11 es el id para ultrasonido y rayosx.
        $response1 = $master->getByNext('sp_imagenologia_resultados_b', [null, $turno_id, $area_id]);

        $response2 = $master->getByProcedure('sp_capturas_imagen_b', [$turno_id, $area_id]);

        $arrayimg = [];
        $arrayNuevascapturas = [];

        // print_r($response2[0]['CAPTURAS']);




        for ($i = 0; $i < count($response2); $i++) {
            // print_r($decodedResponse2);
            $decodedResponse2 = $master->decodeJsonRecursively($response2[$i]);
            array_push($arrayNuevascapturas, $decodedResponse2['CAPTURAS_REPORTE']);
        }


        // echo "<pre>";
        // var_dump($arrayNuevascapturas);
        // echo "</pre>;";
        // // print_r($decodedResponse2);
        // exit;


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
            'ESTUDIOS' => $arrayimg,
            'IMAGENES' => $arrayNuevascapturas
        );
    }

    private function getMedicalCarrier($info = array())
    {
        // print_r($info);
        $carreraPrincipal = array_filter($info, function ($obj) {
            $r = $obj['ESPECIALIDAD'] == 0;
            return $r;
        });

        $especialidades = array_filter($info, function ($obj) {
            $r = $obj['ESPECIALIDAD'] == 1;
            return $r;
        });

        $carreraPrincipal[0]['ESPECIALIDADES'] = $especialidades;

        return $carreraPrincipal;
    }

    private function getBodyInfoOftal($master, $turno_id)
    {
        #recuperar la informacion del Reporte de interpretacion de oftalmología
        # recuperar los resultados de oftalmología
        $response1 = $master->getByProcedure('sp_oftalmo_resultados_b', [null, $turno_id]);
        $arrayoftalmo = [];

        for ($i = 0; $i < count($response1[0]); $i++) {

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
            $confirmado = $response1[$i]['CONFIRMADO'];
            $con_agudeza_visual = $response1[$i]['AGUDEZA_VISUAL_CON_CORRECCION'];
            $con_oi = $response1[$i]['CON_OD'];
            $con_od = $response1[$i]['CON_OI'];
            $con_jaeger = $response1[$i]['CON_JAEGER'];
            $clave = $response1[$i]['TOKEN'];
            $fecha_resultado = $response1[$i]['FECHA_RESULTADO'];
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
                "OBSERVACIONES" => $observaciones,
                "CONFIRMADO" => $confirmado,
                "AGUDEZA_VISUAL_CON_CORRECCION" => $con_agudeza_visual,
                "CON_OD" => $con_oi,
                "CON_OI" => $con_od,
                "CON_JAEGER" => $con_jaeger,
                "CLAVE" => $clave,
                "FECHA_RESULTADO" => $fecha_resultado
            );
            array_push($arrayoftalmo, $array1);
        }

        return $arrayoftalmo[0];
    }

    private function getBodyInfoLab($master, $id_turno, $area_id): array
    {

        # informacion general del paciente

        #Estudios solicitados por el paciente
        $clasificaciones = $master->getByProcedure('sp_laboratorio_clasificacion_examen_b', [null, $area_id]);
        $response = $master->getByProcedure("sp_cargar_estudios", [$id_turno, $area_id]);

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

        $serv_var_abs = $this->ordernarBodyLab($serv_var_abs_obj, "VALORES ABSOLUTOS", $id_turno, $area_id);
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

                $aux = $this->ordernarBodyLab($servicios, $clasificaciones[$i]['DESCRIPCION'], $id_turno, $area_id);

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

            $aux = $this->ordernarBodyLab($servicios, "NINGUNA", $id_turno, $area_id);
            $arrayGlobal['areas'][] = $aux;
        }

        // var_dump($arrayGlobal);

        return array('global' => $arrayGlobal, 'clave' => $clave);
    }

    private function determinarTipo($parametro, $resultado)
    {
        $parametro = trim($parametro);
        $resultado = str_replace(",", '', trim($resultado));

        // Comprobar si el parámetro contiene un rango de valores
        if (strpos($parametro, '-') !== false) {
            $rango = explode('-', $parametro);
            $minimo = str_replace(",", '', trim($rango[0]));
            $maximo = str_replace(",", "", trim($rango[1]));

            if ($resultado < $minimo) {
                return $this->arrowDown;
            } elseif ($resultado > $maximo) {
                return $this->arrowUp;
            } else {
                return "";
            }
        }

        // Si no es un rango, comparar con el parámetro
        if ($resultado != $parametro) {
            return $this->asterisk;
        } else {
            return "";
        }
    }
    private function ordernarBodyLab($servicios, $clasificacion, $turno, $area_id)
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

            // var_dump($abs);
            // exit;

            foreach ($abs as $current) {
                # dibujar flechas o astericos a lado del resultado de los resultados de los valores absolutos.
                $demonMark = $this->determinarTipo($current['VALOR_REFERENCIA_ABS'], $current['VALOR_ABSOLUTO']);

                $absoluto_array[] = array(
                    "analito" => $current['DESCRIPCION_SERVICIO'],
                    "valor_abosluto" => $current['VALOR_ABSOLUTO'] . (trim($current['VALOR_ABSOLUTO']) === "N/A" ? "" : $demonMark),
                    "referencia" => $current['VALOR_REFERENCIA_ABS'],
                    "grupo_id" => $current['GRUPO_ID'],
                    "unidad" => $current['MEDIDA_ABS']
                );
            }
        }

        $master = new Master();
        $grupos = $master->getByProcedure('sp_cargar_grupos', [$turno, $area_id]);
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
                    $muestra_grupo = $current['MUESTRA_GRUPO'];

                    $current['RESULTADO'] = str_replace("<", "&lt;", $current['RESULTADO']);

                    $item = array(
                        "nombre"            => $current['DESCRIPCION_SERVICIO'],
                        "unidad"            => $current['MEDIDA'],
                        "resultado"         => $current['RESULTADO'] . $current['DEMONMARK'],
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

                        //Filtra por grupo_id, ya que se mezclavan
                        $absoluto_array_b = array_filter($absoluto_array, function ($obj) {
                            $r = $obj['grupo_id'] == 1;
                            return $r;
                        });

                        $analitos[$last_position] = $absoluto_array_b;
                        $analitos[] = $aux;
                        break;
                        #perfil reumatico
                    case 35:
                        if ($clasificacion_id == 1) {
                            # 1 para la clasificacion de hematologia. 
                            # Solo la hematoloigia debe mandar los valores absolutos                        
                            $last_position = count($analitos) - 2;
                            $aux = $analitos[$last_position];
                            // echo "<br/>";
                            // var_dump($absoluto_array);

                            //Filtra por grupo_id, ya que se mezclavan
                            $absoluto_array_b = array_filter($absoluto_array, function ($obj) {
                                $r = $obj['grupo_id'] == 35;
                                return $r;
                            });


                            // echo "<br/>";
                            // var_dump($absoluto_array_b);

                            $analitos[$last_position] = $absoluto_array_b;

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
                    "observaciones"  => isset($id_grupo) ? $observacionnes_generales : null,
                    "muestra"        => $muestra_grupo
                    //"muestra"        => $id_grupo == 972 || $id_grupo == 1599 || $id_grupo = 1677 ? "Plasma EDTA" : ""
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

    function getMuestraGrupo($master, $grupo_id, $turno)
    {
        $muestra = $master->selectByProcedure("sp_recuperar_muestra", [$grupo_id]);
        return $muestra[0];
    }

    function cleanAttachingFiles($files_array)
    {
        $files = [];
        foreach ($files_array as $file) {
            $files[] = $file['RUTA'];
        }

        return $files;
    }

    function decodeJson($parsing)
    {
        $decoded = array();

        foreach ($parsing as $key => $value) {

            if (!is_int($value)) {
                if ($this->str_ends_with($value, '}') || $this->str_ends_with($value, ']')) {
                    $aux = json_decode($value, true);
                    $s = 0;
                } else {
                    $aux = $value;
                }
            } else {

                $aux = $value;
            }
            // $aux = json_decode($value, true);
            // $s = 0;
            if (is_array($aux)) {
                foreach ($aux as $a) {
                    if (is_string($a)) {
                        $s = $s + 1;
                    }
                }
                if ($s > 0) {
                    $aux = $this->decodeJson($aux);
                }

                $decoded[$key] = $aux;
            } else {
                $decoded[$key] = $aux;
            }
        }

        return $decoded;
    }


    function decodeJsonRecursively($jsonArray)
    {
        $decodedArray = array();

        foreach ($jsonArray as $key => $value) {
            if (is_array($value)) {
                $decodedArray[$key] = $this->decodeJsonRecursively($value);
            } else {
                if ($this->str_ends_with($value, ']') || $this->str_ends_with($value, '}')) {
                    $decodedValue = json_decode($value, true);

                    // Si json_decode devuelve NULL, significa que el valor no es un JSON válido,
                    // por lo que simplemente lo mantenemos tal como está.
                    // De lo contrario, seguimos decodificando recursivamente.
                    if ($decodedValue === NULL) {
                        $decodedArray[$key] = $value;
                    } else {
                        $decodedArray[$key] = $this->decodeJsonRecursively($decodedValue);
                    }
                } else {
                    $decodedArray[$key] = $value;
                }
            }
        }

        return $decodedArray;
    }



    function str_ends_with($haystack, $needle)
    {
        return (@substr_compare($haystack, $needle, -strlen($needle)) == 0);
    }


    function cleanAttachFilesImage($master, $turno_id, $area_id, $cliente, $reenviar = 0, $fecha_busqueda = null): array
    {
        # reporte
        $response = $master->getByProcedure("sp_recuperar_reportes_confirmados", [$turno_id, $area_id, $cliente, $fecha_busqueda, 0]);

        #reportes filtrados, solo los que estan validados
        if ($reenviar != 0) {
            $reportes_validados = array_filter($response, function ($obj) {
                $r = $obj['DOUBLE_CHECK'] == 1;
                return $r;
            });
            $response = $reportes_validados;
        }

        $reporte = $this->cleanAttachingFiles($response);

        # imagenes.
        $capturas = $master->getByProcedure("sp_capturas_imagen_b", [$turno_id, $area_id]);

        if ($reenviar != 0 || !is_null($fecha_busqueda)) {
            # imagenes filtradas
            $imagenes_array = [];
            foreach ($response as $item) {
                $area = $item['AREA'];
                $turno = $item['TURNO_ID'];
                $img = array_filter($capturas, function ($obj) use ($area, $turno) {
                    $r = $obj['TURNO_ID'] == $turno && $obj['AREA_ID'] == $area && isset($obj['RUTA']);
                    return $r;
                });

                if (!empty($img)) {
                    foreach ($img as $item) {
                        array_push($imagenes_array, $item);
                    }
                }
            }

            $capturas = $imagenes_array;
        }

        $decodedArray = [];
        foreach ($capturas as $cap) {
            $decodedArray[] = $this->decodeJson($cap);
        }

        $imagenes = array();
        foreach ($decodedArray as $item) {
            foreach ($item['CAPTURAS'][0] as $i) {
                $imagenes[] = $i['url'];
            }
        }


        # unimos ambos arreglos
        $attachment = array_merge($reporte, $imagenes);
        $attachment = array_unique($attachment);

        return [$attachment, $response[array_key_first($response)]['CORREO'], array_map(function ($obj) {
            return $obj['TURNO_ID'];
        }, $response), array_map(function ($obj) {
            return $obj['NOMBRE_ARCHIVO'];
        }, $response)];
    }

    public function joinPdf($files = [])
    {
        $merger = new Merger;
        if (!empty($files)) {
            $merger->addIterator($files);
            try {
                $createpdf = $merger->merge();
                return $createpdf;
            } catch (Exception $e) {
                echo $e;
            }
        }
        return null;
    }

    public function  scanDirectory($directory)
    {
        #enviar los dos puntos [../] basandose en el archivo de miscelaneus
        $files = array();
        if ($gestor = opendir($directory)) {
            // echo "Gestor de directorio: $gestor\n";
            // echo "Entradas:\n";

            /* Esta es la forma correcta de iterar sobre el directorio. */
            $count = 0;
            while (false !== ($entrada = readdir($gestor))) {
                if ($count > 1) {
                    array_push($files, $directory . $entrada);
                }
                $count++;
            }

            closedir($gestor);
        }

        return $files;
    }

    public function selectHost($domain): string
    {

        switch ($domain) {
            case "localhost":
                $preUrl = "http://localhost/nuevo_checkup/";
                break;
            case "bimo-lab.com":
                $preUrl = "https://bimo-lab.com/nuevo_checkup/";
                break;
            case "drjb.com.mx":
                $preUrl = "https://drjb.com.mx/nuevo_checkup/";
                break;
            case "helicebiologicos.com":
                $preUrl = "http://helicebiologicos.com/nuevo_checkup/";
                break;
            default:
                $preUrl = "https://bimo-lab.com/nuevo_checkup/";
                break;
        }

        return $preUrl;
    }

    public function getByPatientNameByTurno($master, $turno)
    {
        $name = $master->getByProcedure("sp_get_patient_name_by_turno", [$turno]);
        return isset($name[0]['NOMBRE_COMPLETO']) ? $name[0]['NOMBRE_COMPLETO'] : "NONE";
    }

    public function setToNull($params = array())
    {
        # esta funcion convierte en null 
        # todas aquellas variables que tengans strlen =0,
        # las que tengas la palabra "null" o las que no traigan contenido.
        # Si trae algo distinto en su valor, lo deja intacto.

        $formattedParams = array();

        foreach ($params as $param) {
            if (!isset($param) || strlen($param) == 0 || strtolower($param) == "null") {
                $formattedParams[] = null;
            } else {
                $formattedParams[] = $param;
            }
        }

        return $formattedParams;
    }

    public function getEmailMedico($master, $id_turno)
    {
        $response = $master->getByProcedure("sp_correo_medico_tratante", [$id_turno]);

        # el response trae el correo2 del paciente y el correo del medico
        # en el mismo row, asi que solo tenemos que acceder al indice 0 del $response

        # declaramos un contenedor de los correos
        $correos = array();

        #le agregamos los correos al controlador
        $correos[] = $response[0]['CORREO2'];
        $correos[] = $response[0]['CORREO_MEDICO'];

        # probablemente alguno de los correos no se haya rellenado en recepcion,
        # entonces enviamos un arreglo filtrado de aquellos elementos que tengan
        # algo escrito en dichos campos.
        return array_filter($correos, function ($item) {
            return strlen($item) > 0;
        });
    }
    public function getBodyAudio($master, $id_turno)
    {

        # recuperamos los datos del paciente
        $response = $master->getByProcedure("sp_audiometria_resultados_b", [$id_turno, null, null, null]);
        return $this->decodeJsonRecursively($response[0]);
    }
    public function getBodyEspiro($master, $turno_id)
    {
        # json para el reporte de espirometria.
        $respuestas = $master->getByProcedure("sp_espiro_cuestionario_b", [$turno_id]);

        # declaramos el arreglo que guardara el id de la pregunta
        $preguntas = array();

        # llenamos el arreglo
        foreach ($respuestas as $current) {
            $preguntas[] = $current['ID_P'];
        }

        # eliminamos las duplicidades
        $preguntas = array_unique($preguntas);

        # Declaramos un arreglo que guarde el cuestionario del paciente.
        $cuestionario = array();

        # llenamos el cuestionario, preparando el arreglo para el json.
        foreach ($preguntas as $pregunta) {

            #filtramos las respuestas de cada pregunta del arreglo origina, el que viene de la base de datos.
            $res_pregunta = array_filter($respuestas, function ($array) use ($pregunta) {
                return $array['ID_P'] == $pregunta;
            });

            # formamos el arreglo para el json.
            $cuestionario[] = array(
                "id_pregunta" => $res_pregunta[array_key_first($res_pregunta)]['ID_P'],
                "pregunta" => $res_pregunta[array_key_first($res_pregunta)]['PREGUNTA'],
                "respuestas" => $master->getFormValues(array_map(function ($item) {
                    return array("respuesta"  => $item['RESPUESTA'], "comentario" => $item['COMENTARIO']);
                }, $res_pregunta))
            );
        }

        return $cuestionario;
    }


    public function getBodyTemperatura($master, $turno_id)
    {
        $folio = $turno_id;
        #Llenar tabla del formato PDF, pasar ID del FOLIO
        $response = $master->getByNext('sp_temperatura_formato_b', [$folio]);

        $result = array();
        $i = 1;
        foreach ($response[0] as $key => $e) {
            $dia = $e['DIA'];
            $firma_usuario = $e['RUBRICA_FIRMA'];
            $turno = $e['TURNO'];
            $valor = $e['valor'];
            $hora = $e['HORA'];
            $anho = $e['ANHO'];
            $mes = $e['MES'];
            $color = $e['MODIFICADO'] == 0 ?  "blue" : "mostaza";
            $id_registro = $e['ID_REGISTRO_TEMPERATURA'];
            if (!isset($result[$dia])) {
                $result[$dia] = array();
            }

            // if ($i === 3) {
            //     $i = 1;
            // }

            if ($turno === "MATUTINO") {
                $i = 1;
            } else {
                $i = 2;
            }

            $result[$dia][$i] = array("valor" => $valor, "color" => $color, "id" => $id_registro, "hora" => $hora, "FIRMA" => $firma_usuario);
            $i++;
        }


        foreach ($response[1] as $key => $e) {
            # Equipo
            $intervalo_min = $e['INTERVALO_MIN'];
            $intervalo_max = $e['INTERVALO_MAX'];
            $equipo = $e['ENFRIADOR'];
            $equipo_marca = $e['ENFRIADOR_MARCA'];
            $equipo_modelo = $e['ENFRIADOR_MODELO'];
            $equipo_numero_serie = $e['ENFRIADOR_NUMERO_SERIE'];
            $termometro_marca = $e['TERMOMETRO_MARCA'];
            $termometro_id = $e['TERMOMETRO_ID'];
            $termometro_factor_correcion = $e['FACTOR_DE_CORRECCION'];
            #Termometro
            $termometro_marca = $e['TERMOMETRO_MARCA'];
            $termometro_id = $e['TERMOMETRO_ID'];
            $termometro_factor_correcion = $e['FACTOR_DE_CORRECCION'];
            #Ultima fecha de registro
            $fecha_formato = date("d/m/Y", strtotime($e['FECHA']));
            #Supervisor
            $usuario_name = $e['px'];
            $usuario_rubrica = $e['RUBRICA'];
            #Ruta tabla
            $url_tabla = $e['RUTA_TABLA'];
            $localizacion = $e['LOCALIZACION'];
            $fecha_verificacion = $e['FECHA_VERIFICACION'];

            $observaciones = $e['OBSERVACIONES'];
        }

        $cargo = 'SUPERVISOR';
        $response = [];
        // Datos de los equipos que se usaron en el mes como el equipo que se le checo la temperatura y el termometro que se uso para saber la temperatura del equipo.
        $response['EQUIPO']['ANHO'] = $anho;
        $response['EQUIPO']['MES'] = $mes;
        $response['EQUIPO']['FOLIO'] = $folio;
        $response['EQUIPO']['LOCALIZACION'] = is_null($localizacion) ? 'N/A' : $localizacion;
        $response['EQUIPO']['INTERVALO_MIN'] = is_null($intervalo_min) ? 'N/A' : $intervalo_min;
        $response['EQUIPO']['INTERVALO_MAX'] = is_null($intervalo_max) ? 'N/A' : $intervalo_max;
        $response['EQUIPO']['URL_TABLA'] = is_null($url_tabla) ? 'N/A' : $url_tabla;
        $response['EQUIPO']['EQUIPO_NOMBRE'] = is_null($equipo) ? 'N/A' : $equipo;
        $response['EQUIPO']['EQUIPO_MARCA'] = is_null($equipo_marca) ? 'N/A' : $equipo_marca;
        $response['EQUIPO']['EQUIPO_MODELO'] =  is_null($equipo_modelo) ? 'N/A' : $equipo_modelo;
        $response['EQUIPO']['EQUIPO_NUMERO_SERIE'] = is_null($equipo_numero_serie) ? 'N/A' : $equipo_numero_serie;
        $response['EQUIPO']['TERMOMETRO_MARCA'] = is_null($termometro_marca) ? 'N/A' : $termometro_marca;
        $response['EQUIPO']['TERMOMETRO_ID'] = is_null($termometro_id) ? 'N/A' : $termometro_id;
        $response['EQUIPO']['FECHA_VERIFICACION'] = is_null($fecha_verificacion) ? 'N/A' : $fecha_verificacion;
        $response['EQUIPO']['FACTOR_CORRECCION'] = is_null($termometro_factor_correcion) ? 'N/A' : $termometro_factor_correcion;

        // Datos de la persona que superviso el formato como las observaciones, el nombre, el cargo, la fecha y la firma
        $response['USUARIO']['OBSERVACIONES'] = is_null($observaciones) ? 'N/A' : $observaciones;
        $response['USUARIO']['NOMBRE'] = is_null($usuario_name) ? 'N/A' : $usuario_name;
        $response['USUARIO']['CARGO'] = is_null($cargo) ? 'N/A' : $cargo;
        $response['USUARIO']['FECHA'] = is_null($fecha_formato) ? 'N/A' : $fecha_formato;
        $response['USUARIO']['RUBRICA'] = is_null($usuario_rubrica) ? 'N/A' : $usuario_rubrica;


        #Laura
        #Aurora
        #Nery -> supervisor
        #Enoc  -> supervisor
        #Karen
        #Jaime

        $response['DIAS'] = $result;

        return $response;
    }

    function llamar_api()
    {

        // Datos que deseas enviar a la API
        $datos = array(
            'api' => '1',
            'user' => 'TurneroUno',
            'pass' => 'I16E!H{fg7'
        );

        $url1 = "https://bimo-lab.com/nuevo_checkup/api/login_api.php";

        // Crear opciones de la petición HTTP
        $opciones = array(
            "http" => array(
                "header" => "Content-type: application/x-www-form-urlencoded\r\n",
                "method" => "POST",
                "content" => http_build_query($datos), # Agregar el contenido definido antes
            ),
        );
        # Preparar petición
        $contexto = stream_context_create($opciones);
        # Hacerla
        $json = file_get_contents($url1, false, $contexto);

        $res = json_decode($json, true);


        return $res;
    }

    public function getLevenshteinDistance($str1, $str2)
    {
        $str1 = strtolower($str1);
        $str2 = strtolower($str2);

        $len1 = strlen($str1);
        $len2 = strlen($str2);

        // Crear una matriz para almacenar los resultados de los subproblemas
        $dp = array();
        for ($i = 0; $i <= $len1; $i++) {
            $dp[$i] = array();
            for ($j = 0; $j <= $len2; $j++) {
                $dp[$i][$j] = 0;
            }
        }

        // Llenar la matriz con valores iniciales
        for ($i = 0; $i <= $len1; $i++) {
            $dp[$i][0] = $i;
        }
        for ($j = 0; $j <= $len2; $j++) {
            $dp[0][$j] = $j;
        }

        // Calcular la distancia de Levenshtein
        for ($i = 1; $i <= $len1; $i++) {
            for ($j = 1; $j <= $len2; $j++) {
                $cost = ($str1[$i - 1] != $str2[$j - 1]) ? 1 : 0;
                $dp[$i][$j] = min(
                    $dp[$i - 1][$j] + 1,
                    $dp[$i][$j - 1] + 1,
                    $dp[$i - 1][$j - 1] + $cost
                );
            }
        }

        return $dp[$len1][$len2];
    }

    public function getBodyCorteCaja($master, $turno_id)
    {
        #Llenar tabla del formato PDF, pasar ID del FOLIO
        $response1 = $master->getByProcedure("sp_recuperar_info_hostorial_caja", [$turno_id]);
        $response2 = $master->getByProcedure("sp_corte_detalle_pagos", [$turno_id]);
        $response = [$response1, $response2];

        $result = array();
        $i = 0;

        $folio = 0000;
        $subtotal_general = 0;
        $iva_general = 0;
        $total_general = 0;
        $resumen_credito = 0;
        $resumen_contado = 0;
        $resumen_cortesia = 0;
        $resumen_BIMO =  0; # CONCEPTO BIMO

        // Datos de todos los pacientes que entraron en el cierre de caja
        $array_prefolios = array();
        foreach ($response[0] as $key => $e) {

            $prefolio = $e['PREFOLIO'];
            $nombre_paciente = $e['PACIENTE'];
            $subtotal = $e['SUBTOTAL'];
            $iva = $e['MONTO_IVA'];
            $total = $e['TOTAL'];
            $forma_pago = $e['FORMA_PAGO'];
            $factura = $e['FACTURA'];

            $monto_tipo_pago = $e['FORMA_PAGO_MONTO']; # Monto por tipo de pago;

            $nombre_caja = $e['NOMBRE_CAJA']; # nombre de la caja
            $procedencia = $e['NOMBRE_COMERCIAL']; # procedencia del paciente

            $result[$i] =  array(
                "PREFOLIO" => $prefolio,
                "NOMBRE_PACIENTE" => $nombre_paciente,
                "SUBTOTAL" => $subtotal,
                "IVA" => $iva,
                "TOTAL" => $total,
                "FORMA_PAGO" => substr($forma_pago, 0, 4),
                "MONTO_PAGO_TIPO" => $monto_tipo_pago,
                "FACTURA" => $factura,
                "PROCEDENCIA" => $procedencia
            );

            $i++;

            if (!in_array($prefolio, $array_prefolios)) {
                $subtotal_general += $subtotal;
                $iva_general += $iva;
                $total_general += $total;

                $clientes = $master->getByProcedure("sp_clientes_configuracion_pago_b", [null]);

                $cliente_ids = [];

                foreach ($clientes as $row) {
                    if ($row['DETALLE_PAGO'] == 1) {
                        $cliente_ids[] = $row['CLIENTE_ID'];
                    }
                }

                $resumen_contado  += in_array($e['CLIENTE_ID'], $cliente_ids) ? $total : 0;
                $resumen_credito  += !in_array($e['CLIENTE_ID'], $cliente_ids) ? $total : 0;
                $resumen_cortesia += in_array($e['CLIENTE_ID'], [17]) ? $total : 0;
                $resumen_BIMO     += in_array($e['CLIENTE_ID'], [15]) ? $total : 0;
            }

            $array_prefolios[] = $prefolio;

            $folio = $e['FOLIO'];
            $fecha_inicio = $e['FECHA_INICIO'];
            $fecha_final = is_null($e['FECHA_FINAL']) ? "N/A" : $e['FECHA_FINAL'];
        }

        $tipos_precio = array();
        $x = 0;
        // Desglose de todos los tipos de precios con sus respectivos montos
        foreach ($response[1] as $key1 => $value1) {
            # code...
            $tipo_pago = $value1['TIPO_PAGO'];
            $total_tipo_pago = $value1['TOTAL'];
            $ignorar = $value1['IGNORAR'];

            $tipos_precio[$x] = array(
                "DESCRIPCION" => $tipo_pago,
                "MONTO" => $total_tipo_pago,
                "IGNORAR" => $ignorar
            );

            $cortador = is_null($value1['HECHO_POR']) ?  "CORTE SIN FINALIZAR" : $value1['HECHO_POR'];


            $x++;
        }

        return [
            $result,
            $subtotal_general,
            $iva_general,
            $total_general,
            $resumen_credito,
            $resumen_contado,
            $folio,
            $fecha_inicio,
            $fecha_final,
            $cortador,
            $tipos_precio,
            $nombre_caja,
            $resumen_cortesia,
            $resumen_BIMO
        ];
    }

    public function getBodyEnvioMuestras($master, $turno_id)
    {
        # json para recuperar datos de envio de muestras
        $respuestas = $master->getByProcedure("", [$turno_id]);
    }

    public function setLogEmail(
        $master,
        $turno_id,
        $area_id,
        $correo_origen,
        $correo_destino,
        $tipo_correo,
        $notas,
        $enviado
    ) {
        # Guarda el comportamiento de los correo de resultados o cualquier otro correo enviado por bimo.
        $response = $master->insertByProcedure("", []);

        return true;
    }


    public function getBodyFormatoEnvioLotesMaquila($master, $id_lote)
    {
        $resultset = $master->getByNext("sp_maquilas_datos_reporte", [$id_lote]);

        $detalle = $resultset[0];
        $generales = $resultset[1][0];

        $generales["DETALLE"] = $detalle;

        return $generales;
    }

    function token_api()
    {
        return [
            'openAI' => "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",
        ];
    }
}
