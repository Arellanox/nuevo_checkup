<?php

// Configuración de rutas de archivos
class FileConfig {
    // URL base para acceder a los archivos
    public static function getBaseUrl() {
        // Para desarrollo local
        return 'http://localhost/nuevo_checkup/';
        
        // Para producción cambiar por:
        // return 'https://tudominio.com/';
    }
    
    // Directorio base para uploads de postulaciones
    public static function getPostulacionesPath() {
        return $_SERVER['DOCUMENT_ROOT'] . '/nuevo_checkup/vista/menu/recursos_humanos/archivos/postulaciones/';
    }
    
    // URL para acceder a archivos de postulaciones
    public static function getPostulacionesUrl() {
        return self::getBaseUrl() . 'vista/menu/recursos_humanos/archivos/postulaciones/';
    }
    
    // Crear estructura de directorios por fecha para postulaciones
    public static function createPostulacionesDirectoryStructure() {
        $year = date('Y');
        $month = date('m');
        
        $relativePath = "vista/menu/recursos_humanos/archivos/postulaciones/{$year}/{$month}/";
        $fullPath = $_SERVER['DOCUMENT_ROOT'] . '/nuevo_checkup/' . $relativePath;
        
        if (!file_exists($fullPath)) {
            mkdir($fullPath, 0755, true);
        }
        
        return [
            'relative_path' => $relativePath,
            'full_path' => $fullPath,
            'url_path' => self::getBaseUrl() . $relativePath
        ];
    }
    
    // Generar nombre único para archivo
    public static function generateUniqueFileName($originalName, $prefix = '') {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $nameWithoutExt = pathinfo($originalName, PATHINFO_FILENAME);
        
        // Limpiar nombre de archivo
        $cleanName = preg_replace('/[^a-zA-Z0-9\-_]/', '_', $nameWithoutExt);
        $cleanName = substr($cleanName, 0, 50); // Limitar longitud
        
        $timestamp = time();
        $randomString = substr(str_shuffle('0123456789abcdefghijklmnopqrstuvwxyz'), 0, 6);
        
        return $prefix . $timestamp . '_' . $randomString . '_' . $cleanName . '.' . $extension;
    }
    
    // Validar tipos de archivo permitidos
    public static function isValidFileType($fileMimeType, $allowedTypes) {
        return in_array($fileMimeType, $allowedTypes);
    }
    
    // Validar tamaño de archivo
    public static function isValidFileSize($fileSize, $maxSize) {
        return $fileSize <= $maxSize;
    }
}
