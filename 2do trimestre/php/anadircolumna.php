<?php
$servername = "sql308.thsite.top";
$username = "thsi_38097494";
$password = "fDxz?Ica";
$dbname = "thsi_38097494_bdpruebas";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
} 

// sql to create table
$sql = "ALTER TABLE usuarios 
ADD fullname VARCHAR(50),
ADD email VARCHAR(200);
";

if ($conn->query($sql) === TRUE) {
    echo "<p>Table usuarios created successfully</p>";
  } else {
    echo "Error creating table: " . $conn->error;
  }
  

  $conn->close();

?>