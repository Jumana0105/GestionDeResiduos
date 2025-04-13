<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'db_gestionresiduos');
if ($conn->connect_error) die("Conexión fallida");

$id_usuario = $_SESSION['id'] ?? null;

if (!$id_usuario) {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$resultado = $stmt->get_result();
$usuario = $resultado->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="../styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: #f4f4f4;
        }
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .header a {
            background-color: #27ae60;
            padding: 10px 15px;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }
        .container {
            display: flex;
        }
        .sidebar {
            width: 250px;
            background: #d0ead5;
            padding: 20px;
            position: sticky;
            top: 0;
            height: 100vh;
        }
        .sidebar h3 {
            margin-top: 0;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar li {
            margin: 15px 0;
        }
        .sidebar li a {
            color: #2c3e50;
            text-decoration: none;
            font-weight: bold;
        }
        .content {
            flex: 1;
            padding: 30px;
            background: white;
        }
        .section {
            margin-bottom: 40px;
        }
        .section h2 {
            color: #2c3e50;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input, textarea, select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .btn {
            padding: 10px 20px;
            background: #0277bd;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .foto-preview {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
<div class="header">
    <h1>Mi Perfil</h1>
    <a href="../index.php">🏠 Home</a>
</div>

<div class="container">
    <div class="sidebar">
        <h3>Menú</h3>
        <ul>
            <li><a href="#info">Información básica</a></li>
            <li><a href="#reportes">Mis reportes</a></li>
            <li><a href="#comentarios">Mis comentarios</a></li>
            <li><a href="#solicitudes">Mis solicitudes</a></li>
            <li><a href="#educacion">Mi educación</a></li>
            <li><a href="#ranking">Mi ranking</a></li>
            <li><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </div>

    <div class="content">
        <section id="info" class="section">
            <h2>Información Básica</h2>
            <form action="guardar_perfil.php" method="POST" enctype="multipart/form-data">
                <?php if (!empty($usuario['foto_perfil'])): ?>
                    <img src="<?php echo $usuario['foto_perfil']; ?>" class="foto-preview" alt="Foto de perfil">
                <?php endif; ?>
                <div class="form-group">
                    <label>Foto de perfil</label>
                    <input type="file" name="foto_perfil">
                </div>
                <div class="form-group">
                    <label>Nombre de usuario</label>
                    <input type="text" name="nombre" value="<?php echo htmlspecialchars($usuario['nombre'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Correo electrónico</label>
                    <input type="email" name="correo" value="<?php echo htmlspecialchars($usuario['correo'] ?? ''); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Número de teléfono</label>
                    <input type="text" name="telefono" value="<?php echo htmlspecialchars($usuario['telefono'] ?? ''); ?>">
                </div>
                <div class="form-group">
                    <label>Dirección</label>
                    <textarea name="direccion"><?php echo htmlspecialchars($usuario['direccion'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Comunidad</label>
                    <select name="comunidad">
                        <option value="El Roble" <?php if (($usuario['comunidad'] ?? '') === 'El Roble') echo 'selected'; ?>>El Roble</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Número de casa</label>
                    <input type="text" name="numero_casa" value="<?php echo htmlspecialchars($usuario['numero_casa'] ?? ''); ?>">
                </div>
                <button class="btn" type="submit">Guardar cambios</button>
            </form>
        </section>

        <section id="reportes" class="section">
            <h2>Mis Reportes</h2>
            <a href="../reportes/reportes.php" class="btn">Crear nuevo reporte</a>
            <!-- Aquí se listarían los reportes del usuario -->
        </section>

        <section id="comentarios" class="section">
            <h2>Mis Comentarios</h2>
            <!-- Aquí se mostrarán los comentarios realizados -->
        </section>

        <section id="solicitudes" class="section">
            <h2>Mis Solicitudes</h2>
            <a href="../recoleccion.html" class="btn">Crear nueva solicitud</a>
            <!-- Aquí se mostrarán las solicitudes realizadas -->
        </section>

        <section id="educacion" class="section">
            <h2>Mi Educación</h2>
            <!-- Aquí se puede insertar un gráfico o resumen -->
        </section>

        <section id="ranking" class="section">
            <h2>Mi Ranking</h2>
            <!-- Aquí se puede mostrar el puesto del usuario -->
        </section>
    </div>
</div>
</body>

</html>
