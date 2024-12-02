<?php
// Configurar la zona horaria
date_default_timezone_set('Europe/Madrid'); // Cambia según tu zona horaria

// Obtener la fecha y hora actual
$fechaHora = new DateTime();
echo "La fecha y hora actual es: " . $fechaHora->format('l, d \d\e F \d\e Y, H:i:s');
?>
