<?php
require_once "../conexion.php";
include "miscelaneus.php";

class Clientes extends Miscelaneus{
    public $id;
    public $segmento_id;
    public $nombre_comercial;
    public $razon_social;
    public $nombre_sistema;
    public $rfc;
    public $curp;
    public $direccion_fiscal;
    public $direccion_entrega_servicios;
    public $direccion;
    public $abreviatura;
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

    function setSegmentoId($segmento){
        $this->segmento_id = $segmento;
    }

    function getSegmentoId(){
        return $this->segmento_id;
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

    function setDireccionFiscal($direccion){
        $this->direccion_fiscal = $direccion;
    }

    function getDireccionFiscal(){
        return $this->direccion_fiscal;
    }

    function setDireccionEntregaServicios($direccion){
        $this->direccion_entrega_servicios = $direccion;
    }

    function getDireccionEntregaServicios(){
        return $this->direccion_entrega_servicios;
    }

    function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    function getDireccion(){
        return $this->direccion;
    }

    function setAbreviatura($ab){
        $this->abreviatura = $ab;
    }

    function getAbreviatura(){
        return $this->abreviatura;
    }

    function setActivo($activo){
        $this->activo = $activo;
    }

    function getActivo(){
        return $this->activo;
    }

    function setter($id,$segmento,$nombre_comercial,$razon,$nombre_sistema,$rfc,$curp,$direccion_fiscal,
    $direccion_entrega_servicios,$direccion,$abreviatura){
        $this->setId($id);
        $this->setSegmentoId($segmento);
        $this->setNombreComercial($nombre_comercial);
        $this->setRazonSocial($razon_social);
        $this->setNombreSistema($nombre_sistema);
        $this->setRfc($rfc);
        $this->setCurp($curp);
        $this->setDireccionFiscal($direccion_fiscal);
        $this->setDireccionEntregaServicios($direccion_entrega_servicios);
        $this-setDireccion($direccion);
        $this->setAbreviatura($abreviatura);
    }

    function validarTipoDato($datos){
        $intergers = array(0);
        $strings = array(1,2,3,4,5,6,7,8,9);
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


    function insert($segmento_input,$nombre_comercial_input,$razon_social_input,$nombre_sistema_input,
                    $rfc_input,$curp_input,$direccion_fiscal_input,$direccion_entrega_servicios_input,$direccion_input,
                    $abreviatura_input){
        global $conexion;
        //blindar la consulta contra SQL INJECTION
        $stmt = $conexion->prepare("INSERT INTO $this->tabla (segmento_id,nombre_comercial,razon_social,nombre_sistema,rfc,curp,direccion_fiscal,
                    direccion_entrega_servicios,direccion,abreviatura) VALUES (?,?,?,?,?,?,?,?,?,?)");
        $stmt->bind_param("isssssssss", $segmento, $nombre_comercial, $razon_social, $nombre_sistema, $rfc, 
        $curp, $direccion_fiscal, $direccion_entrega_servicios, $direccion, $abreviatura);

        $datos_array = array();
        $datos_array[0] = $segmento_input; //este dato es un entero por lo que no debe ir dentro del arreglo para escapar cadenas
        $datos_array[1] = $nombre_comercial_input;
        $datos_array[2] = $razon_social_input;
        $datos_array[3] = $nombre_sistema_input;
        $datos_array[4] = $rfc_input;
        $datos_array[5] = $curp_input;
        $datos_array[6] = $direccion_fiscal_input;
        $datos_array[7] = $direccion_entrega_servicios_input;
        $datos_array[8] = $direccion_input;
        $datos_array[9] = $abreviatura_input;

        $datos_escapados = $this->mis->escaparDatos($datos_array);
        $error_tipo_dato = $this->validarTipoDato($datos_escapados);

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        
        $segmento =                     $datos_escapados[0];
        $nombre_comercial =             $datos_escapados[1];
        $razon_social =                 $datos_escapados[2];
        $nombre_sistema =               $datos_escapados[3];
        $rfc =                          $datos_escapados[4];
        $curp =                         $datos_escapados[5];
        $direccion_fiscal =             $datos_escapados[6];
        $direccion_entrega_servicios =  $datos_escapados[7];
        $direccion =                    $datos_escapados[8];
        $abreviatura =                  $datos_escapados[9];

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }    
        $afectados = $stmt->affected_rows;
      
        $stmt->close();
        $last_id = $conexion->insert_id;    
        $this->setter($last_id,$datos_escapados[0],$datos_escapados[1],$datos_escapados[2],$datos_escapados[3],
                        $datos_escapados[4],$datos_escapados[5],$datos_escapados[6],$datos_escapados[7],
                        $datos_escapados[8],$datos_escapados[9]);
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

    function update($id_input,$segmento_input,$nombre_comercial_input,$razon_social_input,$nombre_sistema_input,
                    $rfc_input,$curp_input,$direccion_fiscal_input,$direccion_entrega_servicios_input,$direccion_input,
                    $abreviatura_input){
        
        global $conexion;
        
        $stmt = $conexion->prepare("UPDATE $this->tabla SET segmento_id=?,nombre_comercial=?,razon_social=?,nombre_sistema=?,
                                    rfc=?,curp=?,direccion_fiscal=?,direccion_entrega_servicios=?,direccion=?,
                                    abreviatura=? WHERE id_cliente = ?");
        $stmt->bind_param("isssssssssi", $segmento, $nombre_comercial, $razon_social, $nombre_sistema, $rfc, 
        $curp, $direccion_fiscal, $direccion_entrega_servicios, $direccion, $abreviatura,$id);

        $datos_array = array();
        $datos_array[0] = $segmento_input; //este dato es un entero por lo que no debe ir dentro del arreglo para escapar cadenas
        $datos_array[1] = $nombre_comercial_input;
        $datos_array[2] = $razon_social_input;
        $datos_array[3] = $nombre_sistema_input;
        $datos_array[4] = $rfc_input;
        $datos_array[5] = $curp_input;
        $datos_array[6] = $direccion_fiscal_input;
        $datos_array[7] = $direccion_entrega_servicios_input;
        $datos_array[8] = $direccion_input;
        $datos_array[9] = $abreviatura_input;
        $datos_array[10]= $id_input;

        $datos_escapados = $this->mis->escaparDatos($datos_array);
        $error_tipo_dato = $this->validarTipoDato($datos_escapados);

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        
        $segmento =                     $datos_escapados[0];
        $nombre_comercial =             $datos_escapados[1];
        $razon_social =                 $datos_escapados[2];
        $nombre_sistema =               $datos_escapados[3];
        $rfc =                          $datos_escapados[4];
        $curp =                         $datos_escapados[5];
        $direccion_fiscal =             $datos_escapados[6];
        $direccion_entrega_servicios =  $datos_escapados[7];
        $direccion =                    $datos_escapados[8];
        $abreviatura =                  $datos_escapados[9];
        $id =                           $datos_escapados[10];

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }    
        
        $afectados = $stmt->affected_rows;
        
        $stmt->close();    
        $this->setter($datos_escapados[10],$datos_escapados[0],$datos_escapados[1],$datos_escapados[2],$datos_escapados[3],
                        $datos_escapados[4],$datos_escapados[5],$datos_escapados[6],$datos_escapados[7],
                        $datos_escapados[8],$datos_escapados[9]);
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