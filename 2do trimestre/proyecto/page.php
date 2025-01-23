<?php
session_start();

// Redirigir a login.php si el usuario no está autenticado
if (!isset($_SESSION['usuario'])) {
    header("Location: http://proyectovictor.likesyou.org/login.php");
    exit();
}

// Conexión a la base de datos
$servername = "sql308.thsite.top";
$username = "thsi_38097494";
$password = "fDxz?Ica";
$database = "thsi_38097494_proyectovictor";

$enlace = mysqli_connect($servername, $username, $password, $database);

if (!$enlace) {
    die("Error al conectar con la base de datos: " . mysqli_connect_error());
}

// Procesar formulario de inserción
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = mysqli_real_escape_string($enlace, $_POST['titulo']);
    $tipo = mysqli_real_escape_string($enlace, $_POST['tipo']);
    $departamento = mysqli_real_escape_string($enlace, $_POST['departamento']);
    $profesor_responsable = mysqli_real_escape_string($enlace, $_POST['profesor_responsable']);
    $trimestre = mysqli_real_escape_string($enlace, $_POST['trimestre']);
    $fecha_inicio = mysqli_real_escape_string($enlace, $_POST['fecha_inicio']);
    $hora_inicio = mysqli_real_escape_string($enlace, $_POST['hora_inicio']);
    $fecha_fin = mysqli_real_escape_string($enlace, $_POST['fecha_fin']);
    $hora_fin = mysqli_real_escape_string($enlace, $_POST['hora_fin']);
    $organizador = mysqli_real_escape_string($enlace, $_POST['organizador']);
    $acompanantes = mysqli_real_escape_string($enlace, $_POST['acompanantes']);
    $ubicacion = mysqli_real_escape_string($enlace, $_POST['ubicacion']);
    $coste = mysqli_real_escape_string($enlace, $_POST['coste']);
    $total_alumnos = mysqli_real_escape_string($enlace, $_POST['total_alumnos']);
    $objetivo = mysqli_real_escape_string($enlace, $_POST['objetivo']);

    $sql = "INSERT INTO actividad (titulo, tipo, departamento, profesor_responsable, trimestre, fecha_inicio, hora_inicio, fecha_fin, hora_fin, organizador, acompanantes, ubicacion, coste, total_alumnos, objetivo)
            VALUES ('$titulo', '$tipo', '$departamento', '$profesor_responsable', '$trimestre', '$fecha_inicio', '$hora_inicio', '$fecha_fin', '$hora_fin', '$organizador', '$acompanantes', '$ubicacion', '$coste', '$total_alumnos', '$objetivo')";

    if (mysqli_query($enlace, $sql)) {
        $mensaje = "Actividad guardada correctamente.";
    } else {
        $mensaje = "Error al guardar la actividad: " . mysqli_error($enlace);
    }
}

// Consultar todas las actividades
$resultado = mysqli_query($enlace, "SELECT * FROM actividad");

mysqli_close($enlace);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Actividades</title>
</head>
<body>
    <h1>Bienvenido, <?php echo htmlspecialchars($_SESSION['usuario']); ?></h1>
    
    <?php if (isset($mensaje)) echo "<p>$mensaje</p>"; ?>

    <h2>Registrar Nueva Actividad</h2>
    <form method="POST">
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br>

        <label for="tipo">Tipo:</label>
        <select id="tipo" required>
            <option value="1">Extraescolar</option>
            <option value="2">Complementaria</option>
        </select id="tipo"><br>

        <label for="departamento">Departamento:</label>
        <input type="text" id="departamento" name="departamento" required><br>

        <label for="profesor_responsable">Profesor Responsable:</label>
        <input type="text" id="profesor_responsable" name="profesor_responsable" required><br>

        <label for="trimestre">Trimestre:</label>
        <select id="trimestre" required>
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="2">3</option>
        </select id="trimestre"><br>

        <label for="fecha_inicio">Fecha de Inicio:</label>
        <input type="date" id="fecha_inicio" name="fecha_inicio" required><br>

        <label for="hora_inicio">Hora de Inicio:</label>
        <input type="time" id="hora_inicio" name="hora_inicio" required><br>

        <label for="fecha_fin">Fecha de Fin:</label>
        <input type="date" id="fecha_fin" name="fecha_fin" required><br>

        <label for="hora_fin">Hora de Fin:</label>
        <input type="time" id="hora_fin" name="hora_fin" required><br>

        <label for="organizador">Organizador:</label>
        <input type="text" id="organizador" name="organizador" required><br>

        <label for="acompanantes">Acompañantes:</label>
        <input type="number" id="acompanantes" name="acompanantes" required><br>

        <label for="ubicacion">Ubicación:</label>
        <input type="text" id="ubicacion" name="ubicacion" required><br>

        <label for="coste">Coste:</label>
        <input type="number" id="coste" name="coste" step="0.01" required><br>

        <label for="total_alumnos">Total de Alumnos:</label>
        <input type="number" id="total_alumnos" name="total_alumnos" required><br>

        <label for="objetivo">Objetivo:</label>
        <textarea id="objetivo" name="objetivo" required></textarea><br>

        <button type="submit">Guardar Actividad</button>
    </form>

    <h2>Lista de Actividades</h2>
    <table border="1">
        <tr>
            <th>Título</th>
            <th>Tipo</th>
            <th>Departamento</th>
            <th>Profesor Responsable</th>
            <th>Trimestre</th>
            <th>Fecha Inicio</th>
            <th>Hora Inicio</th>
            <th>Fecha Fin</th>
            <th>Hora Fin</th>
            <th>Organizador</th>
            <th>Acompañantes</th>
            <th>Ubicación</th>
            <th>Coste</th>
            <th>Total Alumnos</th>
            <th>Objetivo</th>
        </tr>
        <?php while ($actividad = mysqli_fetch_assoc($resultado)): ?>
        <tr>
            <td><?php echo htmlspecialchars($actividad['titulo']); ?></td>
            <td><?php echo htmlspecialchars($actividad['tipo']); ?></td>
            <td><?php echo htmlspecialchars($actividad['departamento']); ?></td>
            <td><?php echo htmlspecialchars($actividad['profesor_responsable']); ?></td>
            <td><?php echo htmlspecialchars($actividad['trimestre']); ?></td>
            <td><?php echo htmlspecialchars($actividad['fecha_inicio']); ?></td>
            <td><?php echo htmlspecialchars($actividad['hora_inicio']); ?></td>
            <td><?php echo htmlspecialchars($actividad['fecha_fin']); ?></td>
            <td><?php echo htmlspecialchars($actividad['hora_fin']); ?></td>
            <td><?php echo htmlspecialchars($actividad['organizador']); ?></td>
            <td><?php echo htmlspecialchars($actividad['acompanantes']); ?></td>
            <td><?php echo htmlspecialchars($actividad['ubicacion']); ?></td>
            <td><?php echo htmlspecialchars($actividad['coste']); ?></td>
            <td><?php echo htmlspecialchars($actividad['total_alumnos']); ?></td>
            <td><?php echo htmlspecialchars($actividad['objetivo']); ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
