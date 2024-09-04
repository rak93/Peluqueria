<?php
require_once "DaoCitas.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener las fechas de inicio y fin del cuerpo de la solicitud POST
    $start = $_POST['start'];
    $end = $_POST['end'];

    // Convertir las fechas a un formato que MySQL pueda entender
    $startDate = date("Y-m-d H:i:s", strtotime($start));
    $endDate = date("Y-m-d H:i:s", strtotime($end));

    try {
        // Conectarse a la base de datos
        $base = "if0_36491370_mipelu";
        $daoCitas = new DaoCitas($base);

        // Llamar a la función de borrado pasando las fechas de inicio y fin
        $daoCitas->borrarPorFechas($startDate, $endDate);

        // Enviar una respuesta JSON con estado de éxito y mensaje
        echo json_encode([
            'status' => 'success',
            'message' => 'Cita borrada correctamente'
        ]);
    } catch (Exception $e) {
        // Enviar una respuesta JSON con estado de error y mensaje
        echo json_encode([
            'status' => 'error',
            'message' => 'Error al borrar la cita: ' . $e->getMessage()
        ]);
    }
} else {
    // Si la solicitud no es de tipo POST, enviar una respuesta JSON con estado de error
    echo json_encode([
        'status' => 'error',
        'message' => 'Método no permitido'
    ]);
}
?>