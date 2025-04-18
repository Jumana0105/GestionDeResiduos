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
    $usuario = mysqli_real_escape_string($conn, $_POST["usuario"]);
    $descripcion = mysqli_real_escape_string($conn, $_POST["descripcion"]);
    $ubicacion = mysqli_real_escape_string($conn, $_POST["ubicacion"]);

    // Por ahora no procesamos imagen, solo guardamos el nombre si se sube
    $foto = "";
    if (!empty($_FILES["foto"]["name"])) {
        $foto = basename($_FILES["foto"]["name"]);
        $ruta_destino = "imagenes/" . $foto;
        move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta_destino);
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO reportes (id_usuario, descripcion, foto, ubicacion)
            VALUES ('$usuario', '$descripcion', '$foto', '$ubicacion')";

    if (mysqli_query($conn, $sql)) {
        echo "Reporte guardado exitosamente.";
    } else {
        echo "Error al guardar: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    echo "Acceso no permitido.";
}
?>
