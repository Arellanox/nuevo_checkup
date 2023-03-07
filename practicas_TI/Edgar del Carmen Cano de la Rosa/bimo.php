<?php
#Dado 1
 class Dado1{

    function lanzarDado1(){
        $cara = rand(1, 6);
       return $cara;
       
    } 
}



#Dado 2
 class Dado2{

    function lanzarDado2()
    {
        $cara = rand(1, 7);
        return $cara;
    }
 }


 #Dado 3
class Dado3{

    function lanzarDado3()
    {
        $cara = rand(1, 8);
        return $cara;
    }
 }


?>