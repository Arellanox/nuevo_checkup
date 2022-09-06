<?php
include_once "master_class.php";

class UsuariosAreas extends Master implements iMetodos{
    public $id_usuario_area;#2
    public $usuario_id;#0
    public $area_id;#1
    public $activo;
    public $master;
    private $tabla;
    private $public_attributes;
    private $intergers;
    private $strigs;
    private $doubles;
    private $intergers_update;
    private $nulls;

    function UsuariosAreas(){
        $this->master = new Master();
        $this->tabla = "usuarios_areas";
        $this->public_attributes = 4;
        $this->intergers = array(0,1);
        $this->strings = array();
        $this->doubles = array();
        $this->intergers_update = array();
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