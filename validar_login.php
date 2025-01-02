<?php
// Incluir la conexión a la base de datos
include("include/conn_BD.php");
session_start();
// Validar que el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $IDUsuario = trim($_POST['IDUsuario']);
    $password = trim($_POST['password']);
    // Preparar la consulta SQL para validar el usuario
    $stmt = $conn->prepare("SELECT * FROM USUARIOS WHERE IDUsuario = :IDUsuario");
    $stmt->bindParam(':IDUsuario', $IDUsuario);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar si el usuario existe y si la contraseña es correcta
    if ($usuario && password_verify($password, $usuario['Password'])) {
        // Guardar la información del usuario en la sesión
        $_SESSION['IDUsuario'] = $usuario['IDUsuario'];
        $_SESSION['Nombre'] = $usuario['Nombre'];
        $_SESSION['ApellidoPaterno'] = $usuario['ApellidoPaterno'];
        $_SESSION['ApellidoMaterno'] = $usuario['ApellidoMaterno'];
        $_SESSION['TipoUsuario'] = $usuario['TipoUsuario'];

        // Redirigir según el tipo de usuario
        if ($usuario['TipoUsuario'] == 'PL') {
            header("Location: Usuario_PL.php");
        } elseif ($usuario['TipoUsuario'] == 'CL') {
            header("Location: Usuario_CL.php");
        }
        exit();
    } else {
        echo "<p style='color:red;'>Usuario o contraseña incorrectos.</p>";
    }
}
