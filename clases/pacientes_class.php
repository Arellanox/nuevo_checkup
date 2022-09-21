<?php
include_once "master_class.php";

class Pacientes extends Master implements iMetodos{
    public $id_paciente;//24
    public $segmento_id; //0
    public $nombre;//1
    public $paterno;//2
    public $materno;//3
    public $edad;//4
    public $nacimiento;//5
    public $curp;//6
    public $celular;//7
    public $correo;//8
    public $postal;//9
    public $estado;//10
    public $municipio;//11
    public $colonia;//12
    public $exterior;//13
    public $interior;//14
    public $calle;//15
    public $nacionalidad;//16
    public $pasaporte;//17
    public $rfc;//18
    public $vacuna;//19
    public $otravacuna;//20
    public $dosis;//21
    public $genero;//22
    public $foto;//23
    public $activo;
    private $tabla;
    public $master;
    private $public_attributes;
    private $intergers;
    private $strings;
    private $doubles;
    private $intergers_update;
    private $strings_update;
    private $doubles_update;
    private $nulls;

    function Pacientes(){
        $this->public_attributes = 26;
        $this->master = new Master();
        $this->tabla = "pacientes";
        //guarda la POSICIONES en el arreglo de clase de los attributos que sean enteros;
        //para insertar ignora el id, es decir, la posicion [0] es segmento_id
        $this->intergers = array(0,4,7,9,11,13,14,17,22);
        $this->strings = array(1,2,3,5,6,8,10,12,15,16,18,19,20,21,23);
        $this->double = array();
        $this->intergers_update = array(0,4,7,10,11,13,17,22,24);
        $this->nulls = array(0,11,14,20,21,23);
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

    function getByCurp($curp){
        $conn = $this->master->connectDb();
        $activo = 1;
        $sql = "SELECT * FROM $this->tabla WHERE activo=? and curp=?";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$activo);
        $stmt->bindParam(2,$curp);

        $error_tipo_dato = $this->master->mis->validarDatos(array($curp),array(),array(0),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $resultset = $stmt->fetchAll();

        return $resultset;
    }

    function insertByProcedure($sp,$values){
        $response = $this->master->insertByProcedure($sp,$values);
        return $response;
    }
}
?>
