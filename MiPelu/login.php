<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/login.scss">




    <?php
    include "./header.php";
    $base='mipelu';
    require_once "DaoAdmin.php";



    ?>
    <div class="align">

        <div class="grid align__item">

            <div class="register">

                <svg xmlns="http://www.w3.org/2000/svg" class="site__logo" width="56" height="84" viewBox="77.7 214.9 274.7 412">
                    <defs>
                        <linearGradient id="a" x1="0%" y1="0%" y2="0%">
                            <stop offset="0%" stop-color="#8ceabb" />
                            <stop offset="100%" stop-color="#378f7b" />
                        </linearGradient>
                    </defs>
                    <path fill="url(#a)" d="M215 214.9c-83.6 123.5-137.3 200.8-137.3 275.9 0 75.2 61.4 136.1 137.3 136.1s137.3-60.9 137.3-136.1c0-75.1-53.7-152.4-137.3-275.9z" />
                </svg>

                <h2>Inicio Sesion</h2>

                <form action="" method="post" class="form">

                    <form action="" method="post" class="form">

                        <div class="form__field">
                            <input type="name" name="user" placeholder="usuario">
                        </div>

                        <div class="form__field">
                            <input type="password" name="password" placeholder="••••••••••••">
                        </div>

                       
                        <div class="form__field">
                            <input type="submit" name='inicio' value="Iniciar Sesion">
                        </div>

                    </form>

                    <?php
                    if (isset($_POST['inicio'])) {
                        $user=$_POST['user'];
                        $pass=$_POST['password'];
                        $DaoAdmin= new DaoAdmin($base);
                        $DaoAdmin->obtener($user,$pass);
                        if ($DaoAdmin!== null) { 
                            // Iniciar sesión y realizar acciones adicionales
                            session_start(); // Asegúrate de iniciar la sesión
                            $_SESSION['admin'] = $user;
                            header("Location: ./index.php");
                        }
                    }
                    ?>
                    <p>Aún no tienes cuenta <a href="./registro.php">registrar</a></p>

            </div>

        </div>
    </div>
    <?php
    include "./footer.php";



    ?>