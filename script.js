// Esperar a que el DOM esté completamente cargado antes de ejecutar el script
// Manejo de formularios y eventos

document.addEventListener("DOMContentLoaded", function () {
    // Manejo del formulario de reportes
    const formReporte = document.getElementById('formReporte');
    if (formReporte) {
        formReporte.addEventListener('submit', function (event) {
            event.preventDefault();
            const descripcion = document.getElementById('descripcion').value;
            console.log(`Reporte enviado: ${descripcion}`);
        });
    } else {
        console.warn("El formulario de reporte no fue encontrado en el DOM.");
    }

    // Manejo del formulario de recolección de residuos
    const formRecoleccion = document.getElementById("formRecoleccion");
    if (formRecoleccion) {
        formRecoleccion.addEventListener("submit", function (event) {
            event.preventDefault();
            const tipoResiduo = document.getElementById("tipo-residuo").value;
            const direccion = document.getElementById("direccion").value;
            alert(`Solicitud de recolección enviada para: ${tipoResiduo} en ${direccion}`);
        });
    } else {
        console.warn("El formulario de recolección no fue encontrado en el DOM.");
    }

    // Manejo de botones de educación ambiental
    const botonesEducacion = document.querySelectorAll(".btn-educacion");
    if (botonesEducacion.length > 0) {
        botonesEducacion.forEach(boton => {
            boton.addEventListener("click", function () {
                const tema = this.dataset.tema;
                alert(`Mostrando información sobre: ${tema}`);
            });
        });
    } else {
        console.warn("No se encontraron botones de educación en el DOM.");
    }

    // Inicializar el mapa en Costa Rica
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([9.7489, -83.7534], 8); // Costa Rica
    
        // Agregar capa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);
    });
    

    // Cargar reportes desde localStorage y agregar marcadores al mapa
    var reportes = JSON.parse(localStorage.getItem('reportes')) || [];
    reportes.forEach(function(reporte) {
        L.marker([reporte.lat, reporte.lon]).addTo(map)
            .bindPopup(`<strong>${reporte.descripcion}</strong><br>${reporte.direccion}`);
    });

    // Agregar marcadores de ejemplo con información sobre residuos
    var markers = [
        { lat: 9.935, lng: -84.078, lugar: "San José", problema: "Acumulación de residuos sólidos" },
        { lat: 9.99, lng: -84.11, lugar: "Heredia", problema: "Contaminación de ríos por desechos" },
        { lat: 10.015, lng: -84.216, lugar: "Alajuela", problema: "Falta de centros de reciclaje" }
    ];

    markers.forEach(m => {
        L.marker([m.lat, m.lng]).addTo(map)
            .bindPopup(`<b>${m.lugar}</b><br>${m.problema}`);
    });
});
