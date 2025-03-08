document.addEventListener("DOMContentLoaded", function () {
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

    const formRegistro = document.getElementById('formRegistro');
    if (formRegistro) {
        formRegistro.addEventListener('submit', function (event) {
            event.preventDefault();
            const tipoResiduo = document.getElementById('tipo-residuo').value;
            console.log(`Recolección solicitada para: ${tipoResiduo}`);
        });
    } else {
        console.warn("El formulario de registro no fue encontrado en el DOM.");
    }

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

    // Manejo de botones de educación
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
});
