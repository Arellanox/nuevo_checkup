<?php
require_once '../vendor/autoload.php';

use NumberToWords\NumberToWords;

function convertirNumeroATexto($numero)
{
    $numberToWords = new NumberToWords();
    $numberTransformer = $numberToWords->getNumberTransformer('es');

    $texto = $numberTransformer->toWords($numero);

    return $texto;
}
