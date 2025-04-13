<?php
session_start();

// Conexión a la base de datos
$host = 'localhost';
$usuario = 'root';
$clave = '';
$bd = 'db_gestionresiduos';

$conn = new mysqli($host, $usuario, $clave, $bd);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar tipo de acción
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['accion'])) {

    if ($_POST['accion'] === 'login') {
        // LOGIN
        $correo = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        $sql = "SELECT * FROM usuarios WHERE correo = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows === 1) {
            $usuario = $resultado->fetch_assoc();
            if (password_verify($contrasena, $usuario['contrasena'])) {
                $_SESSION['usuario'] = $usuario['nombre'];
                $_SESSION['id'] = $usuario['id'];
                $_SESSION['comunidad'] = $usuario['comunidad'];
                header("Location: index.php");
                exit();
            } else {
                echo "Contraseña incorrecta.";
            }
        } else {
            echo "Correo no registrado.";
        }

    } elseif ($_POST['accion'] === 'registro') {
        // REGISTRO
        $nombre = $_POST['nombre_usuario'];
        $correo = $_POST['correo'];
        $comunidad = $_POST['comunidad'];
        $contrasena = $_POST['contrasena'];
        $confirmar = $_POST['confirmar'];

        if ($contrasena !== $confirmar) {
            echo "Las contraseñas no coinciden.";
            exit();
        }

        $contrasena_hashed = password_hash($contrasena, PASSWORD_DEFAULT);

        // Verificar si ya existe el correo
        $verificar = $conn->prepare("SELECT id FROM usuarios WHERE correo = ?");
        $verificar->bind_param("s", $correo);
        $verificar->execute();
        $verificar->store_result();

        if ($verificar->num_rows > 0) {
            echo "Este correo ya está registrado.";
        } else {
            $sql = "INSERT INTO usuarios (nombre, correo, contrasena, comunidad) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssss", $nombre, $correo, $contrasena_hashed, $comunidad);

            if ($stmt->execute()) {
                $_SESSION['usuario'] = $nombre;
                $_SESSION['id'] = $stmt->insert_id;
                $_SESSION['comunidad'] = $comunidad;
                header("Location: index.php");
                exit();
            } else {
                echo "Error al registrar usuario.";
            }
        }

    } else {
        echo "Acción no reconocida.";
    }

} else {
    echo "Solicitud no válida.";
}

$conn->close();
?>
