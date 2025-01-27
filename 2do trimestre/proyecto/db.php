<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097494";
$password = "******";
$database = "thsi_38097494_proyectovictor";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
