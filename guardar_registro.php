<?php
// Incluir la conexión a la base de datos
include("include/conn_BD.php");

// 4. Capturar el token de ReCaptcha enviado desde el formulario
$recaptcha_token = $_POST['g-recaptcha-response'];

// 5. Verificar el token de ReCaptcha con la API de Google
// 5.1 Incluir la clave secreta de ReCaptcha
$secret_key = '6Le6-kIqAAAAAOjdtuttC3gPdgYWEyL0eGk91VsV';
// 5.2 Realizar la solicitud a la API de Google para verificar el token
// Definir la URL para verificar el reCAPTCHA con Google
$recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
// Hacer una petición a la URL de verificación de Google, pasando la clave secreta y el token generado por el usuario
// El secret_key es la clave secreta de reCAPTCHA que se obtuvo al registrar el sitio
// El recaptcha_token es el token que se generó cuando el usuario interactuó con el reCAPTCHA en el formulario registro.php
$response = file_get_contents($recaptcha_url . '?secret=' . $secret_key . '&response=' . $recaptcha_token);
// Decodifica la respuesta JSON de Google, transformándola en un array asociativo para acceder a sus datos
// La respuesta incluye una clave 'success' que indica si el reCAPTCHA fue exitoso, entre otros datos
$responseKeys = json_decode($response, true);
// En este punto, el array $responseKeys contiene los resultados de la verificación.

// Mostrar la respuesta de la API de Google para comprobar la validación
//var_dump($responseKeys);
//exit();


// 6. Validar la respuesta de ReCaptcha
if ($responseKeys["success"] && $responseKeys["score"] >= 0.5) {
    // El ReCaptcha es válido, proceder con el registro del usuario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Capturar y limpiar los datos del formulario
        $IDUsuario = uniqid('CL_'); // Generar un IDUsuario único
        $nombre = trim($_POST['nombre']);
        $apellidoPaterno = trim($_POST['apellidoPaterno']);
        $apellidoMaterno = trim($_POST['apellidoMaterno']);
        $edad = (int)$_POST['edad'];
        $sexo = $_POST['sexo'];
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $tipoUsuario = "CL"; // Establecer el tipo de usuario como Cliente (CL)
        // Validaciones del lado del servidor
        $errors = [];
        // Verificar que ningún campo esté vacío
        if (empty($nombre) || empty($apellidoPaterno) || empty($apellidoMaterno) || empty($edad) || empty($sexo) || empty($email) || empty($telefono) || empty($password) || empty($confirm_password)) {
            $errors[] = "Todos los campos son obligatorios.";
        }
        // Validar la longitud y complejidad de la contraseña
        if (strlen($password) < 8 || !preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[#\$-_&%]/', $password)) {
            $errors[] = "La contraseña debe tener al menos 8 caracteres, incluir letras, números y al menos un carácter especial (#,$,-,_,&,%).";
        }
        // Validar que las contraseñas coinciden
        if ($password !== $confirm_password) {
            $errors[] = "Las contraseñas no coinciden. Inténtalo de nuevo.";
        }
        // Verificar que el IDUsuario o el correo electrónico no existan ya en la base de datos
        $stmt = $conn->prepare("SELECT COUNT(*) FROM USUARIOS WHERE IDUsuario = :IDUsuario OR Email = :Email");
        $stmt->bindParam(':IDUsuario', $IDUsuario);
        $stmt->bindParam(':Email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        if ($count > 0) {
            $errors[] = "El IDUsuario o el correo electrónico ya existen en el sistema.";
        }
        // Si hay errores, mostrarlos y detener el proceso
        if (!empty($errors)) {
            foreach ($errors as $error) {
                echo "<p style='color:red;'>$error</p>";
            }
            exit();
        }
        // Si no hay errores, proceder con el registro
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Cifrar la contraseña

        try {
            // Preparar la consulta SQL con sentencias preparadas
            $sql = "INSERT INTO USUARIOS (IDUsuario, Nombre, ApellidoPaterno, ApellidoMaterno, Edad, Sexo, Email, Telefono, TipoUsuario, Password)
                    VALUES (:IDUsuario, :Nombre, :ApellidoPaterno, :ApellidoMaterno, :Edad, :Sexo, :Email, :Telefono, :TipoUsuario, :Password)";

            $stmt = $conn->prepare($sql);

            // Asignar los valores a los parámetros de la consulta
            $stmt->bindParam(':IDUsuario', $IDUsuario);
            $stmt->bindParam(':Nombre', $nombre);
            $stmt->bindParam(':ApellidoPaterno', $apellidoPaterno);
            $stmt->bindParam(':ApellidoMaterno', $apellidoMaterno);
            $stmt->bindParam(':Edad', $edad);
            $stmt->bindParam(':Sexo', $sexo);
            $stmt->bindParam(':Email', $email);
            $stmt->bindParam(':Telefono', $telefono);
            $stmt->bindParam(':TipoUsuario', $tipoUsuario);
            $stmt->bindParam(':Password', $hashed_password);

            // Ejecutar la consulta
            $stmt->execute();

            // 7. Redirigir a la página de registro con un mensaje de éxito y el IDUsuario
            header("Location: registro.php?success=true&IDUsuario=$IDUsuario");
            exit();
        } catch (PDOException $e) {
            echo "Error al registrar el usuario: " . $e->getMessage();
        }
    }
} else {
    //7. Si ReCaptcha no es válido, mostrar mensaje de error
    echo "<p style='color:red;'>Verificación ReCaptcha fallida. Inténtalo nuevamente.</p>";
    exit();
}
