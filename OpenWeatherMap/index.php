<?php include("./getweather.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reto: 5 Ciudades - OpenWeatherMap</title>
    <link rel="stylesheet" href="estilos.css"> </head>
        <style>
        /* Estilos básicos para la tabla */
        table { width: 100%; border-collapse: collapse; margin: 20px 0; font-family: Arial; }
        table thead { background-color: #4CAF50; color: white; }
        table th, table td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        img { width: 50px; }
    </style>
<body>

    <h1>Reporte Meteorológico de 5 Ciudades</h1>

    <table>
        <thead>
            <tr>
                <th>Ciudad</th>
                <th>Temperatura</th>
                <th>Mínima</th>
                <th>Máxima</th>
                <th>Humedad</th>
                <th>Descripción</th>
                <th>Icono</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Arreglo con IDs de 5 ciudades (Lerdo, Torreón, Gómez Palacio, Monterrey, Durango)
            $ciudades = [
                '4013706' => 'Ciudad Lerdo',
                '3981609' => 'Torreón',
                '3999912' => 'Gómez Palacio',
                '3995465' => 'Monterrey',
                '4011743' => 'Durango'
            ];

            foreach ($ciudades as $id => $nombre) {
                $data = obtenerClima($id);
                
                if ($data && isset($data['main'])) {
                    $temp = $data['main']['temp'];
                    $min = $data['main']['temp_min'];
                    $max = $data['main']['temp_max'];
                    $hum = $data['main']['humidity'];
                    $desc = $data['weather'][0]['description'];
                    $icon = $data['weather'][0]['icon'];
            ?>
                <tr>
                    <td><strong><?php echo $nombre; ?></strong></td>
                    <td><?php echo $temp; ?> °C</td>
                    <td> <?php echo $min; ?> °C</td>
                    <td> <?php echo $max; ?> °C</td>
                    <td> <?php echo $hum; ?>%</td>
                    <td><?php echo ucfirst($desc); ?></td>
                    <td>
                        <img src="https://openweathermap.org/img/wn/<?php echo $icon; ?>.png" alt="clima">
                    </td>
                </tr>
            <?php 
                } // Fin del if
            } // Fin del foreach 
            ?>
        </tbody>
    </table>

</body>
</html>