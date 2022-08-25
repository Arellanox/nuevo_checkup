<?php
require_once "../conexion.php";
include "miscelaneus.php";

class Clientes extends Miscelaneus{
    public $id;
    public $nombre_comercial;
    public $razon_social;
    public $nombre_sistema;
    public $rfc;
    public $curp;
    public $abreviatura;
    public $limite_credito;
    public $temporalidad_credito;
    public $cuenta_contable;
    public $pagina_web;
    public $facebook;
    public $twitter;
    public $instagram;
    public $activo;
    public $tabla;
    public $mis;

    function Clientes(){
        $this->tabla = "clientes";
        $this->mis = new Miscelaneus();
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setNombreComercial($nombre){
        $this->nombre_comercial = $nombre;
    }

    function getNombreComercial(){
        return $this->nombre_comercial;
    }

    function setRazonSocial($razon){
        $this->razon_social = $razon;
    }
    
    function getRazonSocial(){
        return $this->razon_social;
    }

    function setNombreSistema($nombre){
        $this->nombre_sistema = $nombre;
    }
    
    function getNombreSistema(){
        return $this->nombre_sistema;
    }

    function setRfc($rfc){
        $this->rfc = $rfc;
    }

    function getRfc(){
        return $this->rfc;
    }

    function setCurp($curp){
        $this->curp = $curp;
    }

    function getCurp(){
        return $this->curp;
    }

    function setAbreviatura($ab){
        $this->abreviatura = $ab;
    }

    function getAbreviatura(){
        return $this->abreviatura;
    }

    function setLimiteCredito($limite){
        $this->limite_credito = $limite;
    }

    function getLimiteCredito(){
        return $this->limite_credito;
    }

    function setTemporalidadCredito($temp){
        $this->temporalidad_credito = $temp;
    }

    function getTemporalidadCredito(){
        return $this->temporalidad_credito;
    }

    function setCuentaContable($cuenta){
        $this->cuenta_contable = $cuenta;
    }

    function getCuentaContable(){
        return $this->cuenta_contable;
    }

    function setPaginaWeb($pagina){
        $this->pagina_web = $pagina;
    }

    function getPaginaWeb(){
        return $this->pagina_web;
    }

    function setFacebook($fb){
        $this->facebook = $fb;
    }

    function getFacebook(){
        return $this->facebook;
    }

    function setTwitter($twitter){
        $this->twitter = $twitter;
    }

    function getTwitter(){
        return $this->twitter;
    }

    function setInstagram($insta){
        $this->instagram = $insta;
    }

    function getInstagram(){
        return $this->instagram;
    }

    function setActivo($activo){
        $this->activo = $activo;
    }

    function getActivo(){
        return $this->activo;
    }

    function setter($id,$nombre_comercial,$razon,$nombre_sistema,$rfc,$curp,$abreviatura,$limite,$temporalidad,$cuenta,
                    $pagina,$facebook,$twitter,$instagram){
        $this->setId($id);
        $this->setNombreComercial($nombre_comercial);
        $this->setRazonSocial($razon_social);
        $this->setNombreSistema($nombre_sistema);
        $this->setRfc($rfc);
        $this->setCurp($curp);
        $this->setAbreviatura($abreviatura);
        $this->setLimiteCredito($limite);
        $this->setTemporalidadCredito($temporalidad);
        $this->setCuentaContable($cuenta);
        $this->setPaginaWeb($pagina);
        $this->setFacebook($facebook);
        $this->setTwitter($twitter);
        $this->setInstagram($instagram);
    }

    function validarTipoDato($datos){
        $intergers = array(6,7,8);
        $strings = array(0,1,2,3,4,5,9,10,11,12);
        $errors = array();

        $count = 0;
        foreach($datos as $dato){
            if(in_array($count,$intergers)){
                if(!is_numeric($dato)){
                    $errors[] = $count;
                }
            }

            if(in_array($count,$strings)){
                if(!is_string($dato)){
                    $errors[] = $count;
                }
            }
            $count = $count + 1;
        }

        return $errors;
    }


    function insert($nombre_comercial_input,$razon_social_input,$nombre_sistema_input,
                    $rfc_input,$curp_input,$abreviatura_input,$limite_input,$temporalidad_input,$cuenta_input,$pagina_input,
                    $facebook_input,$twitter_input,$instagram_input){
        global $conexion;
        //blindar la consulta contra SQL INJECTION
        $stmt = $conexion->prepare("INSERT INTO $this->tabla (nombre_comercial,razon_social,nombre_sistema,rfc,curp,abreviatura,
                                limite_credito,temporalidad_de_credito,cuenta_contable,pagina_web,facebook,twitter,
                                instagram) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssssiiissss", $nombre_comercial, $razon_social, $nombre_sistema, $rfc, 
        $curp, $abreviatura,$limite,$temporalidad,$cuenta,$pagina,$facebook,$twitter,$instagram);

        $datos_array = array();
        $datos_array[0] = $nombre_comercial_input;
        $datos_array[1] = $razon_social_input;
        $datos_array[2] = $nombre_sistema_input;
        $datos_array[3] = $rfc_input;
        $datos_array[4] = $curp_input;
        $datos_array[5] = $abreviatura_input;
        $datos_array[6] = $limite_input;
        $datos_array[7] = $temporalidad_input;
        $datos_array[8] = $cuenta_input;
        $datos_array[9] = $pagina_input;
        $datos_array[10] = $facebook_input;
        $datos_array[11] = $twitter_input;
        $datos_array[12] = $instagram_input;

        $datos_escapados = $this->mis->escaparDatos($datos_array);
        $error_tipo_dato = $this->validarTipoDato($datos_escapados);

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        //reemplazamos los datos de la consulta con los ya escapados
        $nombre_comercial =             $datos_escapados[0];
        $razon_social =                 $datos_escapados[1];
        $nombre_sistema =               $datos_escapados[2];
        $rfc =                          $datos_escapados[3];
        $curp =                         $datos_escapados[4];
        $abreviatura =                  $datos_escapados[5];
        $limite =                       $datos_escapados[6];
        $temporalidad =                 $datos_escapados[7];
        $cuenta =                       $datos_escapados[8];
        $pagina =                       $datos_escapados[9];
        $facebook =                     $datos_escapados[10];
        $twitter =                      $datos_escapados[11];
        $instagram =                    $datos_escapados[12];

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }    
        $afectados = $stmt->affected_rows;
      
