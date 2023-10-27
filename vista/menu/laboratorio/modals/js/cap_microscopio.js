$(document).on('click', '#btn-capturas-microscopio', async function (event) {
    event.preventDefault();

    // await getCapturas();

    $('#modalCapturasMicroscopio').modal('show');

})


async function getCapturas() {
    return new Promise(async function (resolve, reject) {
        await ajaxAwait({}, 'api', { callbackBefore: true }, false, () => {



            // Retorna que esta listo
            resolve(1)
        })

    })
}