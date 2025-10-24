$(document).on('click', '#EstudiosInfo', function (e) {
    e.preventDefault();
    e.stopPropagation();

    // Reiniciar modal
    // resetModal();
    // Abrir modal
    $('#modalEstudiosInformacion').modal('show');
})





let rows_estudios = []
let buscar_estudio = 0;
$('#FormEstudioBuscar').submit(function (e) {
    e.preventDefault();

    // Crear un delay de carga de datos
    if (buscar_estudio) {
        alertToast('Cargando datos previos', 'info', 4000)
    } else {
        buscar_estudio = 1;

        // buscar datos
        ajaxAwaitFormData({api: 15}, 'recepcion_api', 'FormEstudioBuscar', { callbackAfter: true }, false, (data) => {
            buscar_estudio = 0;
            rows_estudios = data.response.data;

            const html = rows_estudios.map(row => {
                return `<span class="estudios_encontrados btn-pantone-7541 p-1 d-inline-block m-1" data-id_servicio="${row.ID_SERVICIO}">${row.DESCRIPCION}</span> <br>`;
            }).join(' ');

            if (html !== '') {
                $(`#${'suggestionsListEstudios'}`).html(html);
                $(`#${'listEstudios'}`)
                    .removeClass('d-none')
                    .addClass('animate__animated animate__fadeIn');
            } else {
                $(`#${'listEstudios'}`).addClass('d-none');
            }
        })
    }
})



// Añadir listener de clic a las coincidencias
$(document).on('click', '.estudios_encontrados', function (e) {
    e.preventDefault();
    e.stopPropagation();
    // Texto Element
    $span = $(this);

    // ID del seervicio
    $id_servicio = $span.attr('data-id_servicio')
    const info_estudio = rows_estudios.find(element => element.ID_SERVICIO === $id_servicio);

    // console.log($id_servicio, info_estudio)
    setInformation(info_estudio)
});




// -------------------
//  FUNCIONES
// -------------------

function resetModal() {

    $('#info_estudios-search').fadeOut();
    $('#info_estudios-search').html(html_estudios_info)

    // Reinicia levensteins

    // Reiniciar inputs

    // Reiniciar html
}

function setInformation(datosServicio) {
    // console.log(datosServicio)
    // Ingresar información del estudio por los elementos
    // Asignación de datos a los elementos por ID usando un ciclo
    $.each(datosServicio, function (clave, valor) {
        const idElemento = `#InfoModal_${clave}`;
        let textoMostrar = valor;

        // Convierte valores específicos como '1' y '0' a 'Sí' y 'No'
        if (valor === "1") textoMostrar = "Sí";
        else if (valor === "0") textoMostrar = "No";
        else if (valor === null) textoMostrar = "N/A"; // Para valores nulos

        $(idElemento).html(textoMostrar);
    });

    $('#info_estudios-search').fadeIn();
}


// -------------------
//  adicionales
// -------------------

select2("#select-Areas", "modalEstudiosInformacion", 'Seleccione un estudio');
rellenarSelect('#select-Areas', 'areas_api', 2, 'ID_AREA', 'DESCRIPCION')