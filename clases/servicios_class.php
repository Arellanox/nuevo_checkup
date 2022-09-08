<?php
include_once "master_class.php";

class Servicios extends Master implements iMetodos{
    public $id_servicio;#7
    public $padre;#0
    public $area_id;#1
    public $descripcion;#2
    public $es_perfil;#3
    public $es_producto;#4
    public $seleccionable;#5
    public $es_para;#6
    public $activo;
    public $master;
    private $tabla;
    private $public_attributes;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $nulls;

    function Servicios(){
        $this->master = new Master();
        $this->tabla = "servicios";
        $this->public_attributes = 9;
        $this->intergers = array(0,1,3,4,5,6);
        $this->strings = array(2);
        $this->doubles = array();
        $this->intergers_update = array(0,1,2,3,4,5,6,7);
        $this->nulls = array(0);
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