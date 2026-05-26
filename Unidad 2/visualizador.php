<?php
// Leer el archivo generado por Python
$json_data = file_get_contents('inventario.json');
$productos = json_decode($json_data, true);
echo "<h1>Panel de Inventario</h1>";
echo "<ul>";
foreach ($productos as $item) {
$color = ($item['stock'] < 10) ? "red" : "black";
echo "<li style='color: $color;'>";
echo "<strong>{$item['producto']}</strong> - \${$item['precio']} (Stock:
{$item['stock']})";
echo "</li>";
}
echo "</ul>";
?>