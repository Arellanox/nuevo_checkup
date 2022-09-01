<?php
include_once "master_class.php";

class Dependencias extends Master implements iMetodos{
    public $id_dependencia;
    public $cliente_id;
    public $segmento_id;
    public $activo;
    private $tabla;
    private $public_attributes;
    private $master;
    private $intergers;
    private $intergers_update;

    function Dependencias(){
        $this->tabla = "dependencias_segmentos";
        $this->public_attributes = 4;
        $this->master = new Master();
        $this->intergers = array(0,1);
        $this->intergers_update = array(0,1,2);
    }

    function getAttributes(){
        $array = array();

        $count = 0;
        foreach($this as $key=>$value){
            if($count<$this->public_attributes){
                $array[] = $key;
            }
            $count = $count + 1;
        }

        return $array;
    }

    function insert($values){
        $return = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->intergers,array(),array(),array());
        return $return;
    }

    function getAll(){
        $response = $this->master->getAll($this->tabla);
        return $response;

    }

    function getById($id){
        $response = $this->master->getById($this->tabla,$id,$this->getAttributes());
        return $response;
    }

    function update($values){
        $response = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,array(),array(),array());
        return $response;
    }

    function delete($id){
        $response = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $response;
    }

    function getByCliente($cliente){
        $conn = $this->master->connectDb();
        $activo = 1;
        $sql = "SELECT * FROM $this->tabla WHERE activo = ? and cliente_id = ?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$activo);
        $stmt->bindParam(2,$cliente);

        $error_tipo_dato = $this->master->mis->validarDatos(array($cliente),array(0),array(),array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $resultset = $stmt->fetchAll();

        return $resultset;

    }
}
?>