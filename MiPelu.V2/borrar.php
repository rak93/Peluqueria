<?php
session_start();
$id = $_POST['Citas']; // ID del estilista
$idCli = $_POST['Cliente']; 
require_once 'DaoCitas.php';
$base = 'if0_36491370_mipelu';

if (isset($_SESSION['cliente'])) {
    // Asegúrate de obtener correctamente los valores de $_POST
    
    $daoCitas = new DaoCitas($base);
    
    // Llamada al método `insertar` con parámetros correctos
    $cita = $daoCitas->obtenerPorCitaId($id);
if($idCli == $cita->__get("cliente_id")){
    echo "<meta http-equiv='refresh' content='0;url=./pedirCita.php'>";
  
    $daoCitas->borrar($id);
}
else{
  
 echo "<meta http-equiv='refresh' content='0;url=./pedirCita.php'>";
}
}

else{
require_once 'DaoCitas.php';

// Asegúrate de obtener correctamente los valores de $_POST

$daoCitas = new DaoCitas($base);

// Llamada al método `insertar` con parámetros correctos
$daoCitas->borrar($id);
echo "<meta http-equiv='refresh' content='0;url=./pedirCita.php'>";
}


?>
