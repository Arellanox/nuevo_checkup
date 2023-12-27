<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../lib/excel/vendor/autoload.php';


$fecha_inicial = isset($_GET['fecha_inicial']) ? $_GET['fecha_inicial'] : null;
$fecha_final = isset($_GET['fecha_final']) ?  $_GET['fecha_final'] : null;


#################################  IMPORTACIONES ############################################
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

#################################  FUNCIONES ################################################


## Funcion para obtener los datos
function getData($fecha_inicial, $fecha_final)
{

    $url1 = "http://localhost/nuevo_checkup/api/checadorBimo_api.php";
    // Los datos de enviados
    $datos = [
        "api" => 4,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
    ];

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



    $array = $res['response']['data'];



    return $array;

}


// ##FUNCION PARA PINTAR CELDAS
function pintarCeldas($sheet, $rangoCeldas, $color, $numero)
{
    foreach ($rangoCeldas as $c) {

        $style = $sheet->getStyle($c . $numero);
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB($color);
    }
}

// // ## FUNCION PARA CENTAR EL CONTENIDO DE LAS CELDAS
function centraContenido($sheet, $celdas, $numero)
{

    foreach ($celdas as $c) {

        $style = $sheet->getStyle($c . $numero);
        $style->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        $style1 = $sheet->getStyle($c . $numero);
        $style1->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
    }
}

## FUNCION PARA BORDEAR UN RANGO DE CELDAS
function bordearContenido($sheet, $rangoCeldas,$border ,$numero){

    foreach ($rangoCeldas as $celda){

        $sheet->getStyle($celda.$numero)->applyFromArray($border);


    }
}

## FUNCION PARA HACER LOS  ENCABEZADOS DE LAS FECHAS
function hacerDias($celdas, $color, $border, $sheet, $fecha_inicial)
{
    global $celda1;
    $fechaActual = $fecha_inicial;
    $dias = 0;
    $contadorCeldas = 1;

    foreach ($celdas as $celda) {
        if ($contadorCeldas == 1) {
            $celda1 = $celda . '5';
            $sheet->setCellValue($celda . '6', 'Entrada');
            $sheet-> getColumnDimension($celda)->setWidth(12);


        } else {
            $celda2 = $celda . '5';
            $sheet->setCellValue($celda . '6', 'Salida');
            $sheet->getColumnDimension($celda)->setWidth(12);

            $sheet->mergeCells("$celda1:$celda2");

            $dias = $dias + 1;
            $fecha = clone $fechaActual; // Clonar la fecha actual para no modificar la original
            $fecha = $fecha->add(new DateInterval('P' . $dias . 'D'));
            $fecha = $fecha->format("d/m/Y");

            $sheet->setCellValue($celda1, $fecha);
            $contadorCeldas = 0;
        }

        $contadorCeldas = $contadorCeldas + 1;
    }
}


## FUNCION PARA RELLENAR LOS DATOS
function rellenarExel($sheet, $data, $border)
{

    $numero = 7;

    foreach ($data['REGISTROS'] as $registro) {

        $sheet->setCellValue('A' . $numero, $registro['COUNT']);
        $sheet->setCellValue('B' . $numero, $registro['NOMBRE']);
        $sheet->setCellValue('C' . $numero, $registro['AREA']);
        $sheet->setCellValue('D' . $numero, $registro['HORARIO_ENTRADA']);
        $sheet->setCellValue('E' . $numero, $registro['HORARIO_SALIDA']);
        $sheet->setCellValue('AL' . $numero, $registro['TOTAL_ASISTENCIAS']);
        $sheet->setCellValue('AM' . $numero, $registro['TOTAL_RETARDOS']);

   
        bordearContenido($sheet,['A','B','C','D','E','AL','AJ','AK','AM','AN'], $border,$numero);
        centraContenido($sheet, ['A','D','E','AL','AJ','AK','AM', 'AN'] , $numero);


        $asistenciasArray = json_decode($registro['ASISTENCIAS'], true);

        $columna = 'F';
        foreach ($asistenciasArray as $asistencia) {

            $info = json_decode($asistencia, true);

            $sheet->setCellValue($columna . $numero, $info['HORA_ENTRADA']);
            bordearContenido($sheet, [$columna], $border, $numero);
            centraContenido($sheet, [$columna], $numero);
            $columna++;

            $sheet->setCellValue($columna . $numero, $info['HORA_SALIDA']);
            bordearContenido($sheet, [$columna], $border, $numero);
            centraContenido($sheet, [$columna], $numero);

            $columna++;
        }

        $numero =  $numero + 1;

    }



}


##############################  OBTENCION DE DATOS ############################################


## OBTENEMOS TODA LA INFORMACION Y LA GUARDAMNOS EN VARIABLES
$data = getData($fecha_inicial, $fecha_final);



###################################  ESQUELETE DEL EXCEL ######################################


// // #CREAMOS NUESTRA HOJA DE TRABAJO
$workbook = new Spreadsheet();
$sheet = $workbook->getActiveSheet();


