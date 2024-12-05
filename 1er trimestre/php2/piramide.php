<!DOCTYPE html>
<<<<<<< HEAD
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piramide Asteriscos</title>
</head>
<body>
    <h1>Introduce un numero positivo</h1>
    <input type="number" name="" id="">
    <button type="submit">Enviar</button>
=======
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pirámide Asteriscos</title>
    <script>
        // Validación en JavaScript
        function validarFormulario(event) {
            const numero = document.getElementById("numero").value;
            if (numero === "" || isNaN(numero) || numero <= 0) {
                alert("Por favor, introduce un número positivo.");
                event.preventDefault();
                return false;
            }
            return true;
        }
    </script>
</head>
<body>
    <h1>Pirámide de Asteriscos</h1>
    <form method="POST" onsubmit="return validarFormulario(event)">
        <label for="numero">Introduce un número positivo:</label>
        <input type="number" id="numero" name="numero" min="1" required>
        <button type="submit">Enviar</button>
    </form>

    <?php
    // Validación en PHP y generación de la pirámide
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);

        if ($numero === false || $numero <= 0) {
            echo "<p>Por favor, introduce un número válido positivo.</p>";
        } else {
            echo "<h2>Pirámide Generada:</h2>";
            echo "<pre>"; // Usamos <pre> para respetar el formato de los asteriscos
            for ($i = 1; $i <= $numero; $i++) {
                echo str_repeat("*", $i) . "\n";
            }
            echo "</pre>";
        }
    }
    ?>
>>>>>>> 2f06170dc14bb1b3cabaa1c388356c9d0cf88d6d
</body>
</html>