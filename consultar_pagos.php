<?php
include("include/conn_BD.php"); // Incluir el archivo que establece la conexión a la base de datos
session_start(); // Iniciar la sesión para poder acceder a las variables de sesión

// Verificar si el usuario ha iniciado sesión y si es del tipo 'PL'
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'PL') {
    header("Location: index.php"); // Redirigir a la página principal si no ha iniciado sesión o no es del tipo 'PL'
    exit(); // Detener la ejecución del script para evitar que se continúe el procesamiento
}

$usuario = null; // Inicializar la variable $usuario como null, que se usará para almacenar la información del cliente
$pedidos = []; // Inicializar $pedidos como un array vacío, que se llenará con los pedidos del cliente

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Verificar si la solicitud fue enviada a través del método POST
    $IDUsuario = trim($_POST['IDUsuario']); // Obtener y limpiar el ID del usuario enviado desde el formulario

    // Validar que el IDUsuario no esté vacío y sea un número (ajusta según tus necesidades)
    if (!empty($IDUsuario) && is_numeric($IDUsuario)) {
        // Obtener información del cliente
        $stmt = $conn->prepare("SELECT * FROM USUARIOS WHERE IDUsuario = :IDUsuario"); // Preparar la consulta SQL para obtener los datos del cliente
        $stmt->bindParam(':IDUsuario', $IDUsuario, PDO::PARAM_INT); // Vincular el parámetro :IDUsuario a la variable $IDUsuario
        $stmt->execute(); // Ejecutar la consulta
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC); // Obtener el resultado como un array asociativo y almacenarlo en $usuario

        if ($usuario) { // Si se encontró un cliente con el ID proporcionado
            // Obtener los pedidos realizados por el cliente
            $stmt = $conn->prepare("SELECT * FROM PEDIDOS WHERE IDUsuario = :IDUsuario"); // Preparar la consulta SQL para obtener los pedidos del cliente
            $stmt->bindParam(':IDUsuario', $IDUsuario, PDO::PARAM_INT); // Vincular el parámetro :IDUsuario a la variable $IDUsuario
            $stmt->execute(); // Ejecutar la consulta
            $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtener todos los resultados como un array asociativo y almacenarlos en $pedidos
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consultar Pagos - El Tesoro del Saber</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('msg') === 'edited') {
                const notification = document.createElement('div');
                notification.className = 'notification success';
                notification.textContent = 'El pedido ha sido editado con éxito.';
                document.body.appendChild(notification);
                setTimeout(() => {
                    notification.remove();
                }, 5000);
            } else if (urlParams.get('msg') === 'deleted') {
                const notification = document.createElement('div');
                notification.className = 'notification error';
                notification.textContent = 'El pedido ha sido eliminado con éxito.';
                document.body.appendChild(notification);
                setTimeout(() => {
                    notification.remove();
                }, 5000);
            }
        });
    </script>
</head>

<body class="body-usuario">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                <img src="IMG/Logo.png" alt="Logo Miniatura" class="d-inline-block align-top me-2 rounded-circle" style="width: 45px; height: 45px;">
                El Tesoro del Saber
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="Usuario_PL.php">Regresar</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultar_pagos.php">Consultar</a></li>
                    <li class="nav-item"><a class="nav-link" href="modificar_pedido.php">Modificar</a></li>
                    <li class="nav-item"><a class="nav-link" href="eliminar_pedido.php">Eliminar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario de búsqueda de pedidos -->
    <div class="container-tabla" style="margin-top: 100px;">
        <h2 class="text-center">Consultar pagos de un Cliente</h2>
        <form action="consultar_pagos.php" method="POST" class="d-flex justify-content-center">

            <div class="row">
                <div class="col-12">
                    <label for="IDUsuario" class="form-label">ID Usuario:</label>
                    <input type="text" id="IDUsuario" name="IDUsuario" class="form-control" required>
                </div>
            </div>
            <div class="col-12 text-center mt-3">
                <input type="submit" value="Consultar" class="btn btn-primary">
            </div>
        </form>
    </div>

    <!-- Tabla de pedidos -->
    <div class="container-tabla table-responsive">
        <?php if ($usuario): ?>
            <h3>Cliente: <?php echo htmlspecialchars($usuario['IDUsuario']); ?></h3>
            <h3>Nombre: <?php echo htmlspecialchars($usuario['Nombre']) . " " . htmlspecialchars($usuario['ApellidoPaterno']) . " " . htmlspecialchars($usuario['ApellidoMaterno']); ?></h3>

            <?php if (count($pedidos) > 0): ?>
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Folio</th>
                            <th>Título del libro</th>
                            <th>Autor</th>
                            <th>Precio</th>
                            <th>Fecha</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($pedidos as $pedido): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($pedido['FolioPedido']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['TituloLibro']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['Autor']); ?></td>
                                <td><?php echo htmlspecialchars($pedido['Precio']); ?></td>
                                <td><?php echo date("d/m/Y", strtotime($pedido['FechaPedido'])); ?></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="editar_pedido.php?folio=<?php echo urlencode($pedido['FolioPedido']); ?>" class="btn btn-success btn-sm">Editar</a>
                                        <a href="borrar_pedido.php?folio=<?php echo urlencode($pedido['FolioPedido']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este pedido?');">Eliminar</a>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>Este cliente no tiene pedidos registrados.</p>
            <?php endif; ?>

        <?php elseif ($_SERVER["REQUEST_METHOD"] == "POST"): ?>
            <p>Usuario no encontrado o ID inválido.</p>
        <?php endif; ?>
    </div>

    <!-- Footer -->
    <div class="footer">
        <div class="column">
            <p>Teléfono de atención al cliente: 55 555555-5555</p>
        </div>
        <div class="column">
            <p>&copy; 2024 El Tesoro del Saber. Todos los derechos reservados.</p>
        </div>
        <div class="column redes-sociales">
            <a href="https://facebook.com"><img src="IMG/facebook.jpg" alt="Facebook"></a>
            <a href="https://twitter.com"><img src="IMG/X.jpg" alt="Twitter"></a>
            <a href="https://instagram.com"><img src="IMG/Instagram.jpg" alt="Instagram"></a>
        </div>
    </div>
</body>

</html>