<?php
const API_KEY = '3bf3cc257d71066f505b59c479245ed4';
// Configuración de la ciudad, idioma y unidades
$cityID = '3999912'; // Cambia el valor ... por la ciudad de tu elección
$strCiudad = "Gómez Palacio"; // Nombre de la ciudad para mostrar en el mensaje final
$lenguaje = 'es';
$unidades = 'metric';
// URL-encodificar la ciudad
$city_encoded = urlencode($cityID);
$url ="https://api.openweathermap.org/data/2.5/weather?id={$cityID}&lang={$lenguaje}&units={$unidades}&appid=" . API_KEY;
// Se crea y Configura cURL para realizar la solicitud a la API
$urlSesion = curl_init();
// Configurar opciones de cURL
curl_setopt($urlSesion, CURLOPT_URL, $url);
// ...para manejar la respuesta
curl_setopt($urlSesion, CURLOPT_RETURNTRANSFER, true);
// ...para manejar errores y tiempos de espera
curl_setopt($urlSesion, CURLOPT_TIMEOUT, 10);
// ...para manejar encabezados y seguridad
curl_setopt($urlSesion, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)
AppleWebKit/537.36');
// ...para manejar certificados SSL (si es necesario)
curl_setopt($urlSesion, CURLOPT_SSL_VERIFYPEER, false);