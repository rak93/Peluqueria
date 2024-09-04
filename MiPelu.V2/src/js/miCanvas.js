// Crear una imagen para el SVG
const canvas = document.getElementById("miCanvas");
const ctx = canvas.getContext("2d");

const svgData = '<svg fill="#010002" viewBox="0 0 491.769 491.769" width="32" height="32" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">' +
    '<g>' +
        '<path style="fill:#010002;" d="M407.885,10c-5.333-6-12-9.333-20-10h-86c-4,0-6.833,1.667-8.5,5s-1.667,6.667,0,10s4.5,5,8.5,5' +
            'h71v9h-71c-4,0-6.833,1.667-8.5,5s-1.667,6.5,0,9.5s4.5,4.5,8.5,4.5h71v10h-71c-4,0-6.833,1.667-8.5,5' +
            's-1.667,6.5,0,9.5s4.5,4.5,8.5,4.5h71v10h-71c-4,0-6.833,1.667-8.5,5' +
            's-1.667,6.5,0,9.5s4.5,4.5,8.5,4.5h71v10h-71c-6,0-9,3.167-9,9.5s3,9.5,9,9.5' +
            'h71v10h-71c-4,0-6.833,1.5-8.5,4.5s-1.667,6.167,0,9.5s4.5,5,8.5,5' +
            'h71v9h-71c-4,0-6.833,1.667-8.5,5s-1.667,6.5,0,9.5' +
            's4.5,4.5,8.5,4.5h71v10h-71v19h71v186c0,8.667,3.667,14.833,11,18.5' +
            's14.5,3.667,21.5,0s10.5-9.833,10.5-18.5V30C415.885,22.667,413.218,16,407.885,10z"/>' +
    '</g>' +
'</svg>';


// Crear una imagen para el SVG
const img = new Image();
img.src = 'data:image/svg+xml;base64,' + btoa(svgData); // Convertir a base64

let xSmallScreen = 0; // Posición inicial en pantallas pequeñas
const speedSmallScreen = 1; // Velocidad de movimiento en pantallas pequeñas

// Función para dibujar el SVG en el canvas en pantallas pequeñas
function drawSmallScreen() {
    ctx.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas
    ctx.drawImage(img, xSmallScreen, 100); // Dibujar la imagen en la posición (xSmallScreen, 100)
}

// Función para actualizar la posición del SVG en pantallas pequeñas
function updateSmallScreen() {
    xSmallScreen += speedSmallScreen; // Mover hacia la derecha
    if (xSmallScreen > canvas.width) {
        xSmallScreen = -img.width; // Reiniciar cuando llega al borde
    }
}

// Bucle de animación en pantallas pequeñas
function loopSmallScreen() {
    updateSmallScreen(); // Actualizar posición
    drawSmallScreen();   // Dibujar el SVG en su nueva posición

    // Pedir el siguiente cuadro de animación
    requestAnimationFrame(loopSmallScreen);
}

// Iniciar el bucle de animación en pantallas pequeñas una vez que la imagen esté cargada
img.onload = function() {
    // Verificar el tamaño de la pantalla
    if (window.innerWidth < 600) {
        loopSmallScreen(); // Iniciar bucle de animación en pantallas pequeñas
    } else {
        loop(); // Iniciar bucle de animación normalmente
    }
};
