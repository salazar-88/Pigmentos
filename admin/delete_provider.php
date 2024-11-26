<?php
include('../php/config.php');

if (isset($_POST['ID_Proveedor'])) {
    // Recoger el ID del producto a eliminar
    $ID_Proveedor = $_POST['ID_Proveedor'];
    // Llamar al procedimiento almacenado
    $stmt = $conexion->prepare("CALL Eliminar_Proveedor(?)");
    $stmt->bind_param("i", $ID_Proveedor);

    if ($stmt->execute()) {
        echo "Proveedor eliminado correctamente.";
    } else {
        echo "Error al eliminar el proveedor: " . $conexion->error;
    }

    $stmt->close();
    $conexion->close();
}
?>
