<?php include("include/conn_BD.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <!-- 1. Registrar el sitio en ReCaptcha V3 y obtener clave del sitio y clave secreta-->
    <!-- 2. Cargar el script de ReCaptcha V3 con la clave del sitio-->
    <script src="https://www.google.com/recaptcha/api.js?render=6Le6-kIqAAAAAEd8h2hXXtCAj2jSWJOyWV43v_1y"></script>
    <!-- 3. Generar y asignar el token de ReCaptcha al campo oculto -->
    <script>
        // Cuando la página esté lista, se ejecuta la función de reCaptcha
        grecaptcha.ready(function() {
            // Ejecuta la función de reCaptcha usando la clave pública proporcionada, en este caso con la acción 'submit'
            grecaptcha.execute('6Le6-kIqAAAAAEd8h2hXXtCAj2jSWJOyWV43v_1y', {
                action: 'submit' // Define la acción que se está tomando, en este caso, enviar el formulario
            }).then(function(token) {
                // Una vez que se genera el token de reCaptcha, se inserta en el campo oculto del formulario
                document.getElementById('g-recaptcha-response').value = token;
            });
        });
    </script>

    <title>Registro de Usuario - El Tesoro del Saber</title>
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

    <div class="container mt-5">
        <?php if (isset($_GET['success']) && $_GET['success'] == 'true'): ?>
            <div class="alert alert-success alert-dismissible fade show alert-custom" role="alert">
                Usuario registrado exitosamente. Su ID de ingreso es: <strong><?php echo htmlspecialchars($_GET['IDUsuario']); ?></strong>.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>
    </div>

    <h2 class="text-center">Registro de Nuevo Usuario</h2>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12 col-lg-12">
                <form action="guardar_registro.php" method="POST" class="row g-3">
                    <!-- Nombre -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="nombre" class="form-label">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" required data-bs-toggle="tooltip" title="Ingresa tu nombre completo.">
                    </div>

                    <!-- Apellido Paterno -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="apellidoPaterno" class="form-label">Paterno:</label>
                        <input type="text" id="apellidoPaterno" name="apellidoPaterno" class="form-control" required data-bs-toggle="tooltip" title="Ingresa tu apellido paterno.">
                    </div>

                    <!-- Apellido Materno -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="apellidoMaterno" class="form-label">Materno:</label>
                        <input type="text" id="apellidoMaterno" name="apellidoMaterno" class="form-control" required data-bs-toggle="tooltip" title="Ingresa tu apellido materno.">
                    </div>

                    <!-- Edad -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="edad" class="form-label">Edad:</label>
                        <input type="number" id="edad" name="edad" class="form-control" min="0" required data-bs-toggle="tooltip" title="Ingresa tu edad en años.">
                    </div>

                    <!-- Sexo -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="sexo" class="form-label">Sexo:</label>
                        <select id="sexo" name="sexo" class="form-select" required data-bs-toggle="tooltip" title="Selecciona tu género.">
                            <option value="">Seleccionar</option>
                            <option value="M">Masculino</option>
                            <option value="F">Femenino</option>
                        </select>
                    </div>

                    <!-- Email -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required data-bs-toggle="tooltip" title="Ingresa un email válido.">
                    </div>

                    <!-- Teléfono -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="telefono" class="form-label">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" required data-bs-toggle="tooltip" title="Ingresa tu número de teléfono.">
                    </div>

                    <!-- Contraseña -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="password" class="form-label">Contraseña:</label>
                        <input type="password" id="password" name="password" class="form-control" required data-bs-toggle="tooltip" title="Longitud mínima de 8 posiciones, con letras, números y por lo menos un carácter especial (#,$,-,_,&,%).">
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="col-sm-12 col-md-5 col-lg-3">
                        <label for="confirm_password" class="form-label">Confirmar:</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required data-bs-toggle="tooltip" title="Repite la contraseña ingresada.">
                    </div>

                    <input type="hidden" name="tipoUsuario" value="CL">

                    <!-- Botón de registro -->
                    <div class="col-12 text-center">
                        <!-- Campo oculto para el token de ReCaptcha -->
                        <input type="hidden" id="g-recaptcha-response" name="g-recaptcha-response">
                        <input type="submit" value="Registrarse" class="btn btn-primary">
                    </div>
                </form>
            </div>
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
    <!-- Activación de Tooltips -->
    <script>
        // Se crea una lista vacía a partir de todos los elementos que tengan el atributo 'data-bs-toggle="tooltip"'
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        // Se recorre la lista de elementos que activan los tooltips (tooltipTriggerList) y se les asocia la funcionalidad del tooltip de Bootstrap
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            // A cada elemento de la lista se le aplica el constructor Tooltip de Bootstrap
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    </script>

</body>

</html>