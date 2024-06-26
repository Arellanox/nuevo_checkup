var checkFactorCorrecion;

ListaEnfriadoresActiva = false;
// $(document).on("submit", '#EquiposTemperaturasForm', async function (e) {
//     e.preventDefault();
//     // $('#btn-equipo-temperatura').fadeOut('slow')
//     alertToast('Espere un momento...', 'info', 3000);


// })

async function switchEquipoSelect(time) {
    alertToast('Espere un momento...', 'info', 3000);

    buildPageTemperatura(time)

}

$(document).on('change', '#Equipos', function (e) {
    e.preventDefault()

    ListaEnfriadoresActiva = false;
    $("#Termometro").html("")
    $("#formCapturarTemperatura").trigger("reset")

    fadeMenuTemperatura('Out')

    setTimeout(() => {
        switchEquipoSelect(true)
    }, 200);


})



async function buildPageTemperatura(time = false) {
    return new Promise(function (resolve, reject) {
        $("#Tabla-termometro").html('')
        $("#Tabla-equipos").html('')
        console.log($("#Equipos").val())
        id_equipos = $("#Equipos").val()
        selectedText = $("#Equipos option:selected").text();
        DataEquipo = {
            api: 2,
            Enfriador: id_equipos,
            Descripcion: selectedText
        }
        LoadTermometros(id_equipos, 'Termometro');

        $('#Enfriador').val(id_equipos)
        $("#formCapturarTemperatura").trigger("reset")
        ListaEnfriadoresActiva = true;
        fadeMenuTemperatura('In')


        if (time) {
            tablaTemperaturaFolio.ajax.reload()
        }

        resolve(1);
    })
}

function fadeMenuTemperatura(type) {
    if (type == 'Out') {
        $("#Equipos_Termometros").fadeOut('slow');
        $('#LibererDiaTemperatura').fadeOut('slow');
        $('#btn-lock').removeClass('bi bi-unlock-fill')
        $('#btn-lock').addClass('bi bi-lock-fill')
        // $('#btn-equipo-temperatura').removeClass('disable-element')
        $("#lista-meses-temperatura").fadeOut('slow');
        $(".grafica-temperatura").fadeOut('slow');
        $('#btn-desbloquear-equipos').addClass('disable-element')
        // $('#CapturarTemperaturabtn').addClass('disable-element');
        // $("#SupervisorConfiguracion").fadeOut('slow')
        // $('#btn-equipo-temperatura').fadeIn('slow')
        // $('#btn-desbloquear-equipos').fadeOut('slow')
        // $('#Equipos').removeClass('disable-element')
    } else if (type == 'In') {
        $('#LibererDiaTemperatura').fadeIn('slow');
        // $('#Equipos').addClass('disable-element')
        // $('#btn-equipo-temperatura').addClass('disable-element')
        // $("#SupervisorConfiguracion").fadeIn('slow')
        $('#btn-lock').removeClass('bi bi-lock-fill')
        $('#btn-lock').addClass('bi bi-unlock-fill')
        // $('#btn-desbloquear-equipos').removeClass('disable-element')
    }
}

function LoadTermometros(id_equipos, input) {
    $(`#${input}`).html("")

    ajaxAwait({
        api: 1,
        id_equipo: id_equipos,
        id_tipos_equipos: 5
    }, 'equipos_api', { callbackAfter: true }, false, (data) => {
        selectedEquipos = data.response.data;
        selectedEquipos.forEach(e => {
            $(`#${input}`).val(e['TERMOMETRO_ID']);
            Termometro = e['TERMOMETRO_ID'];
        });
    })

}

// Checa si requiere o no aplicar el factor de correcion
$(document).on('change', '#checkFactorCorrecion', function () {
    var switchState = $(this).is(':checked');
    if (switchState) {
        checkFactorCorrecion = 1;
    } else {
        checkFactorCorrecion = 0;
    }

});


