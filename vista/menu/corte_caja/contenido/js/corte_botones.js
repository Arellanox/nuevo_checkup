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
        if (select) {
            await rellenarSelect("#cajas", "corte_caja_api", 2, "ID_CAJAS", "DESCRIPCION", {}, function () { })
        }

        // // Rellenar Select
        // await rellenarSelect("#cajas", "corte_caja_api", 2, "ID_CAJAS", "DESCRIPCION", {}, function () {
        //     switchCajasSelect(false)
        // })

        filename = `${$('#cajas option:selected').text()} | bimo`
        title = `${$('#cajas option:selected').text()} | bimo`

        index_caja_id = $("#cajas").val()

        // Setear la variable de id_caja para mostrar el historial de esa caja
        dataTablaHistorialCortes = {
            api: 2,
            id_caja: index_caja_id
        }

        if (time) {
            fadeDetalleTable("Out")
            TablaHistorialCortes.ajax.reload()
        }

        resolve(1)
    })



}

// ==============================================================================

// ###################### Eventos y Botones #####################################

// ==============================================================================

// Escucha los cambios del select #cajas
$(document).on("change", "#cajas", function (e) {
    switchCajasSelect(true)
})

// Escuchar el evento click del boton para cerrar la caja
$(document).on('click', '#btnCerrarCaja', function (e) {
    // Alerta de confirmación si esta seguro de cerrar la caja
    alertMensajeConfirm({
        title: '¿Estás seguro de que quieres cerrar la caja?',
        text: 'Ten en cuenta que esta acción no se puede revertir',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No cerrar'
    }, () => {
        alertPassConfirm({
            title: "Por favor, ingrese su contraseña para continuar.", icon: "info"
        }, () => {
            // Se manda a llamar a la función para cerrar la caja y se le mandan los argumentos necesarios
            // En este caso es el ID_CORTE de la tabla Historial de corte
            HacerCorteCaja(SelectedHistorialCaja['ID_CORTE'])
        })
    }, 1)
})

// Escuchar el evento click del boton para visualziar el reporte *PDF
$(document).on('click', '#btnVisualizarReporte', function (e) {
    e.preventDefault();

    api = encodeURIComponent(window.btoa('corte'));
    area = encodeURIComponent(window.btoa(-4));
    id_cortes = encodeURIComponent(window.btoa(id_corte));

    console.log(id_cortes)

    var win = window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${id_cortes}&area=${area}`, '_blank')

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
        alertToast('Corte de caja realizado con éxito', 'success', 4000)
    })
}

