<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$password = $_POST['password'];
$rol_seleccionado = $_POST['rol'];  // Obtenemos el rol seleccionado por el usuario

// Consulta para verificar las credenciales del usuario
$sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$nombre_usuario' AND password = MD5('$password')";
$resultado = $conexion->query($sql);

if ($resultado->num_rows > 0) {
    // Si el usuario existe, obtener su rol desde la base de datos
    $fila = $resultado->fetch_assoc();
    $rol_bd = $fila['rol']; // Rol del usuario en la base de datos

    // Comprobar si el rol seleccionado coincide con el rol en la base de datos
    if ($rol_bd == $rol_seleccionado) {
        // Guardar el rol del usuario en la sesión
        $_SESSION['rol'] = $rol_bd;

        // Redireccionar según el rol
        if ($rol_bd == 'barbero') {
            header("Location: barbero.php");
        } elseif ($rol_bd == 'recepcionista') {
            header("Location: recepcionista.php");
        } elseif ($rol_bd == 'jefe') {
            header("Location: jefe.php");
        } elseif ($rol_bd == 'Jesica') {
            header("Location: jesica.php");
        } elseif ($rol_bd == 'raul') {
            header("Location: raul.php");
        } elseif ($rol_bd == 'webmaster') {
            header("Location: webmaster.php");
        } else {
            echo "Rol no reconocido.";
        }
    } else {
        // Si el rol no coincide con el que está en la base de datos
        echo "Error: El rol seleccionado no coincide con el rol del usuario.";
    }
} else {
    // Si las credenciales son incorrectas
    echo "Usuario o contraseña incorrectos";
    echo '<br><a href="login.php"><button>Volver al Inicio</button></a>';
}

// Cerrar la conexión
$conexion->close();
?>