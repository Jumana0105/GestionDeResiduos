<?php
$conn = new mysqli("localhost", "root", "", "db_gestionresiduos");
$result = $conn->query("SELECT * FROM lugares_mapa");
$lugares = [];
while ($fila = $result->fetch_assoc()) {
    $lugares[] = $fila;
}
echo json_encode($lugares);
?>
