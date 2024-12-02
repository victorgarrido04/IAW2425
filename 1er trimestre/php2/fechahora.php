<?php
    date_default_timezone_set('Europe/Madrid');
    setlocale(LC_TIME, 'es_ES.UTF-8', 'es_ES', 'Spanish_Spain');
    
    $fechaHora = strftime('%A, %d de %B de %Y, %H:%M:%S');
    echo "La fecha y hora actual es: $fechaHora";
?>