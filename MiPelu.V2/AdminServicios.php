<?php
// Asegúrate de comenzar la sesión en la parte superior del archivo
session_start();

if (!isset($_SESSION['admin'])&& !isset($_SESSION['estilista'])) {
    header("Location: ./login.php");
    exit(); // Detiene el script para evitar cualquier salida adicional
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Servicios</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/admin.css">

    <?php
    require_once "DaoEstilistas.php";
    require_once 'DaoClientes.php';
    require_once 'DaoTratamientos.php';
    require_once 'DaoCitas.php';
    $base = "if0_36491370_mipelu";
    $esti = "";
    if (isset($_POST['Estilista'])) {
        $esti = $_POST['Estilista'];
    }
    $tratam = "";
    if (isset($_POST['Tratamientos'])) {
        $tratam = $_POST['Tratamientos'];
    }
    $Clien = "";
    if (isset($_POST['Cliente'])) {
        $Clien = $_POST['Cliente'];
    }
    $Cit = "";
    if (isset($_POST['Citas'])) {
        $Cit = $_POST['Citas'];
    }
    include "./header.php";
    ?>
</header>    
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data" onsubmit="return validarFormularioCLiente()">
        <div class='form'>
            <fieldset id='formI'>
                <legend>Datos de alta Servicios</legend>
                <div>

                    <div class='labelI'> <label for='Nombre'>Nombre</label><input type='text' name='Nombre' required></div>
                    <div class='labelI'><label for='descripcion'>Descripción</label><textarea name='descripcion' required></textarea></div>
                    <div class='labelI'> <label for='duracion'>Duración</label><input type='text' name='duracion' required></div>

                    <div><input type='submit' class='btn-form' name='Guardar' value='Guardar'></div>
                </div>
            </fieldset>
        </div>
    </form>
    <?php
    if (isset($_POST['Guardar'])) {

        // Creamos una instancia de la clase Cliente
        $tratamiento = new tratamiento();
        $daotratam = new Daotratamientos($base);


        // Asignamos los valores del formulario a los atributos del objeto Cliente
        $tratamiento->__set("nombre", $_POST['Nombre']);
        $tratamiento->__set("descripcion", $_POST['descripcion']);
        $tratamiento->__set("duracion", $_POST['duracion']);


        $daotratam->insertarTratamiento($tratamiento);

        // Insertamos el cliente en la base de datos utilizando el método insertarCliente del DAO


        // Aquí podrías agregar un mensaje de éxito o redirigir a otra página
        echo "Tratamiento insertado correctamente";
    }
    ?>
    <div>
        <form name='f2' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>'>
            <div class='form'>
                <fieldset>
                    <div id='formselect'>
                     <legend>Datos Actualizar o borrar Servicios</legend>
                        <label for='tratamientos'>Tratamientos</label>

                        <div id='selform'>
                        <select name='Tratamientos' class="form-control">
                                <option value=""></option>
                                <?php

                                // Llamar al método listar() para obtener los tratamientos
                                $daotratam = new Daotratamientos($base);
                                $daotratam->listar();

                                foreach ($daotratam->tratamientos as $tratamiento) {
                                    echo "<option value='" . $tratamiento->__get('idTratamiento') . "'";

                                    // Comprobar si este cliente es el seleccionado
                                    if ($tratamiento->__get('idTratamiento')  == $tratam) {
                                        echo " selected ";
                                    }

                                    echo ">" . $tratamiento->__get('nombre') . " " .  $tratamiento->__get('duracion') . "min" . "</option>";
                                }  ?>

                        </select>
                    </div>
                    <input type='submit' class='btn-form' name='Buscar' value='Buscar'>
            </div>
            <?php
            if (isset($_POST['Buscar'])) {
                // Obtener el ID del cliente desde el formulario
                $idtratamiento = $_POST['Tratamientos'];
                $tratamiento = new tratamiento();
                $tratamiento = $daotratam->obtenerID($idtratamiento);




                // Acceder a las propiedades del objeto Cliente y mostrarlas en los campos de entrada
                echo "<div class='update'>";
                echo " <legend>Datos de alta Servicios</legend>";
                echo "<div id='labelI'><label for='Nombre'>Nombre </label><input type='text' value='" . $tratamiento->__get('nombre') . "' name='Nombre'></div>";

                echo "<div id='labelI'><label for='descripcion'>Descripcion </label><textarea name='descripcion'>" . $tratamiento->__get('descripcion') . "</textarea></div>";

                echo "<div id='labelI'><label for='Duracion'>Duracion </label><input type='text' value='" . $tratamiento->__get('duracion') . "' name='duracion'></div>";
                echo "<div id='labelI'><input  class='btn-form' type='submit' name='Actualizar' value='Actualizar'> <input  class='btn-form'type='submit' name='Borrar' value='Borrar'>";




                echo "</fieldset>";
                echo "</div>";
                echo " </form>";
            }
            echo "</main>";
            if (isset($_POST['Actualizar'])) {

                $tratamiento = new tratamiento();

                $tratamiento->__set("idTratamiento", $_POST['Tratamientos']);
                $tratamiento->__set("nombre",  $_POST['Nombre']);
                $tratamiento->__set("descripcion",  $_POST['descripcion']);
                $tratamiento->__set("duracion", $_POST['duracion']);
                $daotratam->actualizarTratamiento($tratamiento);
            }
            if (isset($_POST['Borrar'])) {
                $idtratamiento = $_POST['Tratamientos'];
                $daotratam->borrarTratamiento($idtratamiento);
                echo "tratamiento borrado correctamente";
            }
            echo "</div>";



            include "./footer.php"; ?>
        