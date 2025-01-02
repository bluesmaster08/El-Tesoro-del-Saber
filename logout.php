<?php
// Iniciar o reanudar la sesión existente para acceder a los datos de la sesión actual
session_start();
// Destruir la sesión actual, eliminando todos los datos asociados con ella
session_destroy();
// Redirigir al usuario a la página principal (index.php) después de cerrar la sesión
header("Location: index.php");
// Finalizar la ejecución del script para asegurarse de que no se ejecute nada más después de la redirección
exit();
