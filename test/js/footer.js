document.addEventListener("DOMContentLoaded", async function () {
    try {
        // Fetch para cargar el footer desde el archivo footer.html
        const response = await fetch('/test/html/footer.html'); // Cambié la ruta a una ruta absoluta
        if (!response.ok) {
            throw new Error('Error al cargar el footer: ' + response.status);
        }

        const data = await response.text();
        const footerContainer = document.getElementById('footer-container');
        if (footerContainer) {
            footerContainer.innerHTML = data;
        } else {
            console.error('Error: No se encontró el elemento con ID "footer-container".');
        }
    } catch (error) {
        console.error('Error loading footer:', error);
    }
});
