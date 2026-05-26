<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="bootstrap.min.css" />
    <link rel="stylesheet" href="estilos.css" />
    <title>Tabla viajes</title>
</head>

<body>
<div class="container">

    <h1 class="titulo">Tabla de tiempos a otras ciudades desde filadelfia</h1>

    <div class="table-responsive">
        <table class="table table-hover tabla-dinamica">
            <thead>
                <tr>
                    <th>Destino</th>
                    <th>Auto</th>
                    <th>Autobus</th>
                    <th>Bicicleta</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $lista = array(
                    array("Nueva York", "1 h 51 min", "1 h 22 min", "8 h 53 min"),
                    array("Allentown", "1 h 11 min", "-", "6 h 9 min"),
                    array("Reading", "1 h 12 min", "-", "5 h 53 min")
                );

                $tam = count($lista);
                for ($r = 0; $r < $tam; $r++) {
                    echo "<tr>";
                    echo "<td>" . $lista[$r][0] . "</td>";
                    echo "<td>" . $lista[$r][1] . "</td>";
                    echo "<td>" . $lista[$r][2] . "</td>";
                    echo "<td>" . $lista[$r][3] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>