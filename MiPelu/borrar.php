<?php

$id = $_POST['Citas']; // ID del estilista


require_once 'DaoCitas.php';
$base = 'mipelu';
// Asegúrate de obtener correctamente los valores de $_POST

$daoCitas = new DaoCitas($base);

// Llamada al método `insertar` con parámetros correctos
$daoCitas->borrar($id);
header("location:./pedirCita.php")



?>
