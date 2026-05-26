<?php
//creamos json
$json = '{"Pedro":35,"Benito":37,"Joel":43}';
//decodificamos a objeto
$obj = json_decode($json);
// utilzamos la notación de objetos ya conocida,
// mostramos valores de propiedades,
// cada nombre del json se convierte en propiedad.
// Recuerda que tenemos la paridad 'nombre:valor' en json
echo $obj->Pedro;
echo '<br>';
echo $obj->Benito;
echo '<br>';
echo $obj->Joel;

//creamos json como ejemplo
$json = '{"Pedro":35,"Benito":37,"Joel":43}';
//usamos true para poder convertirlo en arreglo en vez de objeto
$arr = json_decode($json, true);
//utilzamos con la notación de arreglos ya conocida
// mostramos los valores asociados
// cada nombre del json se convierte en ubicación
//recuerda que tenemos la paridad 'nombre:valor' en json
echo $arr["Pedro"];
echo '<br>';
echo $arr["Benito"];
echo '<br>';
echo $arr["Joel"];