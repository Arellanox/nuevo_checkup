// Folio del mes que se esta seleccionando en la tabla
FolioMesEquipo = {}, DatosAjax = {}, observaciones = "", Termometro = "";
// Evento Click para abrir el modal de exportar PDF
// $(document).on("click", '#GenerarPDFTemperatura', async function (e) {

// })

let dataJson = {
    api: 15
};

// Evento Click para generar el PDF y mostralo en una ventana nueva
$(document).on('click', "#btn-generar-formato-temperatura", async function (e) {
    // body...
    e.preventDefault();

    // data = new FormData(document.getElementById("GenerarPdfForm"));

    alertMensajeConfirm({
        title: '¿Esta seguro de guardar los datos?',
        text: `Se guardaran los datos para el folio (${FolioMesEquipo})`,
        icon: 'info'
    }, async function () {
        // alertToast('Tomando Captura de la tabla', 'info', 2000);
        alertMensaje('info', 'Se tomará captura de la tabla', 'Espere un momento mientras capturamos y guardamos la tabla de temperatura.')
        await tomarCapturaPantalla({
            type: 'div',
            name: `TablaDePuntos_Temperatura_folio${FolioMesEquipo}`,
            elementId: 'grafica'
        });

        setTimeout(async function () {
            await ajaxAwait(DatosAjax, 'temperatura_api', { callbackAfter: true }, false, (data) => {
                alertToast("Reporte guardado y generado", 'success', 2000)
                $("#observaciones_pdf").val("");
                observaciones = "";
                CrearEncabezadoEquipos(SelectedFoliosData['FOLIO']);
                $('#btn-mostrar-formato-temperatura').fadeIn(0)
                // $("#TemperaturaModalGeneralFirma").modal('hide');
            });
        }, 2000)


    }, 1)

})

$(document).on('click', "#btn-mostrar-formato-temperatura", async function (e) {
    e.preventDefault();

    api = encodeURIComponent(window.btoa('temperatura'));
    area = encodeURIComponent(window.btoa(-1));
    turno = encodeURIComponent(window.btoa(FolioMesEquipo));

    var win = window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, '_blank')

    win.focus();
    // $("#TemperaturaModalGeneralFirma").modal("hide");
})


// Funcion para tomar captura de pantalla a la tabla de temperaturas en 3 capas Tabla, Dots, Canvas
async function tomarCapturaPantalla(data = {}) {
    return await new Promise(function (resolve, reject) {
        Termometro = $("#Termometro_pdf").val();
        observaciones = $("#observaciones_pdf").val();
        var element = document.getElementById(data['elementId']);
        var zoom = 1 / (window.devicePixelRatio || 1); // Nivel de zoom actual de la página

        // Ajustar el tamaño del elemento según el nivel de zoom
        element.style.transform = 'scale(' + zoom + ')';
        element.style.transformOrigin = 'top left';

        var scale = 2; // Ajusta este valor según tus necesidades
        var options = {
            scale: scale * zoom, // Considerar el nivel de zoom actual
            useCORS: true,
            allowTaint: true,
            scrollX: 0,
            scrollY: 0,
        };

        html2canvas(element, options).then(function (canvas) {
            // Restaurar el tamaño original del elemento
            element.style.transform = '';
            element.style.transformOrigin = '';
            elementImg = canvas.toDataURL();
            elementName = data['name'];

            DatosAjax.api = 15
            DatosAjax.UrlImg = elementImg
            DatosAjax.NameImg = elementName
            DatosAjax.Termometro = Termometro
            DatosAjax.folio = FolioMesEquipo
            DatosAjax.observaciones = observaciones

            // swal.close(); 


            resolve(1)
        });


    })
}


