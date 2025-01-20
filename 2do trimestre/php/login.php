<?php
// Datos de conexión a la base de datos
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

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['username'] ?? '';
    $contrasena = $_POST['password'] ?? '';

    if (!empty($usuario) && !empty($contrasena)) {
        // Consulta para verificar credenciales
        $sql = "SELECT * FROM usuarios WHERE username = :username AND password = :password";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $usuario, PDO::PARAM_STR);
        $stmt->bindParam(':password', $contrasena, PDO::PARAM_STR);

        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Inicio de sesión exitoso
            echo "Bienvenido, " . htmlspecialchars($usuario) . "!";
        } else {
            // Credenciales incorrectas
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar sesión</h1>
    <form method="POST" action="login.php">
        <label for="username">Usuario:</label>
        <input type="text" name="username" id="username" required>
        <br><br>
        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>
        <br><br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>
   