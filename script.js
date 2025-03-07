document.getElementById('formReporte').addEventListener('submit', function (event) {
    event.preventDefault();
    const descripcion = document.getElementById('descripcion').value;
    console.log(`Reporte enviado: ${descripcion}`);
});

document.getElementById('formRegistro').addEventListener('submit', function (event) {
    event.preventDefault();
    const tipoResiduo = document.getElementById('tipo-residuo').value;
    console.log(`Recolección solicitada para: ${tipoResiduo}`);
});
