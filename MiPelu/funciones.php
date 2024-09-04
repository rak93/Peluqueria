function agendaDisponible(){



    $arregloHoras = array();

$horaInicial = 7; // Hora inicial en formato de 24 horas
$horaFinal = 17; // Hora final en formato de 24 horas
$estado="disponible";

for ($i = $horaInicial; $i <= $horaFinal; $i++) {
    for ($j = 0; $j < 4; $j++) {
        $hora = $i + ($j / 4); // Calcula la hora con intervalos de 15 minutos
        $ampm = ($i < 12) ? "AM" : "PM"; // Determina si es AM o PM
        
        $horaRedondeada = floor($hora);
        $minuto = ($j % 4) * 15; // Calcula los minutos
       
        
        // Agrega la hora al arreglo
        $arregloHoras[] = array(
            "hora" => $horaRedondeada,
            "minuto" => $minuto,
            "estado" => $estado,
            "ampm" => "$horaRedondeada $ampm",
            "finampm1" => ($horaRedondeada + 1) . " " . $ampm,
            "finampm2" => ($horaRedondeada + 2) . " " . $ampm // Se puede ajustar según tus necesidades
        );
    }
}

$semana = array (
        array ("dia" =>  0),
        array ("dia" => 1),
        array ("dia" => 2),
        array ("dia" => 3),
        array ("dia" => 4),
        array ("dia" => 5),
    );








}