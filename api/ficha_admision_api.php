<?php
require_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    // $tokenVerification->logout();
    // exit;
}

$master = new Master();
$api = $_POST['api'];

$turno_id = $_POST['turno_id'];
$religion = $_POST['religion'];
$lugar_nacimiento = $_POST['lugar_nacimiento'];
$estado_civil = $_POST['estado_civil'];
$telefono_paciente = $_POST['telefono_paciente'];
$puesto_solicita = $_POST['puesto_solicita'];
$depto = $_POST['depto'];
$no_imss = $_POST['no_imss'];
$profesion = $_POST['profesion'];
$escolaridad = $_POST['escolaridad'];
$umf = $_POST['umf'];
#contacto de emergencia
$nombre_contacto = $_POST['nombre_contacto'];
$parentesco = $_POST['parentesco'];
$tel1 = $_POST['tel1'];
$tel2 = $_POST['tel2'];

#busqueda
$fecha_admision = $_POST['fecha_admision'];

#historia familiar
$vive = $_POST['vive'];
$enfermedad = $_POST['enfermedad'];

switch($api){
    case 1:
        # agregar/editar ficha de admision
        $response = $master->insertByProcedure("sp_sigma_ficha_admision_g", [
            $turno_id,
            $religion,
            $lugar_nacimiento,
            $estado_civil,
            $telefono_paciente,
            $puesto_solicita,
            $depto,
            $no_imss,
            $profesion,
            $escolaridad,
            $umf,
            $nombre_contacto,
            $parentesco,
            $tel1,
            $tel2
        ]);
        break;
    case 2:
        #buscar fichas
        $response = $master->getByProcedure('sp_sigma_ficha_admision_b', [$turno_id, $fecha_admision, $umf]);
        break;
    case 3:
        # eliminar ficha de admision
        $response = $master->deleteByProcedure('sp_sigma_ficha_admision_e', [$turno_id]);
        break;
    case 4:
        # guardar historia familiar
        $historia_object = new HistoriaFamiliar();
        $data = $historia_object->crearJsonHistoFam($vive, $enfermedad);
        $response = $master->insertByProcedure('sp_sigma_historia_familiar_g', [$turno_id, $data]);
        // print_r($historia_object->crearJsonHistoFam($vive, $enfermedad));
        break;
    case 5:
        $response = $master->getByProcedure('sp_sigma_histofam_b', [$turno_id]);
        $object = new HistoriaFamiliar();
        $response = $object->crearJsonParaFormulario($response);
        break;
    default:
        $response = "api no definida.";
        break;
}

echo $master->returnApi($response);



class HistoriaFamiliar {
    public $posFamiliares = [
        'hermanos' => 1,
        'abuelo_paterno' => 2,
        'abuela_paterna' => 3,
        'abuelo_materno' => 4,
        'abuela_materna' => 5,
        'hijos' => 6
    ];
    public  $posEnfermedades = [
        'diabetes' => 2,
        'hipertension' => 3,
        'corazon' => 4,
        'pulmones' => 5,
        'cancer' => 6,
        'embolia' => 7,
        'mentales' => 8
    ];
    function crearJsonHistoFam($vive, $enfermedad){
    
        $rs = [];
    
        # pregunta viven
        foreach($vive as $familiar =>$respuesta){
            # 1 ES EL ID de la pregunta, viven
            $rs[] = ['PREGUNTA' => 1, 'FAMILIAR' => $this->posFamiliares[$familiar], 'RESPUESTA' => $respuesta ]; 
        }
    
        #enfermedades
        foreach($enfermedad as $familiar => $enfermedades){
            foreach($enfermedades as $item){
                $rs[] = ['PREGUNTA' => $this->posEnfermedades[$item], 'FAMILIAR' => $this->posFamiliares[$familiar], 'RESPUESTA' => 1];
            }
        }
    
        return json_encode($rs);
    
    }

    function crearJsonParaFormulario($data) {
        $familiares = array_flip($this->posFamiliares);
        $enfermedades = array_flip($this->posEnfermedades);
        $result = [];
        
        foreach ($data as $item) {
            // Crear un array para el familiar si no existe
            $familiar =$familiares[$item['ID_FAMILIAR']];
            if (!isset($result[$familiar])) {
                $result[$familiar] = [
                    'familiar' => $familiar,
                    'vive' => null,
                    'enfermedades' => []
                ];
            }
            
            // Revisar la pregunta y clasificarla
            if ($item['PREGUNTA'] === 'VIVE') {
                $result[$familiar]['vive'] = $item['RESPUESTA'];
            } else {
                if ($item['RESPUESTA'] == 1) {
                    $result[$familiar]['enfermedades'][] = $enfermedades[$item['ID_PREGUNTA']];
                }
            }
        }
        
        // Convertir a formato de array de JSON y devolver
        return array_values($result);
    }
}
