<?php
include("include/conn_BD.php");
session_start();

// Verificar si el usuario ha iniciado sesión y si es del tipo 'PL'
if (!isset($_SESSION['IDUsuario']) || $_SESSION['TipoUsuario'] !== 'PL') {
    header("Location: index.php");
    exit();
}

if (isset($_GET['folio'])) {
    $folio = $_GET['folio'];

    // Eliminar el pedido de la base de datos
    $stmt = $conn->prepare("DELETE FROM PEDIDOS WHERE FolioPedido = :folio");
    $stmt->bindParam(':folio', $folio);

    if ($stmt->execute()) {
        // Redirigir de nuevo a la página de consulta con un mensaje de éxito
        header("Location: consultar_pagos.php?msg=deleted");
        exit();
    } else {
        echo "<p>Error al eliminar el pedido.</p>";
    }
} else {
    echo "<p>No se especificó ningún pedido para eliminar.</p>";
}
