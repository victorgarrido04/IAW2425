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

$sql = "INSERT INTO usuarios (id, username, password)
VALUES ('4', 'PacuPacu', 'PacuPacu4')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

<br>

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT id, username, password FROM usuarios";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["username"]. " - Contra: " . $row["password"]. "<br>";
  }
} else {
  echo "0 results";
}

$conn->close();
?>