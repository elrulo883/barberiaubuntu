<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'webmaster') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Webmaster</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener un archivo de estilos -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenido, Webmaster</h1>
            <nav>
                <ul>
                    <li><a href="registrar_empleado.php" class="nav-link">Registrar Empleado</a></li>
                    <li><a href="eliminar_empleado.php" class="nav-link">Eliminar Empleado</a></li>
                    <li><a href="ver_reportes_financieros.php" class="nav-link">Ver Reportes Financieros</a></li>
                    <li><a href="agendar_cita.php" class="nav-link">Agendar Cita</a></li>
                    <li><a href="manejo_pagos.php" class="nav-link">Manejo de Pagos</a></li>
                    <li><a href="ver_citas.php" class="nav-link">Ver Citas</a></li>
                    <li><a href="gestion_inventario.php" class="nav-link">Gestión de Inventario</a></li>
                    <li><a href="logout.php" class="nav-link">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Funciones de Webmaster</h2>
            <p>Aquí podrás gestionar empleados, reportes, citas y más.</p>
        </main>
    </div>
</body>
</html>