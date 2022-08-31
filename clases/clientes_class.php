<?php
include_once "master_class.php";

class Clientes extends Master implements iMetodos{
    public $id_cliente;//13
    public $nombre_comercial;//0
    public $razon_social;//1
    public $nombre_sistema;//2
    public $rfc;//3
    public $curp;//4
    public $abreviatura;//5
    public $limite_credito;//6
    public $temporalidad_de_credito;//7
    public $cuenta_contable;//8
    public $pagina_web;//9
    public $facebook;//10
    public $twitter;//11
    public $instagram;//12
    public $activo;
    private $tabla;
    private $master;
    private $public_attributes;
    public $intergers;
    public $strings;
    public $doubles;
    private $nulls;
    public $intergers_update;

    function Clientes(){
        $this->public_attributes = 15;
        $this->tabla = "clientes";
        $this->master = new Master();
        $this->intergers = array(7,8);
        $this->strings = array(0,1,2,3,4,5,9,10,11,12);
        $this->doubles = array(6);
        $this->intergers_update = array(7,8,13);
        $this->nulls = array(2,3,4,5,9,10,11,12);
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
        $return = $this->master->insert($this->tabla,$this->getAttributtes(),$values,$this->intergers,$this->strings,$this->doubles,$this->nulls);
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