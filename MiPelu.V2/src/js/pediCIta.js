function guardarFecha() {
    // Obtener el valor de la fecha del campo de entrada
    var fecha = document.getElementById('fecha').value;
    
    // Guardar la fecha en el almacenamiento local
    localStorage.setItem('fecha', fecha);
}

/*<script>
    // Recuperar la fecha del almacenamiento local
    var fechaGuardada = localStorage.getItem('fecha');

    // Establecer la fecha en el campo de entrada si está disponible
    if (fechaGuardada) {
        document.getElementById('fecha').value = fechaGuardada;
    }
</script>

<form onsubmit="guardarFecha()">
    <!-- Utiliza un campo de entrada de tipo fecha -->
    <input type="date" id="fecha">
    <input type="submit" value="Enviar">
</form>
*/