        $stmt->close();
        $last_id = $conexion->insert_id;    
        $this->setter($last_id,$datos_escapados[0],$datos_escapados[1],$datos_escapados[2],$datos_escapados[3],
                        $datos_escapados[4],$datos_escapados[5],$datos_escapados[6],$datos_escapados[7],
                        $datos_escapados[8],$datos_escapados[9],$datos_escapados[10],$datos_escapados[11],$datos_escapados[12]);
        return $afectados;
    }

    function getAll(){
        global $conexion;
        $stmt = $conexion->prepare("SELECT * FROM $this->tabla WHERE activo=?");
        $stmt->bind_param('i', $activo);

        $activo = 1;

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $result = $stmt->get_result();
        $resultset = array();
        
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $resultset[] = $row;
        }

        return $resultset;
    }

    function getById($id_input){
        global $conexion;

        $stmt = $conexion->prepare("SELECT * FROM $this->tabla WHERE activo=? and id_cliente=?");

        $stmt->bind_param("ii",$activo,$id);

        $activo = 1;
        $id = $id_input;

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
        return $row;

    }

    function update($id_input,$nombre_comercial_input,$razon_social_input,$nombre_sistema_input,
                    $rfc_input,$curp_input,$abreviatura_input,$limite_input,$temporalidad_input,$cuenta_input,$pagina_input,
                    $facebook_input,$twitter_input,$instagram_input){
        global $conexion;
        
        $stmt = $conexion->prepare("UPDATE $this->tabla SET nombre_comercial=?,razon_social=?,nombre_sistema=?,
                                    rfc=?,curp=?,abreviatura=?,limite_credito=?,temporalidad_de_credito=?,cuenta_contable=?
                                    pagina_web=?,facebook=?,twitter=?,instagram=? WHERE id_cliente = ?");
        $stmt->bind_param("ssssssiiissssi", $nombre_comercial, $razon_social, $nombre_sistema, $rfc, 
        $curp, $abreviatura,$limite,$temporalidad,$cuenta,$pagina,$facebook,$twitter,$instagram,$id);

        $datos_array = array();
        $datos_array[0] = $nombre_comercial_input;
        $datos_array[1] = $razon_social_input;
        $datos_array[2] = $nombre_sistema_input;
        $datos_array[3] = $rfc_input;
        $datos_array[4] = $curp_input;
        $datos_array[5] = $abreviatura_input;
        $datos_array[6]= $limite_input;
        $datos_array[7]= $temporalidad_input;
        $datos_array[8]= $cuenta_input;
        $datos_array[9]= $pagina_input;
        $datos_array[10]= $facebook_input;
        $datos_array[11]= $twitter_input;
        $datos_array[12]= $instagram_input;
        $datos_array[13]= $id_input;

        $datos_escapados = $this->mis->escaparDatos($datos_array);
        $error_tipo_dato = $this->validarTipoDato($datos_escapados);

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        
        $nombre_comercial =             $datos_escapados[0];
        $razon_social =                 $datos_escapados[1];
        $nombre_sistema =               $datos_escapados[2];
        $rfc =                          $datos_escapados[3];
        $curp =                         $datos_escapados[4];
        $abreviatura =                  $datos_escapados[5];
        $limite =                       $datos_escapados[6];
        $temporalidad =                 $datos_escapados[7];
        $cuenta =                       $datos_escapados[8];
        $pagina =                       $datos_escapados[9];
        $facebook =                     $datos_escapados[10];
        $twitter =                      $datos_escapados[11];
        $instagram =                    $datos_escapados[12];
        $id =                           $datos_escapados[13];

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }    
        
        $afectados = $stmt->affected_rows;
        
        $stmt->close();    
        $this->setter($datos_escapados[13],$datos_escapados[0],$datos_escapados[1],$datos_escapados[2],$datos_escapados[3],
                        $datos_escapados[4],$datos_escapados[5],$datos_escapados[6],$datos_escapados[7],
                        $datos_escapados[8],$datos_escapados[9],$datos_escapados[10],$datos_escapados[11],$datos_escapados[12]);
        return $afectados;
    }

    function delete($id_input){
        global $conexion;

        $stmt = $conexion->prepare("UPDATE $this->tabla SET activo=? WHERE id_cliente=?");
        $stmt->bind_param("ii",$activo,$id);

        $datos = array();
        $datos[0] = 0;
        $datos[1] = $id_input;

        $datos_escapados = $this->mis->escaparDatos($datos);

        $intergers = array(0,1);
        $error_tipo_dato = $this->mis->validarTipoDato($datos_escapados,$intergers,array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }
        
        $activo = $datos_escapados[0];
        $id =     $datos_escapados[1];

        if(!$stmt->execute()){
            $error = "Ha ocurrdio un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $afectados = $stmt->affected_rows;
        $stmt->close();

        return $afectados;
    }
}
?>