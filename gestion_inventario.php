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

// Agregar o eliminar producto del inventario
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion'])) {
    if ($_POST['accion'] == 'agregar') {
        $nombre_producto = $conexion->real_escape_string($_POST['nombre_producto']);
        $cantidad = (int)$_POST['cantidad'];

        // Insertar nuevo producto
        $sql_inventario = "INSERT INTO inventarios (nombre_producto, cantidad) 
                           VALUES ('$nombre_producto', $cantidad)";
        
        if ($conexion->query($sql_inventario) === TRUE) {
            echo "<p>Producto agregado con éxito.</p>";
        } else {
            echo "<p>Error al agregar producto: " . $conexion->error . "</p>";
        }
    } elseif ($_POST['accion'] == 'eliminar') {
        $nombre_producto = $conexion->real_escape_string($_POST['nombre_producto']);

        // Eliminar producto
        $sql_eliminar = "DELETE FROM inventarios WHERE nombre_producto = '$nombre_producto'";
        
        if ($conexion->query($sql_eliminar) === TRUE) {
            echo "<p>Producto eliminado con éxito.</p>";
        } else {
            echo "<p>Error al eliminar producto: " . $conexion->error . "</p>";
        }
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Inventario</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>
    <div class="container">
        <h1>Gestión de Inventario</h1>

        <h2>Agregar Producto</h2>
        <form action="gestion_inventario.php" method="POST">
            <input type="hidden" name="accion" value="agregar">
            <label for="nombre_producto">Nombre del Producto:</label>
            <input type="text" name="nombre_producto" required><br>

            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" required><br>

            <button type="submit">Agregar Producto</button>
        </form>

        <h2>Eliminar Producto</h2>
        <form action="gestion_inventario.php" method="POST">
            <input type="hidden" name="accion" value="eliminar">
            <label for="nombre_producto">Nombre del Producto:</label>
            <input type="text" name="nombre_producto" required><br>

            <button type="submit">Eliminar Producto</button>
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