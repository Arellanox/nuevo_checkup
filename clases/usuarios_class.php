<?php
include "../conexion.php";
include "master_class.php";

class Usuarios extends Master{
    public $id;
    public $cargo_id;
    public $tipo_id;
    public $nombre;
    public $paterno;
    public $materno;
    public $usuario;
    public $contrasenia;
    public $profesion;
    public $activo;
    private $tabla;
    private $public_attributes;
    private $master; 

    function Usuarios(){
        $this->id = 1;
        $this->tabla = "usuarios";
        $this->public_attributes = 10;
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
        $this->master->insert($this->tabla,$this->getAttributes(),$values);
    }
}
?>