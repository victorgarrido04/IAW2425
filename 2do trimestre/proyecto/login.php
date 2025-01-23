<?php
// Conexión a la base de datos
$servername = "sql308.thsite.top"; // Nombre del servidor
$username = "thsi_38097494"; // Nombre de usuario
$password = "fDxz?Ica"; // Contrasena
$database = "thsi_38097494_proyectovictor";
$enlace = mysqli_connect($servername, $username, $password, $database);

// Verificar conexión
if (!$enlace) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Procesar formulario al enviarlo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar que los campos no estén vacíos
    if (empty($_POST['usuario']) || empty($_POST['contrasena'])) {
        die("Error: Todos los campos son obligatorios.");
    }

    // Saneamiento de las entradas
    $usuario = htmlspecialchars(trim($_POST['usuario']));
    $contrasena = htmlspecialchars(trim($_POST['contrasena']));
    $redirectUrl = "http://proyectovictor.likesyou.org/page.php";

    // Consultar el usuario por email
    $query = "SELECT * FROM personas WHERE usuario='$usuario'";
    $resultado = mysqli_query($enlace, $query);

    if (mysqli_num_rows($resultado) === 1) {
        // Recuperar los datos del usuario
        $usuario = mysqli_fetch_assoc($resultado);

        // Usar el hash almacenado como el salt para cifrar la contraseña ingresada
        $password_hashed = crypt($contrasena, $usuario['contrasena']);

        // Verificar la contraseña (comparación estricta)
        if ($usuario['contrasena'] === $contrasena){ // CASO 1 (GRAN ERROR)
        //if (hash_equals($usuario['password'], $password_hashed)) {
            header("Location: $redirectUrl");
            exit();
        } else {
            echo "Error: Contraseña incorrecta." . $password_hashed . " es diferente de " . $usuario['contrasena'];
        }
    } else {
        echo "Error: Usuario no encontrado.";
    }
}

mysqli_close($enlace);
?>

<!-- Formulario de inicio de sesión -->
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <form method="POST" action="login.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>
        <button type="submit">Iniciar sesión</button>
    </form>
</body>
</html>