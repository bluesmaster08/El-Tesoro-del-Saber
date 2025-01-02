<?php include("include/conn_BD.php"); ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Iniciar Sesión - El Tesoro del Saber</title>
</head>

<body>
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
                    <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="categorias.php">Categorías</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <br>
    <br>
    <br>
    <br>
    <!-- Formulario de Login con Grid de Bootstrap -->
    <div class="container d-flex justify-content-center">
        <div class="row w-100">
            <h2 class="text-center">Iniciar Sesión</h2>
            <form action="validar_login.php" method="POST" class="row g-3 w-100">
                <div class="col-lg-3 col-md-5 col-sm-12 mx-auto">
                    <label for="IDUsuario" class="form-label">Usuario:</label>
                    <input type="text" id="IDUsuario" name="IDUsuario" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mx-auto">
                    <label for="password" class="form-label">Contraseña:</label>
                    <input type="password" id="password" name="password" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-5 col-sm-12 mx-auto d-grid">
                    <input type="submit" value="Iniciar sesión" class="btn btn-primary">
                </div>
            </form>
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
</body>

</html>