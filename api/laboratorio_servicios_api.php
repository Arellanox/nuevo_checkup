<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$master = new Master();
$api = $_POST['api'];

$Grupo = $_POST['grupoExamen'];
$contenedores = $_POST['contenedores'];
$Equipo = $_POST['Equipo'];
$Método = $_POST['Método'];
$id_servicio = $_POST['id_servicio'];
$descripcion = $_POST['descripcion']; 
$abreviatura = $_POST['abreviatura'];
$clasificacion_id = $_POST['clasificacion_id'];
$medida_id = $_POST['medida_id'];
$dias_entrega = $_POST['dias_entrega'];
$codigo_sat_id = $_POST['codigo_sat_id'];
$indicaciones = $_POST['indicaciones'];
$es_para = $_POST['es_para'];
$muestra_valores = $_POST['muestra_valor'];
$local = $_POST['local'];
$maquila_lab_id = $_POST['maquila_lab_id'];
$grupo = $_POST['grupoExamen']; # array
$metodo = $_POST['Método']; # array
$contenedores = $_POST['contenedores']; # array
$equipo = $_POST['Equipo']; # array
$valor_minimo = $_POST['valor_minimo'];
$valor_maximo = $_POST['valor_maximo'];
$sexo = $_POST['sexo_enum'];
$edad_inicial = $_POST['edad_inicial'];
$edad_final = $_POST['edad_final'];
$es_grupo = $_POST['grupos'];
$es_producto = $_POST['producto'];
$area_id = $_POST['area'];
$seleccionable = $_POST['selecionable'];
$es_para = $_POST['para'];
$costos = $_POST['costos'];


switch ($api) {
    case 1:
        $response = $master->insertByProcedure("sp_laboratorio_servicios_g",[
            $id_servicio,
            $descripcion,
            $abreviatura,
            $clasificacion_id,
            $medida_id,
            $dias_entrega,
            $codigo_sat_id,
            $indicaciones,
            $muestra_valores,
            $local,
            $maquila_lab_id,
            json_encode($master->getFormValues($grupo)),
            json_encode($master->getFormValues($metodo)),
            json_encode($master->getFormValues($contenedores)),
            json_encode($master->getFormValues($equipo)),
            $valor_minimo,
            $valor_maximo,
            $sexo,
            $edad_inicial,
            $edad_final,
            $es_grupo,
            $es_producto,
            $area_id,
            $seleccionable,
            $es_para,
            $costos,
            $_SESSION['id']
        ]);
        break;
    case 2:
        # buscar servicio
        
    default:
        $response = "Api no definida.";
        break;
}

echo $master->returnApi($response);
?>