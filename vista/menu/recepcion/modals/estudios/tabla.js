$(document).on('click', '#EstudiosInfo', function (e) {
    e.preventDefault();
    e.stopPropagation();

    $('#modalEstudiosInformacion').modal('show');
})





// let rows_estudios = []
// let buscar_estudio = 0;
// $('#FormEstudioBuscar').submit(function (e) {
//     e.preventDefault();
//
//     // Crear un delay de carga de datos
//     if (buscar_estudio) {
//         alertToast('Cargando datos previos', 'info', 4000)
//     } else {
//         buscar_estudio = 1;
//
//         // buscar datos
//         ajaxAwaitFormData({api: 15}, 'recepcion_api', 'FormEstudioBuscar', { callbackAfter: true }, false, (data) => {
//             buscar_estudio = 0;
//             rows_estudios = data.response.data;
//
//             const html = rows_estudios.map(row => {
//                 return `<div class="idEstudiosView"
//                             data-id_servicio="${row.ID_SERVICIO}"
//                              style="background: rgba(0,78,89,0.78); color: #ffffff; border-radius: 10px; margin-top: 10px;
//                              margin-bottom: 10px; padding: 10px; cursor: pointer">
//                             <span class="estudios_encontrados">
//                                   ${row.DESCRIPCION}</span>
//                             <br>
//                         </div>`;
//             }).join(' ');
//
//             if (html !== '') {
//                 $(`#${'suggestionsListEstudios'}`).html(html);
//                 $(`#${'listEstudios'}`)
//                     .removeClass('d-none')
//                     .addClass('animate__animated animate__fadeIn');
//             } else {
//                 $(`#${'listEstudios'}`).addClass('d-none');
//             }
//         })
//     }
// })


let buscar_estudio = 0;
let rows_estudios = [];
let debounceTimer = null;
let currentRequest = null; // Para cancelar peticiones previas

$('#FormEstudioBuscar input[name="estudio"]').on('input', function () {
    const query = $(this).val().trim();

    // Si está vacío, limpiar y ocultar resultados
    if (query.length === 0) {
        $('#suggestionsListEstudios').empty();
        $('#listEstudios').addClass('d-none');
        return;
    }

    // Limpiar debounce anterior
    clearTimeout(debounceTimer);

    // Crear nuevo debounce (ej. 400ms)
    debounceTimer = setTimeout(() => {
        // Cancelar petición previa si aún no termina
        if (currentRequest && typeof currentRequest.abort === 'function') {
            currentRequest.abort();
        }

        if (buscar_estudio) {
            alertToast('Cargando datos previos', 'info', 2000);
            return;
        }

        buscar_estudio = 1;

        // 🔹 Envolver ajaxAwaitFormData para poder abortar
        currentRequest = ajaxAwaitFormData(
            { api: 15, q: query }, // puedes enviar el query al backend
            'recepcion_api',
            'FormEstudioBuscar',
            { callbackAfter: true },
            false,
            (data) => {
                buscar_estudio = 0;
                rows_estudios = data.response.data;

                const html = rows_estudios.map(row => `
                    <div class="idEstudiosView"
                        data-id_servicio="${row.ID_SERVICIO}"
                        style="background: rgba(0,78,89,0.78); color: #ffffff; border-radius: 10px;
                               margin-top: 10px; margin-bottom: 10px; padding: 16px; cursor: pointer">
                        <span class="estudios_encontrados">${row.DESCRIPCION}</span>
                    </div>
                `).join(' ');

                if (html !== '') {
                    $('#suggestionsListEstudios').html(html);
                    $('#listEstudios')
                        .removeClass('d-none')
                        .addClass('animate__animated animate__fadeIn');
                } else {
                    $('#listEstudios').addClass('d-none');
                }
            }
        );
    }, 400); // ⏱ Espera 400ms después del último input
});


// Añadir listener de clic a las coincidencias
$(document).on('click', '.idEstudiosView', async function (e) {
    e.preventDefault();
    e.stopPropagation();
    // Texto Element
    $span = $(this);

    // ID del seervicio
    $id_servicio = $span.attr('data-id_servicio')
    const info_estudio = rows_estudios.find(element => element.ID_SERVICIO === $id_servicio);

    setInformation(info_estudio)


    const subEstudios = await new Promise((resolve, reject) => {
        $.ajax({
            url: http + servidor + "/" + appname + "/api/laboratorio_solicitud_maquila_api.php",
            type: "POST",
            dataType: 'json',
            data: { api: 12, ID_GRUPO_SERVICIO: $id_servicio },
            success: function (data) {
                if (data && data.response?.data) {
                    const datos = data.response.data;
                    const html = datos.map(d => htmlLI2(d["NOMBRE_ESTUDIO"] ?? "Estudio Individual")).join('');
                    resolve(html);
                } else {
                    resolve('');
                }
            },
            error: reject
        });
    });

    loadDetailsGroup(subEstudios);
});

function loadDetailsGroup (datos) {
    $('#lista_grupos').html(datos);
}


function htmlLI2(texto) {
    return '<li class="list-group-item" style="background: #ffffff; color: rgba(0,78,89,0.7); border-radius: 5px; border: 1px solid #bcbcbc; padding: 4px">' + texto + '</li>';
}

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