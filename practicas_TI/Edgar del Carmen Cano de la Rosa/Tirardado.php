<h1 style="text-align:center ;"> Prueba tu suerte</h1>
<h2 style="text-align: center;"> Recarga para tirar 3 dados </h2>
<?php
include 'bimo.php';


#FUNCION DEL DADO 1
echo "Dado 1";

$tirar_dado1 = new Dado1();
$valor1 = $tirar_dado1->lanzarDado1();

if($valor1 == 6){
    echo '<h1 style="color:red;">Felicidades ganaste tu dado callo en '.$valor1.' </h1>';
}else{
    echo "<h1>Cara $valor1</h1>";
}

echo "<br><hr>";


#FUNCION DEL DADO 2
echo "Dado 2";
$tirar_dado2 = new Dado2();
$valor2 = $tirar_dado2->lanzarDado2();
if ($valor2 == 7) {
    echo '<h1 style="color:red;">Felicidades ganaste tu dado callo en '.$valor2.' </h1>';
} else {
    echo "<h1>Cara $valor2</h1>";
}

echo "<br><hr>";


#FUNCION DEL DADO 3
echo "Dado3";
$tirar_dado3 = new Dado3();
$valor3 = $tirar_dado3->lanzarDado3();
if ($valor3 == 8){
    echo '<h1 style="color:red;">Felicidades ganaste tu dado callo en '.$valor3.' </h1>';
} else {
    echo "<h1>Cara $valor3</h1>";
}





?>