<?php
include_once "master_class.php";

class LaboratorioEquipos extends Master{
    public $master;
    public $ins_upd;
    public $del;
    public $sea;

    function LaboratorioEquipos(){
        $this->master = new Master();
        $this->ins_upd = "sp_laboratorio_equipos_g";
        $this->del= "sp_laboratorio_equipos_e";
        $this->sea= "sp_laboratorio_equipos_b";
    }

    function insert($values){
        $response = $this->master->insertByProcedure($this->ins_upd,$values);
        return $response;
    }

    function getAll(){
        $response = $this->master->getByProcedure($this->sea,array(null));
        return $response;
    }

    function getById($id){
        $response = $this->master->getByProcedure($this->sea,array($id));
        return $response;
    }

    function update($values){
        $response = $this->master->updateByProcedure($this->ins_upd,$values);
        return $response;
    }

    function delete($id){
        $response = $this->master->updateByProcedure($this->del,array($id));
        return $response;
    }
}
?>