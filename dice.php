<?php
echo $_SERVER['SERVER_NAME'];
$arr1 = array("hoola"=>1,2,3);
$arr2 = array(4,5,6);

$arr = array_merge($arr1, $arr2);

print_r($arr);

echo date("dmY_His");
class Dice {
    public $num_sides;

    function Dice(){
        $this->num_sides = 6;
    }

    function setNumSides($sides){
        $this->num_sides = $sides;
    }

    function getNumSides(){
        return $this->num_sides;
    }

    function roll($sides){
        $roll = rand(1,$sides);
        
        return $roll;
    }
}

$dados = array();

for ($i=0; $i < 3; $i++) { 
    $dados[] = new Dice();
}


foreach($dados as $dado){
    $dado->setNumSides(12);
}

$acumulador = 0;

foreach($dados as $dado){
    $resultado = $dado->roll($dado->getNumSides());
    echo "Este dado cayó en : ".$resultado;
    echo "<br>";
    $acumulador = $acumulador + $resultado;
}

if($acumulador==36){
    echo "<h1>¡Ganaste!</h1>";
}else{
    echo "<h1>Intenta de nuevo</h1>";
}

print_r($dados);

?>