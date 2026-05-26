<?php
/* * Archivo: prueba.php
* Descripción: Este archivo es una prueba para mostrar cómo obtener imágenes de perros utilizando la
API de The Dog API.
* Se hace uso de var_dump para mostrar los datos obtenidos de la API,
* y se obtiene la URL, ancho y alto de la imagen del perro.
* Autor: [Jesús Salas Marín]
* Fecha: [23 / 03 / 2026]
*/
// URL para obtener imagenes de perros (limitado a 2 para no saturar la respuesta)
$url = "https://api.thedogapi.com/v1/images/search?limit=2";
// Hacer la solicitud para obtener las imágenes aleatorias de un perro
$respuesta = file_get_contents($url);
// Decodificar la respuesta JSON para obtener los datos de las imágenes
$datos = json_decode($respuesta, true);
// Mostrar los datos obtenidos (opcional, para depuración)
var_dump($datos);
// Obtener la URL de la imagen del perro (tomando la primera imagen de la respuesta)
$imagen_perro = $datos[0]['url'];
// obtener el ancho y alto de la imagen
$ancho = $datos[0]['width'];
$alto = $datos[0]['height'];
//se muestran los datos obtenidos
echo "<hr>";
echo "<b>URL de la imagen del perro: </b>" . $imagen_perro . "<br>";
echo "<b>Ancho de la imagen: </b>" . $ancho . " px<br>";
echo "<b>Alto de la imagen: </b>" . $alto . " px<br>";
?>