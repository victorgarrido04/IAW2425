<?php
$imagenes = array("https://pbs.twimg.com/media/Blgl_iWIgAAFAji.jpg:large", "https://www.record.com.mx/sites/default/files/styles/v2-crop768x433/public/articulos/2024/11/22/proyecto_nuevo_-_2024-11-22t124847.496.jpg?itok=IsjU5ja9", "https://i.ytimg.com/vi/z5LavRsp3K8/hq720.jpg?sqp=-oaymwEhCK4FEIIDSFryq4qpAxMIARUAAAAAGAElAADIQj0AgKJD&rs=AOn4CLAV0cv_0Wyr0D15AedDTr9SRmrasw");
$aleatoria = $imagenes[array_rand($imagenes)];

echo "<img src='$aleatoria' alt='Imagen aleatoria'>";
?>
