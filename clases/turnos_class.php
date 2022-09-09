<?php
include_once "master_class.php";

class Turnos extends Master implements iMetodos{
    public $id_turno;#8
    public $paciente_id;#0
    public $prefolio;#1
    public $fecha_recepcion;#2
    public $turno;#3
    public $habilitado;#4
    public $identificacion;#5
    public $fecha_registro;#6
    public $total;#7
    public $activo;
    public $master;
    private $tabla;
    private $public_attributes;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $nulls;

    function Turnos(){
        $this->master = new Master();
        $this->tabla = "turnos";
        $this->public_attributes = 10;
        $this->intergers = array(0,4);
        $this->strings = array(1,2,3,5,6);
        $this->doubles = array(7);
        $this->nulls = array(3,5);
        $this->intergers_update = array(0,4,8);
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