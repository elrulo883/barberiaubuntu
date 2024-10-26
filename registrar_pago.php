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
    $id_cita = $_POST['id_cita'];
    $monto = $_POST['monto'];
    $metodo_pago = $_POST['metodo_pago'];

    // Insertar pago en la tabla pagos
    $sql_pago = "INSERT INTO pagos (id_cita, monto, fecha_pago, metodo_pago) 
                 VALUES ($id_cita, $monto, CURDATE(), '$metodo_pago')";
    
    if ($conexion->query($sql_pago) === TRUE) {
        echo "Pago registrado con éxito.";
    } else {
        echo "Error al registrar el pago: " . $conexion->error;
    }
}

$conexion->close();
?>