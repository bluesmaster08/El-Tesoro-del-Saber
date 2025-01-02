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

// Verificar si se ha enviado el formulario
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

    // Si el formulario de actualización fue enviado
    if (isset($_POST['FolioPedidoModificar'])) {
        $folioPedido = $_POST['FolioPedidoModificar'];
        $titulo = trim($_POST['TituloLibro']);
        $autor = trim($_POST['Autor']);
        $precio = trim($_POST['Precio']);
        $fecha = $_POST['FechaPedido'];

        // Actualizar el pedido en la base de datos
        $stmt = $conn->prepare("UPDATE PEDIDOS SET TituloLibro = :Titulo, Autor = :Autor, Precio = :Precio, FechaPedido = :Fecha WHERE FolioPedido = :FolioPedido");
        $stmt->bindParam(':Titulo', $titulo);
        $stmt->bindParam(':Autor', $autor);
        $stmt->bindParam(':Precio', $precio);
        $stmt->bindParam(':Fecha', $fecha);
        $stmt->bindParam(':FolioPedido', $folioPedido);

        if ($stmt->execute()) {
            header("Location: modificar_pedido.php?msg=edited");
            exit();
        } else {
            $error = "Error al actualizar el pedido.";
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
    <title>Modificar Pedido - El Tesoro del Saber</title>
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
                aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

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
        <h2 class="text-center">Modificar Pedido</h2>

        <!-- Mostrar alertas de error o éxito -->
        <?php if ($error): ?>
            <div class="alert alert-danger text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['msg']) && $_GET['msg'] === 'edited'): ?>
            <div class="alert alert-success text-center">
                El pedido se actualizó correctamente.
            </div>
        <?php endif; ?>

        <!-- Formulario de búsqueda de pedidos -->
        <form id="buscarPedidoForm" action="modificar_pedido.php" method="POST" class="d-flex justify-content-center" style="<?php echo $pedido ? 'display:none;' : ''; ?>">
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

        <!-- Formulario de modificación de pedidos -->
        <?php if ($pedido): ?>
            <form id="modificarPedidoForm" action="modificar_pedido.php" method="POST" class="d-flex justify-content-center mt-5">
                <div class="row g-3">
                    <input type="hidden" name="FolioPedidoModificar" value="<?php echo htmlspecialchars($pedido['FolioPedido']); ?>">

                    <!-- Título del libro -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <label for="TituloLibro" class="form-label">Título:</label>
                        <input type="text" id="TituloLibro" name="TituloLibro" class="form-control" value="<?php echo htmlspecialchars($pedido['TituloLibro']); ?>" required>
                    </div>

                    <!-- Autor -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <label for="Autor" class="form-label">Autor:</label>
                        <input type="text" id="Autor" name="Autor" class="form-control" value="<?php echo htmlspecialchars($pedido['Autor']); ?>" required>
                    </div>

                    <!-- Precio -->
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                        <label for="Precio" class="form-label">Precio:</label>
                        <input type="number" id="Precio" name="Precio" class="form-control" value="<?php echo htmlspecialchars($pedido['Precio']); ?>" required>
                    </div>

                    <!-- Fecha del pedido -->
                    <div class="col-lg-12 col-md-6 col-sm-12 mb-3">
                        <label for="FechaPedido" class="form-label">Fecha:</label>
                        <input type="date" id="FechaPedido" name="FechaPedido" class="form-control" value="<?php echo htmlspecialchars($pedido['FechaPedido']); ?>" required>
                    </div>

                    <!-- Botón de modificar -->
                    <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                        <input type="submit" value="Modificar" class="btn btn-primary">
                    </div>
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
            const modificarForm = document.getElementById('modificarPedidoForm');
            const buscarForm = document.getElementById('buscarPedidoForm');

            // Si el formulario de modificar pedido está presente, ocultar el formulario de búsqueda
            if (modificarForm) {
                buscarForm.style.display = 'none';
            }
        });
    </script>

</body>

</html>