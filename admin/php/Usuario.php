<?php
// Lista de usuarios permitidos con sus contraseñas
$usuarios_permitidos = [
    'pigmentos.grafica@gmail.com' => 'P1gm3nt05',
    'usuario2@example.com' => 'contraseña2',
    'usuario3@example.com' => 'contraseña3'
];

// Verifica si se enviaron datos de inicio de sesión
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    // Comprobar si el usuario y la contraseña coinciden con los usuarios permitidos
    if (array_key_exists($usuario, $usuarios_permitidos) && $usuarios_permitidos[$usuario] === $contrasena) {
        session_start();
        $_SESSION['usuario'] = $usuario;
        header("Location: index.html"); // Redirige a la página principal
        exit();
    } else {
        $mensaje_error = "Nombre de usuario o contraseña incorrectos.";
    }
}
?>