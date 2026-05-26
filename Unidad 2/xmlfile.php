<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lectura de XML - Biblioteca</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body { padding: 20px; }
        h3 { margin-top: 30px; color: #333; }
        .dump-box { background: #f4f4f4; padding: 10px; border: 1px solid #ccc; margin-bottom: 20px; }
    </style>
</head>
<body>

<?php
$nombreArchivo = "biblioteca.xml";

if (file_exists($nombreArchivo)) {
    $miXML = simplexml_load_file($nombreArchivo) or die("Error: No se puede crear el objeto SimpleXMLElement");

    echo "<h2>Pruebas de depuración (var_dump):</h2>";
    
    echo "<h6>1. Objeto completo:</h6> <pre class='dump-box'>";
    var_dump($miXML);
    echo "</pre>";

    echo "<h6>2. Primer libro [0]:</h6> <pre class='dump-box'>";
    var_dump($miXML->libro[0]);
    echo "</pre>";

    echo "<h6>3. Atributos del primer libro:</h6> <pre class='dump-box'>";
    var_dump($miXML->libro[0]->attributes());
    echo "</pre>";

    echo "<hr><h2>Accesos específicos (Echo):</h2>";

    // Mostramos de manera legible el atributo isbn del primer libro (tres maneras)
    echo "<b>ISBN (Método 1):</b> " . ($miXML->libro[0]->attributes()->isbn) . "<br>";
    echo "<b>ISBN (Método 2):</b> " . ($miXML->libro[0]->attributes()[0]) . "<br>";
    echo "<b>ISBN (Método 3):</b> " . ($miXML->libro[0]->attributes()['isbn']) . "<br>";

    // Mostramos el autor del segundo libro
    echo "<b>Autor del 2do libro:</b> " . ($miXML->libro[1]->autor) . "<br>";

    // Accedemos/capturamos el título, precio y la moneda del tercer libro
    $nombreLibro3 = $miXML->libro[2]->titulo;
    $precioLibro3 = $miXML->libro[2]->precio;
    $monedaLibro3 = $miXML->libro[2]->precio->attributes()['moneda'];

    echo "<b>Resumen 3er Libro:</b> El tercer Libro \"" . $nombreLibro3 . "\" cuesta " . $precioLibro3 . " en " . $monedaLibro3 . "<br>";

    echo "<hr><h3>Listado Completo de la Biblioteca (Final de Práctica)</h3>";
    
    // Generación dinámica de la tabla
    echo "<table class='table table-bordered table-striped'>";
    echo "<thead class='thead-dark'>
            <tr>
                <th>ISBN</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Año</th>
                <th>Editorial</th>
                <th>Idioma</th>
                <th>Precio</th>
            </tr>
          </thead>";
    echo "<tbody>";

    // Ciclo para recorrer todos los libros del XML
    foreach ($miXML->libro as $libro) {
        echo "<tr>";
        echo "<td>" . $libro->attributes()->isbn . "</td>";
        echo "<td>" . $libro->titulo . "</td>";
        echo "<td>" . $libro->autor . "</td>";
        echo "<td>" . $libro->anio . "</td>";
        echo "<td>" . $libro->editorial . "</td>";
        echo "<td>" . $libro->idioma . "</td>";
        echo "<td>" . $libro->precio . " (" . $libro->precio->attributes()['moneda'] . ")</td>";
        echo "</tr>";
    }

    echo "</tbody></table>";

} else {
    echo "<div class='alert alert-danger'>Error: No se encontró el archivo $nombreArchivo</div>";
}
?>

</body>
</html>