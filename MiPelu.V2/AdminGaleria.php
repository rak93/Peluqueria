<?php
// Iniciar la sesión para gestionar la autenticación
session_start();

// Redirigir al login si el usuario no es administrador
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
    <title>Administración de Galería</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/admin.css">
    
    <?php
    require_once "DaoGalerias.php";
    $base = "if0_36491370_mipelu";
    $galeriaDAO = new DaoGaleria($base);

    include "./header.php";
    ?>
    </header>   
</head>
<body>
<main>

    <!-- Formulario para agregar nuevas imágenes a la galería -->
    <form name='f1' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data">
        <div class='form'>
            <fieldset id='formI'>
                <legend>Agregar Nueva Imagen</legend>
                <div>
                    <div class='labelI'><label for='descripcion'>Descripción</label><input type='text' name='descripcion' required></div>
                    <div class='labelI'><label for='alto'>Altura</label><input type='number' name='alto' required></div>
                    <div class='labelI'><label for='ancho'>Ancho</label><input type='number' name='ancho'required></div>
                    <div class='labelI'><label for='foto'>Foto</label><input type='file' name='foto' required></div>
                    <div><input type='submit' class='btn-form' name='Guardar' value='Guardar'></div>
                </div>
            </fieldset>
        </div>
    </form>

    <!-- Lógica para guardar la nueva imagen -->
    <?php
    if (isset($_POST['Guardar'])) {
        $galeria = new Galeria();

        if (isset($_FILES['foto'])) {
            $temp = $_FILES['foto']['tmp_name'];
            $conte = file_get_contents($temp);
            $conte = base64_encode($conte);
            $galeria->__set("foto", $conte);
        }

        $galeria->__set("descripcion", $_POST['descripcion']);
        $galeria->__set("alto", $_POST['alto']);
        $galeria->__set("ancho", $_POST['ancho']);

        $galeriaDAO->insertar($galeria);
        echo "Imagen agregada correctamente.";
    }
    ?>

    <!-- Formulario para seleccionar y gestionar imágenes existentes -->
    <form name='f2' method='post' action='<?php echo $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data">
        <div class='form'>
            <fieldset>
                <div id='formselect'>
                    <label for='galeria'>Seleccionar Imagen</label>
                    <div id='selform'>
                        <select name='Galeria' class="form-control">
                            <option value=""></option>
                            <?php
                            $galeriaDAO->listar();
                            foreach ($galeriaDAO->galerias as $item) {
                                echo "<option value='" . $item->__get('id') . "'";
                                if (isset($_POST['Galeria']) && $_POST['Galeria'] == $item->__get('id')) {
                                    echo " selected ";
                                }
                                echo ">" . $item->__get('descripcion') . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <input type='submit' class='btn-form' name='Buscar' value='Buscar'>
                </div>
            </fieldset>
        </div>
  

    <!-- Lógica para mostrar y actualizar imágenes seleccionadas -->
    <?php
    if (isset($_POST['Buscar'])) {
        $idGaleria = $_POST['Galeria'];
        $galeria = $galeriaDAO->obtener($idGaleria);

        if ($galeria) {
           
            echo "<fieldset class='update'>";
            echo "<div class='labelI'><label para='descripcion'>Descripción </label><input type='text' value='" . $galeria->__get('descripcion') . "' name='descripcion'></div>";
            echo "<div class='labelI'><label para='alto'>Altura </label><input type='number' value='" . $galeria->__get('alto') . "' name='alto'></div>";
            echo "<div class='labelI'><label para='ancho'>Ancho </label><input type='number' value='" . $galeria->__get('ancho') . "' name='ancho'></div>";
            echo "<img src='data:image/jpg;base64," . $galeria->__get('foto') . "' width=70 height=70>";
            echo "<input type='hidden' name='foto_actual' value='" . $galeria->__get('foto') . "'>";
            echo "<div class='labelI'><input type='file' name='nueva_foto'></div>";
            echo "<input type='submit' class='btn-form' name='Actualizar' value='Actualizar'>";
            echo "<input type='submit' class='btn-form' name='Borrar' value='Borrar'>";
            echo "</fieldset>";
            echo "</form>";
        }
    }

    if (isset($_POST['Actualizar'])) {
        $id = $_POST['Galeria'];
        $galeria = new Galeria();

        if (isset($_FILES['nueva_foto']) && !empty($_FILES['nueva_foto']['tmp_name'])) {
            $temp = $_FILES['nueva_foto']['tmp_name'];
            $conte = file_get_contents($temp);
            $conte = base64_encode($conte);
            $galeria->__set("foto", $conte);
        } else {
            // Mantener la foto actual si no se carga una nueva
            $galeria->__set("foto", $_POST['foto_actual']);
        }

        $galeria->__set("id", $id);
        $galeria->__set("descripcion", $_POST['descripcion']);
        $galeria->__set("alto", $_POST['alto']);
        $galeria->__set("ancho", $_POST['ancho']);
        
        $galeriaDAO->actualizar($galeria);
        echo "Imagen actualizada correctamente.";
        echo "<meta http-equiv='refresh' content='0;url=./AdminGaleria.php'>";
    }

    if (isset($_POST['Borrar'])) {
        $id = $_POST['Galeria'];
        $galeriaDAO->borrar($id);
        echo "Imagen borrada correctamente.";
        echo "<meta http-equiv='refresh' content='0;url=./AdminGaleria.php'>";
    }
    ?>

    <?php include "./footer.php"; ?>
</main>
</body>
</html>
