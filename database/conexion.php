<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "db_gestionresiduos";

$conexion = new mysqli($host, $username, $password, $dbname);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>