//Funcion para agregar o actualizar temperaturas
function CargarTemperatura() {

    alertMensajeConfirm({
        title: `¿Deseas capturar la temperatura?`,
        text: "Recuerde usar el simbolo negativo (-) si es necesario, para su correcta captura",
        icon: "info"
    }, function () {
        let dataJson = {
            api: 1,
            Enfriador: DataEquipo['Enfriador'],
            checkFactorCorrecion: checkFactorCorrecion
        }

        form = ""
        text = ""
        switch (editRegistro) {
            case true:
                //esta actualizando nueva temperatura
                dataJson["id_registro_temperatura"] = selectRegistro['ID_REGISTRO_TEMPERATURA']
                form = "formActualizarTemperatura"
                text = "Registro actualizado correctamente"

                break;
            case false:
                //esta registrando una nueva temperatura
                form = "formCapturarTemperatura"
                text = "Registro realizado correctamente"
                break;
            default:
                //no esta ni registrando ni actualizando
                return false;
                break;
        }

        ajaxAwaitFormData(dataJson, 'temperatura_api', form, { callbackAfter: true }, false, function (data) {
            alertToast(text, 'success', 4000)
            $("#grafica").html("");
            CrearTablaPuntos(DataMes['FOLIO']);
            CrearEncabezadoEquipos(DataMes['FOLIO']);

            $('#formCapturarTemperatura').trigger("reset");
            $('#formActualizarTemperatura').trigger("reset");
            $("#formActualizarTemperatura").addClass('disable-element');
            // resetFirma(firma_actualizar.ctx, firma_actualizar.canvas);
            // resetFirma(firma_guardar.ctx, firma_guardar.canvas);
            // firmaExist = false
            if (selectTableFolio) {
                // Si entro
                tablaTemperatura.ajax.reload()
            } else {
                // No entro
                tablaTemperaturaFolio.ajax.reload()
            }

            if (ListaEnfriadoresActiva) {
                LoadTermometros(DataEquipo.Enfriador);
            }

            // editRegistro == true ? $('#detallesTemperaturaModal').modal('hide') : $('#CapturarTemperaturaModal').modal('hide')
        })
    }, 1)
}

id_registro_dor = false
$(document).on('click', '.td-hover', async function (event) {
    event.preventDefault();
    event.stopPropagation();

    session.permisos.SupTemp == 0 ? $("#formAgregarComentario").addClass("disable-element") : $("#formAgregarComentario").removeClass("disable-element")

    let dot = $(this)
    id_registro_dor = dot.attr('data_id')

    $("#formAgregarComentario").trigger("reset")

    alertToast('Cargando comentarios, espere un momento', 'success', 4000)

    await mostrarComentariosDiaTemperatura()
    //Abre el modal
    $('#modalComentariosRegistro').modal('show')

})

$(document).on('submit', '#formAgregarComentario', (event) => {
    event.preventDefault();
    alertMensajeConfirm({
        title: '¿Está seguro de agregar este comentario?',
        text: 'No podrás actualizarlo',
        icon: 'info'
    }, function () {
        ajaxAwaitFormData({
            api: 8,
            id_registro_temperatura: id_registro_dor
        }, 'temperatura_api', 'formAgregarComentario', { callbackAfter: true }, false, (data) => {
            agregarNota({
                CREADO_POR: '',
                ID_REGISTRO_TEMPERATURA: 1,
                COMENTARIO: '',
                FECHA: '',
            }, '#content-comentarios-registros')
            alertToast('Comentario Agregado', 'success', 4000)
            mostrarComentariosDiaTemperatura();
            $("#formAgregarComentario").trigger("reset")
        })
    }, 1)
})

$(document).on("click", ".comentario-eliminar", function (event) {
    event.preventDefault();

    let dot = $(this)
    id_comentario = dot.attr('data-cm-id')


    alertMensajeConfirm({
        title: '¿Está seguro de eliminar este comentario?',
        text: 'No podrás revertirlo',
        icon: 'info'
    }, function () {
        ajaxAwait({
            api: 10,
            id_comentario: id_comentario
        }, 'temperatura_api', { callbackAfter: true }, false, (response) => {
            alertToast('Comentario Eliminado', 'success', 4000)
            mostrarComentariosDiaTemperatura();
        })

    }, 1)

})

