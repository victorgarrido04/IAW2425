<!DOCTYPE html>
<html>
<head>
    <title>Cuadrado de color aleatorio</title>
</head>
<body>
    <?php
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    echo "<div style='width:300px; height:300px; background-color:rgb($red, $green, $blue);'></div>";
    ?>
</body>
</html>
