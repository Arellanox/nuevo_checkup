<?php
include_once "master_class.php";

class TiposUsuarios extends Master implements iMetodos{
    public $id_tipo; # 1
    public $descripcion; # 0
    public $activo;
    private $public_attributes;
    private $master;
    private $tabla;
    public $intergers;
    public $intergers_update;
    public $doubles;
    public $strings;
    public $nulls;

    function TiposUsuarios(){
        $this->tabla = "tipos_usuarios";
        $this->public_attributes = 3;
        $this->intergers = array();
        $this->intergers_update = array(1);
        $this->strings = array(0);
        $this->doubles = array();
        $this->nulls = array();
        $this->master = new Master();
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