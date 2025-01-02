<?php include("include/conn_BD.php"); ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script>
        // Función que se ejecuta para abrir un modal con la información proporcionada
        function abrirModal(titulo, descripcion, urlImagen) {
            // Asigna el valor del título recibido al elemento del modal que muestra el título
            document.getElementById('imageModalLabel').innerText = titulo;
            // Asigna la descripción recibida al elemento del modal que muestra la descripción
            document.getElementById('modalDescription').innerText = descripcion;
            // Cambia la fuente (src) de la imagen del modal a la URL de la imagen proporcionada
            document.getElementById('modalImage').src = urlImagen;
        }
    </script>

    <title>El Tesoro del Saber</title>
</head>

<body>

    <!-- 1. Código de la clase de Bootstrap para la barra fija -->
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

    <!--3. Código de la clase de Bootstrap del carrusel con 5 imágenes-->
    <!-- Carrusel: Contenedor principal del carrusel de imágenes -->
    <div id="carouselExample" class="carousel slide mt-5" data-bs-ride="carousel">

        <!-- Indicadores: Los botones que permiten navegar entre las diferentes diapositivas -->
        <div class="carousel-indicators">
            <!-- Cada botón está vinculado a una diapositiva específica del carrusel, identificado por data-bs-slide-to -->
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="3" aria-label="Slide 4"></button>
            <button type="button" data-bs-target="#carouselExample" data-bs-slide-to="4" aria-label="Slide 5"></button>
        </div>

        <!-- Contenedor de las imágenes del carrusel -->
        <div class="carousel-inner">
            <!-- Primera Imagen: Se marca como activa al cargar la página -->
            <div class="carousel-item active">
                <img src="IMG/fachada.png" class="d-block w-100 img-fluid" alt="Fachada Principal"
                    data-bs-toggle="modal" data-bs-target="#imageModal"
                    onclick="abrirModal('Fachada Principal', 'Esta es la fachada principal de nuestra librería.', 'IMG/fachada.png')">
            </div>
            <!-- Segunda Imagen -->
            <div class="carousel-item">
                <img src="IMG/salas.png" class="d-block w-100 img-fluid" alt="Salas de Lectura"
                    data-bs-toggle="modal" data-bs-target="#imageModal"
                    onclick="abrirModal('Salas de Lectura', 'Disfruta de un buen libro en un ambiente relajado.', 'IMG/salas.png')">
            </div>
            <!-- Tercera Imagen -->
            <div class="carousel-item">
                <img src="IMG/seccion.png" class="d-block w-100 img-fluid" alt="Secciones"
                    data-bs-toggle="modal" data-bs-target="#imageModal"
                    onclick="abrirModal('Secciones', 'Explora las diversas secciones temáticas.', 'IMG/seccion.png')">
            </div>
            <!-- Cuarta Imagen -->
            <div class="carousel-item">
                <img src="IMG/biblioteca.png" class="d-block w-100 img-fluid" alt="Biblioteca"
                    data-bs-toggle="modal" data-bs-target="#imageModal"
                    onclick="abrirModal('Biblioteca', 'Nuestra biblioteca contiene una vasta colección de libros.', 'IMG/biblioteca.png')">
            </div>
            <!-- Quinta Imagen -->
            <div class="carousel-item">
                <img src="IMG/anaqueles.png" class="d-block w-100 img-fluid" alt="Anaqueles"
                    data-bs-toggle="modal" data-bs-target="#imageModal"
                    onclick="abrirModal('Anaqueles', 'Los anaqueles están llenos de grandes obras por descubrir.', 'IMG/anaqueles.png')">
            </div>
        </div>

        <!-- Botón para retroceder en el carrusel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>

        <!-- Botón para avanzar en el carrusel -->
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>

    </div>

    <!--4. Código de la clase de Bootstrap de la imagen en otra página modal-->
    <!-- Modal para mostrar la imagen seleccionada -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <!-- Modal fade: este div define el modal, que es una ventana emergente. La clase "fade" agrega una transición suave para la aparición/desaparición del modal. -->
        <div class="modal-dialog"> <!-- modal-dialog: define el contenedor del modal, donde se especifican los márgenes y la posición dentro de la ventana. -->
            <div class="modal-content"><!-- modal-content: contiene todo el contenido del modal, como la cabecera, el cuerpo y el pie si fuera necesario. -->

                <div class="modal-header"> <!-- modal-header: define la cabecera del modal, que incluye el título y el botón para cerrarlo. -->
                    <h5 class="modal-title" id="imageModalLabel">Título de la imagen</h5>
                    <!--aquí se especifica el título del modal, que puede cambiar dinámicamente al mostrar la imagen. -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <!-- botón para cerrar el modal. Usa la clase de Bootstrap "btn-close" y la propiedad data-bs-dismiss para cerrar el modal al hacer clic. -->
                </div>
                <div class="modal-body"> <!-- modal-body: es la parte del modal donde se mostrará el contenido principal: la imagen y su descripción. -->
                    <img src="" id="modalImage" class="img-fluid" alt="Imagen seleccionada">
                    <!-- img-fluid: la clase "img-fluid" asegura que la imagen se ajuste de manera responsiva. El src estará vacío inicialmente, pero se llenará con la ruta de la imagen seleccionada. -->
                    <p id="modalDescription" class="mt-2">Descripción de la imagen.</p>
                    <!-- modalDescription: un párrafo que contiene la descripción de la imagen seleccionada. Será modificado dinámicamente según la imagen que se muestre. -->
                </div>
            </div>
        </div>
    </div>




    <!-- Grid de categorías más vendidas y cuotas de suscripciones -->
    <div class="container mt-4"> <!-- Contenedor general que proporciona márgenes y ajusta el contenido según el tamaño de la pantalla -->
        <div class="row">
            <h2>Géneros más vendidos</h2> <!-- Título para la primera sección -->


            <!--5. Código de la clase de Bootstrap para la sección de 3 columnas y 2 filas-->
            <!-- Primera fila: imágenes de géneros literarios más vendidos -->
            <div class="row"> <!-- Fila que contiene las columnas para los géneros más vendidos -->
                <!-- Primera columna: género 1 -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> <!-- columna adaptable a diferentes tamaños de pantalla -->
                    <img src="IMG/juvenil.jpg" class="img-fluid img-grid" alt="Género 1"> <!-- imagen que se adapta al tamaño del contenedor -->
                    <h5 class="text-center mt-2">Juvenil</h5> <!-- texto descriptivo centrado debajo de la imagen -->
                </div>
                <!-- Segunda columna: género 2 -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> <!-- columna con el segundo género -->
                    <img src="IMG/comic.jpg" class="img-fluid img-grid" alt="Género 2"> <!-- imagen que representa el género Comic -->
                    <h5 class="text-center mt-2">Comic</h5> <!-- texto descriptivo centrado debajo de la imagen -->
                </div>
                <!-- Tercera columna: género 3 -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> <!-- columna con el tercer género -->
                    <img src="IMG/novela.jpg" class="img-fluid img-grid" alt="Género 3"> <!-- imagen que representa el género Novela -->
                    <h5 class="text-center mt-2">Novela</h5> <!-- texto descriptivo centrado debajo de la imagen -->
                </div>
            </div> <!-- Fin de la primera fila -->
            <!-- Segunda fila: Costos de membresía -->
            <h2>Suscripciones</h2> <!-- Título para la segunda sección -->


            <!--6. Código de la clase de Bootstrap para la sección de 3 columnas y 1 fila-->
            <div class="row"> <!-- Fila que contiene las columnas de membresías -->
                <!-- Membresía básica -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> <!-- columna adaptable para la Membresía Básica -->
                    <div class="card text-center"> <!-- tarjeta centrada con la información de la membresía -->
                        <div class="card-body">
                            <h5 class="card-title">Membresía Básica</h5> <!-- título de la tarjeta -->
                            <p class="card-text">$69 MXN/mes</p> <!-- precio de la membresía -->
                        </div>
                    </div>
                </div>
                <!-- Membresía premium -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> <!-- Columna con la membresía premium -->
                    <div class="card text-center"> <!-- tarjeta para la Membresía Premium -->
                        <div class="card-body">
                            <h5 class="card-title">Membresía Premium</h5> <!-- titulo de la tarjeta -->
                            <p class="card-text">$99 MXN/mes</p> <!-- precio de la membresía -->
                        </div>
                    </div>
                </div>
                <!-- Membresía VIP -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4"> <!-- Columna con la membresía VIP -->
                    <div class="card text-center"> <!-- tarjeta centrada con la información de la membresia VIP -->
                        <div class="card-body">
                            <h5 class="card-title">Membresía VIP</h5> <!-- título de la tarjeta -->
                            <p class="card-text">$129 MXN/mes</p> <!-- precio de la membresía -->
                        </div>
                    </div>
                </div>
            </div> <!-- fin de la segunda fila -->
        </div>
    </div> <!-- Fin del contenedor -->


    <!-- Contenedor principal con margen superior (mt-4) -->
    <div class="container mt-4">
        <!-- fila que contiene el título de la sección -->
        <div class="row">
            <h2>Comentarios Destacados</h2>
            <!-- fila para organizar los comentarios en columnas -->
            <div class="row">
                <!-- Primera columna que ocupa toda la fila en pantallas pequeñas (col-12), 
            y una columna (col-lg-4) en pantallas grandes. Añadimos margen inferior (mb-4) -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
                    <!-- tarjeta para mostrar el comentario del cliente -->
                    <div class="card">
                        <div class="card-body">
                            <!-- título con el nombre del cliente -->
                            <h5 class="card-title">Carlos M.</h5>
                            <!-- texto del comentario del cliente -->
                            <p class="card-text">
                                "El mejor lugar para encontrar ediciones especiales y libros raros. El personal siempre está dispuesto a ayudar y es muy atento."
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Segunda columna con las mismas clases y estructura que la primera columna -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Rocio H.</h5>
                            <p class="card-text">
                                "La selección de libros es increíble y el ambiente de la librería es acogedor. Es una experiencia única ¡Volveré pronto!"
                            </p>
                        </div>
                    </div>
                </div>
                <!-- Tercera columna con el mismo diseño que las anteriores -->
                <div class="col-12 col-sm-12 col-md-6 col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Adrian G.</h5>
                            <p class="card-text">
                                "Me encantó la sección de libros infantiles. Mi hijo se divirtió mucho y encontramos varios libros que nos encantaron."
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <!-- Contenido central -->
    <div class="container">
        <div class="column">
            <img src="IMG/Logo.png" alt="Logotipo de El Tesoro del Saber">
        </div>
        <div class="column">
            <h2>Bienvenidos a el Tesoro del Saber</h2>
            <p>
                En el Tesoro del Saber, celebramos el conocimiento y la
                exploración intelectual.
                Ofrecemos una selección cuidadosamente curada de libros de
                diversos géneros y autores,
                en un ambiente diseñado para inspirar y enriquecer tu mente.
                Aquí, cada página es un
                paso hacia el descubrimiento y cada taza de café es un
                compañero perfecto para tu
                viaje literario. ¡Ven y explora el tesoro del conocimiento
                con nosotros!
            </p>
        </div>
        <div class="column">
            <img src="IMG/entrada.png" alt="Entrada principal de Libros & Café">
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