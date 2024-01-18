<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once '../lib/excel/vendor/autoload.php';

# OBTENEMOS EL RANGO DE FECHA PARA HACER LA BUSQUEDA DE LOS DATOS
$fecha_inicial = isset($_POST['fecha_inicial']) ? $_POST['fecha_inicial'] : null;
$fecha_final = isset($_POST['fecha_final']) ?  $_POST['fecha_final'] : null;



#################################  IMPORTACIONES ############################################
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

#################################  FUNCIONES ################################################


## FUNCION PARA OBTENER LOS DATOS
function getData($fecha_inicial, $fecha_final)
{

    $url1 = "http://localhost/nuevo_checkup/api/checadorBimo_api.php";
    # DEFINIMOS LA DATA QUE VAMOS A MANDAR
    $datos = [
        "api" => 4,
        "fecha_inicial" => $fecha_inicial,
        "fecha_final" => $fecha_final,
    ];

    # CREAMOS LA PETICION HTTPS
    $opciones = array(
        "http" => array(
            "header" => "Content-type: application/x-www-form-urlencoded\r\n",
            "method" => "POST",
            "content" => http_build_query($datos), #AGREGAMOS EL CONTENIDO DEFINIDO ANTES
        ),
    );

    # PREPARACION DE LA PETICIONS
    $contexto = stream_context_create($opciones);
    #HACEMOS LA PETICION
    $json = file_get_contents($url1, false, $contexto);

    $res = json_decode($json, true);


    $array = $res['response']['data'];



    return $array;
}

##FUNCION PARA PINTAR CELDAS
function pintarCeldas($sheet, $rangoCeldas, $color, $numero)
{
    foreach ($rangoCeldas as $c) {

        #SACAMOS EL ESTILO A LAS CELDAS PARA PODER PINTAR
        $style = $sheet->getStyle($c . $numero);
        $style->getFill()
            ->setFillType(Fill::FILL_SOLID)
            ->getStartColor()
            ->setRGB($color);
    }
}

## FUNCION PARA CENTAR EL CONTENIDO DE LAS CELDAS
function centraContenido($sheet, $celdas, $numero)
{

    foreach ($celdas as $c) {

        #CENTRAMOS DE FORMA HORIZONTAL
        $style = $sheet->getStyle($c . $numero);
        $style->getAlignment()
            ->setHorizontal(Alignment::HORIZONTAL_CENTER);

        #CENTRAMOS DE FORMA VERTICAL
        $style1 = $sheet->getStyle($c . $numero);
        $style1->getAlignment()
            ->setVertical(Alignment::VERTICAL_CENTER);
    }
}

## FUNCION PARA BORDEAR UN RANGO DE CELDAS
function bordearContenido($sheet, $rangoCeldas, $border, $numero)
{

    foreach ($rangoCeldas as $celda) {

        #SACAMOS EL ESTILO DE LAS CELDAS
        $sheet->getStyle($celda . $numero)->applyFromArray($border);
    }
}



