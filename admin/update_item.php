<?php
include('../php/config.php');

// Recibir datos del cliente
$ID_Inventario = $_POST['ID_Inventario'] ?? null;
$Cantidad = $_POST['Cantidad'] ?? null;

if ($ID_Inventario && $Cantidad) {
    // Llamar al procedimiento almacenado
    $stmt = $conexion->prepare("CALL Actualizar_Inventario(?, ?)");
    $stmt->bind_param("ii", $ID_Inventario, $Cantidad);

    if ($stmt->execute()) {
        echo "Registro actualizado correctamente.";
    } else {
        echo "Error al actualizar el registro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Datos incompletos para la actualización.";
}

$conexion->close();
?>
