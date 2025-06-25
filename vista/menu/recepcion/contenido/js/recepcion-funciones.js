var checkbox = document.getElementById('checkCotizacionAceptar');
var btnCotizacion = document.getElementById('btnCotizacion');
var input = document.getElementById('input-cotizacion');

function toggleCotizacionInput() {
    if (checkbox.checked) {
        input.disabled = true;
        btnCotizacion.style.display = 'none'; // Oculta el botón
        limpiarEstudiosCotizacion();
    } else {
        input.disabled = false;
        btnCotizacion.disabled = false;
        btnCotizacion.style.display = 'block';
    }
}

checkbox?.addEventListener('change', toggleCotizacionInput);
btnCotizacion?.addEventListener('click', async (e) => {
    e.preventDefault();
    
    try {
        const valor = input.value;
        btnCotizacion.disabled = true;
        await precargarEstudiosCotizacion(valor);
    } catch (error) {
        alertToast('Error durante la precarga de estudios, contacte al administrador.', 'error', 5000);
    } finally {
        setTimeout(() => {
            btnCotizacion.disabled = false;
        }, 800);
    }
});

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
        limpiarEstudiosCotizacion();

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

                console.log("Servicios: ", servicios)

                alertToast('Estudios precargados correctamente.', 'success', 4000);
            });
    }

    console.log("Cotizacion: " + numCotizacion)
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

function actualizarPrecioYAgregar(estudio, lista, selector, extra = false) {
    let label = estudio.PRODUCTO;

    lista.forEach(item => {
        if (item.ID_SERVICIO === estudio.ID_SERVICIO) {
            estudio.PRECIO_VENTA = estudio.SUBTOTAL; // Agregamos el campo PRECIO_VENTA
            item.PRECIO_VENTA = estudio.SUBTOTAL; // Campo PRECIO_VENTA requerido para el cálculo
            label = item.ABREVIATURA + ' - ' + item.SERVICIO;
        }
    });

    console.log("Cargando estudio: " + estudio.ID_SERVICIO + " - " + estudio.PRODUCTO);
    cargarEstudiosDiv(estudio.ID_SERVICIO, lista, label, selector, extra);
    detallesEstudiosCotizacion.push(estudio);
}

function cargarEstudiosDiv(id, estudios, text, div, validar = false) {
    if (validar) validarEstudiosLab = 1;
    console.log("Actualizando estudio precio: " + id + " - " + text);
    actualizarTotal(id, estudios, true)
    agregarFilaDiv(div, text, id)
}

function limpiarEstudiosCotizacion() {
    console.log("Limpiando estudios cotizacion")
    console.log(detallesEstudiosCotizacion);

    detallesEstudiosCotizacion.map((item) => {
        eliminarElementoArray(item.ID_SERVICIO)
    })

    detallesEstudiosCotizacion = [];

    $("#list-estudios-laboratorio").empty();
    $("#list-estudios-rx").empty();
    $("#list-estudios-ultrasonido").empty();
    $("#list-estudios-otros").empty();

    limpiarFormAceptar();
}