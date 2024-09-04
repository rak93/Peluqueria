function validarFormularioCLiente() {
    // Obtener los valores de los campos
    var nombre = document.forms["f1"]["Nombre"].value;
    var apellido1 = document.forms["f1"]["Apellido1"].value;
    var apellido2 = document.forms["f1"]["Apellido2"].value;
    var telefono = document.forms["f1"]["telefono"].value;

    // Verificar que todos los campos requeridos tengan contenido
    if (nombre === "" || apellido1 === "" || telefono === "") {
        alert("Los campos Nombre, Apellido1 y Teléfono son obligatorios");
        return false; // Impide el envío del formulario
    }
    return true; // Permite el envío del formulario
}
function validarFormulario() {
    var nombre = document.getElementById("nombre").value;
    var email = document.getElementById("email").value;
    var mensaje = document.getElementById("mensaje").value;

    if (nombre === "" || email === "" || mensaje === "") {
        alert("Todos los campos son obligatorios.");
        return false;
    }

    var regexEmail = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!regexEmail.test(email)) {
        alert("Por favor, ingrese un correo electrónico válido.");
        return false;
    }

    return true;
}