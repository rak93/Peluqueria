 <?php
require_once "DaoCitas.php";
$base = "mipelu";
$daoCitas = new DaoCitas($base);
$daoCitas->mostrarCalendario();

$soloFilas = array("filas" => $daoCitas->filas);

$fila = $soloFilas['filas'];


echo json_encode($fila);






 ?>