<?php
include "../conexion.php";
include "master_class.php";

class Cargos extends Master {
    public $id_cargo;
    public $descripcion;
    public $activo;
    private $tabla;
    private $master;
    private $public_attributes;
    public $validator;
    public $intergers;
    public $strings;
    public $doubles;

    function Cargos(){
        $this->tabla = "cargos";
        $this->master = new Master();
        $this->public_attributes = 3;
        $this->validator = "s";
        $this->intergers = array();
        $this->strings = array(0);
        $this->doubles = array();
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
        print_r($values);
        $return = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->validator,$this->intergers,$this->strings,$this->doubles);
        return $return;
    }

    function getAll(){

    }
}
?>