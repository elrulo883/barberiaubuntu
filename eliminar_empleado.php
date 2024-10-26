<?php
session_start();

// Verificar si el usuario es el jefe o el webmaster
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['jefe', 'webmaster'])) {
    echo "Acceso denegado. Solo el jefe o el webmaster pueden ver esta página.";
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Eliminar empleado si se envía el formulario
if (isset($_POST['eliminar'])) {
    $id_empleado = $_POST['id_empleado'];

    $sql = "DELETE FROM usuarios WHERE id = $id_empleado";

    if ($conexion->query($sql) === TRUE) {
        echo "<p style='color: green;'>Empleado eliminado con éxito.</p>";
    } else {
        echo "Error al eliminar empleado: " . $conexion->error;
    }
}

// Obtener la lista de empleados
$sql = "SELECT id, nombre_usuario, rol FROM usuarios";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Empleados</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>

    <div class="container">
        <h1 class="header">Eliminar Empleados</h1>
        <form method="POST" action="eliminar_empleado.php">
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nombre de Usuario</th>
                    <th>Rol</th>
                    <th>Acción</th>
                </tr>
                <?php
                // Mostrar la lista de empleados
                if ($resultado->num_rows > 0) {
                    while ($fila = $resultado->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $fila['id'] . "</td>";
                        echo "<td>" . $fila['nombre_usuario'] . "</td>";
                        echo "<td>" . $fila['rol'] . "</td>";
                        // Usamos un campo hidden para enviar el ID del empleado
                        echo "<td>
                            <form method='POST' action='eliminar_empleado.php'>
                                <input type='hidden' name='id_empleado' value='" . $fila['id'] . "'>
                                <button type='submit' name='eliminar'>Eliminar</button>
                            </form>
                        </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No hay empleados registrados.</td></tr>";
                }
                ?>
            </table>
        </form>
        <br>
        <p>
            <a href="
            <?php 
                if ($_SESSION['rol'] == 'jefe') {
                    echo 'menu_jefe.php';
                } elseif ($_SESSION['rol'] == 'webmaster') {
                    echo 'webmaster.php';
                }
            ?>">
                <button type="button">Volver al Panel</button>
            </a>
        </p>
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>

</body>
</html>

<?php
// Cerrar la conexión
$conexion->close();
?>