<?php
//Creamos la conexión con la base de datos
$host = "162.241.62.200";
$user = "superosi_comapa";
$pass = "Clave-123";
$db = "superosi_telemetria";
$con = mysqli_connect($host, $user, $pass, $db);
if (!$con) {
  echo "Error: No se pudo conectar a MySQL." . PHP_EOL;
    die("Connection failed: " . mysqli_connect_error());
}else{
    
}
?>
