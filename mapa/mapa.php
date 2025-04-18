<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Interactivo</title>
    <link rel="stylesheet" href="../css/styles.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
</head>
<body>

<header>
    <h1>Mapa Interactivo</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="reportes/reportes.html">Reportes</a></li>
            <li><a href="../recoleccion.html">Recolección</a></li>
            <li><a href="../educacion.html">Educación</a></li>
            <li><a href="usuarios/ranking.html">Ranking</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="map-container">
        <h2>Ubicación de Centros de Reciclaje y Puntos Relevantes</h2>
        <p class="description">
            Este mapa muestra los lugares en tu comunidad donde podés dejar materiales reciclables o encontrar eventos ambientales.
        </p>
        <div id="map" style="height: 500px; width: 100%; margin: 20px 0;"></div>
    </section>
</main>

<footer>
    <p>© 2025 EcoVecindario - Todos los derechos reservados</p>
</footer>

<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>


<script>
    var map = L.map('map').setView([9.7489, -83.7534], 8);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    L.marker([9.932, -84.08]).addTo(map)
        .bindPopup("Centro de reciclaje en San José")
        .openPopup();
</script>

</body>
</html>
