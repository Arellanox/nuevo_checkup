<?php
include "miscelaneus.php";

class Master extends Miscelaneus
{
    public $mis;

    function Master()
    {
        $this->mis = new Miscelaneus();
    }

    function connection()
    {
        $conexion = new mysqli("localhost", "root", "12345678", "checkup");

        if ($conexion->connect_errno) {
            echo "La conexion falló. " . $conexion->connect_error;
        }

        $conexion->set_charset('utf8');

        return $conexion;
    }

    function connectDb()
    {
        //require_once 'pdoconfig.php';
        // $host = "212.1.208.201";
        // $dbname = "u808450138_checkup";
        // $username = "u808450138_bimo";
        // $password = "uJbr*Z7e";
        $host = "localhost";
        $dbname = "checkup";
        $username = "root";
        $password = "12345678";

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            //echo "Connected to $dbname at $host successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }

        return $conn;
    }

    public function getByProcedure($nombreProcedimiento, $parametros)
    {
        try {
            $conexion = $this->connectDb();
            $sp = "call " . $nombreProcedimiento . $this->prepararParametros($parametros);
            $sentencia = $conexion->prepare($sp);
            $sentencia->execute();
            $resultSet = $sentencia->fetchAll();
            $sentencia->closeCursor();
            return $resultSet;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function updateByProcedure($nombreProcedimiento, $parametros)
    {
        $retorno = "";
        $conexion = $this->connectDb();
        $sp = "call " . $nombreProcedimiento . $this->prepararParametros($parametros);
        $sentencia = $conexion->prepare($sp);
        if ($sentencia->execute()) {
            $fila = $sentencia->fetchAll();            
            if (count($fila)>0) {
                $retorno = $fila[0][0];
            } else {
                $retorno = "Alerta: la consulta no devolvió resultado";
            }
        } else {
            $retorno = "Alerta: la consulta al servidor no se realizó correctamente";
        }
        $sentencia->closeCursor();
        return $retorno;
    }

    public function insertByProcedure($nombreProcedimiento, $parametros)
    {
        array_push($parametros, null);
        $retorno = $this->updateByProcedure($nombreProcedimiento, $parametros);
        return $retorno;
    }
    public function deleteByProcedure($nombreProcedimiento, $parametros)
    {
        $retorno = $this->updateByProcedure($nombreProcedimiento, $parametros);
        return $retorno;
    }



    function prepararParametros($parametros)
    {
        $parametrosFormateados = "";
        foreach ($parametros as $valor) {
            switch (strtoupper(gettype($valor))) {
                case 'STRING':
                case 'DATE':
                case 'DATETIME':
                    $parametrosFormateados .= "'" . $valor . "',";
                    break;
                case 'INTEGER':
                case 'FLOAT':
                case 'DOUBLE':
                    $parametrosFormateados .= $valor . ",";
                    break;
                case 'BOOLEAN':
                    $parametrosFormateados .= ($valor ? 1 : 0) . ",";
                    break;
                case 'NULL':
                    $parametrosFormateados .= "NULL,";
                    break;
                default:
                    $parametrosFormateados .= "'" . $valor . "',";
                    break;
            }
        }
        return $parametrosFormateados = "(" . trim($parametrosFormateados, ",") . ");";
    }

    function insert($tabla, $attributes, $values, $intergers, $strings, $doubles, $nulls = array())
    {
        //crea la conexion a la base de datos usando PDO
        $conn = $this->connectDb();

        //construye el codigo sql para insertar dependiendo la tabla y sus atributos
        //reemplazando los atributos por signos de interrogacion (?)
        $sql = "INSERT INTO $tabla ";
        $columns = $this->concatAttributesToInsert($attributes, count($attributes));
        $sql .= "($columns VALUES (";
        $sql = $this->concatQuestionMarkToInsert($sql, count($attributes));

        //Prepara la consulta para enviar SQl injection
        try {
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                echo "error al preparar consulta";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        //verifica que los tipos de datos proporcionados por el usuario sean correctos
        //devuelve un arreglo con las posiciones en que los datos no coinciden
        //con el tipo de dato
        $error_tipo_dato = $this->mis->validarDatos($values, $intergers, $strings, $doubles, $nulls);

        //si el arreglo $error_tipo_dato contiene valores, devuelve un error al usuario
        if (count($error_tipo_dato) > 0) {
            $posiciones = implode(",", $error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        //reemplaza los signos de interrogacion (?) en el codigo SQL por los valores
        //proporcionados por el usuario
        for ($i = 0; $i < count($values); $i++) {
            $stmt->bindParam(($i + 1), $values[$i]);
        }
        //echo $sql;
        // Ejecuta la consulta
        if (!$result = $stmt->execute()) {
            $error = "Ha ocurrido un error(" . $stmt->errorCode() . "). " . implode(" ", $stmt->errorInfo());
            return $error;
        }

        // Recupera el número de filas afectadas
        $afectados = $stmt->rowCount();

        // Recupera el último ID insertado
        $last_id = $conn->lastInsertId();

        // Devuelve el último id;
        return $last_id;

        // Devuelve el número de filas afectadas;
        return $afectados;
    }

    function getAll($tabla)
    {
        $conn = $this->connectDb();

        $activo = 1;

        $stmt = $conn->prepare("SELECT * FROM $tabla WHERE activo=?");

        $error_tipo_dato = $this->mis->validarDatos(array($activo), array(0), array(), array());

        if (count($error_tipo_dato) > 0) {
            $posiciones = implode(",", $error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $stmt->bindParam(1, $activo);

        if (!$stmt->execute()) {
            $error = "Ha ocurrido un error (" . $stmt->errorCode() . "). " . implode(" ", $stmt->errorInfo());
            return $error;
        }

        $resultset = $stmt->fetchAll();
        // $resultset[] = count($resultset);

        return $resultset;
    }

    function getById($tabla, $id_input, $attributes)
    {
        $conn = $this->connectDb();

        $activo = 1;
        $stmt = $conn->prepare("SELECT * FROM $tabla WHERE " . $attributes[0] . "=? and activo=?");

        //$stmt = $conn->prepare("SELECT * FROM $tabla WHERE ".$attributes[0]."=?");

        $stmt->bindParam(1, $id_input);
        $stmt->bindParam(2, $activo);

        $error_tipo_dato = $this->mis->validarDatos(array($id_input), array(0), array(), array());

        if (count($error_tipo_dato) > 0) {
            $posiciones = implode(",", $error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        if (!$stmt->execute()) {
            $error = "Ha ocurrido un error (" . $stmt->errorCode() . "). " . implode(" ", $stmt->errorInfo());
            return $error;
        }

        $resultset = $stmt->fetchAll();

        return $resultset;
    }

    //para actualizar, mandar en el arreglo de $values el id al final
    function update($table, $attributes, $values, $intergers, $strings, $doubles, $nulls = array())
    {

        $conn = $this->connectDb();

        $sql = "UPDATE $table SET ";
        $sql .= $this->concatAttributesToUpdate($attributes);

        try {
            $stmt = $conn->prepare($sql);
            if (!$stmt) {
                echo "error al preparar consulta";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        //$datos_escapados = $this->mis->escaparDatos($values,$conn);
        $error_tipo_dato = $this->mis->validarDatos($values, $intergers, $strings, $doubles, $nulls);

        if (count($error_tipo_dato) > 0) {
            $posiciones = implode(",", $error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        for ($i = 0; $i < count($values); $i++) {
            if (!$stmt->bindParam(($i + 1), $values[$i])) {
                return "Error al bindiar";
            }
        }

        if (!$stmt->execute()) {
            return "Ha ocurrido un error (" . $stmt->errorCode() . "). " . implode(" ", $stmt->errorInfo());
        }

        return $stmt->rowCount();
    }

    function delete($tabla, $attributes, $id_input)
    {
        $conn = $this->connectDb();

        $stmt = $conn->prepare("UPDATE $tabla SET activo=? WHERE " . $attributes[0] . "=?");
        $activo = 0;

        $error_tipo_dato = $this->mis->validarDatos(array($activo), array(0), array(), array());

        if (count($error_tipo_dato) > 0) {
            $posiciones = implode(",", $error_tipo_dato);
            $error_msj = "Error en tipo de datos. Posiciones ($posiciones)";
            return $error_msj;
        }

        $stmt->bindParam(1, $activo);
        $stmt->bindParam(2, $id_input);

        if (!$stmt->execute()) {
            return "Error al ejecutar sentencia";
        }

        return $stmt->rowCount();
    }

    function concatAttributesToUpdate($attributes)
    {
        $string = "";
        $where = "";
        for ($i = 0; $i < count($attributes); $i++) {
            if ($i == 0) {
                $where = "WHERE " . $attributes[$i] . "=?";
            } else if ($i == count($attributes) - 1) {
                //lo ignoramos puesto que se traba del atributo activo
            } else if ($i == count($attributes) - 2) {
                $string .= "" . $attributes[$i] . "=? ";
            } else {
                $string .= "" . $attributes[$i] . "=?, ";
            }
        }

        return $string . $where;
    }

    function concatAttributesToInsert($attributes, $count)
    {
        $string = "";
        for ($i = 0; $i < count($attributes); $i++) {
            if ($i == 0) {
                //Ignora el id ya que este es auto_incremente en la base de datos
            } else if ($i == $count - 1) {
                //ignorar el campo activo (ultimo campo) $string.="?)";
            } else if ($i == $count - 2) {
                $string .= $attributes[$i] . ")";
            } else {
                $string .= $attributes[$i] . ",";
            }
        }

        return $string;
    }

    function concatQuestionMarkToInsert($string, $count)
    {
        for ($i = 0; $i < $count; $i++) {
            if ($i == 0) {
                //Ignora el id ya que este es auto_incremente en la base de datos
            } else if ($i == $count - 1) {
                //ignorar el campo activo $string.="?)";
            } else if ($i == $count - 2) {
                $string .= "?)";
            } else {
                $string .= "?,";
            }
        }

        return $string;
    }

    function checkStartedSession()
    {
        if (!isset($_SESSION['id'])) {
            return false;
        }
        return true;
    }
}
