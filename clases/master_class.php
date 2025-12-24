<?php
include "miscelaneus.php";
include "credenciales_access/database_connect.php";

class Master extends Miscelaneus
{
    public $mis;
    public $urlServer;
    public $urlLocal;
    public $urlComodin;
    public $urlOrdenesMedicas;
    public $urlEquiposLaboratorio;
    public $urlPases;
    public $database;

    function Master()
    {
        $this->mis = new Miscelaneus();
        $this->database = new Database();
        $this->urlServer = 'https://bimo-lab.com/';
        $this->urlLocal = 'http://localhost/';
        $this->urlComodin = '../';
        $this->urlOrdenesMedicas = 'archivos/ordenes_medicas/';
        $this->urlEquiposLaboratorio = "archivos/laboratorio_equipos/";
        $this->urlPases = "archivos/pases/";
    }

    function connectDb()
    {
        $host = $this->database->host;
        $dbname = $this->database->dbname;
        $username = $this->database->username;
        $password = $this->database->password;
        $port = $this->database->port ?? 3306;

        try {
            $conn = new PDO("mysql:host=$host;dbname=$dbname;port=$port", $username, $password);
            //echo "Connected to $dbname at $host successfully.";
        } catch (PDOException $pe) {
            $this->mis->setLog("Could not connect to the database $dbname :" . $pe->getMessage(), 'fn_connect_db');
            // die("Could not connect to the database $dbname :" . $pe->getMessage());
            die('Could not connect to the database');
        }

        return $conn;
    }

