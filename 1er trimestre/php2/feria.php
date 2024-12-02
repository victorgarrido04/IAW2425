<?php
// Fecha actual
$fechaActual = new DateTime();

// Fecha de inicio de la Feria
$fechaFeria = new DateTime('2025-05-06');

// Calcular la diferencia en días
$diferencia = $fechaActual->diff($fechaFeria);

// Comprobar si la fecha de la Feria ya pasó
if ($fechaActual > $fechaFeria) {
    echo "La Feria de 2025 ya ha comenzado.";
} else {
    echo "Faltan " . $diferencia->days . " días para que comience la Feria de 2025.";
}
?>
