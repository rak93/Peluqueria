<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <link rel="stylesheet" href="./src/css/styleIndex.css">
    <link rel="stylesheet" href="./src/css/contacto.css">
     <style>
 </style>
</head>
 <?php
     include "./header.php"; ?>
</header>
<?php
     require './PHPMailer/src/PHPMailer.php';
     require './PHPMailer/src/SMTP.php';
     require './PHPMailer/src/Exception.php';
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST['submit'])) {
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $mensaje = $_POST['mensaje'];

        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp-mail.outlook.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tfgpeluqueria@outlook.es'; // Tu dirección de correo electrónico de Outlook.com
            $mail->Password = 'TFG22Daw'; // Tu contraseña de Outlook.com
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Configuración del correo electrónico
              $mail->setFrom('tfgpeluqueria@outlook.es', 'Mi Peluqueria'); // Tu dirección de correo electrónico de Outlook.com y tu nombre opcional
            $mail->addAddress('tfgpeluqueria@outlook.es'); // Dirección de correo del destinatario
            $mail->Subject = 'Mensaje de contacto';
            $mail->Body = "Nombre: $nombre\nEmail: $email\nMensaje: $mensaje";

            // Enviar el correo electrónico
            $mail->send();
            echo 'El mensaje ha sido enviado correctamente.';
        } catch (Exception $e) {
            echo "Hubo un problema enviando el mensaje: {$mail->ErrorInfo}";
        }
    }
    ?>
php
Copiar código
</header>    
<main class="container mt-5">
    <section class="contacto row">
        <div class="col-md-6 mb-4">
            <div class="info-box p-4 shadow-sm rounded">
                <h3 style='color: #800080'>Información de contacto</h3>
                <p>Para consultas relacionadas con nuestra disponibilidad de fechas, radio de acción, presupuestos aproximados, puedes dejarnos un mensaje y con mucho gusto te contestaremos lo antes posible.</p>
                <h4 style='color: #9370db ' >Contacto</h4>
                <p>🏠 Dirección: C. Tinte, 7, 13001 Ciudad Real</p>
                <p>📱 Teléfono: 12345</p>
                <p>📨 <a href="mailto:destinatario@example.com">Enviar correo</a></p>
                <table class="table">
                    <tr> 
                        <td>martes-viernes:</td>
                        <td>sábado:</td>
                    </tr>
                    <tr>
                        <td>9:00-14:00<br>17:00-20:00</td>
                        <td>9:30-14:00</td>
                    </tr>
                </table>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3101.4689644056416!2d-3.932052024059125!3d38.98179207170617!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6bc314ff3aaaab%3A0xa212383e86cc80ec!2sA%20Punto%20peluqueria%20unisex!5e0!3m2!1ses!2ses!4v1714388266795!5m2!1ses!2ses" width="100%" height="240" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <div id='form' class="col-md-6 mb-4">
            <div >
                <h2>Formulario de Contacto</h2>
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="mensaje">Mensaje:</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="4" required></textarea>
                    </div>
                    <button name="submit" type="submit" class="btn btn-primary">Enviar</button>
                </form>
            </div>
        </div>
    </section>
</main>
<?php include "./footer.php"; ?>
</body>
</html>