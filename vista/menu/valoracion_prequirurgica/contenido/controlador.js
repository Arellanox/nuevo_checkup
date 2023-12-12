
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

// Variables a enviar para la tabla
const area = 1; // area
const cliente = 31; // cliente


async function ObtenerBody() {
    await obtenerTitulo('Valoración prequirúrgica'); //Aqui mandar el nombre de la area
    $.post("contenido/contenido.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {
        estadoFormulario(estado)
        // Datatable    
        $.getScript("contenido/js/tablas.js").done(function (data) {
            // variable a enviar para que la tabla recupere los datos
            createJsonObject(1);
        });
    });
}

// function para crear el json para la tabla de TablaPacientesPrequirurgica
function createJsonObject(type) {

    // sacamos la fecha actual de la sesion
    let fecha = $('#fechaListadoAreaMaster').val();  // fecha actual de la sesion

    // aqui guardaremos el JSON para la tabla de TablaPacientesPrequirurgicas
    var data;

    if (type === 1) {
        data = {
            api: 1,
            fecha_busqueda: fecha,
            area_id: area,
            cliente_id: cliente
        }
    } else if (type === 2) {
        data = {
            api: 1,
            area_id: area,
            cliente_id: cliente
        }
    }

    // seteamos la variable global DataPrequirurgico con la data
    DataPrequirurgico = data;

    // hacemos un ajax reload a la tabla para aplicar los cambios
    TablaPacientesPrequirurgica.ajax.reload()

    // regresamos el JSON
    return data;
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


