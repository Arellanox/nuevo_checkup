//Recupera y muestra la informacion del paciente
function informacionMedica(data) {
    // Información del medico
    $('#nom_paciente').html(ifnull(data, `${session['nombre']} ${session['apellidos']}`, ['MEDICO']))
    $('#fech_nacimiento').html(ifnull(data, session['CEDULA'], ['CEDULA_MEDICA']))

    // Nombre y fecha de nacimiento
    $('#nom_paciente').html(datalist['NOMBRE_COMPLETO'])
    $('#fech_nacimiento').html(datalist['NOMBRE_COMPLETO'])

    // Que lo manden
    $('#segmento').html(datalist['SEGMENTO'])
    $('#categoria').html(datalist['SEGMENTO'])
}


$('#cuerpo_certificado_form').submit(function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Esta seguro de guardar los datos?',
        text: 'No podra modificarlos',
        icon: 'warning',
    }, () => {

    }, 1)

});


// guardar o confirmar interpretación
$(document).on('click', '.btn-interpretacion', function (e) {
    e.preventDefault();

    let $btn = $(this);
    let action = $btn.attr('data-bs-action');
    title = `¿Esta seguro de ${action} el certificado?`
    add_text = 'Se' // <-- De guardar
    switch (action) {
        case 'guardar': bit = 0; break; // <-- Guardar
        case 'confirmar': add_text = 'No'; bit = 1; break; // <-- Confirmar
    }
    text = `${add_text} podrá modificarlo más tarde`;
    btnAlertas(title, text, bit)
})


function btnAlertas(title, text, bit) {
    alertMensajeConfirm({
        title: title,
        text: text,
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro'
    }, function () {
        guardarDatos(bit)
    }, 1)
}


function guardarDatos(bit) {
    ajaxAwaitFormData({ api: 3, tipo_certificado: pdf_format, turno_id: datalist['ID_TURNO'], confirmado: bit }, 'certificados_api', 'cuerpo_certificado_form', { callbackAfter: true }, false, (data) => {
        alertToast('Se han guardado los datos corretamente!', 'success', 4000)
        data.response.data[0].RUTA_REPORTE

        estadoFormulario(1, bit);
    })
}







$(document).on('click', '#listado-resultados div.collapse a[target="_blank"]', (event) => {
    event.preventDefault()
    event.stopPropagation()

    let url = $(this).attr('href')

    // Agrega de forma dinamica el reporte en vista

    // Obtener el texto del enlace de colapso
    let collapseLinkText = $(this).closest('div.collapse').prev().find('a').text().trim();
    // Obtener el texto del enlace clickeado
    let clickedLinkText = $(this).text().trim();

    // Construir el nombre del archivo
    let filename = `${collapseLinkText} - ${clickedLinkText}`;

    vistaPrevia(filename, url);
})


$(document).on('click', '#btn-vistaPrevia', function () {

    let api = encodeURIComponent(window.btoa('certificados_medicos'));
    let turno = encodeURIComponent(window.btoa($(this).attr('turno_actual')));
    let area = encodeURIComponent(window.btoa('-5'));
    let preview = encodeURIComponent(window.btoa(pdf_format));

    let url = `${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}&preview=${preview}`;
    let filename = `${datalist['NOMBRE_COMPLETO']} ${pdf_format}`

    url = ifnull(dataSelect, url, { array: 'url_reporte' })
    // if ()
    window.open(url, "_blank");
    vistaPrevia(filename, url)
})

$(document).on('click', '#consultar-caratula-actual', function (e) {
    e.preventDefault();

    // Validar que tenga o no, ocultarlo si es necesario
    let url = $(this).attr('data-url');
    let filename = $(this).attr('data-nombre-pdf');

    if (ifnull(url, false) && ifnull(filename, false)) {
        vistaPrevia(filename, url)
    } else {
        alertToast('PDF no encontrado', 'question', 4000)
    }

})

function vistaPrevia(filename, url) {

    if (!ifnull(filename, false))
        return
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    url += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: url } },
        metaData: { fileName: filename }
    });
}