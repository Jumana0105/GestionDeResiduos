<?php
require_once "conexion.php";
// Conexión a la base de datos
$host = "localhost"; //nombre de tu conexcion principal
$username = "root"; //nombre de usuario de tu base de datos
$password = "1234578"; //contraseña de tu base de datos
$dbname = "gestion_bd"; //nombre de tu base de datos


//EN CASO QUE HAYA ERRORES EN LA CONEXION A LA BASE DE DATOS
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Activar excepciones
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
  }

// Verifica si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Sanitizar los datos
    $usuario = $_POST["usuario"];
    $descripcion = $_POST["descripcion"];
    $ubicacion = $_POST["ubicacion"];


    // Insertar en la base de datos
    $sql = "INSERT INTO reportes (id_usuario, descripcion, foto, ubicacion)
            VALUES (:usuario, :descripcion, :ubicacion)";

    try {
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':ubicacion', $ubicacion);
        $stmt->execute();
        echo "Reporte guardado exitosamente.";
    } catch (PDOException $e) {
        echo "Error al guardar: " . $e->getMessage();
    }

} else {
    echo "Acceso no permitido.";
}
?>
