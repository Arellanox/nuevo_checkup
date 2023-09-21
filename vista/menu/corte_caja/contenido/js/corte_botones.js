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

// Escucha los cambios del select #cajas
$(document).on("change", "#cajas", function () {
    setTimeout(() => {
        switchCajasSelect(true)
    }, 200);
})


$(document).on('click', '#btnCerrarCaja', function () {
    alertMensajeConfirm({
        title: '¿Estas seguro de cerrar la caja?',
        text: 'No podra revertir los cambios',
        icon: 'warning',
        confirmButtonText: 'Si, estoy seguro',
        cancelButtonText: 'No'
    }, () => {
        // console.log("si cerro la caja")
        HacerCorteCaja(SelectedHistorialCaja['ID_CORTE'])
    }, 1)
})

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