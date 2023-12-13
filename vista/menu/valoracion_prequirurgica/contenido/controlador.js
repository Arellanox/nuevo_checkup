
if (validarVista('PREQUIRURGICO')) {
    ObtenerBody();
}

// Variables Globales
let DataPrequirurgico, TablaPacientesPrequirurgica, tablalistRecomendaciones; // varibale para la tabla de TablaPacientesPrequirurgica
let estado
let arrayPaciente // Trae los datos del paciente
let dataRegistro // Trae la interpretacion que se haya guardado

// Variables a enviar para la tabla
const area = 1; // area
const cliente = 31; // cliente


async function ObtenerBody() {
    await obtenerTitulo('Valoración prequirúrgica'); //Aqui mandar el nombre de la area
    $.post("contenido/contenido.php", function (html) {
        $("#body-js").html(html);
    }).done(async function () {
        estadoFormulario(estado)
        // variable a enviar para que la tabla recupere los datos
        createJsonObject(1, false);
        // Datatable    
        $.getScript("contenido/js/tablas.js").done(function (data) {

        });
    });
}

// function para crear el json para la tabla de TablaPacientesPrequirurgica
function createJsonObject(type, tabla = true) {

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

    if (tabla) {
        // hacemos un ajax reload a la tabla para aplicar los cambios
        TablaPacientesPrequirurgica.ajax.reload()
    }

    // regresamos el JSON
    return data;
}


// Reinicia el formulario de interpretación
function limpiarForm(form) {
    document.getElementById(form).reset()
    $(`#${form} div.collapse`).collapse('hide'); // Oculta de nuevo todos los collapse
}

// Cambia y muestra los botones del formulario
function estadoFormulario(guardado, confirmado) {
    let $vista_previa = $('#btn-vistaPrevia') // Boton de vista previa de pdf
    let $confirmar_rept = $('#btn-confirmarReporte') // Boton de confirmar reporte
    let $guardar_inter = $('#btn-guardarInterpretacion') // Boton de guardar interpretación

    // Resetea los botones para colocar el estado apropiado
    $('.btn_interpretacion_modal').prop('disabled', false)

    if (guardado == 0 && confirmado == 0) {
        // Estado cuando no tiene nada de datos
        $vista_previa.fadeOut()
        $confirmar_rept.fadeOut()
    } else if (guardado == 1 && confirmado == 0) {
        // Estado cuando solo esta guardado
        $('.btn_interpretacion_modal').fadeIn() // Recupera/Visualiza todo
    } else {
        // Estado cuando Esta confirmado
        $confirmar_rept.prop('disabled', true)
        $guardar_inter.prop('disabled', true)

    }
}


