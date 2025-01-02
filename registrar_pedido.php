<?php
session_start();
include("include/conn_BD.php");  // Incluir la conexión a la base de datos

$mensaje = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['titulo']) && !empty($_POST['autor']) && !empty($_POST['precio'])) {
        $idUsuario = $_SESSION['IDUsuario'];
        $titulo = $_POST['titulo'];
        $autor = $_POST['autor'];
        $precio = $_POST['precio'];
        $fechaPedido = date('Y-m-d');

        $sql = "INSERT INTO PEDIDOS (IDUsuario, TituloLibro, Autor, Precio, FechaPedido) 
                VALUES (:idUsuario, :titulo, :autor, :precio, :fechaPedido)";

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':idUsuario', $idUsuario);
        $stmt->bindParam(':titulo', $titulo);
        $stmt->bindParam(':autor', $autor);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':fechaPedido', $fechaPedido);

        if ($stmt->execute()) {
            // Redirigir a la misma página con un mensaje de éxito
            header("Location: registrar_pedido.php?msg=success");
            exit();
        } else {
            $mensaje = "Error al registrar el pedido.";
        }
    } else {
        $mensaje = "Por favor, completa todos los campos.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript para ocultar el mensaje después de 5 segundos -->
    <script>
        setTimeout(function() {
            var alertMsg = document.getElementById('alert-msg');
            if (alertMsg) {
                alertMsg.classList.add('d-none');
            }
        }, 5000); // 5000 ms = 5 segundos
    </script>
    <title>Registrar Pedido - El Tesoro del Saber</title>
</head>

<body class="body-usuario">

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
                    <li class="nav-item"><a class="nav-link" href="usuario_CL.php">Regresar</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultar_pedidos.php">Consultar</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_pedido.php">Registrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <div class="container-tabla">

        <h2 class="text-center">Registrar nuevo pedido</h2>

        <?php
        if (isset($_GET['msg']) && $_GET['msg'] == 'success') {
            echo '<div id="alert-msg" class="alert alert-success text-center" role="alert">¡Pedido registrado exitosamente!</div>';
        }

        if (!empty($mensaje)): ?>
            <div id="alert-msg" class="alert alert-danger text-center" role="alert"><?php echo $mensaje; ?></div>
        <?php endif; ?>

        <!-- Formulario con Grid de Bootstrap 5 -->
        <form action="registrar_pedido.php" method="POST" class="row justify-content-center">
            <div class="col-lg-3 col-md-5 col-sm-12 mb-3">
                <label for="titulo" class="form-label">Título:</label>
                <input type="text" name="titulo" class="form-control" required>
            </div>

            <div class="col-lg-3 col-md-5 col-sm-12 mb-3">
                <label for="autor" class="form-label">Autor:</label>
                <input type="text" name="autor" class="form-control" required>
            </div>

            <div class="col-lg-3 col-md-10 col-sm-12 mb-3">
                <label for="precio" class="form-label">Precio:</label>
                <input type="number" step="0.01" name="precio" class="form-control" required>
            </div>

            <div class="col-lg-5 col-md-10 col-sm-12 text-center">
                <input type="submit" value="Registrar Pedido" class="btn btn-primary">
            </div>
        </form>

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