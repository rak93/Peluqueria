<link rel="stylesheet" href="./src/css/style.css">

</header>

<body>
    <header>
        <nav>
            <button id="botonNav">☰</button>
            <ul id="menuNav">
                <li><a href="./index.php">Inicio</a></li>
                <li><a href="./tratamientos.php">Tratamientos</a></li>
                <li><a href="./pedirCita.php">Pedir Cita</a></li>
                <li><a href="./galeria.php">Galería</a></li>
             <?php
             
                if (isset($_SESSION["admin"])) {
                    echo "  <li><form action='./cerrar.php' method='post'>";
                    echo "  <input type='submit' value='cerrar sesion'>";
                    echo " </form> </li>";
                }
                
                ?> 
            </ul>
        </nav>
        <script src="./src/js/header.js"></script>
    </header>