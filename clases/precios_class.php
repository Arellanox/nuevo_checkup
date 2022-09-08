<?php
include_once "master_class.php";

class Precios extends Master implements iMetodos{
    public $id_precio;#5
    public $cliente_id;#0
    public $servicio_id;#1
    public $costo;#2
    public $utilidad;#3
    public $precio;#4
    public $activo;
    public $master;
    private $tabla;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $nulls;
    private $public_attributes;

    function Precios(){
        $this->master = new Master();
        $this->tabla = "precios";
        $this->intergers = array(0,1);
        $this->strings = array();
        $this->doubles = array(2,3,4);
        $this->intergers_update = array(0,1,5);
        $this->nulls = array();
        $this->public_attributes = 7;
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