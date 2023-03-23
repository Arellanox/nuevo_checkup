<?php
class Paciente {
    public $area_id;
    public $turno_id;
    public $etiqueta_turno;
    public $paciente;
    function Paciente(){
    }

    function setAreaId($area){
        $this->area_id = $area;
    }

    function getAreaId(){
        return $this->area_id;
    }

    function setTurnoId($turno){
        $this->turno_id = $turno;
    }

    function getTurnoId(){
        return $this->turno_id;
    }

    function setEtiquetaTurno($etiqueta){
        $this->etiqueta_turno = $etiqueta;
    }

    function getEtiquetaTurno(){
        return $this->etiqueta_turno;
    }

    function setPaciente($pac){
        $this->paciente = $pac;
    }

    function getPaciente(){
        return $this->paciente;
    }
}


class ListaPacientes {
    public $pacientes;
    public $position;
    
    function ListaPacientes(){
        $this->pacientes = array();
        $this->position = 0;
    }

    function pushPaciente($paciente){
        array_push($this->pacientes,$paciente);
    }

    function getPacientes(){
        return $this->pacientes;
    }

    function setPosition($position){
        $this->position = $position;
    }

    function getPosition(){
        return $this->position;
    }

    function getNextPatient(){
        $patientList = $this->getPacientes();
        
        # comprobar que la posicion exista
        if(!isset($patientList[$this->getPosition()])){
            $this->setPosition(0);
        } 
        return $patientList[$this->getPosition()];
    }
}

class JsonData {
    public $json;
    function JsonData(){
        # recuperamos la informacion del archivo
        $data = file_get_contents("../data.json");
        # decodificamos la cadena para convertirla en arreglo.
        $this->json = json_decode($data, true);
    }

    public function getJson(){
        return $this->json;
    }
    public function setData($area,$turno){
        $this->json[ $area ] = $turno;
        file_put_contents( "../data.json", json_encode( $this->json, JSON_PRETTY_PRINT ) );
    }

    public function getData($area){
        return $this->json[ $area ];
    }

    public function removeArea($turno){
        # remueve la posicion del area en el data.json

        $newJson = array_filter($this->json, function($obj) use ($turno){
            $r = $obj != $turno;
            return $r;
        });

        file_put_contents("../data.json", json_encode($newJson, JSON_PRETTY_PRINT));
    }
}
?>