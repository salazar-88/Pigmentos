<?php

include('../php/config.php');  // Incluye la configuración de la base de datos desde la carpeta 'php'

// Incluir el archivo de configuración para conectar con la base de datos

require_once 'config.php'; // Asegúrate de que esta ruta sea correcta

// Verificar si el formulario fue enviado usando el método POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recoger los datos enviados desde el formulario
    $nombre = trim($_POST['nombre']);
    $email = trim($_POST['email']);
    $mensaje = trim($_POST['mensaje']);

    if (strlen($nombre) < 3) {
        echo "El nombre debe tener al menos 3 caracteres.";
        exit;
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
        exit;
    }
    
    if (strlen($mensaje) < 10) {
        echo "El mensaje debe tener al menos 10 caracteres.";
        exit;
    }
    
    // Validar que los campos no estén vacíos
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo "Por favor, completa todos los campos.";
        exit;
    }

    // Validar que el email sea válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, ingresa un correo electrónico válido.";
        exit;
    }

    // Preparar la consulta SQL para insertar los datos
    $sql = "INSERT INTO formulario_contacto (nombre, email, mensaje) VALUES (?, ?, ?)";

    // Usar prepared statements para evitar inyección SQL
    $stmt = $conexion->prepare($sql);
    if (!$stmt) {
        die("Error en la preparación de la consulta: " . $conexion->error);
    }

    // Enlazar los valores con los marcadores de posición
    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "Formulario enviado correctamente. ¡Gracias por contactarnos!";
    } else {
        echo "Error al guardar los datos: " . $stmt->error;
    }

    // Cerrar el statement y la conexión
    $stmt->close();
    $conexion->close();
} else {
    // Redirigir a una página de error si se accede al archivo directamente
    header("Location: ../test/error.php");
    exit;
}
?>
