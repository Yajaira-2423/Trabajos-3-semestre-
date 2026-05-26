<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    <title>Contactos</title>
</head>
<body>

<?php
    $nombreArchivo = "agenda.csv";
    // Verificamos si el archivo existe antes de intentar abrirlo para evitar errores
    if (file_exists($nombreArchivo)) {
        $archivo = fopen($nombreArchivo, "r") or die("No se puede abrir el archivo: $nombreArchivo");
    } else {
        echo "<div class='container mt-5'><div class='alert alert-warning'>Aún no hay contactos registrados.</div></div>";
        exit;
    }
?>

<div class="container mt-4">
    <h1 class="titulo">Contactos</h1>
    
    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="thead-dark">
                <tr>
                    <th># de contacto</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Fecha de nacimiento</th>
                    <th>Estado civil</th>
                    <th>Origen</th>
                    <th>Email</th>
                    <th>Redes sociales</th>
                </tr>
            </thead>
            
            <tbody>
            <?php
                // Recorremos la agenda línea por línea
                while (($datos = fgetcsv($archivo, 0, ',', '"', '"')) !== false) {
                    print("<tr>");
                    foreach ($datos as $campo) {
                        print("<td>" . htmlspecialchars($campo) . "</td>");
                    }
                    print("</tr>");
                }
                fclose($archivo);
            ?>
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        <a href="index.php" class="btn btn-secondary">Agregar nuevo contacto</a>
    </div>
</div>

</body>
</html>