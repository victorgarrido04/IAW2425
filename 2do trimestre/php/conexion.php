<?php
    $servername = "sql308.byetcluster.com";
    $username = "thsi_38097494";
    $password = "usuario";

    $conn = new mysqli($servername, $username, $password);

    if($conn -> connect_error)