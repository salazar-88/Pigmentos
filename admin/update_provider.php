<?php
include('../php/config.php');


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ID_Proveedor = $_POST['ID_Proveedor'];
    $Proveedor = $_POST['Proveedor'];

    $conexion = new mysqli($servername, $username, $password, $dbname);

    if ($conexion->connect_errno) {
        die("Conexión fallida: " . $conexion->connect_error);
    }

    $stmt = $conexion->prepare("CALL Actualizar_Proveedor(?, ?)");
    $stmt->bind_param("is", $ID_Proveedor, $Proveedor);

    if ($stmt->execute()) {
        echo "Nombre del proveedor actualizado correctamente.";
    } else {
        echo "Error al actualizar el proveedor: " . $stmt->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
