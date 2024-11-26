<?php
include('../php/config.php');

// Lista de usuarios permitidos con sus contraseñas
$usuarios_permitidos = [
    'pigmentos.grafica@gmail.com' => ['contrasena' => 'P1gm3nt05', 'rol' => 'Admin'],
    'deliadominguuezz@yahoo.com' => ['contrasena' => 'P1gm3nt05!_', 'rol' => 'Editor'],
    'dani.domilopi3@gmail.com' => ['contrasena' => 'P1gm3nt05_!', 'rol' => 'Espectador']
];

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$mensaje_error = ""; // Iniciar mensaje de error como vacío

// Verifica si se enviaron datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Verificar si el usuario está en la lista de usuarios permitidos
    if (array_key_exists($usuario, $usuarios_permitidos) && $usuarios_permitidos[$usuario]['contrasena'] === $contrasena) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['rol'] = $usuarios_permitidos[$usuario]['rol'];
        header("Location: dashboard.php");
        exit();
    }

    // Verificar si el usuario está en la base de datos
    $stmt = $conn->prepare("SELECT Contraseña FROM Usuarios WHERE Correo_Electronico = ?");
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $fila = $result->fetch_assoc();
        // Validar contraseña con password_verify
        if (password_verify($contrasena, $fila['Contraseña'])) {
            session_start();
            $_SESSION['usuario'] = $usuario;
            header("Location: index.html");
            exit();
        } else {
            $mensaje_error = "Nombre de usuario o contraseña incorrectos.";
        }
    } else {
        $mensaje_error = "Nombre de usuario o contraseña incorrectos.";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pigmentos - Inicio de Sesión</title>
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
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">

        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="dashboard.php" class="">
                                <h3 class="text-primary"><i class="bi bi-vector-pen"></i>Pigmentos</h3>
                            </a>
                            <h3>Inicio de Sesión</h3>
                        </div>
                        <form method="post" action="">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingInput" name="usuario" placeholder="name@example.com" required>
                                <label for="floatingInput">Correo Electrónico</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" name="contrasena" placeholder="Password" required>
                                <label for="floatingPassword">Contraseña</label>

                                 <!-- Botón para mostrar u ocultar la contraseña -->
                                 <button type="button" onclick="togglePasswordVisibility()" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-3">
                                     <i id="togglePasswordIcon" class="fa fa-eye" style="color: #ffc107;"></i>
                                </button>

                                <?php if (!empty($mensaje_error)) : ?>
                                <p class="text-center mt-2 mb-0" style="color: #ff6b6b; font-size: 0.85em;">
                                    <?= $mensaje_error ?>
                                </p>
                            <?php endif; ?>

                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Inicio Sesión</button>
                            <p class="text-center mb-0">¿No tienes cuenta? <a href="signup.php" style="color: #15B0B5;">Registrate</a></p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        <!-- Botton Password -->

    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById("floatingPassword");
            var toggleIcon = document.getElementById("togglePasswordIcon");
            
            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                toggleIcon.classList.remove("fa-eye");
                toggleIcon.classList.add("fa-eye-slash");
            } else {
                passwordInput.type = "password";
                toggleIcon.classList.remove("fa-eye-slash");
                toggleIcon.classList.add("fa-eye");
            }
        }
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>