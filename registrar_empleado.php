<?php
// Sesión iniciada por el jefe o el webmaster
session_start();

// Verificar si el usuario es el jefe o el webmaster
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['jefe', 'webmaster'])) {
    echo "Acceso denegado. Solo el jefe o el webmaster pueden registrar empleados.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Empleados</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>

    <div class="container">
        <h1 class="header">Registrar Nuevo Empleado</h1>
        
        <form action="procesar_registro.php" method="POST">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" name="nombre_usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" name="password" required>

            <label for="rol">Rol:</label>
            <select name="rol" required>
                <option value="barbero">Barbero</option>
                <option value="recepcionista">Recepcionista</option>
            </select>

            <input type="submit" value="Registrar">
        </form>

        <p>
            <a href="
            <?php 
                if ($_SESSION['rol'] == 'jefe') {
                    echo 'menu_jefe.php';
                } elseif ($_SESSION['rol'] == 'webmaster') {
                    echo 'webmaster.php';
                } 
            ?>">
                <button type="button">Volver al Menú</button>
            </a>
        </p>
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>

</body>
</html>