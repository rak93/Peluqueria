<?php
// Asegurémonos de empezar la sesión
session_start();

// Verifiquemos si al menos uno de los tipos de usuario está presente en la sesión
if (!isset($_SESSION["admin"]) && !isset($_SESSION['estilista']) && !isset($_SESSION['cliente'])) {
    // Si ninguno de ellos está presente, redirigimos al usuario al index
    header("Location: ./index.php");
    // Terminamos la ejecución del script para evitar cualquier salida adicional
    exit();
}

// Si al menos uno de los tipos de usuario está presente en la sesión, destruimos la sesión
session_destroy(); // Destruye todas las variables de sesión

// Aquí podemos redirigir después de destruir la sesión
header("Location: ./index.php");
// Terminamos el script para evitar cualquier salida adicional
exit();
?>

<?php
// Asegurémonos de empezar la sesión
session_start();

// Verifiquemos si al menos uno de los tipos de usuario está presente en la sesión
if (!isset($_SESSION["admin"]) && !isset($_SESSION['estilista']) && !isset($_SESSION['cliente'])) {
    // Si ninguno de ellos está presente, redirigimos al usuario al index
    header("Location: ./index.php");
    // Terminamos la ejecución del script para evitar cualquier salida adicional
    exit();
}

// Si al menos uno de los tipos de usuario está presente en la sesión, destruimos la sesión
session_destroy(); // Destruye todas las variables de sesión

// Aquí podemos redirigir después de destruir la sesión
header("Location: ./index.php");
// Terminamos el script para evitar cualquier salida adicional
exit();
?>

