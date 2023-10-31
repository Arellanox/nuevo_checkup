<?php
class SQLFileDivider {
    private $inputFilePath;
    private $outputDirectory;
    private $commitCount;
    private $commitLimit;

    private $count;
    public function __construct($inputFilePath, $outputDirectory, $salt) {
        $this->inputFilePath = $inputFilePath;
        $this->outputDirectory = $outputDirectory;
        $this->commitCount = 0;
        $this->commitLimit = $salt;
        $this->count = 1;
    }

    public function divideSQLFile() {
        $fileHandle = fopen($this->inputFilePath, 'r');
        $outputFile = null;
        $buffer = '';

        if ($fileHandle) {
            while (!feof($fileHandle)) {
                $line = fgets($fileHandle);
                $buffer .= $line;

                if (strpos($line, 'COMMIT;') !== false) {
                    $this->commitCount++;

                    if ($this->commitCount === $this->commitLimit) {
                        echo "Creando parte " . $this->count . "...";
                        echo "<br>";
                        $outputFile = fopen($this->generateOutputFileName(), 'w');
                        $this->count++;

                        fwrite($outputFile, $buffer);
                        fclose($outputFile);
                        $buffer = '';
                        $this->commitCount = 0;
                    }
                }
            }

            if (!empty($buffer)) {
                // Si quedan líneas en el búfer, crea un archivo con ellas.
                echo "Creando parte " . $this->count . "...";
                echo "<br>";
                $outputFile = fopen($this->generateOutputFileName(), 'w');
                fwrite($outputFile, $buffer);
                fclose($outputFile);
            }

            fclose($fileHandle);
        }
        echo "Todo listo!";
    }
    private function generateOutputFileName() {
        $timestamp = time();
        return $this->outputDirectory . '/output_' . $timestamp .'_'. $this->count. '.sql';
    }
}

?>