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