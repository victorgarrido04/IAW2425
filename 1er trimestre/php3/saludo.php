<!DOCTYPE html>
<html>
<body>
    <form action="saludo.php" method="post" >
        Su nombre: <input type="text" name="nombre">
        <input type="submit">
</form>
</body>
<?php 
    if ($_POST){
        echo "Hola " . htmlspecialchars($_POST['nombre']) . " hoy es " . date("d/m/Y") . "."; 
    }
?>
</html>