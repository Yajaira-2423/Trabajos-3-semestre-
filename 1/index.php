<?php
session_start(); // Inicia o reanuda una sesión para manejar datos del usuario

// Configuraciones mínimas: rutas de archivos
define('USUARIOS_JSON', __DIR__ . '/usuarios.json'); // Archivo donde están los usuarios
define('AUDIT_LOG', __DIR__ . '/auditoria.txt'); // Archivo donde se guardan los registros (logs)

// Función para escribir en el log con bloqueo (evita conflictos si varios escriben al mismo tiempo)
function append_log($texto) {
    $fh = fopen(AUDIT_LOG, 'a'); // Abre el archivo en modo "append" (agregar al final)
    if ($fh === false) return false; // Si falla, termina

    // Bloqueo exclusivo del archivo (solo un proceso escribe a la vez)
    if (flock($fh, LOCK_EX)) {
        fwrite($fh, $texto); // Escribe el texto en el archivo
        fflush($fh); // Fuerza la escritura inmediata
        flock($fh, LOCK_UN); // Libera el bloqueo
    }

    fclose($fh); // Cierra el archivo
    return true;
}

// Verifica que sea una petición POST y que venga el campo id_tarjeta
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_tarjeta'])) {

    // Limpia espacios en blanco del ID ingresado
    $id_ingresado = trim($_POST['id_tarjeta']);

    // Validación: solo números y longitud entre 2 y 10 caracteres
    if ($id_ingresado === '' || !preg_match('/^\d{2,10}$/', $id_ingresado)) {
        $error = "ID inválido. Verifique el formato.";
    } else {

        // Verifica que exista el archivo de usuarios
        if (!file_exists(USUARIOS_JSON)) {
            $error = "Error interno: archivo de usuarios no encontrado.";

            // Registra el error en el log
            $timestamp = date("Y-m-d H:i:s");
            append_log("[$timestamp] ERROR: usuarios.json no encontrado\n");

        } else {
            // Lee el contenido del JSON
            $json_content = file_get_contents(USUARIOS_JSON);

            // Convierte JSON a arreglo PHP
            $usuarios = json_decode($json_content, true);

            // Verifica si hubo error al decodificar
            if (json_last_error() !== JSON_ERROR_NONE) {
                $err = json_last_error_msg();
                $error = "Error interno: usuarios.json inválido.";

                // Registra el error en el log
                $timestamp = date("Y-m-d H:i:s");
                append_log("[$timestamp] ERROR: JSON mal formado - $err\n");

            } else {
                // Buscar el usuario en el arreglo
                $encontrado = null;

                if (is_array($usuarios)) {
                    foreach ($usuarios as $u) {
                        // Compara el ID ingresado con el del usuario
                        if (isset($u['id_tarjeta']) && (string)$u['id_tarjeta'] === $id_ingresado) {
                            $encontrado = $u; // Usuario encontrado
                            break;
                        }
                    }
                }

                $timestamp = date("Y-m-d H:i:s");

                if ($encontrado) {
                    // Extrae datos del usuario (con valores por defecto)
                    $nombre = $encontrado['nombre_empleado'] ?? 'Usuario';
                    $depto  = $encontrado['departamento'] ?? 'Desconocido';
                    $nivel  = $encontrado['nivel_seguridad'] ?? 1;

                    // Registra acceso exitoso
                    $log = "[$timestamp] ACCESO CONCEDIDO: $nombre ($depto)\n";
                    append_log($log);

                    // Seguridad: regenera el ID de sesión
                    session_regenerate_id(true);

                    // Guarda datos en sesión
                    $_SESSION['usuario'] = $nombre;
                    $_SESSION['departamento'] = $depto;
                    $_SESSION['nivel'] = $nivel;

                    // Redirige a la página principal
                    header("Location: pagina.php");
                    exit();

                } else {
                    // Usuario no encontrado: intento fallido
                    $log = "[$timestamp] ALERTA: Intento fallido con ID: $id_ingresado\n";
                    append_log($log);

                    $error = "ID NO REGISTRADO EN EL SISTEMA";
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Acceso Planta Química - BioCorp</title>
    <style>
        body { background: #1a1a1a; color: white; font-family: 'Segoe UI', sans-serif; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-card { background: #2d2d2d; padding: 40px; border-radius: 15px; border-top: 5px solid #00ff00; box-shadow: 0 10px 30px rgba(0,0,0,0.5); text-align: center; }
        input { padding: 10px; width: 80%; margin-top: 20px; border-radius: 5px; border: none; font-size: 1.2rem; text-align: center; color: black; }
        button { margin-top: 20px; padding: 10px 30px; background: #00ff00; border: none; border-radius: 5px; cursor: pointer; font-weight: bold; color: black; }
        .error { color: #ff4d4d; margin-top: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="login-card">
        <h2>CENTRO DE ACCESO BIOCORP</h2>
        <p>Escanee su credencial o ingrese ID</p>
        <form action="index.php" method="POST" autocomplete="off">
            <input type="text" name="id_tarjeta" placeholder="ID de Empleado" required autofocus inputmode="numeric" pattern="\d*">
            <br>
            <button type="submit">VALIDAR ACCESO</button>
        </form>
        <?php if (isset($error)): ?>
            <p class="error"><?php echo htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>
        <?php endif; ?>
    </div>
</body>
</html>