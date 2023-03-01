<?php
include_once "../clases/master_class.php";
require_once "../clases/token_auth.php";
include_once "../clases/correo_class.php";

$tokenVerification = new TokenVerificacion();
$tokenValido = $tokenVerification->verificar();
if (!$tokenValido) {
    $tokenVerification->logout();
    exit;
}

$api = $_POST['api'];
$master = new Master();

$estado_paciente = $_POST['estado'];
$idTurno = $_POST['id_turno'];
$idPaquete = $_POST['id_paquete']; #
$comentarioRechazo = $_POST['comentario_rechazo'];
$identificacion = $_POST['identificacion']; #url
$area_id = $_POST['area_id'];

# reagendar
$fecha_reagenda = $_POST['fecha_reagenda'];


#servicio para pacientes particulares o servicios extras para pacientes de empresas
if (!is_null($_POST['servicios'])) {
    $servicios = explode(",", $_POST['servicios']); //array
}

#ordenes medicas
$orden_laboratorio = $_FILES['orden-medica-laboratorio'];
$orden_rayos_x = $_FILES['orden-medica-rx'];
$orden_ultrasonido = $_FILES['orden-medica-us'];

$ordenes = array(
    'ORDEN_LABORATORIO' => $orden_laboratorio,
    'ORDEN_RAYOS_X' => $orden_rayos_x,
    'ORDEN_ULTRASONIDO' => $orden_ultrasonido
);

$ordenes = $master->checkArray($ordenes,1);

# para envio de correo de empresaas
$cliente_id = $_POST['cliente_id'];
$fecha_ingreso = $_POST['fecha_ingreso'];

