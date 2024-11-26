document.addEventListener("DOMContentLoaded", () => {
    const scrollTopBtn = document.getElementById("scrollTopBtn");

    // Seleccionar todas las secciones, incluyendo el ID 'about'
    const sections = [...document.querySelectorAll("section, .container-eslogan, .Paquetes-content container, .container-imprenta, .mapa ")];
    let currentSectionIndex = sections.length - 1; // Comenzar desde la última sección

    // Mostrar u ocultar el botón según el scroll
    window.onscroll = function () {
        if (window.scrollY > 300) {
            scrollTopBtn.style.display = "block"; // Mostrar el botón
        } else {
            scrollTopBtn.style.display = "none"; // Ocultar el botón
        }
    };

    // Lógica para desplazarse por secciones
    scrollTopBtn.onclick = function () {
        if (currentSectionIndex > 0) {
            currentSectionIndex--; // Retrocede una sección
            sections[currentSectionIndex].scrollIntoView({
                behavior: "smooth",
            });
        } else {
            // Al llegar a la parte superior, ocultar el botón
            window.scrollTo({ top: 0, behavior: "smooth" });
            currentSectionIndex = sections.length - 1; // Reinicia el índice
        }
    };
});
