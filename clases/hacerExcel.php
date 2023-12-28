<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../lib/excel/vendor/autoload.php';


$fecha_inicial = isset($_POST['fecha_inicial']) ? $_POST['fecha_inicial'] : null;
$fecha_final = isset($_POST['fecha_final']) ?  $_POST['fecha_final'] : null;



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
function bordearContenido($sheet, $rangoCeldas, $border, $numero)
{

    foreach ($rangoCeldas as $celda) {

        $sheet->getStyle($celda . $numero)->applyFromArray($border);
    }
}



## FUNCION PARA CREAR Y RELLENAR LOS REGISTRO DE LAS FECHAS
function crearCuerpoFechas($sheet, $data, $border, $colorAzul)
{

    $numero = 7;

    foreach ($data['REGISTROS'] as $registro) {

        $sheet->setCellValue('A' . $numero, $registro['COUNT']);
        $sheet->setCellValue('B' . $numero, $registro['NOMBRE']);
        $sheet->setCellValue('C' . $numero, $registro['AREA']);
        $sheet->setCellValue('D' . $numero, $registro['HORARIO_ENTRADA']);
        $sheet->setCellValue('E' . $numero, $registro['HORARIO_SALIDA']);
        $sheet->setCellValue('H' . $numero, $registro['TOTAL_ASISTENCIAS']);
        $sheet->setCellValue('I' . $numero, $registro['TOTAL_RETARDOS']);


        bordearContenido($sheet, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J'], $border, $numero);
        centraContenido($sheet, ['A', 'D', 'E', 'F', 'G', 'H', 'I', 'J'], $numero);

        $asistenciasArray = json_decode($registro['ASISTENCIAS'], true);

        $columna = 'K';
        foreach ($asistenciasArray as $asistencia) {

            $info = json_decode($asistencia, true);

            $celda1 = $columna . '5';

            ## RELLENAMOS LOS HORARIOS DE ENTRADA
            $sheet->setCellValue($columna . $numero, $info['HORA_ENTRADA']);
            bordearContenido($sheet, [$columna], $border, $numero);
            centraContenido($sheet, [$columna], $numero);

            ##RELLANAMOS LOS ENCABEZADOS
            $sheet->setCellValue($columna . '6', 'Entrada');
            $sheet->getColumnDimension($columna)->setWidth(12);
            pintarCeldas($sheet, [$columna], $colorAzul, 6); #--> Pintamos las celas
            centraContenido($sheet, [$columna], 6); #---> Centramos las celdas
            bordearContenido($sheet, [$columna], $border, 6);

            ## ESTILOS DE LOS ENCABEZADOS DE LAS FECHAS
            pintarCeldas($sheet, [$columna], $colorAzul, 5); #--> Pintamos las celas
            centraContenido($sheet, [$columna], 5); #---> Centramos las celdas
            bordearContenido($sheet, [$columna], $border, 5);

            $columna++; ## INCREMENTAMOS LAS COLUMNAS

            ## <--------------------------------------------------------------------> ##

            $celda2 = $columna . '5';

            ## RELLENAMOS LOS HORARIOS DE ENTRADA
            $sheet->setCellValue($columna . $numero, $info['HORA_SALIDA']);
            bordearContenido($sheet, [$columna], $border, $numero);
            centraContenido($sheet, [$columna], $numero);

            ## RELLENAMOS LOS ENCABEZADOS
            $sheet->setCellValue($columna . '6', 'Salida');
            $sheet->getColumnDimension($columna)->setWidth(12);
            pintarCeldas($sheet, [$columna], $colorAzul, 6); #--> Pintamos las celas
            centraContenido($sheet, [$columna], 6); #---> Centramos las celdas
            bordearContenido($sheet, [$columna], $border, 6);

            ## ESTILOS DE LOS ENCABEZADOS DE LAS FECHAS
            pintarCeldas($sheet, [$columna], $colorAzul, 5); #--> Pintamos las celas
            centraContenido($sheet, [$columna], 5); #---> Centramos las celdas
            bordearContenido($sheet, [$columna], $border, 5);

            

            $columna++; ## RELLENAMOS LAS COLUMNAS


            ## UNIMOS Y RELLENAMOS LOS ENCABEZADOS DE LAS FECHAS
            $sheet->mergeCells("$celda1:$celda2");
            $fechaText = new DateTime($info['FECHA']);
            $fecha = $fechaText->format("d/m/Y");
            $sheet->setCellValue($celda1, $fecha);

          
        }

        $numero =  $numero + 1;
    }
}


##############################  OBTENCION DE DATOS ############################################

// Inicia el búfer de salida
ob_start();


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


//Realizamos el encabezado de las informacion de horas trabajadas
$sheet->mergeCells("F5:J5");
$sheet->setCellValue('F5', 'TOTAL PERIODO');
$sheet->getStyle('F5:J5')->applyFromArray($borderStyle);


$sheet->setCellValue('F6', 'Hrs. Trabajadas');
$sheet->getStyle('F6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('F')->setWidth(15);


$sheet->setCellValue('G6', 'Hrs. Esperadas');
$sheet->getStyle('G6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('G')->setWidth(15);


$sheet->setCellValue('H6', 'Asistencias');
$sheet->getStyle('H6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('H')->setWidth(15);


$sheet->setCellValue('I6', 'Retardos');
$sheet->getStyle('I6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('I')->setWidth(15);


$sheet->setCellValue('J6', 'Hrs. Extras');
$sheet->getStyle('J6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('J')->setWidth(15);

$celdasHoras = ['F', 'G', 'H', 'I', 'J'];
centraContenido($sheet, $celdasHoras, 6);
centraContenido($sheet, ['F'], 5);
pintarCeldas($sheet, $celdasHoras, "FFDB58", 5);
pintarCeldas($sheet, $celdasHoras, "FFDB58", 6);


$colorAzul = '62CBC9';


## EMPEZAMOS A RELLENAR EL EXCEL CON LA INFORMACION DE LOS BIMIERS
crearCuerpoFechas($sheet, $data, $borderStyle, $colorAzul);


## ESCRIBIMOS Y CREAMOS NUESTRA HOJA DE EXCEL
$writer = new Xlsx($workbook);
$writer->save('hello world.xlsx');
$writer->save('php://output');
$excelData = ob_get_clean();

// Devolver el archivo Excel como un blob al cliente
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="hello_world.xlsx"');
header('Cache-Control: max-age=0');

echo $excelData;
exit;
