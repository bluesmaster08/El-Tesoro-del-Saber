<?php
// editar_pedido.php

include("include/conn_BD.php"); // Incluir el archivo que establece la conexión a la base de datos
session_start(); // Iniciar la sesión para poder acceder a las variables de sesión

// Verificar si el usuario ha iniciado sesión y si es del tipo 'PL'
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'PL') {
    header("Location: index.php"); // Redirigir a la página principal si no ha iniciado sesión o no es del tipo 'PL'
    exit(); // Detener la ejecución del script para evitar que se continúe el procesamiento
}

// Inicializar variables
$pedido = null;
$errores = [];

// Verificar si se ha enviado el formulario para actualizar el pedido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener y limpiar los datos del formulario
    $FolioPedido = isset($_POST['FolioPedido']) ? trim($_POST['FolioPedido']) : '';
    $TituloLibro = isset($_POST['TituloLibro']) ? trim($_POST['TituloLibro']) : '';
    $Autor = isset($_POST['Autor']) ? trim($_POST['Autor']) : '';
    $Precio = isset($_POST['Precio']) ? trim($_POST['Precio']) : '';
    $FechaPedido = isset($_POST['FechaPedido']) ? trim($_POST['FechaPedido']) : '';

    // Validar los campos
    if (empty($FolioPedido) || !is_numeric($FolioPedido)) {
        $errores[] = "Folio de pedido inválido.";
    }
    if (empty($TituloLibro)) {
        $errores[] = "El título del libro es obligatorio.";
    }
    if (empty($Autor)) {
        $errores[] = "El autor es obligatorio.";
    }
    if (empty($Precio) || !is_numeric($Precio)) {
        $errores[] = "El precio es inválido.";
    }
    if (empty($FechaPedido)) {
        $errores[] = "La fecha del pedido es obligatoria.";
    }

    if (empty($errores)) {
        // Actualizar el pedido en la base de datos
        $stmt = $conn->prepare("UPDATE PEDIDOS SET TituloLibro = :TituloLibro, Autor = :Autor, Precio = :Precio, FechaPedido = :FechaPedido WHERE FolioPedido = :FolioPedido");
        $stmt->bindParam(':TituloLibro', $TituloLibro, PDO::PARAM_STR);
        $stmt->bindParam(':Autor', $Autor, PDO::PARAM_STR);
        $stmt->bindParam(':Precio', $Precio, PDO::PARAM_STR); // Ajusta el tipo según tu base de datos
        $stmt->bindParam(':FechaPedido', $FechaPedido, PDO::PARAM_STR);
        $stmt->bindParam(':FolioPedido', $FolioPedido, PDO::PARAM_INT);

        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: consultar_pagos.php?msg=edited");
            exit();
        } else {
            $errores[] = "Error al actualizar el pedido. Por favor, intenta de nuevo.";
        }
    }
} else { // Si es una solicitud GET, obtener el FolioPedido para mostrar los datos actuales
    if (isset($_GET['folio']) && is_numeric($_GET['folio'])) {
        $FolioPedido = $_GET['folio'];

        // Obtener los datos del pedido
        $stmt = $conn->prepare("SELECT * FROM PEDIDOS WHERE FolioPedido = :FolioPedido");
        $stmt->bindParam(':FolioPedido', $FolioPedido, PDO::PARAM_INT);
        $stmt->execute();
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$pedido) {
            // Si no se encuentra el pedido, redirigir con mensaje de error
            header("Location: consultar_pagos.php?msg=notfound");
            exit();
        }
    } else {
        // Si no se proporciona un FolioPedido válido, redirigir con mensaje de error
        header("Location: consultar_pagos.php?msg=invalidfolio");
        exit();
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
    <title>Editar Pedido - El Tesoro del Saber</title>
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
                    <li class="nav-item"><a class="nav-link" href="usuario_PL.php">Regresar</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultar_pagos.php">Consultar</a></li>
                    <li class="nav-item"><a class="nav-link" href="modificar_pedido.php">Modificar</a></li>
                    <li class="nav-item"><a class="nav-link" href="eliminar_pedido.php">Eliminar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <div class="container-tabla" style="margin-top: 100px;">
        <h2 class="text-center">Editar Pedido</h2>
        <div class="container" style="margin-top: 100px;">


            <?php if (!empty($errores)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errores as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if ($pedido || $_SERVER["REQUEST_METHOD"] == "POST"): ?>
                <form action="editar_pedido.php" method="POST" class="needs-validation" novalidate>
                    <input type="hidden" name="FolioPedido" value="<?php echo htmlspecialchars($pedido['FolioPedido'] ?? $_POST['FolioPedido']); ?>">

                    <div class="row justify-content-center">
                        <!-- Columna para el Título del Libro -->
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="TituloLibro" class="form-label">Título:</label>
                            <input type="text" id="TituloLibro" name="TituloLibro" class="form-control" required
                                value="<?php echo htmlspecialchars($pedido['TituloLibro'] ?? $_POST['TituloLibro']); ?>">
                            <div class="invalid-feedback">
                                Por favor, ingresa el título del libro.
                            </div>
                        </div>

                        <!-- Columna para el Autor -->
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="Autor" class="form-label">Autor:</label>
                            <input type="text" id="Autor" name="Autor" class="form-control" required
                                value="<?php echo htmlspecialchars($pedido['Autor'] ?? $_POST['Autor']); ?>">
                            <div class="invalid-feedback">
                                Por favor, ingresa el autor.
                            </div>
                        </div>

                        <!-- Columna para el Precio -->
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                            <label for="Precio" class="form-label">Precio:</label>
                            <input type="number" step="0.01" id="Precio" name="Precio" class="form-control" required
                                value="<?php echo htmlspecialchars($pedido['Precio'] ?? $_POST['Precio']); ?>">
                            <div class="invalid-feedback">
                                Por favor, ingresa un precio válido.
                            </div>
                        </div>

                        <!-- Columna para la Fecha del Pedido -->
                        <div class="col-lg-12 col-md-6 col-sm-12 mb-3">
                            <label for="FechaPedido" class="form-label">Fecha:</label>
                            <input type="date" id="FechaPedido" name="FechaPedido" class="form-control" required
                                value="<?php echo htmlspecialchars(date("Y-m-d", strtotime($pedido['FechaPedido'] ?? $_POST['FechaPedido']))); ?>">
                            <div class="invalid-feedback">
                                Por favor, ingresa una fecha válida.
                            </div>
                        </div>
                    </div>

                    <!-- Botones -->
                    <div class="row justify-content-center">
                        <!-- Botón para actualizar pedido (verde) -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3 text-center">
                            <button type="submit" class="btn btn-success w-100">Actualizar</button>
                        </div>

                        <!-- Botón para cancelar -->
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-3 text-center">
                            <a href="consultar_pagos.php" class="btn btn-secondary w-100">Cancelar</a>
                        </div>
                    </div>

                </form>
            <?php endif; ?>
        </div>
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

    <!-- Script para validación de formularios de Bootstrap -->
    <script>
        // Ejemplo de deshabilitar el envío del formulario si hay campos inválidos
        (function() {
            'use strict'

            // Obtener todos los formularios que queremos aplicar estilos de validación de Bootstrap
            var forms = document.querySelectorAll('.needs-validation')

            // Bucle sobre ellos y evitar el envío
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>