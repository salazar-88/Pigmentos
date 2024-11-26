
// Boton de ver mas en la pag de servicios

function toggleImages() {
    // Selecciona todas las filas con la clase "hidden"
    const hiddenRows = document.querySelectorAll('.image-row.hidden');
    const button = document.querySelector('.see-more button');

    // Verifica si las filas están ocultas
    if (hiddenRows[0].style.display === 'none' || !hiddenRows[0].style.display) {
        // Muestra las filas ocultas
        hiddenRows.forEach(row => row.style.display = 'flex');
        button.textContent = 'Ver menos'; // Cambia el texto del botón
    } else {
        // Oculta las filas nuevamente
        hiddenRows.forEach(row => row.style.display = 'none');
        button.textContent = 'Ver más'; // Cambia el texto del botón
    }
}


// opaca las imagenes en la misma pagina de las imagenes de servicios

document.addEventListener("DOMContentLoaded", function () {
    // Selecciona todas las imágenes dentro de la galería
    const images = document.querySelectorAll('.image-gallery img');

    images.forEach(img => {
        img.addEventListener('click', function () {
            // Primero, elimina las clases 'clicked' y 'dimmed' de todas las imágenes
            images.forEach(image => {
                image.classList.remove('clicked');
                image.classList.add('dimmed');
            });

            // Agrega la clase 'clicked' solo a la imagen que fue clickeada
            this.classList.add('clicked');
            this.classList.remove('dimmed');
        });
    });

    // Si haces clic fuera de cualquier imagen, quita el efecto
    document.addEventListener('click', function (e) {
        if (!e.target.closest('.image-gallery img')) {
            images.forEach(image => {
                image.classList.remove('clicked', 'dimmed');
            });
        }
    });
});
