// ==============================================================================

// ###################### BUILDPAGE #############################################

// ==============================================================================

// Funcion para llamar a la funcion de contruir la pagina se reciben 2 parametros
// Si quiere actualizar toda la pagina incluido el select se manda 2 veces true
// Si solo quiere actualizar las tablas solo se manda true una vez
async function switchCajasSelect(time, select = false) {
    alertToast('Espere un momento...', 'info', 3000);

    await buildPageCajas(time, select)
}

// Function para construir la pagina principal
async function buildPageCajas(time, select) {
    return new Promise(async function (resolve, reject) {
        index_caja_id = $("#cajas").val()

        // Setear la variable de id_caja para mostrar el historial de esa caja
        dataTablaHistorialCortes = {
            api: 2,
            id_caja: index_caja_id
        }

        if (time) {
            TablaHistorialCortes.ajax.reload()
        }

        if (select) {
            await rellenarSelect("#cajas", "corte_caja_api", 2, "ID_CAJAS", "DESCRIPCION", {}, function () { })
        }

        resolve(1)
    })



}

// ==============================================================================

// ###################### Eventos y Botones #####################################

// ==============================================================================

// Escucha los cambios del select #cajas
$(document).on("change", "#cajas", function (e) {
    setTimeout(() => {
        switchCajasSelect(true)
    }, 200);
})

// Escuchar el evento click del boton para cerrar la caja
$(document).on('click', '#btnCerrarCaja', function (e) {
    // Alerta de confirmación si esta seguro de cerrar la caja
    alertMensajeConfirm({
        title: '¿Estas seguro de cerrar la caja?',
        text: 'No podra revertir los cambios',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No'
    }, () => {
        // Se manda a llamar a la función para cerrar la caja y se le mandan los argumentos necesarios
        // En este caso es el ID_CORTE de la tabla Historial de corte
        HacerCorteCaja(SelectedHistorialCaja['ID_CORTE'])
    }, 1)
})

// Escuchar el evento click del boton para visualziar el reporte *PDF
$(document).on('click', '#btnVisualizarReporte', function (e) {
    e.preventDefault();

    api = encodeURIComponent(window.btoa('corte'));
    area = encodeURIComponent(window.btoa(-4));
    id_corte = encodeURIComponent(window.btoa(SelectedHistorialCaja['ID_CORTE']));

    var win = window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${id_corte}&area=${area}`, '_blank')

    win.focus();
})

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================

// Function para cerrar una caja
function HacerCorteCaja(id_corte) {
    ajaxAwait({
        api: 10,
        id_corte: id_corte
    }, 'corte_caja_api', { callbackAfter: true }, false, async (data) => {
        await switchCajasSelect(true)
        alertToast('Corte de caja realizado con exito', 'success', 4000)
    })
}

