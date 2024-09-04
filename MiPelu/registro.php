<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- CSS personalizado -->
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/login.css">



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
                                <input type="text" name="nombre" placeholder="Nombre">
                            </div>

                            <div class="form__field">
                                <input type="text" name="apellido1" placeholder="Apellido1">
                            </div>

                            <div class="form__field">
                                <input type="text" name="apellido2" placeholder="Apellido2">
                            </div>

                            <div class="form__field">
                                <input type="text" name="dni" placeholder="Dni">
                            </div>

                            <div class="form__field">
                                <input type="text" name="telefono" placeholder="Telefono">
                            </div>

                            <div class="form__field">
                                <input type="email" name="email" placeholder="info@mailaddress.com">
                            </div>



                            <!-- You can continue adding more fields as needed -->


                            <div class="form__field">
                                <label for="cliente">Cliente</label>
                                <input type="radio" id="cliente" name="role" value="cliente">
                                <label for="estilista">Estilista</label>
                                <input type="radio" id="estilista" name="role" value="estilista">
                            </div>
                            <div class="form__field">
                                <input type="submit" value="Iniciar Sesion">
                            </div>

                        </form>

                        <p>Ya tienes cuenta <a href="./login.php">Iniciar </a></p>

                </div>

            </div>
        </div>
        <?php
        include "./footer.php";




        ?>