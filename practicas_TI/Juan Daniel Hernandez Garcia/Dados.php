<?php
    class Dado1{
        public function Dado1(){
            $r = rand(1,6);

            return $r;
        }
    }

    class Dado2{
        public function Dado2 (){
            $r = rand(1,7);

            return $r;
        }
    }

    class Dado3{
        public function Dado3 (){
            $r = rand(1,8);

            return $r;
        }
    }

    $tirar_dado1 = new Dado1();
    $tirar_dado2 = new Dado2();
    $tirar_dado3 = new Dado3();

    $dado1 = $tirar_dado1->Dado1();
    $dado2 = $tirar_dado2->Dado2();
    $dado3 = $tirar_dado3->Dado3();

    switch (true) {
        case $dado1 > 5:
            # code...
            print ("Felicidades Ganaste tirando el dado1" . "</br> "."Numero:". $dado1 ."</br> ");
            break;
        case $dado2 > 6:
            # code...
            print ("Felicidades Ganaste tirando el dado2" ."</br> "."Numero:". $dado2 ."</br> ");
            break;
        case $dado3 > 7:
            # code...
            print ("Felicidades Ganaste tirando el dado3" ." </br>"."Numero:". $dado3 ."</br> ");
            break;
        default:
            # code...
            print ("Que mala suerte, ningun dado callo en su maximo");
            break;
    }
