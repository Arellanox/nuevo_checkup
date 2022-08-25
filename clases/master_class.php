<?php
include "miscelaneus.php";

class Master extends Miscelaneus{
    public $mis;

    function Master(){
        $this->mis = new Miscelaneus();
    }

    function connection(){
        $conexion = new mysqli("localhost","root","bimo2022","checkup");

        if($conexion->connect_errno){
            echo "La conexion falló. ".$conexion->connect_error;
        }

        $conexion->set_charset('utf8');

        return $conexion;
    }

    function insert($tabla,$attributes,$values,$validator,$intergers,$strings,$doubles){       
        $conn = $this->connection();
        
        $array_columns = array();

        $sql = "INSERT INTO $tabla ";
        $columns = $this->concatAttributesToInsert($attributes,count($attributes));
        $sql.= "($columns VALUES (";
        $sql = $this->concatQuestionMarkToInsert($sql,count($attributes));
        //echo $sql;
        try{
            $stmt = $conn->prepare($sql);
            if(!$stmt){
                echo "error al preparar consulta";
            }
        }catch(Exception $e){
            echo $e->getMessage();
        }

        for ($i=0; $i < strlen($validator); $i++) { 
            $stmt->bind_param($validator[$i],$array_columns[$i]);
        }
        
        // $stmt->bind_param($validator,$array_columns);
        
        
        $datos_escapados = $this->mis->escaparDatos($values,$conn);
        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,$intergers,$strings,$doubles);

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }
        

        for ($i=0; $i < count($datos_escapados); $i++) { 
            $array_columns[$i] = $datos_escapados[$i];
        }
        
        // echo "No tiene errores";
        // echo "<br>";

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }
        //echo "despues de comprobar los datos";
        $afectados = $stmt->affected_rows;
      
        $stmt->close();
        $last_id = $conexion->insert_id;  

        return $afectados;
        
    }

    function getAll($tabla){
        $conn = $this->connection();

        $stmt = $conn->prepare("SELECT * FROM $tabla WHERE activo=?");
        $stmt->bind_param("i",$activo);

        $datos = array();
        $datos[0] = 1;

        $datos_escapados = $this->mis->escaparDatos($datos,$conn);
        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,array(0),array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $activo = $datos_escapados[0];

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $result = $stmt->get_result();
        $resultset = array();
        
        while($row = $result->fetch_array(MYSQLI_ASSOC)){
            $resultset[] = $row;
        }

        return $resultset;


    }

    function getById($tabla,$id){
        $conn = $this->connection();
        
    }

    function concatAttributesToInsert($attributes,$count){
        $string = "";
        for ($i=0; $i < count($attributes); $i++) { 
            if($i==0){
                //Ignora el id ya que este es auto_incremente en la base de datos
            }else if($i==$count-1){
                //ignorar el campo activo (ultimo campo) $string.="?)";
            }else if($i==$count-2){
                $string.=$attributes[$i].")";
            }else{
                $string.=$attributes[$i].",";
            }
        }

        return $string;
    }

    function concatQuestionMarkToInsert($string,$count){
        for($i=0;$i<$count;$i++){
            if($i==0){
                //Ignora el id ya que este es auto_incremente en la base de datos
            }else if($i==$count-1){
                //ignorar el campo activo $string.="?)";
            }else if($i==$count-2){
                $string.="?)";
            }else{
                $string.="?,";
            }
        }

        return $string;
    }
}
?>