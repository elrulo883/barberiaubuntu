<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado el id de la cita
if (isset($_POST['id_cita'])) {
    $id_cita = $_POST['id_cita'];

    // Eliminar los pagos asociados a la cita
    $sqlEliminarPagos = "DELETE FROM pagos WHERE id_cita = ?";
    $stmtEliminarPagos = $conexion->prepare($sqlEliminarPagos);
    $stmtEliminarPagos->bind_param("i", $id_cita);
    $stmtEliminarPagos->execute();
    $stmtEliminarPagos->close();

    // Preparar y ejecutar la consulta para eliminar la cita
    $sql = "DELETE FROM citas WHERE id_cita = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id_cita); // 'i' significa que es un entero

    if ($stmt->execute()) {
        echo "Cita eliminada exitosamente.";
    } else {
        echo "Error al eliminar la cita: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No se ha especificado un ID de cita.";
}

$conexion->close();
?>

<a href="menu_recepcionista.php">Regresar al menú</a>