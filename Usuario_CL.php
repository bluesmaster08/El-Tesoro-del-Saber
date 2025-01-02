<?php
// Iniciar una nueva sesión o reanudar la sesión existente
session_start();
// Verificar si el usuario ha iniciado sesión y si es del tipo 'CL' (Cliente de Librería)
// Si no ha iniciado sesión o no es un usuario 'CL', redirigirlo a la página principal
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'CL') {
    // Redirigir al usuario a la página principal
    header("Location: index.php");
    // Finalizar el script para asegurarse de que no se ejecute nada más después de la redirección
    exit();
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
    <title>Usuario CL - El Tesoro del Saber</title>
</head>

<body>
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
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="consultar_pedidos.php">Consultar</a></li>
                    <li class="nav-item"><a class="nav-link" href="registrar_pedido.php">Registrar</a></li>
                    <li class="nav-item"><a class="nav-link" href="logout.php">Salir</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>

    <div class="container-tabla bg-light p-4 rounded shadow-sm">
        <div class="container text-center my-5">
            <h2 class="display-5 fw-bold">
                ¡Bienvenido(a) <?php echo $_SESSION['Nombre'] . ' ' . $_SESSION['ApellidoPaterno'] . ' ' . $_SESSION['ApellidoMaterno']; ?>!
            </h2>
            <p class="lead">Has ingresado como Cliente (CL).</p>
        </div>
    </div>

    <!-- Footer -->
    <div class="footer">
        <!-- columna 1 -->
        <div class="column">
            <p>Teléfono de atención al cliente: 55 555555-5555</p>
        </div>
        <!-- columna 2 -->
        <div class="column">
            <p>&copy; 2024 El Tesoro del Saber. Todos los derechos
                reservados.</p>
        </div>
        <!-- columna 3 -->
        <div class="column redes-sociales">
            <a href="https://facebook.com"><img src="IMG/facebook.jpg"
                    alt="Facebook"></a>
            <a href="https://twitter.com"><img src="IMG/X.jpg"
                    alt="Twitter"></a>
            <a href="https://instagram.com"><img src="IMG/Instagram.jpg"
                    alt="Instagram"></a>
        </div>
    </div>

</body>

</html>