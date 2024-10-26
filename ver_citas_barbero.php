<?php
session_start();

// Verificar si el usuario es barbero
if (!isset($_SESSION['rol']) || $_SESSION['rol'] != 'barbero') {
    echo "Acceso denegado. Solo los barberos pueden ver esta página.";
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener las citas de la base de datos
$sql = "SELECT citas.id_cita, clientes.nombre_cliente, clientes.apellido_cliente, citas.servicio, citas.fecha_cita, citas.hora_cita 
        FROM citas 
        JOIN clientes ON citas.id_cliente = clientes.id_cliente";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Citas Programadas - Barbero</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>

    <div class="container">
        <h1 class="header">Citas Programadas</h1>

        <?php
        if ($result->num_rows > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID Cita</th><th>Nombre Cliente</th><th>Servicio</th><th>Fecha</th><th>Hora</th></tr>";
            
            // Mostrar cada cita en una fila de la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_cita'] . "</td>";
                echo "<td>" . $row['nombre_cliente'] . " " . $row['apellido_cliente'] . "</td>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['fecha_cita'] . "</td>";
                echo "<td>" . $row['hora_cita'] . "</td>";
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p>No hay citas programadas.</p>";
        }

        $conexion->close();
        ?>

        <p><a href="menu_barbero.php">Regresar al menú</a></p>
        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>

</body>
</html>