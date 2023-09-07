const modalCapturaOdios = document.getElementById('modalCapturaOdios')

// modalCapturaOdios.addEventListener('shown.bs.modal', () => {

//Subir captura del oido izquierdo
InputDragDrop('#dropOidoIzquierdo', (inputArea, salidaInput) => {

    envioCapturaOidos('subirCapturaOidoIzquierdo')

    salidaInput();

})

//Subir captura del oido derecho
InputDragDrop('#dropOidoDerecho', (inputArea, salidaInput) => {

    envioCapturaOidos('subirCapturaOidoDerecho')
    salidaInput();
})

// })

function envioCapturaOidos(formAudiometria) {

    ajaxAwaitFormData({ api: 3, tuno_id: 38 },
        'audiometria_api', formAudiometria, { callbackAfter: true }, false, function () {

            // labelArea.html('Se ha subido su archivo')
            // divCarga.css({ 'display': 'none' })

            salidaInput();
        })

}