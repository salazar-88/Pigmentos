    document.getElementById("fm-contact").addEventListener("submit", function(e) {
        const nombre = document.getElementById("nombre").value.trim();
        const email = document.getElementById("email").value.trim();
        const mensaje = document.getElementById("mensaje").value.trim();

        if (nombre.length < 3) {
            alert("El nombre debe tener al menos 3 caracteres.");
            e.preventDefault(); // Detener el envío
            return;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            alert("Por favor, ingresa un correo válido.");
            e.preventDefault();
            return;
        }

        if (mensaje.length < 10) {
            alert("El mensaje debe tener al menos 10 caracteres.");
            e.preventDefault();
            return;
        }
        // Prevenir el envío del formulario
        e.preventDefault();
        
        // Mostrar cuadro de confirmación con SweetAlert2
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Tu formulario se enviará ahora.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, enviar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, enviar el formulario
                e.target.submit();
            }
        });
    });
