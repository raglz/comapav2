<?php
//Creamos la conexión con la base de datos
$host = "localhost";
$user = "root";
$pass = "";
$db = "comapa";
$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>



