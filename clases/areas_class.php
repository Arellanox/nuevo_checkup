<?php
include_once "master_class.php";

class Areas extends Master implements iMetodos{
    public $id_area;#4
    public $encargado_id;#0
    public $descripcion;#1
    public $esta_libre;#2
    public $prioridad;#3
    public $activo;
    public $master;
    private $tabla;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $public_attributes;
    private $nulls;

    function Areas(){
        $this->master = new Master();
        $this->tabla = "areas";
        $this->public_attributes = 6;
        $this->intergers = array(0,2,3);
        $this->strings = array(1);
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
        $response = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->intergers,$this->strings,$this->doubles,$this->nulls);
        return $response;
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
        $response = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,$this->strings,$this->doubles,$this->nulls);
        return $response;
    }

    function delete($id){
        $response = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $response;
    }
}

?>