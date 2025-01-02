<?php
include("include/conn_BD.php"); // Incluir la conexión a la base de datos
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión y si es del tipo 'PL'
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'PL') {
    header("Location: index.php");
    exit();
}

$pedido = null;
$error = '';
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Si el formulario de búsqueda fue enviado
    if (isset($_POST['FolioPedidoBuscar'])) {
        $folioPedido = trim($_POST['FolioPedidoBuscar']);

        // Buscar el pedido por FolioPedido
        $stmt = $conn->prepare("SELECT * FROM PEDIDOS WHERE FolioPedido = :FolioPedido");
        $stmt->bindParam(':FolioPedido', $folioPedido);
        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pedido) {
            $error = "Pedido no encontrado.";
        }
    }

    // Si el formulario de eliminación fue enviado
    if (isset($_POST['FolioPedidoEliminar'])) {
        $folioPedido = $_POST['FolioPedidoEliminar'];

        // Eliminar el pedido de la base de datos
        $stmt = $conn->prepare("DELETE FROM PEDIDOS WHERE FolioPedido = :FolioPedido");
        $stmt->bindParam(':FolioPedido', $folioPedido);

        if ($stmt->execute()) {
            $success = "Pedido eliminado exitosamente.";
            // Redirigir o limpiar los datos después de la eliminación
            $pedido = null; // Limpiar el pedido para no mostrar datos eliminados
        } else {
            $error = "Error al eliminar el pedido.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Eliminar Pedido - El Tesoro del Saber</title>
</head>

<body class="body-usuario">
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-custom">
        <div class="container-fluid">
            <!-- Nombre o logo del sitio web que sirve como enlace a la página principal -->
            <a class="navbar-brand" href="index.php">
                <img src="IMG/Logo.png" alt="Logo Miniatura" class="d-inline-block align-top me-2 rounded-circle" style="width: 45px; height: 45px;">
                El Tesoro del Saber
            </a>

            <!-- Botón hamburguesa que aparece en pantallas pequeñas.-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenedor del menú que se colapsa en pantallas pequeñas -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="usuario_PL.php">Regresar</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultar_pagos.php">Consultar</a></li>
                    <li class="nav-item"><a class="nav-link" href="modificar_pedido.php">Modificar</a></li>
                    <li class="nav-item"><a class="nav-link" href="eliminar_pedido.php">Eliminar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Formulario para buscar el pedido -->
    <div class="container-tabla">
        <h2 class="text-center">Eliminar Pedido</h2>

        <!-- Mostrar alertas de error o éxito -->
        <?php if ($error): ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success text-center">
                <?php echo $success; ?>
            </div>
        <?php endif; ?>

        <!-- Formulario de búsqueda de pedidos -->
        <form id="buscarPedidoForm" action="eliminar_pedido.php" method="POST" class="d-flex justify-content-center" style="<?php echo $pedido ? 'display:none;' : ''; ?>">
            <div class="row">
                <div class="col-12">
                    <label for="FolioPedidoBuscar" class="form-label">Folio del Pedido:</label>
                    <input type="text" id="FolioPedidoBuscar" name="FolioPedidoBuscar" class="form-control" required>
                </div>
                <div class="col-12 text-center mt-3">
                    <input type="submit" value="Buscar" class="btn btn-primary">
                </div>
            </div>
        </form>
        <br>
        <!-- Formulario de confirmación para eliminar pedidos -->
        <?php if ($pedido): ?>
            <form id="eliminarPedidoForm" action="eliminar_pedido.php" method="POST" class="row justify-content-center">
                <input type="hidden" name="FolioPedidoEliminar" value="<?php echo htmlspecialchars($pedido['FolioPedido']); ?>">

                <div class="col-lg-3 col-md-5 col-sm-12 mb-3">
                    <p><strong>Folio del Pedido:</strong> <?php echo htmlspecialchars($pedido['FolioPedido']); ?></p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-3">
                    <p><strong>Título:</strong> <?php echo htmlspecialchars($pedido['TituloLibro']); ?></p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-3">
                    <p><strong>Autor:</strong> <?php echo htmlspecialchars($pedido['Autor']); ?></p>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mb-3">
                    <p><strong>Precio:</strong> $<?php echo htmlspecialchars($pedido['Precio']); ?></p>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-12 d-flex align-items-end">
                    <input type="submit" value="Eliminar" class="btn btn-danger w-100">
                </div>
            </form>
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

    <!-- JavaScript para controlar la visibilidad del formulario -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const eliminarForm = document.getElementById('eliminarPedidoForm');
            const buscarForm = document.getElementById('buscarPedidoForm');

            // Si el formulario de eliminar pedido está presente, ocultar el formulario de búsqueda
            if (eliminarForm) {
                buscarForm.style.display = 'none';
            }
        });
    </script>

</body>

</html>