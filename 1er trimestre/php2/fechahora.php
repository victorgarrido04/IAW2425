<?php
    $dias = array("Domingo","Lunes","Martes","Miercoles","Jueves","Viernes","Sábado");
    $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
    $hora = time();

    echo $dias[date('w')]." ".date('d')." de ".$meses[date('n')-1]. " del ".date('Y') . $hora-> format('H:i:s') ;
?>