switch ($api) {
    case 1:
        # recuperar pacientes por estado
        # 1 para pacientes aceptados
        # 0 para pacientes rechazados
        # null o no enviar nada, para pacientes en espera
        $response = $master->getByProcedure('sp_buscar_paciente_por_estado', array($estado_paciente));

        break;
    case 2:
        # aceptar o rechazar pacientes [tambien regresar a la vida]
        # enviar 1 para aceptarlos, 0 para rechazarlos, null para pacientes en espera
        // $response = $master->updateByProcedure('sp_recepcion_cambiar_estado_paciente', array($idTurno, $estado_paciente, $comentarioRechazo));
        $response = $master->getByNext('sp_recepcion_cambiar_estado_paciente', array($idTurno, $estado_paciente, $comentarioRechazo));

        $etiqueta_turno = $response[1];

        # Insertar el detalle del paquete al turno en cuestion
        if ($estado_paciente == 1) {
            # si el paciente es aceptado, cargar los estudios correspondientes
            rename($identificacion, "../../archivos/identificaciones/" . $idTurno . ".png");
            $response = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', array($idTurno, $idPaquete, null));
            #aqui subir las ordenes medicas si las hay
            #crear la carpeta de tunos dentro de 

            if(count($ordenes)>0){ 
                $dir = $master->urlComodin.$master->urlOrdenesMedicas."$idTurno/";
                $r = $master->createDir($dir);
                if ($r==1) {
                    #movemos las ordenes medicas
                    $return = $master->guardarFiles($_FILES,'orden-medica-laboratorio',$dir,"ORDEN_MEDICA_LABORATORIO_$idTurno");
                    $return2 = $master->guardarFiles($_FILES,'orden-medica-rx',$dir,"ORDEN_MEDICA_RX_$idTurno");
                    $return3 = $master->guardarFiles($_FILES,'orden-medica-us',$dir,"ORDEN_MEDICA_ULTRASONIDO_$idTurno");
                    
                    $merge = array_merge($return,$return2,$return3);
                
                    #insertarmos las ordenes medicas en la base de datos
                    foreach ($merge as $item){
                        if(!empty($item['tipo'])){
                            $responseOrden = $master->insertByProcedure('sp_ordenes_medicas_g',[1,$idTurno,$item['url'],$item['tipo']]);
                        }
                    }
                }else {
                    $master->setLog("No se pudo crear el directorio para guardar las ordenes medicas","recepcion_api.php [case 2]");
                }
            }
        } else {
            # si el paciente es rechazado, se desactivan los resultados de su turno.
            $response = $master->updateByProcedure('sp_recepcion_desactivar_servicios', array($idTurno));
        }

        # Insertar servicios extrar para pacientes empresas o servicios para particulares
        if (is_array($servicios)) {
            if (count($servicios) > 0) {
                # si hay algo en el arreglo lo insertamos
                foreach ($servicios as $key => $value) {
                    // print_r($servicios);
                    $response2 = $master->insertByProcedure('sp_recepcion_detalle_paciente_g', array($idTurno, null, $value));
                }
            }
        }

        $response = array_merge((array) $response, (array) $etiqueta_turno);
        break;
    case 3:
        # reagendar una cita
        $response = $master->updateByProcedure('sp_recepcion_reagendar', array($idTurno, $fecha_reagenda));
        break;
    case 4:
        # reenviar reportes e imagenes por correo de todas las areas.
        
        # recuperamos reportes e imagenes como arreglo unico.
        # decodificamos las imagenes para poderlas tratar como un array.
        $reportes = $master->cleanAttachFilesImage($master,$idTurno,null,1,1);

        # si existe algo, enviamos el correo.
        if(!empty($reportes[0])){
            $mail = new Correo();
            $r = $mail->sendEmail("resultados","[bimo] Resultados",[$reportes[1]],null,$reportes[0],1);
            if($r){
                $master->setLog("Correo global enviado.", "[recepcion api, case 4]");
                $response =1;
            } else {
                $master->setLog("Falla al enviar correo.","[recepcion api, case 4]");
            }
        } else {
            $response = "Paciente sin resultados o imágenes.";
        }

        break;
    case 5:
        # Enzipar por paciente reportes e imagenes por cliente y enviarlo por correo eletronico
        $zip = new ZipArchive;
        $mail = new Correo();
        #recuperamos el los reportes y las imagenes de los pacientes del cliente seleccionado.
        $reportes = $master->cleanAttachFilesImage($master,null,null,$cliente_id,0,$fecha_ingreso);

        if(!empty($reportes[0])){
            #si hay algo, continuamos con el proceso.
            
            #creamos la carpeta temporal
            if(!is_dir("../tmp")){
                if(!mkdir("../tmp")){
                    $master->setLog("No se pudo crear la carpeta temporal","recepcion api [case 5]");
                    $response = "No se pudo crear la carpeta temporal.";
                    break;
                }
            }

            # creamos el zip por cada paciente.
            for($i=0;$i<count($reportes[3]);$i++){
                $nombre_zip = $explode = explode(".",$reportes[3][$i]);

                #creamos el archivo zip dentro de la carpeta temporal
                $fh = fopen("../tmp/".$nombre_zip[0].".zip", 'a');
                // fwrite($fh, '<h1>Hello world!</h1>');
                fclose($fh);

                # Filtramos todos los archivos del paciente
                $str = "/".$reportes[2][$i]."/";
                $archivos_paciente = [];
                foreach($reportes[0] as $ruta_archivo){
                   
                    $pos = strpos($ruta_archivo,$str);
               
                    try{
                        if($pos!==false){
                            array_push($archivos_paciente,$ruta_archivo);
                        }
                    }catch (Exception $e){
                        print_r($e);
                    }
                   
                }

                # enzipamos los archivos correspondientes al zip actual.
                foreach($archivos_paciente as $a){
                    $ruta = explode("nuevo_checkup",$a);
                    $ruta = "..".$ruta[1];

                    // if ($zip->open("../tmp/".$nombre_zip[0].".zip") === TRUE) {
                    //     $zip->addFile($ruta, basename($ruta));
                    //     $zip->close();
                    // } else {
                    //     echo 'failed';
                    // }
                    if ($zip->open("../tmp/".$nombre_zip[0].".zip") === TRUE) {
                        $zip->addFile("../checkup.sql", basename($ruta));
                        $zip->close();
                    } else {
                        echo 'failed';
                    }
                }
                
            }    

            $archivos_enviar = [];

             
            if ($gestor = opendir('../tmp/')) {
                echo "Gestor de directorio: $gestor\n";
                echo "Entradas:\n";
            
                /* Esta es la forma correcta de iterar sobre el directorio. */
                $count = 0;
                while (false !== ($entrada = readdir($gestor))) {
                    if($count >1){
                        array_push($archivos_enviar,"nuevo_checkup/tmp/".$entrada);
                    }
                    $count++;
                }
            
                closedir($gestor);
            }
            print_r($archivos_enviar);
            
            $r = $mail->sendEmail("resultados","Envio de resultados [bimo]",["arellanox0392@gmail.com"],null,$archivos_enviar,1);

        } else {
            $response = "No hay archivos disponible para el cliente seleccionado.";
        }

        break;
    case 6 :
        # detalle del estudios cargados al paciente.
        $response = $master->getByProcedure("sp_paciente_servicios_cargados",[$idTurno,$area_id]);
        break;
    default:
        # code...
        break;
}

echo $master->returnApi($response);
