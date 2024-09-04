function toggleHeart(heart, event) {
    event.stopPropagation();
    heart.classList.toggle("active");
}

function openLightbox(image) {
    const lightbox = document.getElementById("lightbox-modal");
    const lightboxImg = document.getElementById("lightbox-image");
    lightboxImg.src = image.src;
    lightbox.style.display = "flex";

    // Add class to hide hearts
    document.body.classList.add('hide-hearts');
}

function closeLightbox(event) {
    event.stopPropagation();
    const lightbox = document.getElementById("lightbox-modal");
    lightbox.style.display = "none";

    // Remove class to show hearts again
    document.body.classList.remove('hide-hearts');
}
