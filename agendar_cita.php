<?php
session_start();

// Verificar si el usuario es recepcionista o webmaster
if (!isset($_SESSION['rol']) || !in_array($_SESSION['rol'], ['recepcionista', 'webmaster'])) {
    echo "Acceso denegado. Solo el recepcionista o el webmaster pueden ver esta página.";
    exit();
}

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Verificar si se ha enviado el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre_cliente'];
    $apellido = $_POST['apellido_cliente'];
    $telefono = $_POST['telefono_cliente'];
    $servicio = $_POST['servicio'];
    $fecha = $_POST['fecha_cita'];
    $hora = $_POST['hora_cita'];

    // Insertar cliente en la tabla clientes
    $sql_cliente = "INSERT INTO clientes (nombre_cliente, apellido_cliente, telefono_cliente) 
                    VALUES ('$nombre', '$apellido', '$telefono')";
    
    if ($conexion->query($sql_cliente) === TRUE) {
        // Obtener el ID del cliente insertado
        $id_cliente = $conexion->insert_id;

        // Insertar la cita en la tabla citas
        $sql_cita = "INSERT INTO citas (id_cliente, servicio, fecha_cita, hora_cita) 
                     VALUES ($id_cliente, '$servicio', '$fecha', '$hora')";
        
        if ($conexion->query($sql_cita) === TRUE) {
            echo "<p>Cita agendada con éxito.</p>";
        } else {
            echo "<p>Error al agendar la cita: " . $conexion->error . "</p>";
        }
    } else {
        echo "<p>Error al registrar el cliente: " . $conexion->error . "</p>";
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Cita</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>
    <div class="container">
        <h1>Agendar Cita</h1>
        <form action="agendar_cita.php" method="POST">
            <label for="nombre_cliente">Nombre:</label>
            <input type="text" name="nombre_cliente" required><br>

            <label for="apellido_cliente">Apellido:</label>
            <input type="text" name="apellido_cliente" required><br>

            <label for="telefono_cliente">Teléfono:</label>
            <input type="text" name="telefono_cliente" required><br>

            <label for="servicio">Servicio:</label>
            <input type="text" name="servicio" required><br>

            <label for="fecha_cita">Fecha:</label>
            <input type="date" name="fecha_cita" required><br>

            <label for="hora_cita">Hora:</label>
            <input type="time" name="hora_cita" required><br>

            <button type="submit">Agendar</button>
        </form>

        <p>
            <a href="
            <?php 
                if ($_SESSION['rol'] == 'recepcionista') {
                    echo 'menu_recepcionista.php';
                } elseif ($_SESSION['rol'] == 'webmaster') {
                    echo 'webmaster.php';
                } 
            ?>">
                <button type="button">Regresar al menú</button>
            </a>
        </p>
    </div>
</body>
</html>