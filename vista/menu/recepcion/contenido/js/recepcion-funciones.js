/**
 * Función que se ejecuta al hacer click en un botón con clase btn-aceptar
 * @param {Object} data - Información del paciente seleccionado
 */
function onIngresarPaciente(data) {
    if (data != null) {
        array_selected = data // Almacena la información del paciente seleccionado en una variable global
        $("#modalPacienteAceptar").modal('show');  // Abre el modal para aceptar al paciente
    } else alertSelectTable(); // Muestra un mensaje para seleccionar un paciente
}

async function precargarEstudiosCotizacion(numCotizacion) {
    alertToast('cargando estudios...', 'info', 5000);

    if (numCotizacion == null || numCotizacion == '' || parseInt(numCotizacion) <= 0 || isNaN(parseInt(numCotizacion)))
    {
        alertMensaje(
            'warning', 'No ha ingresado el número de la cotización.',
            'No se puede precargar los estudios de la cotización.'
        );
        return;
    }

    numCotizacion = await obtenerCotizacionIdByFolio(numCotizacion);

    if (numCotizacion !== null) {
        limpiarEstudios();
        limpiarFormAceptar();

        await ajaxAwait({api: 2, id_cotizacion: numCotizacion}, 'cotizaciones_api', {callbackAfter: true}, false,
            (content) => {
                const response = content.response.data;
                const servicios = response[0]?.DETALLE;

                if (
                    !response || !Array.isArray(response) || response.length === 0 ||
                    !servicios || !Array.isArray(servicios) || servicios.length === 0
                ) {
                    alertMensaje('warning', 'No se encontraron estudios para la cotización seleccionada.', 'No se puede precargar los estudios de la cotización.');
                    return;
                }

                servicios?.forEach(estudio => {
                    if (estudio.AREA_ID.toString() == "12") { // Biomolecular
                        actualizarPrecioYAgregar(estudio, estudiosLabBio, "#list-estudios-laboratorio-biomolecular");
                    } else if (estudio.AREA_ID.toString() == "6") { // Clinico
                        actualizarPrecioYAgregar(estudio, estudiosLab, "#list-estudios-laboratorio", true);
                    } else if (estudio.AREA_ID.toString() == "8") { // Rayos X
                        actualizarPrecioYAgregar(estudio, estudiosRX, "#list-estudios-rx");
                    } else if (estudio.AREA_ID.toString() == "11") { // Ultrasonido
                        actualizarPrecioYAgregar(estudio, estudiosUltra, "#list-estudios-ultrasonido");
                    } else { // Otros
                        actualizarPrecioYAgregar(estudio, estudiosOtros, "#list-estudios-otros");
                    }
                });

                alertToast('Estudios precargados correctamente.', 'success', 4000);
            });
    }
}

function actualizarPrecioYAgregar(estudio, lista, selector, extra = false) {
    let label = estudio.PRODUCTO;

    lista.forEach(item => {
        if (item.ID_SERVICIO === estudio.ID_SERVICIO) {
            estudio.PRECIO_VENTA = estudio.SUBTOTAL; // Agregamos el campo PRECIO_VENTA
            item.PRECIO_VENTA = estudio.SUBTOTAL; // Campo PRECIO_VENTA requerido para el cálculo
            label = item.ABREVIATURA + ' - ' + item.SERVICIO;
        }
    });

    cargarEstudiosDiv(estudio.ID_SERVICIO, lista, label, selector, extra);

    detallesEstudiosCotizacion.push(estudio);
}


function cargarEstudiosDiv(id, estudios, text, div, validar = false) {
    if (validar) validarEstudiosLab = 1;

    actualizarTotal(id, estudios, true)
    agregarFilaDiv(div, text, id)
}

async function obtenerCotizacionIdByFolio(folio) {
    let idCotizacion = null;

    await ajaxAwait({api: 8, id_cotizacion: folio}, 'cotizaciones_api', {callbackAfter: true}, false, (content) => {
        if (!content.response.data || !Array.isArray(content.response.data) || content.response.data.length === 0) {
            alertMensaje('warning', 'No se encontraron cotizaciones.', 'No se puede precargar los estudios de la cotización.');
            return null;
        }

        idCotizacion = content.response.data?.[0].ID_COTIZACION;
    });

    return idCotizacion;
}

function limpiarEstudios() {
    // estudiosLabBio = [];
    // estudiosLab = [];
    // estudiosRX = [];
    // estudiosUltra = [];
    // estudiosOtros = [];

    $("#list-estudios-laboratorio").empty();
    $("#list-estudios-rx").empty();
    $("#list-estudios-ultrasonido").empty();
    $("#list-estudios-otros").empty();
}