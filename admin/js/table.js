<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById('mostrar-todos').addEventListener('click', function(event) {
        event.preventDefault(); // Evita que el enlace recargue la página

        const rows = document.querySelectorAll('.extra-row');
        rows.forEach(row => {
            row.style.display = row.style.display === 'none' ? '' : 'none';
        });

        // Cambia el texto del enlace
        this.textContent = this.textContent === 'Mostrar Todos';
    })
})
</script>
