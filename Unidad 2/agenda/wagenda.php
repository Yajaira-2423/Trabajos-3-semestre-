<?php
// Establecemos que el nombre de la agenda será agenda.csv
$nombreAgenda = "agenda.csv";

// Construimos la lista (arreglo) para el nuevo registro
$Registro = array();

// Verificamos si existe el archivo para calcular el número de registro (ID)
if (file_exists($nombreAgenda)) {
    // file() lee el archivo en un arreglo de líneas, count() las cuenta
    $numLineas = count(file($nombreAgenda));
} else {
    // Si el archivo no existe, empezamos desde cero
    $numLineas = 0;
}

// Capturamos los datos enviados por el formulario (POST)
$Registro[] = $numLineas + 1; // ID auto-incrementable
$Registro[] = $_POST['nombre'];
$Registro[] = $_POST['apellidos'];
$Registro[] = $_POST['fnacimiento'];
$Registro[] = $_POST['estadocivil'];
$Registro[] = $_POST['origen'];
$Registro[] = $_POST['correo'];
$Registro[] = $_POST['redess'];

// Abrimos el archivo en modo "a" (append / agregar al final)
$fp = fopen($nombreAgenda, "a") or die("No se puede abrir el archivo: $nombreAgenda");

// Escribiendo la línea en el archivo CSV
$resp = fputcsv($fp, $Registro, ',', '"', '"');

if ($resp === false) {
    die("Error al escribir en CSV");
}

// Cerramos el archivo para asegurar que se guarden los cambios
fclose($fp) or die("No se puede cerrar el archivo: $nombreAgenda");

// Enviamos mensaje de éxito al usuario
echo ("<h1> Se agregó el contacto a la agenda: $nombreAgenda </h1>");

// Redireccionamos a la página de contactos después de 3 segundos
header("refresh:3; url=contactos.php");
?>