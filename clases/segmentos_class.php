<?php
include_once "master_class.php";

class Segmentos extends Master implements iMetodos{
    public $id_segmento;
    public $padre;
    public $descripcion;
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
    private $nulls_update;
    public $segmento;
    public $globalCounter;

    function Segmentos(){
        $this->tabla = "segmentos";
        $this->master = new Master();
        $this->public_attributes = 4;
        $this->intergers = array(0);
        $this->strings = array(1);
        $this->doubles = array();
        $this->intergers_update = array(0,2);
        $this->strings_update = array(1);
        $this->doubles_update = array();
        $this->nulls = array(0);
        $this->nulls_update = array(0);
        $this->segmento = "";
        $this->globalCounter = 0;
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
        $return = $this->master->update($this->tabla,$this->getAttributes(),$values,$this->intergers_update,$this->strings_update,$this->doubles_update,$this->nulls_update);
        return $return;
    }

    function delete($id){
        $return = $this->master->delete($this->tabla,$this->getAttributes(),$id);
        return $return;
    }

    function getSegmento(){
        return $this->segmento;
    }

    function setSegmento($son){
        $activo = 1;
        $conn = $this->master->connectDb();

        $sql = "SELECT padre,descripcion FROM $this->tabla WHERE activo=? and id_segmento=?";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(1,$activo);
        $stmt->bindParam(2,$son);

        $stmt->execute();

        $x = 0;

        if($stmt->rowCount()>0){

            $stmt->bindColumn(1,$padre);
            $stmt->bindColumn(2,$descripcion);

            while($row = $stmt->fetch(PDO::FETCH_BOUND)){
                // echo "id: $padre, Descripcion: $descripcion";
                $x = $padre;
                if($this->globalCounter==0){
                    $this->segmento = $descripcion;
                } else {
                    $this->segmento = $descripcion." - ".$this->segmento;
                }
            }

            $this->globalCounter = $this->globalCounter + 1;
            $this->setSegmento($x);

        }
    }

    function fillSelect($cliente){
        $conn = $this->master->connectDb();
        $newArray = array();
        $activo = 1;
        $sql = 'call fillSelect_segmentos(?)';

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$cliente);

        if (!$stmt->execute()) {
            return "Ha ocurrido un error(".$stmt->errorCode()."). ".implode(" ",$stmt->errorInfo());
        }

        return $stmt->fetchAll();
    }


    function insertArraySegmento($values){
      
    }
}
?>
