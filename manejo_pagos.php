<?php
session_start();

// Verificar si el usuario es recepcionista, webmaster o raul
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['recepcionista', 'webmaster', 'raul'])) {
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
        echo "<p>Pago registrado con éxito.</p>";
    } else {
        echo "<p>Error al registrar el pago: " . $conexion->error . "</p>";
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manejo de Pagos</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>
    <div class="container">
        <h1>Manejo de Pagos</h1>
        <form action="manejo_pagos.php" method="POST">
            <label for="id_cita">ID de Cita:</label>
            <input type="text" name="id_cita" required><br>

            <label for="monto">Monto:</label>
            <input type="number" step="0.01" name="monto" required><br>

            <label for="metodo_pago">Método de Pago:</label>
            <input type="text" name="metodo_pago" required><br>

            <button type="submit">Registrar Pago</button>
        </form>
        
        <p>
            <a href="
            <?php 
                if ($_SESSION['rol'] == 'recepcionista') {
                    echo 'menu_recepcionista.php';
                } elseif ($_SESSION['rol'] == 'webmaster') {
                    echo 'webmaster.php';
                } elseif ($_SESSION['rol'] == 'raul') {
                    echo 'raul.php';
                } 
            ?>">
                <button type="button">Regresar al menú</button>
            </a>
        </p>
    </div>
</body>
</html>