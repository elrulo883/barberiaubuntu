<?php
session_start();

// Verificar si el usuario es jefe
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'jefe') {
    echo "Acceso denegado. Solo los jefes pueden ver esta página.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Jefe</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body class="dark-theme">

    <div class="container">
        <h1 class="header">Bienvenido, Jefe</h1>
        
        <h3>Opciones</h3>
        <form method="GET" action="registrar_empleado.php">
            <button type="submit">Registrar Nuevo Empleado</button>
        </form>
        <form method="GET" action="eliminar_empleado.php">
            <button type="submit">Eliminar Empleado</button>
        </form>
        <form method="GET" action="ver_reportes_financieros.php">
            <button type="submit">Ver Reportes Financieros</button>
        </form>

        <br>
        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>

</body>
</html>