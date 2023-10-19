$(document).on("click", "#btn-mostrar-formato-consentimiento", function () {
    MostrarReportePDF();
})

// Function para mostrar en el modal el visualizador de reporte, obvio con el reporte seleccionado xd
function MostrarReportePDF() {
    const RUTA = "null";
    const NOMBRE = "null";

    if (RUTA === null) {
        alertMsj({
            title: '¡No se pudo obtener su reporte!', text: 'Hubo un problema al obtener su reporte, por favor de contactar al soporte de bimo',
            icon: 'error', allowOutsideClick: true, showCancelButton: false, showConfirmButton: true
        })
        $("#consentimiento_paciente_modal").modal("hide");
        return false;
    } else {
        getNewView(RUTA, NOMBRE)
        $("#consentimiento_paciente_modal").modal("show");
    }

}

// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}
