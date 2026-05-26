<?php
session_start();

// Seguridad: evitar acceso sin login
if (!isset($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$nivel = $_SESSION['nivel'];

// ===============================
// CONEXIÓN CON auditoria.txt
// ===============================
$archivo = "auditoria.txt";
$lineas = [];
$ultimo = "Sin registros";

// Leer archivo si existe
if (file_exists($archivo)) {
    $lineas = file($archivo, FILE_IGNORE_NEW_LINES);
    
    if (count($lineas) > 0) {
        $ultimo = $lineas[count($lineas) - 1];
    }
}

// ===============================
// ESTADO DINÁMICO DEL SISTEMA
// ===============================
$estado = "OPERATIVO";
$color_estado = "#2ecc71"; // verde

if (strpos($ultimo, "ALARMA") !== false || strpos($ultimo, "DENEGADO") !== false) {
    $estado = "ALERTA";
    $color_estado = "#e74c3c"; // rojo
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Panel de Control - Nivel <?php echo $nivel; ?></title>

<style>
body { 
    font-family: 'Segoe UI', sans-serif; 
    background: #1a1a1a; 
    padding: 20px; 
    color: white;
}

.card { 
    background: #2d2d2d; 
    padding: 20px; 
    border-radius: 10px; 
    margin-bottom: 20px; 
    box-shadow: 0 4px 6px rgba(0,0,0,0.4); 
}

.nivel-1 { border-left: 8px solid #3498db; }
.nivel-2 { border-left: 8px solid #f1c40f; }
.nivel-3 { border-left: 8px solid #e74c3c; }

.badge { 
    padding: 5px 10px; 
    border-radius: 5px; 
    color: white; 
    font-size: 0.8em; 
}

.bg-blue { background: #3498db; }
.bg-gold { background: #f1c40f; }
.bg-red { background: #e74c3c; }

ul {
    padding-left: 20px;
}

li {
    margin-bottom: 5px;
}
</style>
</head>

<body>

<nav style="background: #2d2d2d; padding: 15px; border-radius: 8px; margin-bottom: 20px; display: flex; justify-content: space-between;">
    
    <div>
        <a href="pagina.php" style="color: #00ff00; text-decoration: none; margin-right: 20px;">[ Página principal ]</a>
        
        <?php if ($nivel == 3): ?>
            <a href="monitor.php" style="color: white; text-decoration: none;">[ Monitor de Auditoría ]</a>
        <?php endif; ?>
    </div>

    <div>
        <a href="logout.php" style="color: #ff4d4d; text-decoration: none;">[ Salir ]</a>
    </div>

</nav>

<!-- INFORMACIÓN DEL USUARIO -->
<div class="card">
    <h1>Bienvenido, <?php echo $_SESSION['usuario']; ?></h1>
    <p>Departamento: <strong><?php echo $_SESSION['departamento']; ?></strong></p>

    <span class="badge <?php echo ($nivel==3)?'bg-red':(($nivel==2)?'bg-gold':'bg-blue'); ?>">
        Nivel de Acceso: <?php echo $nivel; ?>
    </span>

    <hr>

    <p>Estado del sistema: 
        <strong style="color: <?php echo $color_estado; ?>;">
            <?php echo $estado; ?>
        </strong>
    </p>

    <p>Último evento:</p>
    <small><?php echo htmlspecialchars($ultimo); ?></small>
</div>

<!-- ESTADO GENERAL -->
<div class="card nivel-1">
    <h3>Estado General de la Planta</h3>
    <p>Estatus: <strong style="color: <?php echo $color_estado; ?>;"><?php echo $estado; ?></strong></p>
    <p>Última limpieza de tanques: 12/04/2026</p>
</div>

<!-- NIVEL 2 -->
<?php if ($nivel >= 2): ?>
<div class="card nivel-2">
    <h3>Datos de Supervisión</h3>
    <p>Temperatura Reactor 1: 74°C</p>
    <p>Presión de Tuberías: 120 PSI</p>
    <p>Personal en turno: 14 empleados</p>
</div>
<?php endif; ?>

<!-- NIVEL 3 -->
<?php if ($nivel == 3): ?>
<div class="card nivel-3">
    <h3>CONTROLES CRÍTICOS</h3>
    <p>Mezcla Química: <strong>Fórmula VX-90</strong></p>
    <p>Código de Autodestrucción: [RESTRINGIDO]</p>
    <button style="background:red; color:white; padding:10px;">
        DETENER REACTOR
    </button>
</div>
<!-- ÚLTIMOS ACCESOS -->
<div class="card">
    <h3>Últimos accesos registrados</h3>

    <?php if (count($lineas) > 0): ?>
        <ul>
        <?php 
        $contador = 0;
        foreach (array_reverse($lineas) as $linea): 
            $color = "white";

            if (strpos($linea, "ALARMA") !== false || strpos($linea, "DENEGADO") !== false) {
                $color = "#ff4d4d";
            }
        ?>
            <li style="color: <?php echo $color; ?>">
                <?php echo htmlspecialchars($linea); ?>
            </li>
        <?php 
            $contador++;
            if ($contador == 5) break;
        endforeach; 
        ?>
        </ul>
    <?php else: ?>
        <p>No hay registros aún.</p>
    <?php endif; ?>
</div>
<?php endif; ?>


</body>
</html>