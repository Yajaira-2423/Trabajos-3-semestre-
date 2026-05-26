<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráfica 2 - Análisis de Líneas</title>
    
    <link rel="stylesheet" href="./css/chartist.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/chartist.min.js"></script>

    <style>
        /* 1. ESTILOS DE LA GRÁFICA DE LÍNEAS */
        /* Serie A: Temperaturas Máximas (Naranja) */
        .ct-series-a .ct-line {
            stroke: #ff5722; 
            stroke-width: 4px;
        }
        .ct-series-a .ct-point {
            stroke: #ff5722;
            stroke-width: 10px;
        }

        /* Serie B: Temperaturas Mínimas (Azul) */
        .ct-series-b .ct-line {
            stroke: #0277bd;
            stroke-width: 4px;
        }
        .ct-series-b .ct-point {
            stroke: #0277bd;
            stroke-width: 10px;
        }

        /* 2. ESTILOS DE LA INTERFAZ */
        .centro { text-align: center; margin-top: 30px; margin-bottom: 30px; }
        .temp-container { display: flex; justify-content: center; gap: 30px; margin-bottom: 15px; }
        .leyenda-item { display: flex; align-items: center; font-weight: bold; }
        .box { width: 40px; height: 15px; margin-right: 10px; border-radius: 3px; }
        .max { background-color: #ff5722; }
        .min { background-color: #0277bd; }
        .subt { color: #673ab7; font-size: 1.2rem; display: block; margin-top: 5px; }
        
        /* Ajuste de altura para que se vea mejor en PC */
        .ct-chart { height: 400px; }
    </style>
</head>
<body>

<div class="container">
    <div class="centro">
        <h1>Análisis de Temperaturas Mayo 2019</h1>
        <div class="temp-container">
            <div class="leyenda-item"><div class="box max"></div> Máximas</div>
            <div class="leyenda-item"><div class="box min"></div> Mínimas</div>
        </div>
        <span class="subt">Gráfica 2: Evolución Temporal (Líneas)</span>
    </div>

    <div class="ct-chart ct-octave"></div>

    <?php
    // Lógica PHP para extraer datos del CSV
    $archivoTemps = "./csv/tempMyMWeek2.csv";
    
    if (file_exists($archivoTemps)) {
        $handle = fopen($archivoTemps, "r");
        $d_encabezados = fgetcsv($handle, 0, ',', '"');
        $d_temp_max = fgetcsv($handle, 0, ',', '"');
        $d_temp_min = fgetcsv($handle, 0, ',', '"');
        fclose($handle);
    } else {
        die("<div class='alert alert-danger'>Error: No se encontró el archivo $archivoTemps</div>");
    }
    ?>

    <script>
    // Configuración de Datos
    var datos = {
        labels: <?php echo json_encode($d_encabezados); ?>,
        series: [
            {
                name: 'Máximas',
                data: [<?php echo implode(',', $d_temp_max); ?>]
            },
            {
                name: 'Mínimas',
                data: [<?php echo implode(',', $d_temp_min); ?>]
            }
        ]
    };

    // Opciones de la Gráfica de Líneas
    var opciones = {
        fullWidth: true,
        showPoint: true,         // Mostrar los puntos en cada día
        lineSmooth: Chartist.Interpolation.cardinal({
            tension: 0.2         // Suaviza la línea ligeramente
        }),
        chartPadding: { right: 40, bottom: 20 },
        axisX: {
            position: 'end',     // Etiquetas en la parte inferior
            showGrid: true
        },
        axisY: {
            type: Chartist.FixedScaleAxis,
            ticks: [0, 10, 20, 30, 40, 50],
            low: 0,
            high: 45
        }
    };

    // Opciones para dispositivos móviles
    var opcionesResponsive = [
        ['screen and (max-width: 640px)', {
            axisX: {
                labelInterpolationFnc: function(value) {
                    return value[0]; // En celular solo muestra la inicial (j, v, s...)
                }
            }
        }]
    ];

    // INICIALIZACIÓN COMO LÍNEA
    new Chartist.Line('.ct-chart', datos, opciones, opcionesResponsive);
    </script>
</div>

</body>
</html>