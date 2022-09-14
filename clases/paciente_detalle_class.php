<?php
include_once "master_class.php";

class PacienteDetalle extends Master implements iMetodos{
    public $id_paciente_detalle;#6
    public $id_paciente;#0
    public $id_servicio;#1
    public $id_turno;#2
    public $fecha_ingreso;#3
    public $checked;#4
    public $subtotal;#5
    public $activo;
    public $master;
    private $tabla;
    private $public_attributtes;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $nulls;

    function PacienteDetalle(){
        $this->master = new Master();
        $this->tabla = "paciente_detalle";
        $this->public_attributes = 8;
        $this->intergers = array(0,1,2,4);
        $this->strings = array(3);
        $this->doubles = array(5);
        $this->intergers_update = array(0,1,2,4,6);
        $this->nulls = array();
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