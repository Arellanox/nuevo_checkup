<?php
include "master_class.php";

class Pacientes extends Master implements iPacientes{
    public $id_paciente;//22
    public $segmento_id; //0
    public $nombre;//1
    public $paterno;//2
    public $materno;//3
    public $edad;//4
    public $nacimiento;//5
    public $curp;//6
    public $celular;//7
    public $correo;//8
    public $calle;//9
    public $exterior;//10
    public $interior;//11
    public $colonia;//12
    public $postal;//13
    public $rfc;//14
    public $nacionalidad;//15
    public $pasaporte;//16
    public $genero;//17
    public $vacuna;//18
    public $otravacuna;//19
    public $dosis;//20
    public $foto;//21
    public $activo;
    private $tabla;
    private $master;
    private $public_attributes;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $strings_update;
    private $doubles_update;
    private $nulls;

    function Pacientes(){
        $this->public_attributes = 24;
        $this->master = new Master();
        $this->tabla = "pacientes";
        //guarda la POSICIONES en el arreglo de clase de los attributos que sean enteros;
        //para insertar ignora el id, es decir, la posicion [0] es segmento_id
        $this->intergers = array(0,4,7,10,11,13,17,22); 
        $this->strings = array(1,2,3,5,6,8,9,12,14,15,16,18,19,20,21);
        $this->double = array();
        $this->intergers_update = array(0,4,7,10,11,13,17,22);
        $this->nulls = array(0,11,14,21);
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
        $return = $this->master->insert($this->tabla,$this->getAttributes(),$values,$this->intergers,$this->strings,$this->doubles,$this->nulls);
        return $return;
    }

    function getAll(){
        $return = $this->master->getAll($this->tabla);
        return $return;
    }

    function getById($id){
        $return = $this->master->getById($this->tabla,$id,$this->getAttributes());
        return $return;
    }

    function update($values){
        $return = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,$this->strings,$this->doubles,$this->nulls);
        return $return;
    }

    function delete($id){
        $return = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $return;
    }
}
?>