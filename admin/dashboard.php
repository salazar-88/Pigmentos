<?php

include('../php/config.php');  // Incluye la configuración de la base de datos desde la carpeta 'php'

$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "Imprenta_Pigmentos_db";

$conexion = new mysqli($servername, $username, $password, $dbname);

if ($conexion->connect_errno) {
    die("Conexión Fallida: " . $conexion->connect_errno);
} 
// else {
//     echo "Conectado";
// }


$sql = "SELECT * FROM Inventario";
$result = $conexion->query($sql);

$sql_proveedores = "SELECT * FROM Proveedores";
$result_proveedores = $conexion->query($sql_proveedores);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pigmentos - Dashboard</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/Recurso-2.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/pigmentos.css"rel="stylesheet"> 

        <style>
        /* CSS para ocultar filas adicionales al cargar la página */
        .extra-row {
            display: none;
        }
    </style>

</head>
<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="dashboard.php" class="navbar-brand mx-4 mb-3" title="Pigmentos Reynosa">
                    <h3 class="text-primary"><i class="bi bi-vector-pen"></i></i>Pigmentos</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                <div class="navbar-nav w-100">

                       <!-- Menú personalizado según el rol -->
                       <a href="dashboard.php" class="nav-item nav-link" title="Panel de inventario">
                            <i class="bi bi-archive-fill"></i> <span class="ms-2">Inventario</span>
                        </a>
                        <a href="form.php" class="nav-item nav-link" title="Panel de formularios de paquetes">
                            <i class="bi bi-envelope-open-fill"></i> <span class="ms-2">Formularios</span>
                        </a>
                    </div>
                </nav>
        </div>
        <!-- Sidebar End -->

        <!-- Content Start -->
        <div class="content">
            <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="dashboard.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars"></i>
                </a>
                        </nav>
            <!-- Navbar End -->

            <!-- Inventory -->
            <div class="container-fluid pt-4 px-4">
                <div class="panel text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                    <h6 class="mb-0" style="color: #000;" title="Inventario">Inventario</h6>
                    <!-- Personalización según el rol -->
                    </div>
                    <div class="text-start mb-4">
                    <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addInventoryModal" title="Agregar Inventario">
                        <i class="bi bi-plus-circle-fill"></i> Agregar Inventario
                    </button>

                    </div>
                    <div class="table-responsive">
    <table class="table text-start align-middle table-bordered table-hover mb-0">
        <thead>
            <tr class="text-white">
            <th scope="col" title="Identificador único del material">ID</th>
            <th scope="col" title="Nombre del material">Material</th>
            <th scope="col" title="Cantidad disponible en el inventario">Cantidad</th>
            <th scope="col" title="Identificador único del proveedor">ID Proveedor</th>
                    <th scope="col" title="Opciones para gestionar el inventario">Acciones</th> <!-- Clase para la columna -->
            </tr>
        </thead>
        
                    <?php
                        $rowCount = 0;
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $rowClass = $rowCount < 5 ? "" : "extra-row";
                                echo "<tr class='$rowClass'>";
                                echo "<td>" . $row["ID_Inventario"] . "</td>";
                                echo "<td>" . $row["Material"] . "</td>";
                                echo "<td>" . $row["Cantidad"] . "</td>";
                                echo "<td>" . $row["ID_Proveedor"] . "</td>";
                                echo "<td>";
                                    echo "
                                        <button class='btn btn-primary me-2 delete-btn' data-id='" . $row["ID_Inventario"] . "' title='Eliminar este material'>
                                            <i class='bi bi-trash-fill'></i> Borrar
                                        </button>
                                        <button class='btn btn-light update-btn' data-id='" . $row["ID_Inventario"] . "' title='Actualizar este material'>
                                            <i class='bi bi-pencil-square'></i> Actualizar
                                        </button>";
                                }
                                   echo "</td>";
                                echo "</tr>";
                                $rowCount++;
                            }
                        ?>
    </table>
