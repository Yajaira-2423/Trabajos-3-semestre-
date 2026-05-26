<?php 
//arreglo asociativo con edades 
$edades = array("Pedro"=>35, "Benito"=>37, "Joel"=>43); 
//convertimos arreglo asociativo en json 
$mijson = json_encode($edades); 
//mostrammos variable 
echo $mijson; 

//arreglo normal -indexado 
$autos = array("Volvo", "BMW", "Toyota"); 
//convertimos arreglo asociativo en json 
$mijson = json_encode($autos); 
//mostrammos variable 
echo $mijson;

$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5); $x = json_encode($arr); 
echo $x; 

