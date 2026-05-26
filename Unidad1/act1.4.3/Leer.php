<?php 
// Tratamos de abrir el archivo, si no se puede  
// mandamos un mensaje: no se puede abrir...  
$miArchivo = fopen("miDiccionario.txt", "r") 
or die("No se puede abrir el archivo!"); 
// Utilizamos un ciclo while para recorrer línea a línea  
// el archivo mientras no sea fin de archivo 
// y obtenemos dicha línea y la mostramos 
while (!feof($miArchivo)) { 
$linea = fgets($miArchivo); 
echo ($linea). "<br>"; 
}
// cerramos el archivo 
fclose($miArchivo); 
?> 