## FUNCION PARA CREAR Y RELLENAR LOS REGISTRO DE LAS FECHAS
function crearCuerpoFechas($sheet, $data, $border, $colorAzul)
{

    $numero = 7;

    foreach ($data['REGISTROS'] as $registro) {

        #AGREGAMOS LOS DATOS ESTATICOS DE LA INFORMACION DE BIMER
        $sheet->setCellValue('A' . $numero, $registro['COUNT']);
        $sheet->setCellValue('B' . $numero, $registro['NOMBRE']);
        $sheet->setCellValue('C' . $numero, $registro['AREA']);
        $sheet->setCellValue('D' . $numero, $registro['DIAS_LABORALES']);
        $sheet->setCellValue('E' . $numero, $registro['HORARIO_ENTRADA']);
        $sheet->setCellValue('F' . $numero, $registro['HORARIO_SALIDA']);
        $sheet->setCellValue('H' . $numero, $registro['HORAS_ESPERADAS']);
        $sheet->setCellValue('I' . $numero, $registro['TOTAL_ASISTENCIAS']);
        $sheet->setCellValue('J' . $numero, $registro['TOTAL_RETARDOS']);

        #LE DAMOS ESTILOS A NUESTROS ENCANBEZADOS
        bordearContenido($sheet, ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'], $border, $numero);
        centraContenido($sheet, ['A', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K'], $numero);

        $asistenciasArray = json_decode($registro['ASISTENCIAS'], true);

        $columna = 'L';
        foreach ($asistenciasArray as $asistencia) {

            // $info = json_decode($asistencia, true);
            $info = $asistencia;

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

##INICIAMOS EL BUFER DE  SALIDA
ob_start();


## OBTENEMOS TODA LA INFORMACION Y LA GUARDAMNOS EN VARIABLES
$data = getData($fecha_inicial, $fecha_final);



###################################  ESQUELETO  DEL EXCEL ######################################


#CREAMOS Y ENICIALIZAMOS  NUESTRA HOJA DE TRABAJO
$workbook = new Spreadsheet();
$sheet = $workbook->getActiveSheet();


## DEFINIMOS COLORES
$colorGris = "C0C0C0";
$colorAzul = 'FF4F80BD';
$colorBlanco = 'FFFFFF';


## DEFINIMOS LOS BORDES
$borderStyle = [
    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN,
        ],
    ],
];


$sheet->setTitle('Asistencias');

## REALIZAMOS LA PRIMERA PARTE DE LOS ENCABEZADOS
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

$sheet->mergeCells('D5:D6');
$sheet->setCellValue('D5', 'DÍAS LABORALES');
$sheet->getStyle('D5:D6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('D')->setWidth(45);


$sheet->mergeCells('E5:F5');
$sheet->setCellValue('E5', 'HORARIO');
$sheet->getStyle('E5:F5')->applyFromArray($borderStyle);

## CENTRAMOS LOS ENCABEZADOS
$celdasCentradas = ['A', 'B', 'C', 'D', 'E', 'F'];
centraContenido($sheet, $celdasCentradas, 5);

## PINTAMOS LOS ENCABEZADOS 
$celdasEncabezados = ['A', 'B', 'C', 'D', 'E', 'F'];
pintarCeldas($sheet, $celdasEncabezados, $colorGris, 5);


$sheet->setCellValue('E6', 'Entrada');
$sheet->setCellValue('F6', 'Salida');
$celdasCentradas2 = ['E', 'F'];
centraContenido($sheet, $celdasCentradas2, 6);
$sheet->getStyle('E6')->applyFromArray($borderStyle);
$sheet->getStyle('F6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('E')->setWidth(15);
$sheet->getColumnDimension('F')->setWidth(15);
$style = $sheet->getStyle('E6');
$style->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB($colorGris);
$style = $sheet->getStyle('F6');
$style->getFill()
    ->setFillType(Fill::FILL_SOLID)
    ->getStartColor()
    ->setARGB($colorGris);


## REALIZAMOS EL DISEÑO Y LOS ENCABEZADOS PARA LA INFORMACION DE LAS HORAS
$sheet->mergeCells("G5:K5");
$sheet->setCellValue('G5', 'TOTAL PERIODO');
$sheet->getStyle('G5:K5')->applyFromArray($borderStyle);


$sheet->setCellValue('G6', 'Hrs. Trabajadas');
$sheet->getStyle('G6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('G')->setWidth(15);


$sheet->setCellValue('H6', 'Hrs. Esperadas');
$sheet->getStyle('H6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('H')->setWidth(15);


$sheet->setCellValue('I6', 'Asistencias');
$sheet->getStyle('I6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('I')->setWidth(15);


$sheet->setCellValue('J6', 'Retardos');
$sheet->getStyle('J6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('J')->setWidth(15);


$sheet->setCellValue('K6', 'Hrs. Extras');
$sheet->getStyle('K6')->applyFromArray($borderStyle);
$sheet->getColumnDimension('K')->setWidth(15);

$celdasHoras = ['G', 'H', 'I', 'J', 'K'];
centraContenido($sheet, $celdasHoras, 6);
centraContenido($sheet, ['G'], 5);
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

## DEVOLVEMOS EL ARCHIVO DE EXCEL COMO BLOB AL CLIENTE
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="hello_world.xlsx"');
header('Cache-Control: max-age=0');

echo $excelData;
exit;
