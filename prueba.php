<?php
// Inicia una nueva sesión o reanuda una sesión existente.
session_start();
// Crea una nueva instancia de PDO para conectarse a la base de datos.
$pdo = new PDO('mysql:host=localhost;dbname=mi_base_datos', 'usuario', 'contraseña');
// Prepara una consulta SQL para insertar datos en la tabla 'pedidos'.

$stmt = $pdo->prepare("INSERT INTO pedidos (user_id, producto) VALUES (:user_id, :producto)");
// Vincula el valor del placeholder ':user_id' a la variable de sesión '$_SESSION['user_id']'.
// Esto significa que el valor de 'user_id' en la tabla 'pedidos' será el valor almacenado en la sesión actual del usuario.
$stmt->bindParam(':user_id', $_SESSION['user_id']);
// Vincula el valor del placeholder ':producto' a la variable '$producto'.
// Este valor se establece más adelante en el código.
$stmt->bindParam(':producto', $producto);
// Asigna un valor a la variable '$producto'. En este caso, se establece como 'Libro de PHP'.
// Este valor se utilizará para el campo 'producto' en la tabla 'pedidos'.
$producto = 'Libro de PHP';
// Ejecuta la consulta preparada, insertando el registro en la base de datos con los valores vinculados anteriormente.
$stmt->execute();
