<?php
session_start(); 
class TokenVerificacion
{

    private $_id_usuario;
    private $_token;
    function TokenVerificacion($id_usuario,$token){
        $this->_id_usuario = $id_usuario;
        $this->_token = $token;
    }
    function verificar()
    {
        try {
            $master = new Master();
            $parametros = [ $this->_id_usuario, $this->_token];
            $conexion = $master->connectDb();
            $sp = "call sp_usuarios_token_b". $this->concatQuestionMark(count($parametros));
            $sentencia = $conexion->prepare($sp);
            $sentencia = $this->bindParams($sentencia,$parametros);
            $sentencia->execute();
            $resultSet = $sentencia->fetchAll();
            $sentencia->closeCursor();
            if (count($resultSet)>0){
                return true;
            }
        } catch (Exception $e) {
            echo $sentencia->errorCode();
        }
        return false;
    }

    private function concatQuestionMark($length){
        $questionMarks = "(";
        for ($i=0; $i < $length; $i++) {
            if ($i==$length-1) {
                $questionMarks.="?";
            } else {
                $questionMarks.="?,";
            }
        }

        $questionMarks.=");";
        return $questionMarks;
    }

    private function bindParams($object, $params){
        for ($i=0; $i < count($params); $i++) {
            $object->bindParam(($i+1),$params[$i]);
        }
        return $object;
    }
    public function logout(){
        // jason con orden de logout
    }

}
