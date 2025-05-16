// Funciones by Juan

// Boton para consultar el reporte por el prefolio
$(document).on('click', '#btn_consultar_prefolio', function (e) {
    e.preventDefault();

    // limpiamos el campo del pdf por si tiene algo no deseado
    $('#adobe-dc-view').html("")

    // Sacamos el prefolio que ingreso
    let prefolio = $('#prefolio').val();

    // validamos si el prefolio esta vacio
    if (prefolio === "") {
        alertToast("El prefolio esta vacio", "error", 2000);
        return false;
    }


    // hacemos la petición para consultar el turno del prefolio ingresado
    ajaxAwait({
        api: 4,
        prefolio: prefolio
    }, 'valores_referencia_api', { callbackAfter: true }, false, (data) => {
        let turno_id = data.response.data[0][0];

        const URL = obtener_reporte(turno_id);
        const NOMBRE = `reporte_${prefolio}`;


        // getNewView(URL, NOMBRE);
    })
})

// function para obtener el reporte por medio del turno_id
function obtener_reporte(turno_id) {
    let api = encodeURIComponent(window.btoa('laboratorio'));
    let turno = encodeURIComponent(window.btoa(turno_id));
    let area = encodeURIComponent(window.btoa('6'));

    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, '_blank');

    return `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`;
}

// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    var clientId = isLocalHost ? '3867b556792e429084f3e9253d3ea45c' : 'cd0a5ec82af74d85b589bbb7f1175ce3';
    let adobeDCView = new AdobeDC.View({ clientId: clientId, divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}