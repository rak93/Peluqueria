<?php
// Asegúrate de empezar la sesión
session_start();

// Si no hay administrador en la sesión, redirige al index
if (!isset($_SESSION["admin"])) {
    header("Location: ./index.php");
    exit(); // Detiene el script para evitar cualquier salida posterior
}

// Si el administrador está presente, destruye la sesión
session_destroy(); // Destruye todas las variables de sesión

// Aquí puedes redirigir después de destruir la sesión
header("Location: ./index.php");
exit(); // Termina el script para evitar cualquier salida posterior
?>
