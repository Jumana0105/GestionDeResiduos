

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Gestión de Residuos</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <header>
        <h1>Gestión de Residuos - Reportes</h1>
        <nav>
            <ul>
                <li><a href="index.html">Inicio</a></li>
                <li><a href="mapa.html">Mapa</a></li>
                <li><a href="recoleccion.html">Recolección</a></li>
                <li><a href="educacion.html">Educación</a></li>
                <li><a href="ranking.html">Ranking</a></li>
            </ul>
        </nav>
    </header>

    <section id="reportes">
        <h2>Reportar un Problema</h2>
        <!-- Formulario que envía los datos al mismo archivo PHP -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="provincia">Provincia:</label>
                <input type="text" id="provincia" name="provincia" required>
            </div>

            <div class="form-group">
                <label for="canton">Cantón:</label>
                <input type="text" id="canton" name="canton" required>
            </div>

            <div class="form-group">
                <label for="distrito">Distrito:</label>
                <input type="text" id="distrito" name="distrito" required>
            </div>

            <div class="form-group">
                <label for="barrio">Barrio:</label>
                <input type="text" id="barrio" name="barrio" required>
            </div>

            <div class="form-group">
                <label for="nombre">Nombre Completo:</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="form-group">
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telefono">Teléfono:</label>
                <input type="tel" id="telefono" name="telefono" required>
            </div>

            <div class="form-group">
                <label for="descripcion">Descripción del Problema:</label>
                <textarea id="descripcion" name="descripcion" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <label for="coordenadasDMS">Coordenadas (DMS, opcional):</label>
                <input type="text" id="coordenadasDMS" name="coordenadasDMS" placeholder="Ejemplo: 9°58'55\"N 84°01'25\"W">
            </div>

            <button type="submit" class="submit-btn">Enviar Reporte</button>
        </form>

        <div id="reportesEnviados" class="reportes-enviados">
            <h3>Reportes Enviados</h3>
            <ul id="listaReportes">
                <!-- Aquí se podrían listar los reportes almacenados si fuera necesario -->
            </ul>
        </div>
        <?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $provincia = $_POST['provincia'];
    $canton = $_POST['canton'];
    $distrito = $_POST['distrito'];
    $barrio = $_POST['barrio'];
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $descripcion = $_POST['descripcion'];
    $coordenadasDMS = $_POST['coordenadasDMS'];
    // Definir el nombre del archivo de reportes
    $file = fopen("Reportes_residuos.txt", "a");

    // Escribir los datos del formulario en el archivo
    fwrite($file, "Provincia: " . $provincia . "\n");
    fwrite($file, "Cantón: " . $canton . "\n");
    fwrite($file, "Distrito: " . $distrito . "\n");
    fwrite($file, "Barrio: " . $barrio . "\n");
    fwrite($file, "Nombre: " . $nombre . "\n");
    fwrite($file, "Email: " . $email . "\n");
    fwrite($file, "Teléfono: " . $telefono . "\n");
    fwrite($file, "Descripción: " . $descripcion . "\n");
    fwrite($file, "Coordenadas: " . $coordenadasDMS . "\n");
    fwrite($file, "----------------------------\n");

    
    fclose($file);
    echo "Reporte guardado exitosamente";
} else {
    echo "Error al abrir el archivo.";
}
?>
    </section>
    <footer>
        <p>&copy; 2025 Gestión de Residuos - Grupo 8 - Ambiente Web Cliente Servidor - Universidad Fidelitas</p>
    </footer> 
    <script src="reportes.js"></script>
</body>
</html>

