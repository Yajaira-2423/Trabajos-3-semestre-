<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <title>Territorios</title>
</head>
<body>

<?php
    // Configuración del archivo
    $nombreArchivo = "territory_names2.csv";
    $archivo = fopen($nombreArchivo, "r") or die("No se puede abrir el archivo: $nombreArchivo");
    $datos = array();
?>

<div class="container">
    <h1 class="titulo">Territorios del Mundo</h1>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th>Abreviatura</th>
                <th>Nombre</th>
                <th>Nombre Oficial</th>
                <th>Nombres de Ciudadanos</th>
            </tr>
        </thead>
        <tbody>

        <?php
            // Ciclo para generar las filas dinámicamente
            while (($datos = fgetcsv($archivo, 0, ',', '"', '"')) !== false) {
                print("<tr>");
                foreach ($datos as $campo) {
                    print("<td>");
                    print("$campo");
                    print("</td>");
                }
                print("</tr>");
            }
            // Cerramos el archivo después del ciclo
            fclose($archivo);
        ?>

        </tbody>
    </table> </div>

</body>
</html>