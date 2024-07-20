<?php
$hostname = "localhost";
$usuariodb = "root";
$contrasenadb = "";
$dbname = "bilinguismo";

// Generar conexión con el servidor MySQL
$conexion = mysqli_connect($hostname, $usuariodb, $contrasenadb, $dbname);

// Verificar la conexión
if (!$conexion) {
    die("La conexión a la base de datos ha fallado: " . mysqli_connect_error());
}

// Ahora la variable $conexion contiene la conexión activa a la base de datos
?>
