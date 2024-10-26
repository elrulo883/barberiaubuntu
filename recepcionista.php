<?php
session_start();

// Verificar si el usuario es recepcionista
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'recepcionista') {
    echo "Acceso denegado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Recepcionista - Barbería</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>
    <div class="container">
        <h1>Bienvenida Recepcionista</h1>
        <h2>Seleccione una opción:</h2>
        <ul>
            <li><a href="agendar_cita.php">Agendar Cita</a></li>
            <li><a href="manejo_pagos.php">Manejo de Pagos</a></li>
            <li><a href="ver_citas.php">Ver Citas</a></li>
            <li><a href="gestion_inventario.php">Gestión de Inventario</a></li>
        </ul>
        <a href="cerrar_sesion.php">Cerrar Sesión</a>
    </div>
</body>
</html>