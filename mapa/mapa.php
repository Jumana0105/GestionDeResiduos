<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa Interactivo</title>
    <link rel="stylesheet" href="../styles.css">

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
    <style>
        #map { height: 500px; width: 100%; margin: 20px 0; }
        .filtro-container { margin: 20px 0; }
    </style>
</head>
<body>

<header>
    <h1>Mapa Interactivo</h1>
    <nav>
        <ul>
            <li><a href="../index.php">Inicio</a></li>
            <li><a href="../reportes/reportes.html">Reportes</a></li>
            <li><a href="mapa.php" class="activo">Mapa</a></li>
            <li><a href="../recoleccion.html">Recolección</a></li>
            <li><a href="../educacion.html">Educación</a></li>
            <li><a href="../ranking.html">Ranking</a></li>
        </ul>
    </nav>
</header>

<main>
    <section class="map-container">
        <h2>Ubicación de Centros de Reciclaje, Biodigestores y Eventos</h2>
        <p class="description">
            Este mapa muestra los lugares en tu comunidad donde podés dejar materiales reciclables, encontrar eventos o conocer tecnologías como biodigestores.
        </p>

        <div class="filtro-container">
            <label for="filtro-tipo">Filtrar por tipo:</label>
            <select id="filtro-tipo">
                <option value="todos">Todos</option>
                <option value="reciclaje">Reciclaje</option>
                <option value="biodigestor">Biodigestor</option>
                <option value="evento">Evento</option>
            </select>
        </div>

        <div id="map"></div>
    </section>
</main>

<footer>
    <p>© 2025 EcoVecindario - Todos los derechos reservados</p>
</footer>

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<script>
    const map = L.map('map').setView([9.9844, -84.7343], 14); // El Roble

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);

    let marcadores = [];

    // Íconos personalizados
    const iconos = {
        reciclaje: L.icon({
            iconUrl: 'icons/reciclaje.png',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        }),
        biodigestor: L.icon({
            iconUrl: 'icons/biodigestor.png',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        }),
        evento: L.icon({
            iconUrl: 'icons/evento.png',
            iconSize: [30, 30],
            iconAnchor: [15, 30],
            popupAnchor: [0, -30]
        })
    };

    function cargarPuntos(filtro) {
        fetch('puntos_mapa.php')
            .then(res => res.json())
            .then(data => {
                // Limpiar marcadores anteriores
                marcadores.forEach(m => map.removeLayer(m));
                marcadores = [];

                data.forEach(lugar => {
                    if (filtro === 'todos' || lugar.tipo === filtro) {
                        const icono = iconos[lugar.tipo] || null;

                        const marcador = L.marker([lugar.latitud, lugar.longitud], { icon: icono })
                            .bindPopup(`<strong>${lugar.nombre}</strong><br>${lugar.descripcion}`);

                        marcador.addTo(map);
                        marcadores.push(marcador);
                    }
                });
            });
    }

    // Filtro por tipo
    document.getElementById("filtro-tipo").addEventListener("change", e => {
        cargarPuntos(e.target.value);
    });

    // Cargar todos al inicio
    cargarPuntos('todos');

    // Dibujar perímetro desde el archivo GeoJSON
    fetch('el_roble.geojson')
        .then(res => res.json())
        .then(data => {
            L.geoJSON(data, {
                style: {
                    color: '#228B22',
                    weight: 2,
                    fillColor: '#aaffaa',
                    fillOpacity: 0.2
                }
            }).addTo(map).bindPopup("Perímetro aproximado de El Roble");
        });
</script>

</body>
</html>
