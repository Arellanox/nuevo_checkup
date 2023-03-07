<?php
class  dado{

    function lanza_dado(){
        $lado = 1;
        $lado2 = 2;
        $lado3 = 3;
        $lado4 = 4;
        $lado5 = 5;
        $lado6 = 6;

        return  $lado6;
    }
}
class  dado2{

    function lanza_dado(){
        $lado = 1;
        $lado2 = 2;
        $lado3 = 3;
        $lado4 = 4;
        $lado5 = 5;
        $lado6 = 6;
        $lado7 = 7;

        return $lado7;


    }
}
class  dado3{

    function lanza_dado(){
        $lado = 1;
        $lado2 = 2;
        $lado3 = 3;
        $lado4 = 4;
        $lado5 = 5;
        $lado6 = 6;
        $lado7 = 7;
        $lado8 = 8;

        return $lado8;
    }
    

}
   $lanza = new dado();
   $lanza2 = new dado2();
   $lanza3 = new dado3();


    $dado = $lanza->dado();
    $dado2 = $lanza2->dado2();
    $dado3 = $lanza3->daod3();

   switch(true){
case $dado == 6: 
print ("Ganaste");
break;
case $dado2 == 7: 
    print ("Ganaste");
    break;
    case $dado3 == 7: 
        print ("Ganaste");
        break;
        default:
        print("No hay ningun resulatdo");
        break;
   }
    
    print $lanza;
?>