// ## DEFINIMOS COLORES
$colorGris = "C0C0C0";
$colorAzul = 'FF4F80BD';
$colorBlanco = 'FFFFFF';


// ## DEFINIMOS LOS BORDES
$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];


$sheet->setTitle('Asistencias');

// Reaalizamos la primera parte de los encabezados
$sheet->setCellValue('A1', 'CONSOLIDADO  REGISTRO DE ENTRADAS Y SALIDAS DEL PERSONAL ');
$style = $sheet->getStyle('A1');
$font = $style->getFont()->setSize(18)->setBold(true);
$sheet->getRowDimension(2)->setRowHeight(30);
$sheet->getColumnDimension('A')->setWidth(15);


$sheet->setCellValue('A3', 'PERIODO');
$style = $sheet->getStyle('A3');
$style->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB($colorGris);

$sheet->setCellValue('B3', '20/23');


$sheet->mergeCells('A5:A6');
$sheet->setCellValue('A5', 'ID');
$sheet->getStyle('A5:A6')->applyFromArray($borderStyle);

$sheet->mergeCells('B5:B6');
$sheet->setCellValue('B5', 'NOMBRE COLABORADOR');
$sheet->getStyle('B5:B6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('B')->setWidth(35);

$sheet->mergeCells('C5:C6');
$sheet->setCellValue('C5', 'AREA');
$sheet->getStyle('C5:C6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('C')->setWidth(25);


$sheet->mergeCells('D5:E5');
$sheet->setCellValue('D5', 'HORARIO');
$sheet->getStyle('D5:E5')->applyFromArray($borderStyle);

## CENTRAMOS LOS ENCABEZADOS
$celdasCentradas = ['A', 'B', 'C', 'D'];
centraContenido($sheet, $celdasCentradas, 5);

## PINTAMOS LOS ENCABEZADOS 
$celdasEncabezados = ['A', 'B', 'C', 'D'];
pintarCeldas($sheet, $celdasEncabezados, $colorGris, 5);


$sheet->setCellValue('D6', 'Entrada');
$sheet->setCellValue('E6', 'Salida');
$celdasCentradas2 = ['D', 'E'];
centraContenido($sheet, $celdasCentradas2, 6);
$sheet->getStyle('D6')->applyFromArray($borderStyle);
$sheet->getStyle('E6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('D')->setWidth(15);
$sheet->getColumnDimension('E')->setWidth(15);
$style = $sheet->getStyle('D6');
$style->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB($colorGris);
$style = $sheet->getStyle('E6');
$style->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB($colorGris);


## Realizamos la segunda parte de los encabezados en donde iran las fechas

$celdas = ['F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI'];

$colorAzul = '40E0D0';
$fecha_inicial = new DateTime($fecha_inicial);
$fechaModificada = $fecha_inicial->sub(new DateInterval('P1D'));
hacerDias($celdas, $colorAzul, $borderStyle, $sheet, $fechaModificada); #--> Hacemos los encabezados de las celdas que son las fechas
pintarCeldas($sheet,$celdas,$colorAzul,5); #--> Pintamos las celas
pintarCeldas($sheet,$celdas,$colorAzul,6); #--> Pintamos las celas
centraContenido($sheet, $celdas,5); #--> Centramos las celdas
centraContenido($sheet, $celdas, 6); #---> Centramos las celdas
bordearContenido($sheet,$celdas,$borderStyle,5);
bordearContenido($sheet, $celdas, $borderStyle, 6);



//Realizamos el encabezado de las informacion de horas trabajadas
$sheet->mergeCells("AJ5:AN5");
$sheet->setCellValue('AJ5', 'TOTAL PERIODO');
$sheet->getStyle('AJ5:AN5')->applyFromArray($borderStyle);


$sheet->setCellValue('AJ6', 'Hrs. Trabajadas');
$sheet->getStyle('AJ6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('AJ')->setWidth(15);


$sheet->setCellValue('AK6', 'Hrs. Esperadas');
$sheet->getStyle('AK6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('AK')->setWidth(15);


$sheet->setCellValue('AL6', 'Asistencias');
$sheet->getStyle('AL6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('AL')->setWidth(15);


$sheet->setCellValue('AM6', 'Retardos');
$sheet->getStyle('AM6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('AM')->setWidth(15);


$sheet->setCellValue('AN6', 'Hrs. Extras');
$sheet->getStyle('AN6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('AN')->setWidth(15);

$celdasHoras = ['AJ','AK','AL','AM','AN'];
centraContenido($sheet,$celdasHoras,6);
centraContenido($sheet,['AJ'],5);


## EMPEZAMOS A RELLENAR EL EXCEL CON LA INFORMACION DE LOS BIMIERS
rellenarExel($sheet, $data, $borderStyle);


## ESCRIBIMOS Y CREAMOS NUESTRA HOJA DE EXCEL
$writer = new Xlsx($workbook);
$writer->save('hello world.xlsx');


echo " El excel fue creado correctamente";

