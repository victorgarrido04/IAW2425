<?php
    $servername = "sql308.thsite.top";
    $username = "thsi_38097494";
    $password = "fDxz?Ica";

    $conn = new mysqli($servername, $username, $password);

    $conn = mysqli_connect($servername, $username, $password);

    if (!$conn) {
        die("Falló la conexión: " . mysqli_connect_error());
    }
    echo "Conexión exitosa";
?>