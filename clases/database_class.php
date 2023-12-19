<?php
include_once '../interfaces/iDatabase.php';

class Database implements iDatabase{

    public $nombres;
    public $conexion;
    public $archivoSalida;

    function Database($listaNombres = [], $conexion, $archivo){
        $this->nombres = $listaNombres;
        $this->conexion = $conexion;
        $this->archivoSalida = $archivo;
    }

    public function guardarDefinicionesFunciones(){
        try {
            // Verificar si el archivo de salida ya existe y borrarlo si es necesario
            if (file_exists($this->archivoSalida)) {
                unlink($this->archivoSalida);
            }
            
            // Abrir el archivo de salida en modo escritura
            $archivo = fopen($this->archivoSalida, 'w');
            
            // Almacena las sentencias DROP y las definiciones en arreglos separados
            $sentenciasDrop = [];
            $definiciones = [];
            
            // Iterar a través de los nombres de procedimientos y funciones
            foreach ($this->nombres as $nombre) {
                // Obtener la definición del procedimiento o función
                $sql = "SHOW CREATE PROCEDURE $nombre";
                $consulta = $this->conexion->prepare($sql);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                
                if ($resultado) {
                    // Eliminar la cláusula DEFINER de la definición
                    $definicion = preg_replace('/DEFINER=.*?@.*? /', '', $resultado['Create Procedure']);
                    
                    // Almacenar la sentencia DROP en el arreglo
                    $sentenciasDrop[] = "DROP PROCEDURE IF EXISTS $nombre;";
                    
                    // Almacenar la definición en el arreglo
                    $definiciones[] = "-- Definición de $nombre --\n$definicion;\n\n";
                } else {
                    // Si no se encontró el procedimiento, verificar si es una función
                    $sql = "SHOW CREATE FUNCTION $nombre";
                    $consulta = $this->conexion->prepare($sql);
                    $consulta->execute();
                    $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                    
                    if ($resultado) {
                        // Eliminar la cláusula DEFINER de la definición
                        $definicion = preg_replace('/DEFINER=.*?@.*? /', '', $resultado['Create Function']);
                        
                        // Almacenar la sentencia DROP en el arreglo
                        $sentenciasDrop[] = "DROP FUNCTION IF EXISTS $nombre;";
                        
                        // Almacenar la definición en el arreglo
                        $definiciones[] = "-- Definición de $nombre --\n$definicion;\n\n";
                    } else {
                        // Si ni el procedimiento ni la función existen, mostrar un mensaje de error
                        fwrite($archivo, "-- $nombre no encontrado --\n\n");
                    }
                }
            }
            
            // Escribir primero todas las sentencias DROP en el archivo
            foreach ($sentenciasDrop as $sentenciaDrop) {
                fwrite($archivo, $sentenciaDrop . "\n");
            }
            
            // Escribir luego todas las definiciones en el archivo
            foreach ($definiciones as $definicion) {
                fwrite($archivo, "DELIMITER // \n");
                fwrite($archivo, $definicion);
                fwrite($archivo, "// \n");
            }
            
            // Cerrar el archivo
            fclose($archivo);
            
            echo "Script MySQL generado con éxito en $this->archivoSalida";
        } catch (PDOException $e) {
            echo "Error al generar el script MySQL: " . $e->getMessage();
        }
    }

    public function guardarDefinicionesTablas(){
        try {
            // Verificar si el archivo de salida ya existe y borrarlo si es necesario
            if (file_exists($this->archivoSalida)) {
                unlink($this->archivoSalida);
            }
            
            // Abrir el archivo de salida en modo escritura
            $archivo = fopen($this->archivoSalida, 'w');
            
            foreach ($this->nombres as $tabla) {
                // Verificar si la tabla existe en la base de datos
                $sql = "SHOW TABLES LIKE :tabla";
                $consultaTabla = $this->conexion->prepare($sql);
                $consultaTabla->bindParam(':tabla', $tabla, PDO::PARAM_STR);
                $consultaTabla->execute();
                
                if ($consultaTabla->rowCount() > 0) {
                    // Obtener la definición de la tabla
                    $sql = "SHOW CREATE TABLE $tabla";
                    $consultaDefinicion = $this->conexion->prepare($sql);
                    $consultaDefinicion->execute();
                    $resultado = $consultaDefinicion->fetch(PDO::FETCH_ASSOC);
                    
                    if ($resultado) {
                        // Obtener la definición de la tabla y buscar la cadena AUTO_INCREMENT=
                        $definicionTabla = $resultado['Create Table'];
                        preg_match("/AUTO_INCREMENT=([^ ]+)/", $definicionTabla, $matches);
                        $autoIncrementValue = isset($matches[1]) ? $matches[1] : null;
                        
                        if ($autoIncrementValue !== null) {
                            // Reemplazar el valor del autoincremento por 1
                            $definicionTabla = str_replace("AUTO_INCREMENT=$autoIncrementValue", "AUTO_INCREMENT=1", $definicionTabla);
                        }
                        
                        // Escribir la definición de la tabla en el archivo
                        fwrite($archivo, "-- Definición de la tabla $tabla --\n");
                        fwrite($archivo, $definicionTabla . ";\n\n");
                        
                        echo "Definición de la tabla $tabla guardada en $this->archivoSalida.<br>";
                    } else {
                        echo "No se pudo obtener la definición de la tabla $tabla.<br>";
                    }
                } else {
                    echo "La tabla $tabla no existe en la base de datos.<br>";
                }
            }
            
            // Cerrar el archivo
            fclose($archivo);
            
            echo "Definiciones de las tablas guardadas en $this->archivoSalida";
        } catch (PDOException $e) {
            echo "Error al guardar las definiciones de las tablas: " . $e->getMessage();
        }
    }

}


?>