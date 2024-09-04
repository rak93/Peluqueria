<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/styleIndex.css">
    <?php
    include "./header.php";
    require_once "DaoTratamientos.php";
    require_once "DaoClientes.php";

    require_once "DaoEstilistas.php";
    require_once 'DaoCitas.php'; // Asegúrate de importar el DAO de estilistas

    $base = "mipelu";
    $tratam = "";
    if (isset($_POST['tratamientos'])) {
        $tratam = $_POST['tratamientos'];
    }
    $esti = "";
    if (isset($_POST['Estilista'])) {
        $esti = $_POST['Estilista'];
    }
    $dia = "";
    if (isset($_POST['fecha'])) {
        $dia = $_POST['fecha'];
    }
      $hora = $_POST['hora'];
        $estilista_id=$_POST['Estilista'];
        $fecha = $_POST["fecha"];
        echo "esto esta arriba $esti";
        echo "esto esta arriba $dia";
    ?>
   
</head>

<body>
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
        <fieldset>
            <legend>Seleccione tratamiento</legend>
            <label for='tratamientos'>Tratamiento</label>
            <select name='tratamiento'>
                <option value=""></option>
                <?php
                // Llamar al método listar() para obtener los tratamientos
                $daotratam = new Daotratamientos($base);
                $daotratam->listar();
           
                foreach ($daotratam->tratamientos as $tratamiento) {
                    $duracion_tratamiento = $tratamiento->__get('duracion'); // Guardar la duración del tratamiento en una variable
                    echo "<option value=" . $tratamiento->__get('idTratamiemto');
                    if ($tratam == $tratamiento->__get('idTratamiemto')) {
                        echo " selected ";
                    }
                    echo ">" . $tratamiento->__get('nombre') . " - Duración: " . $duracion_tratamiento . " minutos</option>";
                }
                ?>
            </select>
        </fieldset>

        <fieldset>
            <legend>Seleccione Estilista</legend>
            <label for='estilista'>Estilista</label>
            <select name='Estilista'>
                <option value=""></option>
                <?php
                // Llamar al método listar() para obtener los estilistas
                $daoEsti = new DaoEstilistas($base);
                $daoEsti->listar();
                foreach ($daoEsti->estilistas as $estilista) {
                    echo "<option value='" . $estilista->__get('IdEstilista') . "'";
                    if ($esti == $estilista->__get('IdEstilista')) {
                        echo " selected ";
                    }
                    echo ">" . $estilista->__get('nombre') . "</option>";
                }
                ?>
            </select>

            </select>
        </fieldset>

        <input type="date" name="fecha" required>
        <button type="submit" name="seleccionar_tratamiento">Seleccionar</button>
        
    </form>

    <?php
   /* if (isset($_POST['seleccionar_tratamiento'])) {
        echo '<form name="f2" method="post" action="' . $_SERVER['PHP_SELF'] . '" enctype="multipart/form-data">';
        echo '<fieldset>';
        echo '<legend>Seleccione hora</legend>';
       
      echo $esti;
        echo $dia;
        $daoCitas = new DaoCitas($base);
        // Obtener las horas reservadas para el estilista en la fecha especificada utilizando el DAO
        $horas_reservadas = $daoCitas->obtenerHorasReservadas($fecha, $esti);

        // Generar opciones de hora en intervalos de 15 minutos, excluyendo las horas reservadas
        $intervalo = 15;
        $hora_inicio = strtotime('08:00'); // Cambiar "08:00" por la hora de apertura
        $hora_fin = strtotime('17:45'); // Cambiar "17:45" por la última hora posible para comenzar un tratamiento
        echo '<select id="hora" name="hora" required>';
        for ($i = $hora_inicio; $i <= $hora_fin; $i += 60 * $intervalo) {
            $hora_actual = date('H:i', $i);
            if (!in_array($hora_actual, $horas_reservadas)) {
                echo '<option value="' . $hora_actual . '">' . $hora_actual . '</option>';
            }
        }
        echo '</select>';

        echo "<input type='text' value='$esti' name='id_est'>";
        echo "<input type='text' id='$dia' name='fecha'>";
        echo '<input type="hidden" id="hora_seleccionada" name="hora_seleccionada">';
        echo '</fieldset>';
        echo '<button type="submit" name="reservar">Confirmar hora</button>';
        echo '</form>';
    }
    /*
    if (isset($_POST['reservar'])) {
       
      
        // Verificar si la cita está disponible utilizando el DAO
        $daoCitas = new DaoCitas($base);
        $esti= $_POST['id_est'];
        $dia=$_POST['fecha'];
        echo "abajo  $esti";

        if ($daoCitas->verificarCitaDisponible($dia, $hora, $esti)) {
            // Obtener la duración del tratamiento desde la base de datos utilizando el DAO de tratamientos
           

            // Calcular la hora de finalización del tratamiento
            $hora_fin = strtotime($hora) + $duracion_tratamiento * 60;
            $hora_fin_str = date("H:i", $hora_fin);

            // Verificar si la hora de finalización del tratamiento no sobrepasa el horario de cierre
            if (strtotime($hora_fin_str) <= strtotime("18:00")) { // Cambiar "18:00" por el horario de cierre
                // La cita está disponible y el horario es válido, reservarla utilizando el DAO de citas
                $daoCitas->insertar($fecha, $hora, $hora_fin_str, $esti, true);
                echo "Cita reservada exitosamente.";
            } else {
                echo "La hora de inicio más la duración del tratamiento sobrepasa el horario de cierre.";
            }
        } else {
            echo "La cita seleccionada no está disponible.";
        }
    }*/
    ?> 
    
    <?php include "./footer.php"; ?>*/

</body>

</html>