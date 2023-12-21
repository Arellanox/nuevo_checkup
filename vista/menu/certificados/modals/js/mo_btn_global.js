//Recupera y muestra la informacion del paciente
function datosPaciente(data, cliente) {

    switch (cliente) {
        case 'SLB':
            $('#Nom_medico').html(data['MEDICO'])
            $('#cedula').html(data['CEDULA_MEDICO'])
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


$('#btn-subirCertificadoSLB').on('click', function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Esta seguro de guardar los datos?',
        text: 'No podra modificarlos',
        icon: 'warning',
    }, () => {
        ajaxAwaitFormData({ api: 3 }, 'certificados_api', 'formSubirCertificadoSLB', { callbackAfter: true }, false, () => {
            alertToast('Se han guardado los datos corretamente!', 'success', 4000)
        })
    }, 1)

});


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
