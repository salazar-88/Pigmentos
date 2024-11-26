<?php
include('../php/config.php');

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Crear la conexión usando mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Conexión fallida: " . $conn->connect_error]);
    exit;
}

// Verificar si todos los campos están completos
if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password'])) {
    echo json_encode(["status" => "error", "message" => "Todos los campos son obligatorios."]);
    $conn->close();
    exit;
}

// Obtener los datos de usuario
$usuario = $_POST['username'];
$correo = $_POST['email'];
$contrasena = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Preparar la llamada al procedimiento almacenado
$stmt = $conn->prepare("CALL Insertar_Usuario(?, ?, ?)");
if (!$stmt) {
    echo json_encode(["status" => "error", "message" => "Error en la preparación: " . $conn->error]);
    $conn->close();
    exit;
}

// Asignar parámetros y ejecutar el procedimiento
$stmt->bind_param("sss", $usuario, $correo, $contrasena);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "Usuario agregado correctamente."]);
} else {
    echo json_encode(["status" => "error", "message" => "Error al agregar al usuario: " . $stmt->error]);
}

// Cerrar el statement y la conexión
$stmt->close();
$conn->close();
?>
