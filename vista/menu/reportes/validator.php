<?php
class AreaValidator {

    // Lista de áreas permitidas con sus IDs (basada en tu tabla)
    private static $areas_permitidas = [
        1  => 'CONSULTORIO',
        2  => 'SOMATOMETRIA',
        3  => 'OFTALMOLOGIA',
        4  => 'AUDIOMETRIA',
        5  => 'ESPIROMETRIA',
        6  => 'LABORATORIO CLÍNICO',
        7  => 'IMAGENOLOGÍA',
        8  => 'RX',
        9  => 'PRUEBA DE ESFUERZO',
        10 => 'ELECTROCARDIOGRAMA',
        11 => 'ULTRASONIDO',
        12 => 'LABORATORIO BIOMOLECULAR',
        13 => 'CITOLOGÍA',
        14 => 'NUTRICION',
        15 => 'COTIZACIONES',
        16 => 'TICKET',
        17 => 'CORTE',
        18 => 'CARDIOLOGÍA',
        19 => 'CHECKUPS',
        20 => 'PSICOLOGÍA',
        21 => 'PEDIATRIA',
        22 => 'GERIATRIA'
    ];

    /**
     * Obtiene el área de POST o GET y la valida
     * @return array - ['valida' => bool, 'area' => string, 'id' => int|null, 'normalizada' => string]
     */
    public static function validarArea(): array
    {
        $area = $_POST['area'] ?? $_GET['area'] ?? null;
        $area_normalizada = $area ? strtolower(str_replace([' ', 'Í', 'Ó'], ['_', 'i', 'o'], trim($area))) : '';

        // Buscar el ID del área
        $id_area = null;
        $area_valida = 0;

        if (!empty($area)) {
            foreach (self::$areas_permitidas as $id => $nombre) {
                if ($nombre === $area) {
                    $id_area = $id;
                    $area_valida = 1;
                    break;
                }
            }
        }

        return [
            'valida' => $area_valida,
            'area' => $area,
            'id' => $id_area,
            'normalizada' => $area_normalizada,
            'areas_disponibles' => array_values(self::$areas_permitidas)
        ];
    }

    /**
     * Obtiene todas las áreas disponibles
     * @return array
     */
    public static function getAreasDisponibles(): array
    {
        return self::$areas_permitidas;
    }

    /**
     * Obtiene el ID de un área por su nombre
     * @param string $nombre_area
     * @return int|null
     */
    public static function getIdPorNombre($nombre_area): ?int
    {
        if (empty($nombre_area)) {
            return null;
        }

        $nombre_normalizado = strtoupper(trim($nombre_area));

        foreach (self::$areas_permitidas as $id => $nombre) {
            if ($nombre === $nombre_normalizado) {
                return $id;
            }
        }

        return null;
    }

    /**
     * Verifica si un área existe por nombre
     * @param string $nombre_area
     * @return bool
     */
    public static function existeArea(string $nombre_area): bool
    {
        if (empty($nombre_area)) {
            return false;
        }

        $nombre_normalizado = strtoupper(trim($nombre_area));
        return in_array($nombre_normalizado, self::$areas_permitidas);
    }

    /**
     * Genera el HTML de error cuando el área no es válida
     * @param array $resultado - Resultado de validarArea()
     * @return string
     */
    public static function generarHtmlError(array $resultado): string
    {
        $area_recibida = htmlspecialchars($resultado['area'] ?? 'sin definir');
        $areas_ejemplos = implode(', ', array_slice(self::$areas_permitidas, 0, 5));

        return '
            <div class="d-flex flex-column align-items-center justify-content-center text-center" style="height: calc(100vh - 100px)">
                <div class="p-4 p-md-5 w-100" style="max-width: 600px; ">
                    <!-- Mensaje principal -->
                    
                    <div class="d-flex flex-column align-items-center justify-content-center text-center">
                        <i class="bi bi-exclamation-triangle display-1 text-danger mb-4"></i>
                        <h1 class="mb-2">Área no válida </h1>
                        <p class="lead">El área <code class="bg-danger px-2 py-1 rounded text-white font-bold">' . htmlspecialchars($area_recibida) . '</code> no está permitida.</p>
                        <p class=" mt-2 " style="color: #777777; font-size: 0.9rem; font-weight: lighter">Esta solicitud no cumple con los parámetros de seguridad establecidos, por favor, accede desde una vista válida o contacta al administrador.</p>
                       
                    </div>
                  
                    <!-- Ejemplos de áreas válidas -->
                    <div class="p-3 my-4">
                        <h6 class="text-success mb-2">
                            <i class="bi bi-check-circle me-2"></i>
                            Áreas válidas disponibles:
                        </h6>
                        <div class="d-flex flex-wrap gap-2 justify-content-center">
                            ' . implode('', array_map(function($area) {
                            return '<span class="badge bg-success bg-opacity-75 px-3 py-2">' . htmlspecialchars($area) . '</span>';
                        }, explode(', ', $areas_ejemplos))) . '
                        </div>
                    </div>
                </div>
            </div>
        ';
    }
}