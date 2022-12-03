<?php
include_once "master_class.php";

class Contactos extends Master implements iMetodos{
    public $id_contacto;#6
    public $id_cliente;//0
    public $nombre;//1
    public $apellidos;//2
    public $telefono1;#3
    public $telefono2;#4
    public $email;#5
    public $activo;
    private $tabla;
    private $public_attributes;
    private $master;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $nulls;

    function Contactos(){
        $this->tabla = "contactos";
        $this->public_attributes = 8;
        $this->master = new Master();
        $this->intergers = array(0,3,4);
        $this->strings = array(1,2,5);
        $this->doubles = array();
        $this->intergers_update = array(0,3,4,6);
        $this->nulls = array(4);
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
        $return  = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->intergers,$this->strings,$this->doubles,$this->nulls);
        return $return;
    }

    function getAll(){
        $return = $this->master->getAll($this->tabla);
        return $return;
    }

    function getById($id){
        $return = $this->master->getById($this->tabla,$id,$this->getAttributes());
        return $return;
    }

    function update($values){
        $return = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,$this->strings,$this->doubles,$this->nulls);
        return $return;
    }

    function delete($id){
        $return = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $return;
    }

    function getByCliente($cliente){
        $conn = $this->master->connectDb();
        $activo = 1;

        $stmt = $conn->prepare("SELECT * FROM $this->tabla WHERE activo=? and id_cliente=?");
        $stmt->bindParam(1,$activo);
        $stmt->bindParam(2,$cliente);

        $error_tipo_dato = $this->master->mis->validarDatos(array($cliente),array(),array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }
        // echo $sql;
        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->error."). ".$stmt->error;
            return $error;
        }

        $resultset = $stmt->fetchAll();
    
        return $resultset;
    }

}
?>