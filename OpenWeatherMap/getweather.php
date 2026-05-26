<?php
require_once 'config.php';

function obtenerClima($cityID) {
    // Usamos la API_KEY definida en config.php
    $apiKey = API_KEY;
    $url = "https://api.openweathermap.org/data/2.5/weather?id={$cityID}&lang=es&units=metric&appid={$apiKey}";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    
    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}
?>