
// if (validarVista('REGISTRO_TEMPERATURA')) {
//     hasLocation();
//     $(window).on("hashchange", function (e) {
//         hasLocation();
//     });
// }

hasLocation();
$(window).on("hashchange", function (e) {
    hasLocation();
});

// Variables Globales
let DataPrequirurgico, TablaPacientesPrequirurgica; // varibale para la tabla de TablaPacientesPrequirurgica
let estado

async function ObtenerBody() {
    await obtenerTitulo('Valoración prequirúrgica'); //Aqui mandar el nombre de la area
    $.post("contenido/contenido.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {

        // Variables a enviar para la tabla
        const fecha = $('#fechaListadoAreaMaster').val(); // fecha actual de la sesion
        const area = 1; // area
        const cliente = 31; // cliente

        // variable a enviar para que la tabla recupere los datos
        DataPrequirurgico = {
            api: 1,
            fecha_busqueda: fecha,
            area_id: area,
            cliente_id: cliente
        }
        estadoFormulario(estado)
        // Datatable
        $.getScript("contenido/js/tablas.js");
    });
}


function hasLocation() {
    var hash = window.location.hash.substring(1);
    $("a").removeClass("navlinkactive");
    $("nav li a[href='#" + hash + "']").addClass("navlinkactive");
    switch (hash) {

        case '':
            ObtenerBody();
            break;
        default:
            // window.location.hash = '#';
            break;
    }
}

// Reinicia el formulario de interpretación
function limpiarForm(form) {
    document.getElementById(form).reset()
    $(`#${form} div.collapse`).collapse('hide'); // Oculta de nuevo todos los collapse
}

// Cambia y muestra los botones del formulario
function estadoFormulario(estado) {
    switch (estado) {
        case 1:
            $('#btn-vistaPrevia').fadeIn()
            $('#btn-confirmarReporte').fadeIn()
            $('#btn-guardarInterpretacion').fadeIn()
            break;

        case 2:
            $('#btn-confirmarReporte').fadeOut()
            $('#btn-guardarInterpretacion').fadeOut()
            // $('#formInterpretacion').prop('disabled', true);
            break;

        default:
            $('#btn-vistaPrevia').fadeOut()
            $('#btn-confirmarReporte').fadeOut()
            break;
    }
}


