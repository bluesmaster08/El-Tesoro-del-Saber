<?php
session_start(); // Inicia la sesión para acceder a las variables de sesión

// Verificar si el usuario ha iniciado sesión y si es del tipo 'CL'
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'CL') {
    // Si no hay una sesión iniciada o el usuario no es de tipo 'CL', redirige a la página principal
    header("Location: index.php");
    exit(); // Termina la ejecución del script después de la redirección
}
include("include/conn_BD.php"); // Incluye el archivo que establece la conexión con la base de datos
// Recuperar la información del usuario y sus pedidos
$IDUsuario = $_SESSION['IDUsuario']; // Obtiene el ID del usuario desde la sesión
try {
    // Prepara la consulta SQL para recuperar los datos del usuario y sus pedidos
    $stmt = $conn->prepare("SELECT u.IDUsuario, u.Nombre, u.ApellidoPaterno, u.ApellidoMaterno, 
                            p.FolioPedido, p.TituloLibro, p.Autor, p.Precio, p.FechaPedido 
                            FROM USUARIOS u 
                            JOIN PEDIDOS p ON u.IDUsuario = p.IDUsuario 
                            WHERE u.IDUsuario = :IDUsuario");
    // Vincula el valor de $IDUsuario al marcador de posición :IDUsuario en la consulta
    $stmt->bindParam(':IDUsuario', $IDUsuario);
    // Ejecuta la consulta
    $stmt->execute();
    // Recupera todos los resultados de la consulta y los almacena en un arreglo asociativo
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    // Si ocurre un error en la consulta, se muestra el mensaje de error
    echo "Error: " . $e->getMessage();
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
    <title>Consultar Pedidos - El Tesoro del Saber</title>
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
    <div class="container-tabla">
        <h2>ID Cliente: <?php echo $IDUsuario; ?> Nombre: <?php echo $_SESSION['Nombre'] . ' ' . $_SESSION['ApellidoPaterno'] . ' ' . $_SESSION['ApellidoMaterno']; ?></h2>
    </div>
    <div class="container-tabla table-responsive">
        <h3>Pedidos realizados</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Folio</th>
                    <th>Título del libro</th>
                    <th>Autor</th>
                    <th>Precio</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Verifica si hay pedidos en la variable $pedidos
                if (!empty($pedidos)) {
                    // Recorre cada pedido en el arreglo $pedidos
                    foreach ($pedidos as $pedido) {
                        echo "<tr>"; // Inicia una nueva fila en la tabla
                        // Muestra el folio del pedido en una celda
                        echo "<td>" . $pedido['FolioPedido'] . "</td>";
                        // Muestra el título del libro en una celda
                        echo "<td>" . $pedido['TituloLibro'] . "</td>";
                        // Muestra el autor del libro en una celda
                        echo "<td>" . $pedido['Autor'] . "</td>";
                        // Muestra el precio del libro en una celda, formateado con dos decimales
                        echo "<td>$" . number_format($pedido['Precio'], 2) . "</td>";
                        // Muestra la fecha del pedido en una celda, formateada como día/mes/año
                        echo "<td>" . date("d/m/Y", strtotime($pedido['FechaPedido'])) . "</td>";
                        echo "</tr>"; // Cierra la fila de la tabla
                    }
                } else {
                    // Si no hay pedidos, muestra una fila con un mensaje indicando que no se encontraron pedidos
                    echo "<tr><td colspan='5'>No se encontraron pedidos.</td></tr>";
                }
                ?>
            </tbody>
        </table>
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