<?php
session_start();

// Verificar si el usuario está autenticado como Jesica o webmaster
if (!isset($_SESSION['rol']) || ($_SESSION['rol'] !== 'Jesica' && $_SESSION['rol'] !== 'webmaster')) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú de Jesica y Webmaster</title>
    <link rel="stylesheet" href="styles.css"> <!-- Asegúrate de tener un archivo de estilos -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Bienvenid@, <?php echo $_SESSION['rol']; ?></h1>
            <nav>
                <ul>
                    <li><a href="ver_citas.php" class="nav-link">Citas</a></li>
                    <li><a href="logout.php" class="nav-link">Cerrar Sesión</a></li>
                </ul>
            </nav>
        </header>
        <main>
            <h2>Funciones de <?php echo $_SESSION['rol']; ?></h2>
            <p>Puedes gestionar citas desde el menú de navegación.</p>
        </main>
    </div>
</body>
</html>