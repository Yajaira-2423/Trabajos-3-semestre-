<?php
session_start();
session_destroy(); // Borra los datos de la sesión
header("Location: index.php"); // Regresa al formulario de entrada
exit();
?>