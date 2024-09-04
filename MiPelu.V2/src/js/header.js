const menuNav= document.getElementById("menuNav");
const btnNav= document.getElementById("botonNav");


btnNav.addEventListener("click", function() {
   
    if (menuNav.style.display === "none") {
        menuNav.style.display = "inline-block"; // Mostrar el menú
    } else {
        menuNav.style.display = "none"; // Ocultar el menú
    }
});
