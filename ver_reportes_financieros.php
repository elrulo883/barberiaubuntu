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

// Obtener datos de pagos para la gráfica
$sql = "SELECT fecha_pago, SUM(monto) as total FROM pagos GROUP BY fecha_pago ORDER BY fecha_pago ASC";
$result = $conexion->query($sql);

$fechas = [];
$montos = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fechas[] = $row['fecha_pago'];
        $montos[] = $row['total'];
    }
}

$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes Financieros</title>
    <link rel="stylesheet" href="styles.css"> <!-- Enlace al CSS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1 class="header">Reportes Financieros</h1>
        
        <canvas id="graficaPagos" width="400" height="200"></canvas>
        <script>
            const ctx = document.getElementById('graficaPagos').getContext('2d');
            const graficaPagos = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode($fechas); ?>,
                    datasets: [{
                        label: 'Total de Pagos',
                        data: <?php echo json_encode($montos); ?>,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1,
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>

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
                <button type="button">Regresar al menú</button>
            </a>
        </p>

        <p><a href="logout.php">Cerrar Sesión</a></p>
    </div>

    <footer>
        <p>Barbería R.J.P. Derechos Reservados</p>
    </footer>
</body>
</html>