    public function getByProcedure($nombreProcedimiento, $parametros)
    {
        try {
            $conexion = $this->connectDb();

            $sp = "call " . $nombreProcedimiento . $this->concatQuestionMark(count($parametros));
            $sentencia = $conexion->prepare($sp);

            $sentencia = $this->bindParams($sentencia, $parametros);

            if (!$sentencia->execute()) {
                $error_msj = "Ha ocurrido un error(" . $sentencia->errorCode() . "). " . implode(" ", $sentencia->errorInfo());
                $this->mis->setLog($error_msj, $nombreProcedimiento);
                return "ERROR. No se pudieron recuperar los datos.";
            }

            $resultSet = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            $sentencia->closeCursor();

            # cerramos la conexion a la base de datos.

            return $resultSet;
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $nombreProcedimiento);
            echo $e->getMessage();
        } finally {
            $conexion = null;
        }
    }

    public function getByNext($nombreProcedimiento, $parametros)
    {
        try {
            $conexion = $this->connectDb();

            $sp = "call " . $nombreProcedimiento . $this->concatQuestionMark(count($parametros));
            $sentencia = $conexion->prepare($sp);

            $sentencia = $this->bindParams($sentencia, $parametros);

            if (!$sentencia->execute()) {
                $error_msj = "Ha ocurrido un error(" . $sentencia->errorCode() . "). " . implode(" ", $sentencia->errorInfo());
                $this->mis->setLog($error_msj, $nombreProcedimiento);
                return "ERROR. No se pudieron recuperar los datos.";
            }

            $global = [];
            do {
                $resultSet = $sentencia->fetchAll();
                $global[] = $resultSet;
            } while ($sentencia->nextRowset());

            $sentencia->closeCursor();

            # cerramos la conexion a la base de datos.
            return $global;
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $nombreProcedimiento);
            echo $e->getMessage();
        } finally {
            $conexion = null;
        }
    }

    public function updateByProcedure($nombreProcedimiento, $parametros)
    {
        try {
            $retorno = "";
            $conexion = $this->connectDb();
            $sp = "call " . $nombreProcedimiento . $this->concatQuestionMark(count($parametros));
            $sentencia = $conexion->prepare($sp);
            $sentencia = $this->bindParams($sentencia, $parametros);

            if ($sentencia->execute()) {
                $fila = $sentencia->fetchAll();
                if (count($fila) > 0) {
                    $retorno = $fila[0][0];
                } else {
                    $retorno = "Alerta: la consulta no devolvió resultado";
                }
            } else {
                $error_msj = "Ha ocurrido un error(" . $sentencia->errorCode() . "). " . implode(" ", $sentencia->errorInfo());
                # return "ERROR. No se pudieron recuperar los datos.";
                $retorno = "Alerta: la consulta al servidor no se realizó correctamente".implode(" ", $sentencia->errorInfo());
            }

            $sentencia->closeCursor();
            return $retorno;
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), 'error en: '.$nombreProcedimiento);
            echo $e->getMessage();
        } finally {
            $conexion = null;
        }
    }

    public function insertByProcedure($nombreProcedimiento, $parametros)
    {
        return $this->updateByProcedure($nombreProcedimiento, $parametros);
    }

    public function deleteByProcedure($nombreProcedimiento, $parametros)
    {
        return $this->updateByProcedure($nombreProcedimiento, $parametros);
    }

    function insert($tabla, $attributes, $values, $intergers, $strings, $doubles, $nulls = array())
    {
        try {
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

            // Recupera el último ID insertado
            // Devuelve el último id;
            return $conn->lastInsertId();
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $tabla);
            echo $e->getMessage();
        } finally {
            $conn = null;
        }
    }

    function getAll($tabla)
    {
        try {
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

            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $tabla);
            echo $e->getMessage();
        } finally {
            $conn = null;
        }
    }

    function getById($tabla, $id_input, $attributes)
    {
        try {
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

            return $stmt->fetchAll();
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $tabla);
            echo $e->getMessage();
        } finally {
            $conn = null;
        }
    }

    //para actualizar, mandar en el arreglo de $values el id al final
    function update($table, $attributes, $values, $intergers, $strings, $doubles, $nulls = array())
    {
        try {
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
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $table);
            echo $e->getMessage();
        } finally {
            $conn = null;
        }
    }

    function delete($tabla, $attributes, $id_input)
    {
        try {
            $conn = $this->connectDb();

            $stmt = $conn->prepare("UPDATE $tabla SET activo=? WHERE " . $attributes[0] . "=?");
            $activo = 0;

            $error_tipo_dato = $this->mis->validarDatos(array($activo), array(0), array(), array());

            if (count($error_tipo_dato) > 0) {
                $posiciones = implode(",", $error_tipo_dato);
                $error_smsj = "Error en tipo de datos. Posiciones ($posiciones)";
                return $error_msj;
            }

            $stmt->bindParam(1, $activo);
            $stmt->bindParam(2, $id_input);

            if (!$stmt->execute()) {
                return "Error al ejecutar sentencia";
            }

            return $stmt->rowCount();
        } catch (Exception $e) {
            $this->mis->setLog($e->getMessage(), $tabla);
            echo $e->getMessage();
        } finally {
            $conn = null;
        }
    }

    function concatAttributesToUpdate($attributes): string
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

    private function trimmer($trimming = array()): array
    {
        $trimed = array();
        // for ($i = 0; $i < count($trimming); $i++) {
        //     $trimed[] = trim( $trimming[$i] );
        // }

        foreach ($trimming as $key => $current) {
            //$current = strlen($current)>0 ? $current : null;
            $trimed[$key] = isset($current) ? trim($current) : $current;
        }

        return $trimed;
    }

    private function concatQuestionMark($length): string
    {
        $questionMarks = "(";
        for ($i = 0; $i < $length; $i++) {
            if ($i == $length - 1) {
                $questionMarks .= "?";
            } else {
                $questionMarks .= "?,";
            }
        }

        $questionMarks .= ");";
        return $questionMarks;
    }

    private function bindParams($object, $params)
    {
        $params = $this->trimmer($params);
        for ($i = 0; $i < count($params); $i++) {
            $object->bindParam(($i + 1), $params[$i]);
        }
        return $object;
    }

    function concatAttributesToInsert($attributes, $count): string
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

    function concatQuestionMarkToInsert($string, $count): string
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

    function checkStartedSession(): bool
    {
        if (!isset($_SESSION['id'])) {
            return false;
        }
        return true;
    }
}
