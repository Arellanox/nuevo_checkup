<?php
include "../conexion.php";
include "../miscelaneus.php";

class Contactos extends Miscelaneus{
    public $id;
    public $cliente_id;
    public $nombre;
    public $apellidos;
    public $telefono1;
    public $telefono2;
    public $email;
    public $activo;
    public $tabla;
    public $mis;

    function Contactos(){
        $this->tabla = "contactos";
        $this->mis = new Miscelaneus();
    }

    function setId($id){
        $this->id = $id;
    }

    function getId(){
        return $this->id;
    }

    function setClienteId($cliente){
        $this->cliente_id = $cliente;
    }

    function getClienteId(){
        return $this->cliente_id;
    }

    function setNombre($nombre){
        $this->nombre = $nombre;
    }

    function getNombre(){
        return $this->nombre;
    }

    function setApellidos($apellidos){
        $this->apellidos = $apellidos;
    }

    function getApellidos(){
        return $this->apellidos;
    }

    function setTelefono1($tel){
        $this->telefono1 = $tel;
    }

    function getTelefono1(){
        return $this->telefono1;
    }

    function setTelefono2($tel){
        $this->telefono2 = $tel;
    }

    function getTelefono2(){
        return $this->telefono2;
    }

    function setEmail($email){
        $this->email = $email;
    }

    function getEmail(){
        return $this->email;
    }

    function setActivo($activo){
        $this->activo = $activo;
    }

    function getActivo(){
        return $this->activo;
    }

    function setter($id,$cliente,$nombre,$apellidos,$tel1,$tel2,$email){
        $this->setId($id);
        $this->setClienteId($cliente);
        $this->setNombre($nombre);
        $this->setApellidos($apellidos);
        $this->setTelefono1($tel1);
        $this->setTelefono2($tel2);
        $this->setEmail($email);
    }

    function insert($cliente_input,$nombre_input,$apellidos_input,$tel1_input,$tel2_input,$email_input){
        global $conexion;

        $stmt = $conexion->prepare("INSERT INTO $this->tabla (id_cliente,nombre,apellidos,telefono1,telefono2,email) VALUES (
                                    ?,?,?,?,?,?)");
        $stmt->bind_param("issiis",$cliente,$nombre,$apellidos,$tel1,$tel2,$email);

        $datos = array();
        $datos[0] = $cliente_input;
        $datos[1] = $nombre_input;
        $datos[2] = $apellidos_input;
        $datos[3] = $tel1_input;
        $datos[4] = $tel2_input;
        $datos[5] = $email_input;

        $datos_escapados = $this->mis->escaparDatos($datos);

        $intergers = array(0,3,4);
        $strings = array(1,2,5);
        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,$intergers,$strings,array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $cliente = $datos_escapados[0];
        $nombre = $datos_escapados[1];
        $apellidos = $datos_escapados[2];
        $tel1 = $datos_escapados[3];
        $tel2 = $datos_escapados[4];
        $email = $datos_escapados[5];

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }    
        $afectados = $stmt->affected_rows;
      
        $stmt->close();
        $last_id = $conexion->insert_id;  
        
        $this->setter($last_id,$datos_escapados[0],$datos_escapados[1],$datos_escapados[2],$datos_escapados[3],$datos_escapados[4],
        $datos_escapados[5]);

        return $afectados;
        
    }

    function getAll(){
        global $conexion;
    }

    function getbyId($id_input){
        global $conexion;

        $stmt = $conexion->prepare("SELECT * FROM $this->tabla WHERE activo=? and id_contacto=?");
        $stmt->bind_param("ii",$activo,$id);

        $datos = array();
        $datos[0] = 1;
        $datos[1] = $id_input;

        $datos_escapados = $this->mis->escaparDatos($datos);

        $intergers = array(0,1);

        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,$intergers,array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $activo =   $datos_escapados[0];
        $id =       $datos_escapados[1];

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $result = $stmt->get_result();
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $stmt->close();
        return $row;


    }

    function getAllByClient($id_cliente_input){
        global $conexion;

        $stmt = $conexion->prepare("SELECT * FROM $this->tabla where id_cliente=? and activo=?");
        $stmt->bind_param("ii",$cliente,$activo);

        $datos = array();
        $datos[0] = $id_cliente_input;
        $datos[1] = 1;

        $datos_escapados = $this->mis->escaparDatos($datos);
        
        $intergers = array(0,1);

        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,$intergers,array(),array());
        
        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $cliente = $datos_escapados[0];
        $activo = $datos_escapados[1];

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
    
    function update($id_input,$nombre_input,$apellidos_input,$tel1_input,$tel2_input,$email_input,$cliente_input){
        global $conexion;

        $stmt = $conexion->prepare("UPDATE $this->tabla SET id_cliente=?,nombre=?,apellidos=?,telefono1=?,telefono2=?,email=? where id_contacto=?");
        $stmt->bind_param("issiisi",$cliente,$nombre,$apellidos,$tel1,$tel2,$email,$id);

        $datos = array();
        $datos[0] = $nombre_input;
        $datos[1] = $apellidos_input;
        $datos[2] = $tel1_input;
        $datos[3] = $tel2_input;
        $datos[4] = $email_input;
        $datos[5] = $id_input;
        $datos[6] = $cliente_input;
        
        $datos_escapados = $this->mis->escaparDatos($datos);

        $intergers = array(2,3,5,6);
        $strings = array(0,1,4);

        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,$intergers,$strings,array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $nombre =       $datos_escapados[0];
        $apellidos =    $datos_escapados[1];
        $tel1 =         $datos_escapados[2];
        $tel2 =         $datos_escapados[3];
        $email =        $datos_escapados[4];
        $id =           $datos_escapados[5];
        $cliente =      $datos_escapados[6];

        if(!$stmt->execute()){
            $error = "Ha ocurrido un error (".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        if (!$result = $stmt->execute()){
            $error = "Ha ocurrido un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }    
        
        $afectados = $stmt->affected_rows;
        
        $stmt->close();    
        $this->setter($datos_escapados[5],$datos_escapados[6],$datos_escapados[0],$datos_escapados[1],$datos_escapados[2],
        $datos_escapados[3],$datos_escapados[4]);
        return $afectados;

    }

    function delete($id_input){
        global $conexion;

        $stmt = $conexion->prepare("UPDATE $this->tabla SET activo=? WHERE id_contacto=?");
        $stmt->bind_param("ii",$activo,$id);

        $datos = array();
        $datos[0] = 0;
        $datos[1] = $id_input;

        $datos_escapados = $this->mis->escaparDatos($datos);

        $intergers = array(0,1);

        $error_tipo_dato = $this->mis->validarDatos($datos_escapados,$intergers,array(),array());

        if(count($error_tipo_dato)>0){
            $posiciones = implode(",",$error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $activo = $datos_escapados[0];
        $id =     $datos_escapados[1];

        if(!$stmt->execute()){
            $error = "Ha ocurrdio un error(".$stmt->errno."). ".$stmt->error;
            return $error;
        }

        $afectados = $stmt->affected_rows;
        $stmt->close();

        return $afectados;
    }

}
?>