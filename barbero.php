<?php
session_start();

// Verificar si el usuario es barbero
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'barbero') {
    echo "Acceso denegado. Solo los barberos pueden ver esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Barbero</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>

    <div class="container">
        <h1 class="header">Bienvenido, Barbero</h1>
        
        <!-- Sección de ver citas -->
        <h3>Ver Citas Programadas</h3>
        <form method="GET" action="ver_citas_barbero.php">
            <button type="submit">Ver Citas</button>
        </form>

        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>

</body>
</html>