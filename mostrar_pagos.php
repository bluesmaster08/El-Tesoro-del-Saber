<?php
include("include/conn_BD.php");
session_start();

// Verificar si el usuario ha iniciado sesión y si es del tipo 'PL'
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'PL') {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDUsuario = trim($_POST['IDUsuario']);

    // Obtener información del cliente
    $stmt = $conn->prepare("SELECT * FROM USUARIOS WHERE IDUsuario = :IDUsuario");
    $stmt->bindParam(':IDUsuario', $IDUsuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        // Obtener los pedidos realizados por el cliente
        $stmt = $conn->prepare("SELECT * FROM PEDIDOS WHERE IDUsuario = :IDUsuario");
        $stmt->bindParam(':IDUsuario', $IDUsuario);
        $stmt->execute();
        $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo "<h2>Cliente: " . htmlspecialchars($usuario['IDUsuario']) . "</h2>";
        echo "<h3>Nombre: " . htmlspecialchars($usuario['Nombre']) . " " . htmlspecialchars($usuario['ApellidoPaterno']) . " " . htmlspecialchars($usuario['ApellidoMaterno']) . "</h3>";

        if (count($pedidos) > 0) {
            echo "<table>";
            echo "<tr><th>Folio</th><th>Título del libro</th><th>Autor</th><th>Precio</th><th>Fecha</th><th>Acciones</th></tr>";
            foreach ($pedidos as $pedido) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($pedido['FolioPedido']) . "</td>";
                echo "<td>" . htmlspecialchars($pedido['TituloLibro']) . "</td>";
                echo "<td>" . htmlspecialchars($pedido['Autor']) . "</td>";
                echo "<td>" . htmlspecialchars($pedido['Precio']) . "</td>";
                echo "<td>" . date("d/m/Y", strtotime($pedido['FechaPedido'])) . "</td>";
                echo "<td><a href='editar_pedido.php?folio=" . htmlspecialchars($pedido['FolioPedido']) . "'>Editar</a> | <a href='borrar_pedido.php?folio=" . htmlspecialchars($pedido['FolioPedido']) . "'>Borrar</a></td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>Este cliente no tiene pedidos registrados.</p>";
        }
    } else {
        echo "<p>Usuario no encontrado.</p>";
    }
}
