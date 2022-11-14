<?php
class TokenPreregistro
{

 
    public function generarTokenPrergistro($correo)
    {
        if (!(filter_var($correo, FILTER_VALIDATE_EMAIL))) {
            echo 'Invalid email';
        }

        $token='';

        try {
            $master = new Master();
            $parametros = [null,$correo,null];
            $conexion = $master->connectDb();
            $sp = "call generar_token_preregistro". $this->concatQuestionMark(count($parametros));
            $sentencia = $conexion->prepare($sp);
            $sentencia = $this->bindParams($sentencia,$parametros);
            $sentencia->execute();
            $resultSet = $sentencia->fetchAll();
            $sentencia->closeCursor();            
            if (count($resultSet)>0){
                $token =  $resultSet[0]['TOKEN'];
            }
        } catch (Exception $e) {
            return ('Error: '  . $sentencia->errorCode());
        }
        return $token;
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

}
