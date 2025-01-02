<?php
include("include/conn_BD.php");

// Recuperar todas las contraseñas no cifradas
$stmt = $conn->query("SELECT IDUsuario, Password FROM USUARIOS");
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($usuarios as $usuario) {
    $password = $usuario['Password'];

    // Verificar si la contraseña ya está cifrada (comienza con $2y$ o $2a$)
    if (substr($password, 0, 4) !== '$2y$' && substr($password, 0, 4) !== '$2a$') {
        // Cifrar la contraseña si no está ya cifrada
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Actualizar la contraseña en la base de datos
        $update_stmt = $conn->prepare("UPDATE USUARIOS SET Password = :hashed_password WHERE IDUsuario = :IDUsuario");
        $update_stmt->bindParam(':hashed_password', $hashed_password);
        $update_stmt->bindParam(':IDUsuario', $usuario['IDUsuario']);
        $update_stmt->execute();
    }
}

// echo "Contraseñas cifradas correctamente.";
