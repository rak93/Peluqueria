<?php
echo "hola";

require_once 'DaoCitas.php';
$base = 'mipelu';
// Asegúrate de obtener correctamente los valores de $_POST
$idEst = $_POST['Estilista']; // ID del estilista
$idCli = $_POST['Cliente']; // ID del cliente
$ntratamiento = $_POST['Tratamientos']; // Número de tratamientos
$title = $_POST['titulo']; // Asumimos que el título será el número de tratamientos
$title=$title." ".$ntratamiento." min";
$fecha = $_POST['fechaReserva']; // Fecha de la reserva
$color = $_POST['color'];
$start = $fecha; // Hora de inicio
$end = $fecha; // Hora de inicio



$end = $fecha;
$fyhC = $fecha;
$cita = new Cita();

$cita->__set("estilista_id", $idEst);
$cita->__set("fecha", $fecha);
$cita->__set("cliente_id", $idCli);
$cita->__set("title", $title);
$cita->__set("color", $color);
$cita->__set("start", $start);
$cita->__set("end", $end);
$cita->__set("fyh_creacion", $fyhC);








$daoCitas = new DaoCitas($base);

// Llamada al método `insertar` con parámetros correctos
$daoCitas->insertar($cita);
header("location:./pedirCita.php")



?>
