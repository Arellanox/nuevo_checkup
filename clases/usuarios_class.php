<?php
include_once "master_class.php";

class Usuarios extends Master implements iMetodos{
    public $id_usuario;#8
    public $cargo_id;#0
    public $tipo_id;#1
    public $nombre;#2
    public $paterno;#3
    public $materno;#4
    public $usuario;#5
    public $contrasenia;#6
    public $profesion;#7
    public $activo;
    private $tabla;
    private $public_attributes;
    public $master; 
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $nulls;

    function Usuarios(){
        $this->tabla = "usuarios";
        $this->public_attributes = 10;
        $this->master = new Master();
        $this->intergers = array(0,1);
        $this->strings = array(2,3,4,5,6,7);
        $this->doubles = array();
        $this->intergers_update(0,1,8);
        $this->nulls = array(7);

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
        $response = $this->master->getById($this-tabla,$id,$this->getAttributes());
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