<?php
// Asegúrate de comenzar la sesión en la parte superior del archivo
session_start();

// Comprueba si el usuario no es administrador
if (!isset($_SESSION['admin']) && !isset($_SESSION['estilista'])) {
    header("Location: ./login.php");
    exit(); // Detiene el script para evitar cualquier salida adicional
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración Estilistas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/admin.css">
<script src='./src/js/validarFormularios.js'></script>
    <?php
    require_once "DaoEstilistas.php";
    require_once 'DaoClientes.php';
    require_once 'DaoTratamientos.php';
    require_once 'DaoCitas.php';
    $base = "if0_36491370_mipelu";
    $estilista = new Estilista();
    $EstilistaDAO = new DaoEstilistas($base);

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
    <main>
        <?php
        if (!isset($_SESSION['estilista'])) {
   
            echo "<form name='f1' method='post' action='" . $_SERVER['PHP_SELF'] . "' enctype='multipart/form-data' onsubmit='return validarFormularioEstilista()'>";
            echo "<div class='form'>";
            echo "<fieldset id='formI'>";
            echo "<legend>Datos de alta, Borrado, Actualizado Estilista</legend>";
            echo "<div>";
            echo "<div class='labelI'> <label for='nif'>NIF</label><input type='text' name='nif' required></div>";
            echo "<div class='labelI'> <label for='Nombre'>Nombre</label><input type='text' name='Nombre' required></div>";
            echo "<div class='labelI'><label for='Apellido1'>Apellido1</label><input type='text' name='Apellido1'></div>";
            echo "<div class='labelI'> <label for='Apellido2'>Apellido2</label><input type='text' name='Apellido2'></div>";
            echo "<div class='labelI'> <label for='telefono'>Teléfono</label><input type='text' name='telefono'></div>";
            echo "<div class='labelI'> <label for='user'>Usuario</label><input type='text' name='user'></div>";
            echo "<div class='labelI'> <label for='pass'>Contraseña</label><input type='password' name='pass'></div>";
            echo "<div class='labelI'> <label for='foto'>Foto</label><input type='file' name='foto'></div>";
            echo "<div><input type='submit' class='btn-form' name='Guardar' value='Guardar'></div>";
            echo "</div>";
            echo "</fieldset>";
            echo "</div>";
            echo "</form>";
        }

        
        if (isset($_POST['Guardar'])) {
            // Verificamos si todos los campos necesarios están definidos
            if (isset($_POST["user"], $_POST["pass"], $_POST["nif"], $_POST["Nombre"], $_POST["Apellido1"], $_POST["Apellido2"], $_POST["telefono"])) {
                $user = $_POST["user"];
                $pass = $_POST["pass"];
                $nif = $_POST["nif"];
                $nombre = $_POST["Nombre"];
                $apellido1 = $_POST["Apellido1"];
                $apellido2 = $_POST["Apellido2"];
                $telefono = $_POST["telefono"];
                $passHash = password_hash($pass, PASSWORD_BCRYPT);
        
                // Creamos una instancia del DAO de estilista
                $EstilistaDAO = new DaoEstilistas($base);
        
                // Verificamos si el NIF ya existe en la base de datos
                $estilistaExistente = $EstilistaDAO->obtenerEstilistaPorNIF($nif);
                if ($estilistaExistente) {
                    echo "El NIF de este estilista ya existe.";
                } else {
                    // Verificamos si el usuario ya existe en la base de datos
                    $estilistaExistente = $EstilistaDAO->obtenerPorUser($user);
                    if ($estilistaExistente) {
                        echo "El usuario de este estilista ya existe.";
                    } else {
                        $foto = ""; // Suponemos por defecto que el valor del campo foto es vacío
        
                        // Verificamos si se ha subido un archivo de foto
                        if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
                            $temp = $_FILES['foto']['tmp_name'];
                            $conte = file_get_contents($temp);
                            $foto = base64_encode($conte);
                        }
        
                        // Creamos una instancia de la clase Estilista
                        $estilista = new Estilista();
                        $estilista->__set("nif", $nif);
                        $estilista->__set("nombre", $nombre);
                        $estilista->__set("Apellido1", $apellido1);
                        $estilista->__set("Apellido2", $apellido2);
                        $estilista->__set("telefono", $telefono);
                        $estilista->__set("foto", $foto);
                        $estilista->__set("user", $user);
                        $estilista->__set("pass", $passHash);
        
                        // Insertamos el estilista en la base de datos utilizando el método insertarEstilista del DAO
                        $EstilistaDAO->insertarEstilistaRe($estilista);
                        echo "Estilista insertado correctamente.";
                    }
                }
            } else {
                echo "Por favor, complete todos los campos del formulario.";
            }
        }
        
        


        ?>
        <div>
            <form name='f2' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype='multipart/form-data'>
                <div class='form'>
                    <fieldset>
                        <div id='formselect'>


                            <label for='estilista'>Estilista</label>
                            <div id='selform'>
                                <select name='Estilista' class="form-control">
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
                                        echo ">" . $estilista->__get('nombre') . " " . $estilista->__get('Apellido1') . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <input type='submit' class='btn-form' name='Buscar' value='Buscar'>
                        </div>

                        <?php
                        if (isset($_POST['Buscar'])) {
                            // Verifica que se haya enviado un ID de estilista
                            $idEstilista = $_POST['Estilista'];
                            $EstilistaDAO = new DaoEstilistas($base);
                            // Intenta obtener el estilista por ID
                            $estilista = $EstilistaDAO->obtener($idEstilista);

                            // Estilista encontrado
                            echo "<form method='post' action='{$_SERVER['PHP_SELF']}' enctype='multipart/form-data'>";
                            echo "<div class='update'>";
                            echo "<div id='labelI'><label for='nif'>NIF </label><input type='text' value='" . $estilista->__get('nif') . "' name='nif'></div>";
                            echo "<div id='labelI'><label for='nombre'>Nombre </label><input type='text' value='" . $estilista->__get('nombre') . "' name='Nombre'></div>";
                            echo "<div id='labelI'><label for='Apellido1'>Apellido1 </label><input type='text' value='" . $estilista->__get('Apellido1') . "' name='Apellido1'></div>";
                            echo "<div id='labelI'><label for='Apellido2'>Apellido2 </label><input type='text' value='" . $estilista->__get('Apellido2') . "' name='Apellido2'></div>";
                            echo "<div id='labelI'><label for='telefono'>Teléfono </label><input  type='text' value='" . $estilista->__get('telefono') . "' name='telefono'></div>";
                            echo "<div id='labelI'><label for='user'>Usuario </label><input type='text' value='" . $estilista->__get('user') . "' name='user'></div>";
                            echo "<div id='labelI'><label for='pass'>Contraseña </label><input type='password' value='" . $estilista->__get('pass') . "' name='pass'></div>";
                            $conte = $estilista->__get("foto");
                            echo  "<img src='data:image/jpg;base64,$conte' width=70 height=70>";

                            // Campo oculto para almacenar la imagen actual
                            echo "<input type='hidden' name='foto_actual' value='$conte'>";
                            echo "<div class='labelI'><label > <input type='file' name='Fotos'></label></div>";
                            echo "<div id='labelI'><input class='btn-form' type='submit' name='Actualizar' value='Actualizar'> <input class='btn-form' type='submit' name='Borrar' value='Borrar'></div>";
                            echo "</div>";
                            echo "</form>";
                            echo "</main>";
                        }

                        if (isset($_POST['Actualizar'])) {
                            $estilista = new Estilista();
                            $estilista->__set("IdEstilista", $_POST['Estilista']);
                            $estilista->__set("nif", $_POST['nif']);
                            $estilista->__set("nombre", $_POST['Nombre']);
                            $estilista->__set("Apellido1", $_POST['Apellido1']);
                            $estilista->__set("Apellido2", $_POST['Apellido2']);
                            $estilista->__set("telefono", $_POST['telefono']);
                            $estilista->__set("user", $_POST['user']);


                            $passHash = password_hash($_POST['pass'], PASSWORD_BCRYPT);
                            $estilista->__set("pass", $passHash);


                            if (isset($_FILES['Fotos']) && !empty($_FILES['Fotos']['tmp_name'])) {
                                $temp = $_FILES['Fotos']['tmp_name'];
                                $conte = file_get_contents($temp);
                                $conte = base64_encode($conte);
                                $estilista->__set("foto", $conte);
                            } else {
                                // Mantén la foto anterior si no se seleccionó una nueva
                                $estilista->__set("foto", $_POST['foto_actual']);
                            }

                            $EstilistaDAO = new DaoEstilistas($base);

                          
                                    $EstilistaDAO->actualizarEstilista($estilista);
                                    echo "Estilista actualizado correctamente.";
                             
                        }

                        if (isset($_POST['Borrar'])) {
                            $id = $_POST['Estilista'];
                            $EstilistaDAO = new DaoEstilistas($base);
                            $estilista =  $EstilistaDAO->obtenerPorUser($_SESSION['estilista']);

                            $idE = $estilista->__get("IdEstilista");
                            if ($idE == $id) {
                                session_destroy(); // Destruye todas las variables de sesión
                                header("Location: ./index.php");
                                exit(); // Asegúrate de que el script no continúe después de redirigir
                                $EstilistaDAO->borrarEstilista($id);
                            } else {
                                $EstilistaDAO->borrarEstilista($id);

                                echo "Estilista borrado correctamente";
                            }
                        }
                        echo "</div>";
                        echo "</main>";
                        include "./footer.php";
                        ?>

                        </body>

</html>