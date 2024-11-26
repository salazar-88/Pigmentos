<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Pigmentos - Crear Cuenta</title>
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
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Sign Up Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="dashboard.php" class="">
                                <h3 class="text-primary"><i class="bi bi-vector-pen"></i>Pigmentos</h3>
                            </a>
                            <h3>Crear cuenta</h3>
                        </div>
                        <form id="registerForm" method="POST">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="floatingText" name="username" placeholder="jhondoe" required>
                                <label for="floatingText">Nombre de Usuario</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" required>
                                <label for="floatingInput">Correo Electrónico</label>
                            </div>
                            <div class="form-floating mb-4">
                                <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password" required>
                                <label for="floatingPassword">Contraseña</label>
                                <button type="button" onclick="togglePasswordVisibility()" class="btn btn-sm btn-outline-secondary position-absolute top-50 end-0 translate-middle-y me-3">
                                    <i id="togglePasswordIcon" class="fa fa-eye" style="color: #ffc107;"></i>
                                </button>
                            </div>
                            <button type="submit" class="btn btn-primary py-3 w-100 mb-4">Registrarse</button>
                            <p class="text-center mb-0">¿Ya tienes una cuenta? <a href="signin.php" style="color: #15B0B5;">Inicia Sesión</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign Up End -->
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

        $(document).ready(function() {
            $("#registerForm").on("submit", function(event) {
                event.preventDefault();

                var username = $("#floatingText").val();
                var email = $("#floatingInput").val();
                var password = $("#floatingPassword").val();

                $.ajax({
                    url: 'register.php',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        username: username,
                        email: email,
                        password: password
                    },
                    success: function(response) {
                        if (response.status === "success") {
                            alert(response.message);
                            window.location.href = "signin.php"; // Redirige al inicio de sesión
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function() {
                        alert("Usuario agregado correctamente.");
                        window.location.href = "signin.php"; // Redirige al inicio de sesión
                    }
                });
            });
        });
    </script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>
