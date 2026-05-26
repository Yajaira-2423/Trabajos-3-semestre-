<?php
const API_KEY = '3bf3cc257d71066f505b59c479245ed4';
// Configuración de la ciudad, idioma y unidades
$cityID = '4013706'; // Ciudad Lerdo
$strCiudad = "Ciudad Lerdo"; 
$lenguaje = 'es';
$unidades = 'metric';

// URL de la API (Asegúrate de que appid esté pegado)
$url = "https://api.openweathermap.org/data/2.5/weather?id={$cityID}&lang={$lenguaje}&units={$unidades}&appid=" . API_KEY;

// Configuración de cURL
$urlSesion = curl_init();
curl_setopt($urlSesion, CURLOPT_URL, $url);
curl_setopt($urlSesion, CURLOPT_RETURNTRANSFER, true);
curl_setopt($urlSesion, CURLOPT_TIMEOUT, 10);
curl_setopt($urlSesion, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
curl_setopt($urlSesion, CURLOPT_SSL_VERIFYPEER, false);
?>