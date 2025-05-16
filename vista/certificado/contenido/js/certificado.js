
function getCertificado(){
    ajaxAwait({hash: codigo, api: 4}, 'certificado_medico_api', {
        callbackAfter: true, response: false
    }, false, (data) => {
        const response = data.response.data[0];
        let route = response['RUTA_CERTIFICADO'];

        if (isLocalHost) route = route.replace(/^https?:\/\/[^/]+\/nuevo_checkup\//, 'http://localhost/nuevo_checkup/');

        getNewView(route, 'CERTIFICADO_'+response['NOMBRE_COMPLETO']);
    })
}


function getNewView(url, filename) {
    let clientId = isLocalHost ? '3867b556792e429084f3e9253d3ea45c' : 'cd0a5ec82af74d85b589bbb7f1175ce3';
    let adobeDCView = new AdobeDC.View({ clientId: clientId, divId: "adobe-dc-view" });
    let nuevaURL = url + "?timestamp=" + Date.now();

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}

getCertificado();