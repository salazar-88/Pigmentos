//INICIO DEL CAROUSEL 
// Selecciona el botón

const infoButton = document.getElementById('infoButton');

infoButton.textContent = 'Escolares';
infoButton.href = '/test/html/escolares.html'; // Cambia la URL

// Selecciona los inputs del slide
const slide1 = document.getElementById('slide-1');
const slide2 = document.getElementById('slide-2');
const slide3 = document.getElementById('slide-3');
const slide4 = document.getElementById('slide-4');
const slide5 = document.getElementById('slide-5');
const slide6 = document.getElementById('slide-6');
const slide7 = document.getElementById('slide-7');

// Añade event listeners a cada slide para cambiar el texto y el href del botón
slide1.addEventListener('change', function () {
    if (slide1.checked) {
        infoButton.textContent = 'Escolares';
        infoButton.href = '/test/html/escolares.html'; // Cambia la URL
    }
});

slide2.addEventListener('change', function () {
    if (slide2.checked) {
        infoButton.textContent = 'Navidad';
        infoButton.href = '/test/html/navidad.html'; // Cambia la URL
    }
});

slide3.addEventListener('change', function () {
    if (slide3.checked) {
        infoButton.textContent = 'Septiembre';
        infoButton.href = '/test/html/septiembre.html'; // Cambia la URL
    }
});

slide4.addEventListener('change', function () {
    if (slide4.checked) {
        infoButton.textContent = 'Noviembre';
        infoButton.href = '/test/html/noviembre.html'; // Cambia la URL
    }
});

slide5.addEventListener('change', function () {
    if (slide5.checked) {
        infoButton.textContent = 'Halloween';
        infoButton.href = '/test/html/halloween.html'; // Cambia la URL
    }
});

slide6.addEventListener('change', function () {
    if (slide6.checked) {
        infoButton.textContent = 'Enero';
        infoButton.href = '/test/html/enero.html'; // Cambia la URL
    }
});

slide7.addEventListener('change', function () {
    if (slide7.checked) {
        infoButton.textContent = 'Febrero';
        infoButton.href = '/test/html/febrero.html'; // Cambia la URL
    }
});
//FIN DEL CAROUSEL

//INICIO DEL MENU
// Obtener la URL actual
const currentUrl = window.location.pathname;

// Obtener todos los elementos del menú
const menuItems = document.querySelectorAll('.menu-item');

// Recorrer cada elemento del menú
menuItems.forEach(item => {
    // Comparar el href del enlace con la URL actual
    if (item.getAttribute('href') === currentUrl) {
        item.classList.add('active');  // Agregar la clase "active"
    }
});


