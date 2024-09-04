<?php
// Asegúrate de comenzar la sesión en la parte superior del archivo
session_start();

// Comprueba si el usuario no es administrador
if (!isset($_SESSION['admin'])) {
    // Si el usuario no está autenticado como administrador, redirige al login
    header("Location: ./login.php");
    exit(); // Detiene el script para evitar cualquier salida adicional
}
?>
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
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap JavaScript y dependencias -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src='src/js/calendario.js'></script>
    <?php
    require_once "DaoEstilistas.php";
    require_once 'DaoClientes.php';
    require_once 'DaoTratamientos.php';
    require_once 'DaoCitas.php';
    $base = "mipelu";
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
    <h2>Bienvenido al servicio de citas</h2>
    <div class='row'>
        <div class='col-md-2'></div>
        <div class='col-md-8'>
            <div id='calendar'></div>
        </div>
        <div class='col-md-2'></div>

    </div>


    <!-- Modal -->
    <div class="modal fade" id="modal_reservas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reservas tu cita para el dia <span id="diaSemana"></span> </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">




                    <button type="button" id='btn_h1' class="btn btn-success" data-dismiss="modal">Insertar</button>


                    <button type="button" id='btn_borrar' class="btn btn-success" data-dismiss="modal">borrar</button>


                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Button trigger modal -->
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="modal_formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formulario_reserva" method='post' action='./reservar.php'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reservas tu cita para el dia <span id="diaSemana"></span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for='estilista'>Estilista</label>
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
                                echo ">" . $estilista->__get('nombre') . "</option>";
                            }
                            ?>
                        </select>
                        <label for='clinte'>Cliente</label>
                        <select name='Cliente' class="form-control">
                            <option value=""></option>
                            <?php
                            // Crear una instancia de DaoClientes
                            $daoCliente = new DaoClientes($base);
                            $daoCliente->listar();

                            // Iterar sobre los clientes
                            foreach ($daoCliente->clientes as $cliente) {
                                echo "<option value='" . $cliente->__get('IdCliente') . "'";

                                // Comprobar si este cliente es el seleccionado
                                if ($cliente->__get('IdCliente') == $Clien) {
                                    echo " selected ";
                                }

                                echo ">" . $cliente->__get('Nombre') . "</option>";
                            }
                            ?>
                        </select>







                        <label for='tratamientos'>Tratamientos</label>

                        <select name='Tratamientos' class="form-control">
                            <option value=""></option>
                            <?php

                            // Llamar al método listar() para obtener los tratamientos
                            $daotratam = new Daotratamientos($base);
                            $daotratam->listar();

                            foreach ($daotratam->tratamientos as $tratamiento) {
                                echo "<option value='" . $tratamiento->__get('duracion') . "'";

                                // Comprobar si este cliente es el seleccionado
                                if ($tratamiento->__get('idTratamiemto')  == $tratam) {
                                    echo " selected ";
                                }

                                echo ">" . $tratamiento->__get('nombre') . " " .  $tratamiento->__get('duracion') . "min" . "</option>";
                            }  ?>

                        </select>

                        <label for='fecha'>fecha</label>
                        <input type="text" class='form-control' name='fechaReserva' id='fechaReserva'>

                        <label for='titulo'>titulo</label>
                        <input type="text" class='form-control' name='titulo' id='titulo'>
                        <label for="color">Escoge un color:</label>
                        <input type="color" id="color" name="color" value="#ff0000">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Reservar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="modal_eliminar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formulario_eliminar" method='post' action='./borrar.php'>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reservas tu cita para el dia <span id="diaSemana"></span> </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <select name='Citas' class="form-control">
                            <option value=""></option>
                            <?php


                            // Llamar al método listar() para obtener los tratamientos
                            $daoCitas = new DaoCitas($base);
                            $daoCitas->listar();

                            foreach ($daoCitas->citas as $cita) {
                                echo "<option value='" . $cita->__get('Id') . "'";

                                // Comprobar si este cliente es el seleccionado
                                if ($cita->__get('Id')  == $Cit) {
                                    echo " selected ";
                                }

                                echo ">" . $cita->__get('title')  . "" . $cita->__get('start') . $cita->__get('Id') . "</option>";
                            }  ?>

                        </select>


                    </div>
                    <div class="modal-footer">
                        <!-- Mantén el botón de cerrar con data-dismiss -->
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                        <!-- Elimina data-dismiss del botón de envío -->
                        <button type="submit" class="btn btn-primary">Eliminar cita</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $('#btn_h1').click(function() {
                $("#modal_formulario").modal('show'); // Abre el modal para reservas
                $('#fechaReserva').val(a);
            });

            $('#btn_borrar').click(function() {
                $("#modal_eliminar").modal('show'); // Abre el modal para eliminar
                $('#fechaReserva').val(a);
            });

            // Evento de envío para el formulario de reservas
            $('#formulario_reserva').submit(function(event) {
                event.preventDefault(); // Detiene el envío por defecto
                // Ejecutar lógica antes de enviar (si es necesario)
                this.submit(); // Luego, envía el formulario
            });

            // Evento de envío para el formulario de eliminar
            $('#formulario_eliminar').submit(function(event) {
                event.preventDefault(); // Detiene el envío por defecto
                // Ejecutar lógica antes de enviar (si es necesario)
                this.submit(); // Luego, envía el formulario
            });
        });
    </script>


    <?php include "./footer.php"; ?>
    </body>

</html>