//Muestra los comentarios
function mostrarComentariosDiaTemperatura() {
    return new Promise(function (resolve, reject) {
        //Recupera los comentarios
        ajaxAwait({
            api: 9,
            id_registro_temperatura: id_registro_dor
        }, 'temperatura_api', { callbackAfter: true, WithoutResponseData: true }, false, (row) => {
            let div = $('#content-comentarios-registros')
            div.html('');
            for (const key in row) {
                if (Object.hasOwnProperty.call(row, key)) {
                    const element = row[key];
                    // formatoFecha2(element['FECHA'], [0, 1, 3, 0]).toUpperCase();
                    // formatoFecha2(element['FECHA'], [0, 1, 5, 2, 1, 1, 1])
                    $("#fecha_comentario").html(formatoFecha2(element['FECHA'], [3, 1, 3, 1, 1, 1, 1]).toUpperCase())
                    agregarNota(element, '#content-comentarios-registros')
                }
            }



            resolve(1);
        })

    })


}

function agregarNota(element = [], div) {
    if (element['COMENTARIO'] == null) {
        html = ""
    } else {
        html = `<div class="card m-3 p-3">
                    <div class="row">
                     <p>${formatoFecha2(element['FECHA_COMENTARIO'], [0, 1, 5, 2, 1, 1, 1])}</p>
                        <div class="col-10">
                            <h5>${element['CREADO_POR']}</h5>
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-hover comentario-eliminar" data-cm-id="${element['ID_TEMPERATURA_COMENTARIOS']}" data-bs-id="${element['ID_REGISTRO_TEMPERATURA']}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>
                    </div>
                    <p>${element['COMENTARIO']}</p>
                </div>
                    `;

    }


    $(div).append(html);
}

$(document).on("click", "#ConfiguracionTemperaturasbtn", async function () {
    alertToast('Cargando Configuración...', 'info', 2000)


    $("#matutino_inicio").val("")
    $("#matutino_final").val("")
    $("#vespertino_inicio").val("")
    $("#vespertino_final").val("")
    $('#Domingos').prop('checked', false)
    await CargarConfiguracionTemperaturas()


    $('#offcanvasConfiguracionTemperaturas').offcanvas('show');
})

$(document).on("click", '#btn-configuracion-temperatura', function (e) {
    e.preventDefault();

    switchState = $('#Domingos').is(':checked');

    alertMensajeConfirm({
        title: 'Esta seguro de cambiar la configuración',
        text: '',
        icon: 'info',
        confirmButtonText: "Si"
        // denyButtonText: "No",
        // showDenyButton: true
    }, () => {
        ajaxAwaitFormData({
            api: 12,
            domingos: domingos
        }, 'temperatura_api', 'ConfiguracionTemperaturaForm', { callbackAfter: true }, false, (data) => {
            alertToast('Configuración Actualizada', 'success', 1000)

            $('#offcanvasConfiguracionTemperaturas').offcanvas('hide');
        })

    }, 1)


})

var domingos;
// Escuchar los cambios en el switch
$(document).on('change', '#Domingos', function () {
    var switchState = $(this).is(':checked');
    if (switchState) {
        domingos = 1
        // $('#factor_coreccion').collapse('show');
    } else {
        domingos = 0
        // $('#factor_coreccion').collapse('hide');
    }
});

$(document).on('click', '#DomingosbtnTemperaturas', function (e) {
    e.preventDefault();

    CargarConfiguracionTemperaturas()

    Domingos = parseInt(dataConfig['DOMINGOS']) == 0 ? true : false;




    var config = {
        title: null,
        text: null,
        text2: null,
        action: null
    }
    switch (Domingos) {
        case true:
            config = {
                title: '¿Desea deshabilitar los días domingos?',
                text: 'Se deshabilitaran los días domingos ',
                text2: 'Domingos deshabilitado',
                action: 0
            }
            break;
        case false:
            config = {
                title: '¿Desea activar los días domingos?',
                text: 'Se activarán los días domingos ',
                text2: 'Domingos habilitado',
                action: 1
            }
            break;
        default:
            title = title
            text = text
            break;
    }

    alertMensajeConfirm({
        title: config.title,
        text: config.text,
        icon: 'info',
        confirmButtonText: "Si"
        // denyButtonText: "No",
        // showDenyButton: true
    }, () => {
        ajaxAwait({
            api: 12,
            domingos: config.action
        }, 'temperatura_api', { callbackAfter: true }, false, () => {
            alertToast(config.text2, 'success', 4000)
        })

        // alertToast('Domingo deshabilitado', 'success ', 1000)
        // console.log("le dio que si el we")
    }, 1)


})


