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







<body>


<?php
    include "./header.php";
    require_once "DaoTratamientos.php";

    $base="mipelu";
    $tratam="";




    ?>


            <?php 
            // Llamar al método listar() para obtener los tratamientos
            $daotratam= new Daotratamientos($base);
            $daotratam->listar();
            foreach ($daotratam->tratamientos as $tratamiento) {
                echo "<h3>".$tratamiento->__get('nombre')."</h3>";
                echo "<p>".$tratamiento->__get('descripcion')."</p>";
                echo "<p>".$tratamiento->__get('duracion')."</p>";
            }
            ?>
        </select>
    </fieldset>
</form>
    <?php
    include "./footer.php";

   
  


    ?>