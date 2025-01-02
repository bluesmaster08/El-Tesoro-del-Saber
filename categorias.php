<?php include("include/conn_BD.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <title>Categorías - El Tesoro del Saber</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-light fixed-top navbar-custom">
        <div class="container-fluid">
            <!-- Nombre o logo del sitio web que sirve como enlace a la página principal -->
            <a class="navbar-brand" href="index.php">
                <img src="IMG/Logo.png" alt="Logo Miniatura" class="d-inline-block align-top me-2 rounded-circle" style="width: 45px; height: 45px;">
                El Tesoro del Saber
            </a>

            <!-- 2. Código de la clase de Bootstrap del menú desplegable-->
            <!-- Botón hamburguesa que aparece en pantallas pequeñas.-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="true" aria-label="Toggle navigation">
                <!-- Icono de hamburguesa dentro del botón -->
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Contenedor del menú que se colapsa en pantallas pequeñas -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Lista de enlaces del menú. Se alinean a la derecha con ms-auto -->
                <ul class="navbar-nav ms-auto">
                    <!-- Cada elemento del menú es un enlace a una sección diferente del sitio web -->
                    <li class="nav-item"><a class="nav-link" href="index.php">Inicio</a></li>
                    <li class="nav-item"><a class="nav-link" href="registro.php">Registrarse</a></li>
                    <li class="nav-item"><a class="nav-link" href="login.php">Iniciar sesión</a></li>
                    <li class="nav-item"><a class="nav-link" href="categorias.php">Categorías</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido central -->
    <div class="container">
        <!-- columna 1 -->
        <div class="column">
            <div class="categoria">
                <h3>Niños</h3>
                <img src="IMG/ninos.jpg" alt="Categoría Niños">
                <p>Libros de aventuras y enseñanzas para los
                    niños</p>
            </div>

            <div class="categoria">
                <h3>Juvenil</h3>
                <img src="IMG/juvenil.jpg" alt="Categoría Juvenil">
                <p>Historias emocionantes con los que los jóvenes se
                    identificarán.</p>
            </div>
        </div>

        <!-- columna 2 -->
        <div class="column">
            <div class="categoria">
                <h3>Ciencia ficción</h3>
                <img src="IMG/ciencia-ficcion.jpg"
                    alt="Categoría Ciencia Ficción">
                <p>Explora mundos desconocidos y tecnologías futuristas.</p>
            </div>

            <div class="categoria">
                <h3>Novela</h3>
                <img src="IMG/novela.jpg" alt="Categoría Novela">
                <p>Relatos apasionantes que te mantendrán al borde del
                    asiento.</p>
            </div>
        </div>

        <!-- columna 3 -->
        <div class="column">
            <div class="categoria">
                <h3>Cuento</h3>
                <img src="IMG/cuento.jpg" alt="Categoría Cuento">
                <p>Pequeñas historias con grandes lecciones y emociones.</p>
            </div>

            <div class="categoria">
                <h3>Cómic</h3>
                <img src="IMG/comic.jpg" alt="Categoría Cómic">
                <p>Viñetas llenas de acción y color para todas las
                    edades.</p>
            </div>
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

</html>