$(document).on("click", '#TurnosbtnTemperaturas', function (e) {
    $("#TurnosTemperaturasModal").modal("show");
})

async function CargarConfiguracionTemperaturas() {
    return await ajaxAwait({
        api: 11,
    }, 'temperatura_api', { callbackAfter: true, WithoutResponseData: true }, false, (row) => {
        console.log(3)

        for (const key in row) {
            if (Object.hasOwnProperty.call(row, key)) {
                const element = row[key];
                dataConfig = element
                Domingos_bit = ifnull(parseInt(dataConfig['DOMINGOS']), 0)
                domingos = Domingos_bit;

                if (Domingos_bit == 1) {
                    // true
                    $('#Domingos').prop('checked', true)
                } else {
                    // False    
                    $('#Domingos').prop('checked', false)
                }


                $("#matutino_inicio").val(dataConfig['MATUTINO_INICIO'].split(':')[0] + ':' + dataConfig['MATUTINO_INICIO'].split(':')[1])
                $("#matutino_final").val(dataConfig['MATUTINO_FINAL'].split(':')[0] + ':' + dataConfig['MATUTINO_FINAL'].split(':')[1])
                $("#vespertino_inicio").val(dataConfig['VESPERTINO_INICIO'].split(':')[0] + ':' + dataConfig['VESPERTINO_INICIO'].split(':')[1])
                $("#vespertino_final").val(dataConfig['VESPERTINO_FINAL'].split(':')[0] + ':' + dataConfig['VESPERTINO_FINAL'].split(':')[1])
            }
        }
    })
}

async function CrearEncabezadoEquipos(folio) {
    return await ajaxAwait({
        api: 7,
        folio: folio
    }, 'temperatura_api', { callbackAfter: true, WithoutResponseData: true }, false, async (row) => {
        $("#Tabla-termometro").html('');
        $("#Tabla-equipos").html('');
        // console.log(row['EQUIPO'])
        await rellenarInformacionEquipos([{
            title: 'Equipo',
            Description: `${row['EQUIPO']['EQUIPO_NOMBRE']}`
        }, {
            title: 'Marca',
            Description: `${row['EQUIPO']['EQUIPO_MARCA']}`
        }, {
            title: 'Modelo',
            Description: `${row['EQUIPO']['EQUIPO_MODELO']}`,
        }, {
            title: 'N° Serie',
            Description: `${row['EQUIPO']['EQUIPO_NUMERO_SERIE']}`
        }, {
            title: 'Localización',
            Description: `${row['EQUIPO']['LOCALIZACION']}`
        }, {
            title: 'Intervalo óptimo',
            Description: `${row['EQUIPO']['INTERVALO_MIN']} A ${row['EQUIPO']['INTERVALO_MAX']} °C`
        }], 'col-6', 'Tabla-equipos', 'Equipo');

        await rellenarInformacionEquipos([{
            title: 'Marca',
            Description: `${row['EQUIPO']['TERMOMETRO_MARCA']}`
        }, {
            title: 'ID',
            Description: `${row['EQUIPO']['TERMOMETRO_ID']}`
        }, {
            title: 'Factor de corrección',
            Description: `${row['EQUIPO']['FACTOR_CORRECCION']}`,
        }, {
            title: 'Fecha de verificacion',
            Description: `${row['EQUIPO']['FECHA_VERIFICACION']}`
        }, {
            title: 'MES',
            Description: `${row['EQUIPO']['MES']}`
        }, {
            title: 'AÑO',
            Description: `${row['EQUIPO']['ANHO']}`
        }], 'col-6', 'Tabla-termometro', 'Termómetro');
    })






}

async function rellenarInformacionEquipos(data = [], col, elementId, title) {
    return new Promise(function (resolve, reject) {
        let html = `<div class='row'>
        <p class="text-center mb-2">${title}</p>`

        for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
                const element = data[key];

                html += `
                <div class="${col}">
                    <strong>${element['title']}:</strong>
                    ${ifnull(element['Description'], 'N/A')}
                </div>
                `;
            }
        }
        html += `</div>`

        $(`#${elementId}`).html(html)
        resolve(1)
    })
}



