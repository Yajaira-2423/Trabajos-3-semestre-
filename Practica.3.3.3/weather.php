<?php
// Incluir el archivo de configuración para obtener la URL ($url)
require_once 'config.php';
echo "<strong>URL:</strong> <pre>$url</pre><br>"; // Imprime la URL para verificar que se ha construido correctamente
echo "<br><br>"; // Salto de línea para mejor legibilidad
//se ejecuta la solicitud y se obtiene la respuesta
$response = curl_exec($urlSesion);
//$response = file_get_contents($url, false, stream_context_create($arrContextOptions));
// Obtener el código de respuesta HTTP y cualquier error de cURL
$http_code = curl_getinfo($urlSesion, CURLINFO_HTTP_CODE);
$curl_error = curl_error($urlSesion);
curl_close($urlSesion);
echo $response; // Imprime la respuesta JSON para verificar que se ha recibido correctamente
echo "<br><br>"; // Salto de línea para mejor legibilidad
$data = json_decode($response, true);
var_dump($data); // Imprime la estructura del objeto para verificar que se ha decodificado correctamente
echo "<br><br>"; // Salto de línea para mejor legibilidad
//mostrar la temperatura y descripción del clima
if (isset($data['main'] ['temp']) && isset($data['weather'] [0] ['description'])) {
$temperatura = $data['main']['temp'];
$descripcion = $data['weather'][0]['description'];
echo "<p>La temperatura actual en $strCiudad es de $temperatura °C con $descripcion.</p>";
} else {
echo "<p>No se pudieron obtener los datos meteorológicos para $strCiudad.</p>";
 }