<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'raul') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Raúl</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener un archivo de estilos -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenido, Raúl</h1>
            <nav>
                <ul>
                    <li><a href="gestion_inventario.php" class="nav-link">Inventarios</a></li>
                    <li><a href="manejo_pagos.php" class="nav-link">Pagos</a></li>
                    <li><a href="logout.php" class="nav-link">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Funciones de Raúl</h2>
            <p>Aquí podrás gestionar inventarios y pagos.</p>
        </main>
    </div>
</body>
</html>