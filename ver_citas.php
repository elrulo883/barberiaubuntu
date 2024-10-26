<?php
session_start();

// Verificar si el usuario tiene un rol permitido (recepcionista, jesica o webmaster)
$isPermitted = isset($_SESSION['rol']) && ($_SESSION['rol'] == 'recepcionista' || $_SESSION['rol'] == 'jesica' || $_SESSION['rol'] == 'webmaster');

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
    <title>Ver Citas - Barbería</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>
    <div class="container">
        <h2>Citas Programadas</h2>

        <?php
        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>ID Cita</th><th>Nombre Cliente</th><th>Servicio</th><th>Fecha</th><th>Hora</th>";
            
            // Mostrar la columna de acciones solo si el usuario no es un barbero
            if (!$isPermitted) {
                echo "<th>Acciones</th>";
            }
            
            echo "</tr>";
            
            // Mostrar cada cita en una fila de la tabla
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id_cita'] . "</td>";
                echo "<td>" . $row['nombre_cliente'] . " " . $row['apellido_cliente'] . "</td>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['fecha_cita'] . "</td>";
                echo "<td>" . $row['hora_cita'] . "</td>";
                
                // Mostrar el botón de eliminar solo si el usuario tiene permisos
                if ("barbero" != $_SESSION['rol']) {
                    echo "<td>
                            <form method='POST' action='eliminar_cita.php'>
                                <input type='hidden' name='id_cita' value='" . $row['id_cita'] . "'>
                                <button type='submit'>Eliminar</button>
                            </form>
                          </td>";
                } else {
                    echo "<td>No tienes permisos para eliminar</td>"; // Opcional: mensaje informativo
                }
                
                echo "</tr>";
            }
            
            echo "</table>";
        } else {
            echo "<p>No hay citas programadas.</p>";
        }

        $conexion->close();
        ?>
        
        <p>
            <a href="
            <?php 
                if ($_SESSION['rol'] == 'recepcionista') {
                    echo 'menu_recepcionista.php';
                } elseif ($_SESSION['rol'] == 'Jesica') {
                    echo 'jesica.php';
                } elseif ($_SESSION['rol'] == 'webmaster') {
                    echo 'webmaster.php';
                } 
            ?>">Regresar al menú</a>
        </p>
        
        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>
</body>
</html>