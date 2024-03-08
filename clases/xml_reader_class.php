<?php

class CustomXMLReader {
    protected $xml; // Almacena el objeto SimpleXML

    // Constructor que carga el archivo XML
    public function CustomXMLReader($filePath) {
        if (file_exists($filePath)) {
            $this->xml = simplexml_load_file($filePath);
        } else {
            throw new Exception("El archivo no existe: " . $filePath);
        }
    }

    // Método para obtener el valor de una etiqueta dada
    public function getTagValue($tagName) {
        if (isset($this->xml->{$tagName})) {
            return (string)$this->xml->{$tagName};
        } else {
            throw new Exception("Etiqueta no encontrada: " . $tagName);
        }
    }

     // Método para obtener el valor de un atributo de una etiqueta específica
     public function getAttributeValue($tagName, $attributeName) {
        


        if (isset($this->xml->{$tagName}[$attributeName])) {
            return (string)$this->xml->{$tagName}[$attributeName];
        } elseif (isset($this->xml->{$tagName}->attributes()->{$attributeName})) {
            return (string)$this->xml->{$tagName}->attributes()->{$attributeName};
        } else {
            throw new Exception("Atributo '$attributeName' no encontrado en la etiqueta '$tagName'.");
        }
    }

     // Método para verificar si existe una etiqueta dada
     public function tagExists($tagName) {
        // Buscamos en todo el documento XML la etiqueta deseada
        foreach ($this->xml->xpath("//*[local-name() = '$tagName']") as $item) {
            return true; // La etiqueta existe
        }
        return false; // La etiqueta no fue encontrada
    }
    
    public function getAttributeValueWithoutNamespace($tagName, $attributeName) {
        // Construimos una consulta XPath que ignora los espacios de nombres para el nombre del tag
        // y busca cualquier elemento que tenga un atributo con el nombre especificado.
        $results = $this->xml->xpath("//*[local-name() = '$tagName']/@*[local-name() = '$attributeName']");
    
        if (!empty($results)) {
            // Si se encontraron resultados, devolvemos el valor del primer atributo encontrado.
            // La conversión a string asegura que obtenemos el valor textual del atributo.
            return (string) $results[0];
        } else {
            throw new Exception("Atributo '$attributeName' no encontrado en la etiqueta '$tagName'.");
        }
    }
}

