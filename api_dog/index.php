<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>The Dog API - Razas de Perros</title>
<link rel="stylesheet" href="estilos.css">
</head>
<body>
<?php
include 'datosDogs.php';
?>
<h1>Imágenes de Perro</h1>
<h2>Lista aleatoria de Razas</h2>
<ul>
<?php
// Mostrar las imagenes de los perros obtenidos
foreach ($datos as $perro) {
$url = $perro['url'];
echo "<li><img src='$url' alt='Perro'></li>";
}
?>
</ul>
</body>
</html>