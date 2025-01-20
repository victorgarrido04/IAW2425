<?php
// Configuración de la base de datos
$servername = "sql308.thsite.top";
$username_db = "thsi_38097494";
$password_db = "fDxz?Ica";
$dbname = "thsi_38097494_bdpruebas";

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username_db, $password_db);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}

// Inicializamos un mensaje de error o éxito
$mensaje = "";

// Verificamos si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recibimos y saneamos los datos del formulario
    $username = trim(htmlspecialchars($_POST['username'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $password = trim($_POST['password'] ?? '');
    $confirm_password = trim($_POST['confirm_password'] ?? '');

    // Validamos que los campos no estén vacíos
    if (empty($username) || empty($email) || empty($password) || empty($confirm_password)) {
        $mensaje = "Todos los campos son obligatorios.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $mensaje = "El correo electrónico no es válido.";
    } elseif ($password !== $confirm_password) {
        $mensaje = "Las contraseñas no coinciden.";
    } else {
        // Verificamos si el usuario ya existe
        $sql = "SELECT * FROM usuarios WHERE username = :username OR email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        if ($stmt->fetch()) {
            $mensaje = "El usuario o el correo ya están registrados.";
        } else {
            // Ciframos la contraseña
            $password_hashed = password_hash($password, PASSWORD_BCRYPT);

            // Insertamos al nuevo usuario
            $sql = "INSERT INTO usuarios (username, email, password) VALUES (:username, :email, :password)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':password', $password_hashed, PDO::PARAM_STR);

            if ($stmt->execute()) {
                // Enviamos el correo al usuario
                $asunto = "Registro exitoso";
                $mensaje_email = "Hola $username,\n\nTe has registrado exitosamente con los siguientes datos:\n\n"
                               . "Usuario: $username\nCorreo: $email\n\n"
                               . "Gracias por registrarte.\n";
                $cabeceras = "From: no-reply@tu-dominio.com";

                // Usamos mail() para enviar el correo
                if (mail($email, $asunto, $mensaje_email, $cabeceras)) {
                    $mensaje = "Registro completado con éxito. Se ha enviado un correo de confirmación.";
                } else {
                    $mensaje = "Registro completado, pero no se pudo enviar el correo.";
                }
            } else {
                $mensaje = "Ocurrió un error al registrar al usuario.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
</head>
<body>
    <h1>Registro de Usuario</h1>
    <?php if (!empty($mensaje)) : ?>
        <p style="color: red;"><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>
    <form method="POST" action="registro.php">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        <label for="email">Correo electrónico:</label>
        <input type="email" name="email" id="email" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" name="confirm_password" id="confirm_password" required>
        <br><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>


