// redireccionamiento al formulario con cambio de titulo 

document.addEventListener("DOMContentLoaded", () => {
    const referrer = document.referrer; // Detecta la URL de la página de origen
    const titulo = document.querySelector("#forms");
    const subtitulo = document.querySelector(".fm_subtitle");

    if (referrer.includes("/test/html/FomularioExterno.html") || 
        referrer.includes("escolares.html") || 
        referrer.includes("navidad.html") || 
        referrer.includes("sanvalentin.html") || 
        referrer.includes("septiembre.html") ||
        referrer.includes("noviembre.html") ||
        referrer.includes("halloween.html") ||
        referrer.includes("febrero.html") ||
        referrer.includes("enero.html"))
        {
        // Si proviene de alguna página que corresponde a "paquetes"
        titulo.textContent = "¡Formulario de Paquetes!";
        subtitulo.textContent = "Llena los campos del siguiente formulario para pedir más información acerca de los paquetes que más te interesen.";
    } else if (referrer.includes("servicios.html")) {
        // Si proviene de servicios.html
        titulo.textContent = "¡Formulario de Servicios!";
        subtitulo.textContent = "Llena los campos del siguiente formulario para pedir más información acerca de los servicios que ofrecemos.";
    } else {
        // Caso general o acceso directo
        titulo.textContent = "¡Formulario Servicios!";
        subtitulo.textContent = "Llena los campos del siguiente formulario para pedir más información acerca de los servicios que ofrecemos.";
    }
});
