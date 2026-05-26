<?php
/**
* Archivo: datosDogs.php
* Descripción: Este archivo obtiene datos de perros desde la API de The Dog API.
* Autor: [Jesús Salas Marín]
* Fecha: [23 / 03 / 2026]
*/
// URL para obtener imagenes de perros (limitado a 2 para no saturar la respuesta)
$url = "https://api.thedogapi.com/v1/images/search?limit=2";
// Hacer la solicitud para obtener las imágenes aleatorias de un perro
$respuesta = file_get_contents($url);
// Decodificar la respuesta JSON para obtener los datos de las imágenes
$datos = json_decode($respuesta, true);
?>