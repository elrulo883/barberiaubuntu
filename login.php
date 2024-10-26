<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Barbería</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
</head>
<body>

    <div class="container">
        <h1 class="header">Bienvenidos Colaboradores</h1>
        <h2>Iniciar Sesión</h2>
        <form action="procesar_login.php" method="POST">
            <label for="nombre_usuario">Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="rol">¿Cuál es tu puesto?</label>
            <select id="rol" name="rol" required>
                <option value="barbero">Barbero</option>
                <option value="recepcionista">Recepcionista</option>
                <option value="jefe">Jefe</option>
                <option value="Jesica">Jesica</option>
                <option value="raul">Raul</option>
                <option value="webmaster">Webmaster</option>
            </select>

            <button type="submit">Iniciar Sesión</button>
        </form>

        <p class="error"><?php if(isset($error)) echo $error; ?></p> <!-- Mensaje de error si lo hay -->
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>

</body>
</html>