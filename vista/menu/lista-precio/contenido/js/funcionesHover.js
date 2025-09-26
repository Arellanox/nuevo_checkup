$(document).ready(function () {
    var refSelectEstudios = document.querySelector('#select2-seleccion-estudio-container');
    var tooltip = document.querySelector('#tooltip');

    popperHover(refSelectEstudios, tooltip, function (event) {
        if (event) {
            PopEstudiosList('#seleccion-estudio', popSelectEstudios);
        }
        console.log(2)
        console.log(popSelectEstudios)
    })

    $("#check-editar").on("click", function (e) {
        if ($("input[type=radio][name=selectPaquete]:checked").val() === 2) {
            let el = document.getElementById('#select2-seleccion-estudio-container');
            let newEl = el.cloneNode(true); // true = copia también hijos
            el.parentNode.replaceChild(newEl, el);

            let el2 = document.getElementById('#tooltip');
            let newEl2 = el.cloneNode(true); // true = copia también hijos
            el2.parentNode.replaceChild(newEl2, el2);

            popSelectEstudios = [];

            popperHover(refSelectEstudios, tooltip, function (event) {
                if (event) {
                    PopEstudiosList('#seleccion-estudio', popSelectEstudios);
                }
                console.log(1)
                console.log(popSelectEstudios)
            })
        }
    })

    function PopEstudiosList(select, estudioData) {
        let dataJSON = {
            api: 16
        }

        let id = $(select).prop('selectedIndex');

        parseInt(estudioData[id]['ES_GRUPO']) ? dataJSON['id_grupo'] = estudioData[id]['ID_SERVICIO'] : dataJSON['id_servicio'] = estudioData[id]['ID_SERVICIO'];
        ajaxAwait(dataJSON, "servicios_api", { callbackAfter: true, callbackBefore: true }, function () {
            //Antes de llamar
            //vaciar la lista de estudios
            $('#container-label').fadeIn(0);
            $('#container-estudios').fadeOut(0);
            $('#container-grupos').fadeOut(0);

            $('#listaContenidoEstudios').html('')
            $('#listContenidoGrupos').html('')
        }, function (data) {
            //Despues de llamar
            $('#listaContenidoEstudios').html('')
            $('#listContenidoGrupos').html('')
            let row = data.response.data
            let grupo = false;
            let servicio = false;
            for (const key in row) {
                if (Object.hasOwnProperty.call(row, key)) {
                    const element = row[key];
                    if (element['ES_GRUPO'] == 0) {
                        $('#listaContenidoEstudios').append(`<li class="list-group-item">${element['DESCRIPCION']}</li>`)
                        servicio = true;
                    } else {
                        $('#listContenidoGrupos').append(`<li class="list-group-item">${element['DESCRIPCION']}</li>`)
                        grupo = true;
                    }
                }
            }

            $('#container-label').fadeOut(0);
            if (servicio) $('#container-estudios').fadeIn(0);
            if (grupo) $('#container-grupos').fadeIn(0);
        })
    }

});