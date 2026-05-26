<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica de temperatura durante 10 hrs</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/estilos.css">
    
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="centro">
            <h1>Temperaturas tomadas en un lapso de 10 horas</h1>
            <span class="subt">Horario de: 14:00 del día 23 de mayo hasta las 10:00 del día 24 de mayo de 2019</span>
        </div>

        <div class="ct-chart ct-octave"></div>

        <?php
        // 1. Ubicación del archivo JSON
        $archivo = './json/tempMyMByHour-14hrs.json';

        // 2. Lectura del archivo
        if (file_exists($archivo)) {
            $handle = fopen($archivo, 'r') or die("Error: No se puede abrir el archivo json");
            $size = filesize($archivo);
            $contenido = fread($handle, $size);
            fclose($handle);

            // 3. Convertir JSON a arreglo de PHP
            $listaTemper = json_decode($contenido, true);

            // 4. Separar etiquetas (horas) y valores (temperaturas)
            $lista_labels = array_keys($listaTemper);
            $lista_valores = array_values($listaTemper);
        } else {
            echo "<script>console.error('Archivo JSON no encontrado en: $archivo');</script>";
            $lista_labels = [];
            $lista_valores = [];
        }
        ?>

        <script>
        // CONFIGURACIÓN DE DATOS (Recibidos desde PHP)
        var datos = {
            labels: <?php echo json_encode($lista_labels); ?>,
            series: [{
                name: 'serie-1',
                data: <?php echo json_encode($lista_valores); ?>
            }]
        };

        // CONFIGURACIÓN DE OPCIONES
        var opciones = {
            fullWidth: true,
            showArea: true,    // Habilita el sombreado bajo la curva
            showLine: false,   // Oculta la línea sólida (según la imagen de la práctica)
            showPoint: false,  // Oculta los puntos de los valores (cambiar a true para ejercicio extra)
            chartPadding: {
                bottom: 60,
                right: 35,
                left: 10
            },
            axisX: {
                position: 'start' // Coloca las etiquetas de las horas arriba
            },
            axisY: {
                type: Chartist.FixedScaleAxis,
                ticks: [0, 20, 25, 30, 35, 40],
                low: 20,
                high: 40
            },
            series: {
                'serie-1': {
                    // Crea el efecto de curva suave (Interpolación Cardinal)
                    lineSmooth: Chartist.Interpolation.cardinal()
                }
            }
        };

        // OPCIONES PARA DISEÑO RESPONSIVO (Pantallas pequeñas)
        var opcionesResponsive = [
            ['screen and (max-width: 640px)', {
                series: {
                    'serie-1': {
                        lineSmooth: Chartist.Interpolation.none() // Quita el suavizado en móviles
                    }
                }
            }]
        ];

        // INICIALIZACIÓN DE LA GRÁFICA
        // Se usa Chartist.Line para representar áreas con curvas
        new Chartist.Line('.ct-chart', datos, opciones, opcionesResponsive);
        </script>
    </div>
</body>
</html>