document.addEventListener("DOMContentLoaded", function () {
    // Fetch para cargar el menú desde el archivo menu.html
    fetch('/test/html/menu.html') // Usa ruta absoluta para evitar problemas de rutas
        .then(response => {
            if (!response.ok) {
                throw new Error('Error al cargar el menú: ' + response.status);
            }
            return response.text();
        })
        .then(data => {
            const menuContainer = document.getElementById('menu-container');
            if (menuContainer) {
                menuContainer.innerHTML = data;

                // Si la página actual es "Servicios", añadir clase al menú
                if (document.title.trim() === 'Servicios') {
                    menuContainer.classList.add('bg-yellow');
                }

                // Verifica si la página actual no es "Pigmentos" y añade clase al menú
                if (document.title.trim() !== 'Pigmentos') {
                    const menuBar = document.getElementById('menuBar');
                    if (menuBar) {
                        menuBar.classList.add('colored');
                    } else {
                        console.error('Error: No se encontró el elemento con ID "menuBar".');
                    }

                    // Asegura que el botón "Regresar" esté visible en otras páginas
                    const backButton = document.getElementById('backButton');
                    if (backButton) {
                        backButton.style.display = 'inline-block'; // Muestra el botón "Regresar"
                    }
                } else {
                    // Si estamos en la página "Pigmentos", oculta el botón "Regresar"
                    const backButton = document.getElementById('backButton');
                    if (backButton) {
                        backButton.style.display = 'none'; // Oculta el botón "Regresar" en la página "Pigmentos"
                    }
                }
            } else {
                console.error('Error: No se encontró el elemento con ID "menu-container".');
            }
        })
        .catch(error => console.error('Error loading menu:', error));

    const menu = document.getElementById('menuBar'); // Selecciona el menú por su ID
    if (menu) { // Verifica si el menú existe antes de agregar el evento de scroll
        const stickyOffset = menu.offsetTop; // Obtiene la posición inicial del menú

        function handleScroll() {
            if (window.pageYOffset > stickyOffset) {
                menu.classList.add('fixed'); // Añade la clase 'fixed' cuando haces scroll hacia abajo
            } else {
                menu.classList.remove('fixed'); // La quita cuando estás en la parte superior
            }
        }

        window.addEventListener('scroll', handleScroll); // Añade el evento de scroll
    } else {
        console.error('Error: No se encontró el elemento con ID "menuBar" para fijar al hacer scroll.');
    }
});