</div>
                </div>
                <div class="panel text-center rounded p-4 mt-4">
                <h6 class="mb-4 text-start" style="color: #000;" title="Proveedores">Proveedores</h6>
                <div class="text-start mb-4">
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addProviderModal" title="Agregar Proveedor">
                    <i class="bi bi-plus-circle-fill"></i> Agregar Proveedor
                </button>
                </div>
                <div class="table-responsive">
                    <table class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                            <th scope="col" title="Identificador único del proveedor">ID</th>
                            <th scope="col" title="Nombre del proveedor">Proveedor</th>
                                    <th scope="col" title="Opciones para gestionar proveedores">Acciones</th>
                            </tr>
                        </thead>
                        <?php
                                    if ($result_proveedores->num_rows > 0) {
                                        while ($row = $result_proveedores->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row["ID_Proveedor"] . "</td>";
                                            echo "<td>" . $row["Proveedor"] . "</td>";
                                            echo "<td>";
                                                echo "
                                                <button class='btn btn-primary delete-provider-btn' data-id='" . $row["ID_Proveedor"] . "' title='Eliminar este proveedor'>
                                                    <i class='bi bi-trash-fill'></i> Borrar
                                                </button>
                                                <button class='btn btn-light update-provider-btn' data-id='" . $row["ID_Proveedor"] . "' title='Actualizar este proveedor'>
                                                    <i class='bi bi-pencil-square'></i> Actualizar
                                                </button>";

                                            }
                                             echo     "</td>";
                                            echo "</tr>";
                            }                        ?>
                    </table>
                </div>
            </div>
            </div>
     </div>

     <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>

        </div>
        <!-- Content End -->

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <script>
        document.getElementById("showAllBtn").addEventListener("click", function() {
            var extraRows = document.querySelectorAll(".extra-row");
            var areRowsVisible = extraRows[0].style.display === "table-row";

            extraRows.forEach(function(row) {
                row.style.display = areRowsVisible ? "none" : "table-row";
            });

            // Cambia el texto del botón
            this.textContent = areRowsVisible ? "Mostrar Todos" : "Ocultar";

            // Alterna la clase de centrado en el mensaje de bienvenida
            document.getElementById("welcomeMessage").classList.toggle("centered-text");
        });
    </script>

<script>
document.querySelectorAll('.delete-btn').forEach(button => {
    button.addEventListener('click', function() {
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            const ID_Inventario = this.getAttribute('data-id');

            fetch('/php/delete_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `ID_Inventario=${encodeURIComponent(ID_Inventario)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
</script>

<script>
document.querySelectorAll('.update-btn').forEach(button => {
    button.addEventListener('click', function() {
        const ID_Inventario = this.getAttribute('data-id');
        const Cantidad = prompt("Ingrese la nueva cantidad:");

        if (Cantidad && !isNaN(Cantidad)) {
            fetch('update_item.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `ID_Inventario=${encodeURIComponent(ID_Inventario)}&Cantidad=${encodeURIComponent(Cantidad)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert("Por favor, ingrese un número válido.");
        }
    });
});
</script>

<script>
    document.querySelectorAll('.delete-provider-btn').forEach(button => {
    button.addEventListener('click', function() {
        if (confirm('¿Estás seguro de que deseas eliminar este proveedor?')) {
            const ID_Proveedor = this.getAttribute('data-id');

            fetch('delete_provider.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `ID_Proveedor=${encodeURIComponent(ID_Proveedor)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        }
    });
});
</script>

<script>

document.querySelectorAll('.update-provider-btn').forEach(button => {
    button.addEventListener('click', function() {
        const ID_Proveedor = this.getAttribute('data-id');
        const Proveedor = prompt("Ingrese el nuevo nombre del proveedor:");
        if (Proveedor && Proveedor.trim() !== "") {
            fetch('update_provider.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `ID_Proveedor=${encodeURIComponent(ID_Proveedor)}&Proveedor=${encodeURIComponent(Proveedor)}`
            })
            .then(response => response.text())
            .then(data => {
                console.log('Respuesta del servidor:', data);
                alert(data);
                location.reload();
            })
            .catch(error => console.error('Error:', error));
        } else {
            alert("Por favor, ingrese un nombre válido.");
        }
    });
});
</script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <div class="modal fade" id="addInventoryModal" tabindex="-1" aria-labelledby="addInventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addInventoryForm" method="POST" action="add_item.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addInventoryModalLabel">Agregar Inventario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="material" class="form-label">Material</label>
                        <input type="text" class="form-control" id="material" name="Material" required>
                    </div>
                    <div class="mb-3">
                        <label for="cantidad" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="cantidad" name="Cantidad" required>
                    </div>
                    <div class="mb-3">
                        <label for="idProveedor" class="form-label">ID Proveedor</label>
                        <input type="number" class="form-control" id="idProveedor" name="ID_Proveedor" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="addProviderModal" tabindex="-1" aria-labelledby="addProviderModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addProviderForm" method="POST" action="add_provider.php">
                <div class="modal-header">
                    <h5 class="modal-title" id="addProviderModalLabel">Añadir Proveedor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="Proveedor" class="form-label">Nombre del Proveedor</label>
                        <input type="text" class="form-control" id="Proveedor" name="Proveedor" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Añadir</button>
                </div>
            </form>
        </div>
    </div>
</div>


</body>
</html>
