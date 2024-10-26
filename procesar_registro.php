<?php
session_start();

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "barberia");

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

// Obtener los datos del formulario de registro
$nombre_usuario = $_POST['nombre_usuario'];
$password = $_POST['password'];
$rol = $_POST['rol'];

// Insertar los datos del nuevo empleado en la base de datos
$sql = "INSERT INTO usuarios (nombre_usuario, password, rol) VALUES ('$nombre_usuario', MD5('$password'), '$rol')";
if ($conexion->query($sql) === TRUE) {
    // Redirigir al panel del jefe con un mensaje de éxito
    $_SESSION['mensaje'] = "Empleado registrado con éxito.";
    header("Location: jefe.php");
} else {
    echo "Error: " . $sql . "<br>" . $conexion->error;
}

// Cerrar la conexión
$conexion->close();
?>