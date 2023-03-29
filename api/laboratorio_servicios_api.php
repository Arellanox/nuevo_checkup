<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
// if (!$tokenValido) {
//     $tokenVerification->logout();
//     exit;
// }

$master = new Master();
$api = $_POST['api']; 

/*$parametros = Array
(
    [descripcion] => servicio_nombre
    [abreviatura] => SN
    [clasificacion_id] => 14
    [medida_id] => 17
    [dias_entrega] => INMEDIATA
    [codigo_sat_id] => 14
    [indicaciones] => Ayuno 12 horas
    [es_para] => 1
    [muestra_valores] => 1
    [local] => 1
    [maquila_lab_id] => 1
    [Grupo] => Array
        (
            [0] => 15
            [978719] => 343
        )

    [Método] => Array
        (
            [0] => 18
            [%0D%0A196326] => 14
        )

    [contenedores] => Array
        (
            [2] => Array
                (
                    [contenedor] => 5
                    [muestra] => 6
                )

            [1] => Array
                (
                    [contenedor] => 5
                    [muestra] => 6
                )

        )

    [Equipo] => Array
        (
            [0] => 4
        )

    [valor_minimo] => <1
    [valor_maximo] => 2>
    [sexo_enum] => 1
    [edad_inicial] => 1
    [edad_final] => 30
    [grupos] => 0
    [producto] => 1
    [area] => 6
    [seleccionable] => 1
    [para] => 3
    [costos] => 1
    [api] => 0
        );*/
$Grupo = $_POST['Grupo'];    

switch($api){
    case 1:
        echo json_encode($Grupo);
    break;
}
