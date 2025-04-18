

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes - Gestión de Residuos</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const form = document.querySelector("form");
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Evita el envío del formulario para mostrar el mensaje
            alert("Reporte enviado");
            console.log("Reporte enviado");
            form.submit(); // Envía el formulario después de mostrar el mensaje
        });
    });
</script>
<body>
    <header>
        <h1>Gestión de Residuos - Reportes</h1>
        <nav>
            <ul>
                <li><a href="../index.php">Inicio</a></li>
                <li><a href="../mapa.html">Mapa</a></li>
                <li><a href="../recoleccion.html">Recolección</a></li>
                <li><a href="../educacion.html">Educación</a></li>
                <li><a href="../usuarios/ranking.html">Ranking</a></li>
            </ul>
        </nav>
    </header>

    <section id="reportes">
        <h2>Reportar un Problema</h2>
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

            <button type="submit" class="submit-btn">Enviar Reporte</button>
        </form>

        <div id="reportesEnviados" class="reportes-enviados">
            <h3>Reportes Enviados</h3>
            <ul id="listaReportes">
            </ul>
        </div>
        <?php
$file_name = "Reportes_residuos.txt";

// Ruta al archivo de reportes
$archivo = "Reportes_residuos.txt";

// Verifica si el archivo existe
if (!file_exists($archivo)) {
    echo json_encode(["error" => "El archivo no existe"]);
    exit;
}

// Leer el contenido del archivo
$contenido = file_get_contents($archivo);

// Convertir cada línea en un array asociativo (suponiendo que el archivo tiene formato JSON por línea)
$lineas = explode("\n", trim($contenido));
$reportes = [];

foreach ($lineas as $linea) {
    $dato = json_decode($linea, true);
    if ($dato) {
        $reportes[] = $dato;
    }
}

// Enviar los reportes como JSON
header('Content-Type: application/json');
echo json_encode($reportes);



header("Content-Type: application/json");

// Verifica si el archivo existe
$archivo = "Reportes_residuos.txt";
if (!file_exists($archivo)) {
    echo json_encode([]);
    exit;
}

// Lee el contenido del archivo
$contenido = file_get_contents($archivo);
$reportes = explode("---", $contenido); // Divide los reportes usando "---" como separador

$datos = [];
foreach ($reportes as $reporte) {
    $lineas = explode("\n", trim($reporte));
    $info = [];
    
    foreach ($lineas as $linea) {
        if (strpos($linea, "Provincia:") !== false) {
            $info["Provincia"] = trim(str_replace("Provincia:", "", $linea));
        } elseif (strpos($linea, "Cantón:") !== false) {
            $info["Cantón"] = trim(str_replace("Cantón:", "", $linea));
        } elseif (strpos($linea, "Descripción:") !== false) {
            $info["Descripción"] = trim(str_replace("Descripción:", "", $linea));
        } elseif (strpos($linea, "Coordenadas:") !== false) {
            $info["Coordenadas"] = trim(str_replace("Coordenadas:", "", $linea));
        }
    }

    if (!empty($info)) {
        $datos[] = $info;
    }
}

echo json_encode($datos, JSON_PRETTY_PRINT);
?>

    </section>
    <footer>
        <p>&copy; 2025 Gestión de Residuos - Grupo 8 - Ambiente Web Cliente Servidor - Universidad Fidelitas</p>
    </footer> 
    <script src="reportes.js"></script>
</body>
</html>

