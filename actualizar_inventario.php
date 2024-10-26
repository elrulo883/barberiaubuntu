<?php
session_start();

// Verificar si el usuario es recepcionista
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'recepcionista') {
    echo "Acceso denegado.";
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre_producto = $_POST['nombre_producto'];
    $cantidad = $_POST['cantidad'];

    // Actualizar la cantidad del producto en el inventario
    $sql_inventario = "UPDATE inventarios SET cantidad = $cantidad, fecha_actualizacion = CURDATE() 
                       WHERE nombre_producto = '$nombre_producto'";
    
    if ($conexion->query($sql_inventario) === TRUE) {
        echo "Inventario actualizado con éxito.";
    } else {
        echo "Error al actualizar el inventario: " . $conexion->error;
    }
}

$conexion->close();
?>