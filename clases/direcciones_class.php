<?php
include_once "master_class.php";

class Direcciones extends Master implements iMetodos{
   public $id_direccion;#10
    public $cliente_id;#0
    public $calle;#1
    public $num_exterior;#2
    public $num_interior;#3
    public $cp;#4
    public $colonia;#5
    public $ciudad;#6
    public $municipio;#7
    public $estado;#8
    public $pais;#9
    public $activo;
    private $tabla;
    private $master;
    private $public_attributes;
    public $intergers;
    public $strings;
    public $doubles;
    public $intergers_update;
    public $nulls;

    function Direcciones(){
        $this->public_attributes = 12;
        $this->master = new Master();
        $this->tabla = "direcciones";
        $this->intergers = array(0,2,3,4);
        $this->strings = array(1,5,6,7,8,9);
        $this->doubles = array();
        $this->intergers_update = array(0,2,3,4);
        $this->nulls = array(3);
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
        $return = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->intergers,$this->strings,$this->doubles,$this->nulls);
        return $return;
    }

    function getAll(){
        $response =  $this->master->getAll($this->tabla);
        return $response;
    }

    function getById($id){
        $response = $this->master->getById($this->tabla,$id,$this->getAttributes());
        return $response;
    }

    function update($values){
        $response = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,$this->strings,$this->doubles,$this->nulls);
        return $response;
    }

    function delete($id){
        $response = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $response;
    }

    function getByCliente($cliente){
        $conn = $this->master->connetDb();
        $activo = 1;
        $sql = "SELECT * FROM $this->tabla WHERE activo=? and cliente_id=?";

        $stmt= $conn->prepare($sql);

        $error_tipo_dato = $this->mis->validarDatos(array($cliente),array(0),array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $stmt->bindParam(1,$activo);
        $stmt->bindParam(2,$cliente);

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $resultset = $stmt->fetchAll();

        return $resultset;

    }
}
?>