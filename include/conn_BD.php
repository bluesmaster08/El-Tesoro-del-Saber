<?php
// Definir las credenciales de la base de datos
//para uso en desarrollo
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_tesoro_del_saber";

/*para uso en la web
$servername = "sql110.infinityfree.com";
$username = "if0_37122069";
$password = "blues080592";
$dbname = "if0_37122069_bd_tesoro_del_saber";*/


try {
    // Crear la conexión usando PDO
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);

    // Configurar PDO para que lance excepciones en caso de error
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Mostrar un mensaje de conexión exitosa (opcional)
    // echo "Conexión exitosa";
} catch (PDOException $e) {
    // Mostrar un mensaje en caso de error
    echo "Error de conexión: " . $e->getMessage();
}
