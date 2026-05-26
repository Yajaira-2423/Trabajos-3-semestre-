<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 1.4.1 - PHP</title>
</head>
<body>
<?php
// 1. Definir el nombre del archivo y el contenido (Agregamos el contenido que faltaba)
$nombreArchivo = "archivo_texto.txt";
$contenido = "Hola Mundo desde PHP\n";

// 2. Abrimos el archivo en modo escritura ("w")
// Se corrigió la posición del 'or die' para que sea válido
$archivo = fopen($nombreArchivo, "w") or die("Error al abrir el nuevo archivo");

// Escribimos y cerramos
fwrite($archivo, $contenido);
fclose($archivo);

// 3. Mostramos el contenido dentro de un div
echo "<div>";
// readfile imprime el texto y guarda el número de bytes en $bytes
$bytes = readfile($nombreArchivo);
echo "</div>";

echo "<p>Total de bytes leídos: $bytes</p>";
?>
</body>
</html>