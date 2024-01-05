//Recupera y muestra la informacion del paciente
function datosPaciente(data, cliente) {

    switch (cliente) {
        case 'SLB':
            $('#nom_paciente').html(data['NOMBRE_PACIENTE'])
            $('#fech_nacimiento').html(data['FECHA_NACIMIENTO'])
            $('#segmento').html(data['SEGMENTO'])
            $('#categoria').html(data['CATEGORIA'])
            break;

        default:
            break;
    }


}

// $('#btn-subirCertificadoSLB').on('click', function () {
//     // console.log('Click al btn de slb')
//     // dataJson = {}

//     // dataJson['']
//     // dataJson['add'] = $('#add-2').val()

//     // console.log(dataJson)

//     var formulario = document.getElementById('formSubirCertificadoSLB'); // Reemplaza 'tuFormulario' con el ID de tu formulario
//     var elementos = formulario.elements;

//     for (var i = 0; i < elementos.length; i++) {
//         console.log("Nombre del elemento:", elementos[i].name);
//         console.log("Tipo del elemento:", elementos[i].type);
//         // Puedes agregar más información según tus necesidades
//     }
// })


$('#cuerpo_certificado_form').submit(function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Esta seguro de guardar los datos?',
        text: 'No podra modificarlos',
        icon: 'warning',
    }, () => {

    }, 1)

});


$(document).on('click', '#btn-guardarInterpretacion', function (e) {
    e.preventDefault();
    title = '¿Esta seguro de guardar la valoración prequirúrgica?'
    text = 'Se podra modificarlo despues'
    btnAlertas(title, text, 0)
})

$(document).on('click', '#btn-confirmarReporte', function (e) {
    e.preventDefault();
    title = '¿Esta seguro de confirmar el reporte?'
    text = 'No se podra modificar despues'
    btnAlertas(title, text, 1)
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

    console.log(pdf_format)
    ajaxAwaitFormData({ api: 3, tipo_certificado: pdf_format, turno_id: datalist['ID_TURNO'], confirmado: bit }, 'certificados_api', 'cuerpo_certificado_form', { callbackAfter: true }, false, () => {
        alertToast('Se han guardado los datos corretamente!', 'success', 4000)

        estadoFormulario(1, bit);
    })

}







$(document).on('click', '#listado-resultados div.collapse a[target="_blank"]', (event) => {
    event.preventDefault()
    event.stopPropagation()

    let url = $(this).attr('href')

    // Agrega de forma dinamica el reporte en vista
    console.log($(this).attr('href'))

    // Obtener el texto del enlace de colapso
    let collapseLinkText = $(this).closest('div.collapse').prev().find('a').text().trim();
    // Obtener el texto del enlace clickeado
    let clickedLinkText = $(this).text().trim();

    // Construir el nombre del archivo
    let filename = `${collapseLinkText} - ${clickedLinkText}`;

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

})


$(document).on('click', '#btn-vistaPrevia', function () {

    let api = encodeURIComponent(window.btoa('certificados_medicos'));
    let turno = encodeURIComponent(window.btoa($(this).attr('turno_actual')));
    let area = encodeURIComponent(window.btoa('-5'));
    let preview = encodeURIComponent(window.btoa(pdf_format));

    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}&preview=${preview}`, "_blank");
})