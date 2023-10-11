<?php
include_once "database_class.php";
class DatabaseDiferencias extends Database implements iDatabaseDiferencias{

    public $conexionOrigen;
    public $conexionDestino;        
    public $lista;
    public $archivo;
    public $extension;


    function DatabaseDiferencias($archivo, $conexionOrigen, $conexionDestino){
        
        $this->conexionOrigen = $conexionOrigen;
        $this->conexionDestino = $conexionDestino;
        $this->archivo = $archivo;
        $this->extension = "";
        
    }

    public function recuperarListaFuncionesNuevas(){

        $listaOrigen = $this->obtenerListaFuncionesProcedimientos($this->conexionOrigen);
        $listaDestino = $this->obtenerListaFuncionesProcedimientos($this->conexionDestino);

        $diferencias = array_diff($listaOrigen,$listaDestino);

        return $diferencias;
    }

    public function recuperarListaTablasNuevas(){
        
        $lista1 = $this->obtenerListaTablas($this->conexionOrigen);
        $lista2 = $this->obtenerListaTablas($this->conexionDestino);

        $diferencias = array_diff($lista1,$lista2);
        return $diferencias;
    }

    public function recuperarListaVistasNuevas(){
        $lista1 = $this->obtenerListaVistas($this->conexionOrigen);
        $lista2 = $this->obtenerListaVistas($this->conexionDestino);

        $diferencias = array_diff($lista1, $lista2);
        return $diferencias;
    }

    public function recuperarListaTriggersNuevos(){
        $lista1 = $this->obtenerListaTriggers($this->conexionOrigen);
        $lista2 = $this->obtenerListaTriggers($this->conexionDestino);

        $diferencias = array_diff($lista1, $lista2);

        return $diferencias;
    }

    private function obtenerListaFuncionesProcedimientos($conexion) {
        // Consultar la lista de funciones y procedimientos en la conexión
        $sql = "SELECT ROUTINE_NAME FROM information_schema.ROUTINES WHERE ROUTINE_SCHEMA = :database";
        $consulta = $conexion->prepare($sql);
        $consulta->bindParam(':database', $conexion->query("SELECT DATABASE()")->fetchColumn(), PDO::PARAM_STR);
        $consulta->execute();
        
        $lista = array();
        while ($row = $consulta->fetch(PDO::FETCH_ASSOC)) {
            $lista[] = $row['ROUTINE_NAME'];
        }
    
        return $lista;
    }

    private function obtenerListaTablas($conexion){
        try {
            // Consultar la lista de tablas en la base de datos actual
            $sql = "SHOW TABLES";
            $consulta = $conexion->query($sql);
            $tablas = $consulta->fetchAll(PDO::FETCH_COLUMN);
            
            return $tablas;
        } catch (PDOException $e) {
            echo "Error al obtener la lista de tablas: " . $e->getMessage();
            return array(); // En caso de error, devuelve un arreglo vacío
        }
    }

    private function obtenerListaVistas($conexion){
        try {
            // Consultar la lista de tablas en la base de datos actual
            $sql = "SHOW FULL TABLES WHERE TABLE_TYPE LIKE 'VIEW'";
            $consulta = $conexion->query($sql);
            $vistas = $consulta->fetchAll(PDO::FETCH_COLUMN);
            
            return $vistas;
        } catch (PDOException $e) {
            echo "Error al obtener la lista de tablas: " . $e->getMessage();
            return array(); // En caso de error, devuelve un arreglo vacío
        }
    }

    private function obtenerListaTriggers($conexion){
        try {
            // Consultar la lista de tablas en la base de datos actual
            $sql = "SHOW TRIGGERS";
            $consulta = $conexion->query($sql);
            $vistas = $consulta->fetchAll(PDO::FETCH_COLUMN);
            
            return $vistas;
        } catch (PDOException $e) {
            echo "Error al obtener la lista de tablas: " . $e->getMessage();
            return array(); // En caso de error, devuelve un arreglo vacío
        }
    }

    private function setLista($lista){
        $this->lista = $lista;
    }

    private function getLista(){
        return $this->lista;
    }

    private function agregarTipoDefinicion($tipo){
        $explode = explode(".",$this->archivo);
        $this->extension = $explode[0]."_$tipo.".end($explode);

        return $this->extension;        
    }

    public function guardarDefinicion($tipo,$columna){
        try{
            // Verificar si el archivo de salida ya existe y borrarlo si es necesario
            if (file_exists($this->archivoSalida)) {
                unlink($this->archivoSalida);
            }

            $sentenciasDrop = [];
            $definiciones = [];

            // Abrir el archivo de salida en modo escritura
            $archivo = fopen($this->archivoSalida, 'w');

            foreach($this->lista as $vista){
                // Obtener la definición del procedimiento o función
                $sql = "SHOW CREATE $tipo $vista";
                $consulta = $this->conexionOrigen->prepare($sql);
                $consulta->execute();
                $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
                
                if($resultado){
                     // Eliminar la cláusula DEFINER de la definición
                     $definicion = preg_replace('/DEFINER=.*?@.*? /', '', $resultado[$columna]);
                    
                     // Almacenar la sentencia DROP en el arreglo
                     $sentenciasDrop[] = "DROP VIEW IF EXISTS $vista;";
                     
                     // Almacenar la definición en el arreglo
                     $definiciones[] = "-- Definición de $vista --\n$definicion;\n\n";
                } else {
                    fwrite($archivo, "-- $vista no encontrada --\n\n");
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
            echo "$tipo's se generaron con éxito en $this->archivoSalida";
        } catch(PDOException $e){
            echo "Error al generar el script de vistas: " . $e->getMessage();
        }
    }

    public function buildScript(){
        #FUNCIONES Y PROCEDURES.
        # obtenemos la lista de las funciones
        $this->setLista($this->recuperarListaFuncionesNuevas());
        # inicializamos la clase padre
        parent::Database($this->getLista(), $this->conexionOrigen, $this->agregarTipoDefinicion("funciones"));
        # guardamos el script
        parent::guardarDefinicionesFunciones();
        echo "<br>";
        
        # TABLAS
        # obtenemos la lista de las funciones
        $this->setLista($this->recuperarListaTablasNuevas());
        # inicializamos la clase padre
        parent::Database($this->getLista(), $this->conexionOrigen, $this->agregarTipoDefinicion("tablas"));
        # guardamos el script
        parent::guardarDefinicionesTablas();
        echo "<br>";

        # VISTAS
        $this->setLista($this->recuperarListaVistasNuevas());
        $this->archivoSalida = $this->agregarTipoDefinicion("vistas");
        $this->guardarDefinicion("VIEW", "Create View");
        echo "<br>";

        # TRIGGERS
        $this->setLista($this->recuperarListaTriggersNuevos());
        $this->archivoSalida = $this->agregarTipoDefinicion("triggers");
        $this->guardarDefinicion("TRIGGER", "SQL Original Statement");
        echo "<br>";

    }
}



?>