<?php
include_once "master_class.php";

class Cargos extends Master implements iMetodos{
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
    public $validator_update;
    public $interges_update;
    public $strings_update;
    public $doubles_update;

    function Cargos(){
        $this->tabla = "cargos";
        $this->master = new Master();
        $this->public_attributes = 3;
        $this->intergers = array();
        $this->strings = array(0);
        $this->doubles = array();
        $this->intergers_update = array(1);
        $this->strings_update = array(0);
        $this->doubles_update = array();
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

    //esta funcion recibe un arreglo de datos
    function insert($values){
        $return = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->intergers,$this->strings,$this->doubles);
        return $return;
    }


    function getAll(){
        $return = $this->master->getAll($this->tabla);
        return $return;
    }

    // esta funcion recibe solo el id del cargo (int)
    function getById($id){
        $return = $this->master->getById($this->tabla,$id,$this->getAttributes());
        return $return;
    }

    //recibe un array de datos con el id al final
    function update($values){
        $return = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,$this->strings_update,$this->doubles_update);
        return $return;
    }

    //recibe unicamente el id del registro que se va a eliminar
    function delete($id){
        $return = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $return;
    }
}
?>