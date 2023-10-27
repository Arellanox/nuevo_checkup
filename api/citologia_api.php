<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";


$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();

$turno_id = $_POST['turno_id'];

#OBTENEMOS LA API POR MEDIO DEL POST
$api = $_POST['api'];
$id_turno = $_POST['id_turno'];
$sexo = $_POST['sexo'];
$inicio_vida_sexual  = $_POST['inicio_vida_sexual'];
$tratamiento_hormonal = $_POST['tratamiento_hormonal'];
$dato_relevante = $_POST['dato_relevante'];
$vasectomia = $_POST['vasectomia'];
$lesiones_visibles = $_POST['lesiones_visibles'];
$espezifique_zona = $_POST['espezifique_zona'];
$primera_mestruacion = $_POST['primera_mestruacion'];
$ultima_mestruacion = $_POST['ultima_mestruacion'];
$n_embarazos = $_POST['n_embarazos'];
$n_partos = $_POST['n_partos'];
$n_abortos = $_POST['n_abortos'];
$n_cesarias = $_POST['n_cesarias'];
$salpingoclasia = $_POST['salpingoclasia'];
$coloco_diu = $_POST['coloco_diu'];
$usuario = $_SESSION['id'];


$host = $_SERVER['SERVER_NAME'] == "localhost" ? "http://localhost/nuevo_checkup/" : "https://bimo-lab.com/nuevo_checkup/";


$parametros = $master->setToNull(array(

    $sexo,
    $id_turno,
    $inicio_vida_sexual,
    $tratamiento_hormonal,
    $dato_relevante,
    $vasectomia,
    $lesiones_visibles,
    $espezifique_zona,
    $primera_mestruacion,
    $ultima_mestruacion,
    $n_embarazos,
    $n_partos,
    $n_abortos,
    $n_cesarias,
    $salpingoclasia,
    $coloco_diu

));


switch ($api) {

    case 1:

        $response = $master->insertByProcedure('sp_citologia_formularios_g', $parametros);

        break;
    case 2:

        $response = $master->getByProcedure('sp_citologia_formularios_b', [$turno_id]);

        break;


    case 9:
        # Recuperación del reporte anterior
        $response = $master->getByProcedure('sp_citologia_reporte_varios', [null, $turno_id, null, null, 2 /* Va recuperar */]);
        break;

    case 10:
        #Carga de reporte individual o reporte generado en el sistema anterior

        // Trabajar el pdf
        $dir = '../reportes/modulo/citologia/reportes_varios/';
        $r = $master->createDir($dir);
        $url_pdf = $master->guardarFiles($_FILES, 'reporte-citologia', $dir, "CITOLOGIA_RESULTADO_$turno_id");

        $ruta_reporte_cito = str_replace("../", $host, $url_pdf[0]['url']);


        $response = $master->insertByProcedure(
            'sp_citologia_reporte_varios',
            [
                null, // para actualizar, pero por ahora no
                $turno_id, // Paciente
                $ruta_reporte_cito, // Pdf de resultado
                $usuario,
                1 // Insertar
            ]
        );
        break;
    default:
        $response = "Api no definida";
};


echo $master->returnApi($response);
