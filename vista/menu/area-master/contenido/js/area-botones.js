$('#fechaListadoAreaMaster').change(function () {
    recargarVistaLab();
})

$('#fechaFinalListadoAreaMaster').change(function () {
    recargarVistaLab();
})

$('#checkDiaAnalisis').click(function () {
    if ($(this).is(':checked')) {
        recargarVistaLab(0)
        $('#fechaListadoAreaMaster').prop('disabled', true)
        $('#fechaFinalListadoAreaMaster').prop('disabled', true)
    } else {
        recargarVistaLab();
        $('#fechaListadoAreaMaster').prop('disabled', false)
        $('#fechaFinalListadoAreaMaster').prop('disabled', false)
    }
})

function recargarVistaLab(fecha = 1) {
    dataListaPaciente = {
        api: 5,
        area_id: areaActiva
    }

    if (fecha) {
        dataListaPaciente['fecha_busqueda'] = $('#fechaListadoAreaMaster').val();
        dataListaPaciente['fecha_busqueda_final'] = $('#fechaFinalListadoAreaMaster').val();
    }

    tablaContenido.ajax.reload()
}


$("#btn-analisis-pdf").click(function () {
    if (dataSelect.array['select']) {
        chooseEstudio(selectEstudio.array, '#ModalSubirInterpretacion', 1)
    } else {
        alertSelectTable();
    }
});

$(document).on('click', '#btn-captura-inbody', function (e) {
    if (dataSelect.array) {
        $('#ModalInterpretacionInbody').modal('show');
    } else {
        alertSelectTable();
    }
})

$(document).on('click', '#btn-modalView-nutricion', function (e) {
    if (dataSelect.array) {
        $('#ModalViewInbody').modal('show');
    } else {
        alertSelectTable();
    }
})

$(document).on('click', '#btn-modalView', function (e) {
    if (dataSelect.array) {
        pdf_view = $(this).attr('url');
        $('#ModalView').modal('show');
    } else {
        alertSelectTable();
    }
})


$(document).on('click', '#btn-capturas-pdf', function () {
    if (dataSelect.array['select']) {
        switch (areaActiva) {
            case 10:
                $('#MostrarCapturasElectro').modal('show');
                break;
            case 13:
                servicio_nombre = 'Citología'; // <--Nombrar la ventana
                $("#ModalSubirCapturas").modal("show");
                break;
            //Captura Genericas
            case 9:
            case 18:
                servicio_nombre = $(this).attr('servicio'); // <--Nombrar la ventana
                $('#ModalSubirCapturas').modal('show');
                break;
            default:
                chooseEstudio(selectEstudio.array, '#ModalSubirCapturas', 2)
                break;
        }
    } else {
        alertSelectTable();
    }
})

$('#btn-analisis-oftalmo').click(function () {
    if (dataSelect.array['select']) {
        $("#ModalSubirInterpretacionOftalmologia").modal("show");
    } else {
        alertSelectTable();
    }
})

$('#abrirModalResultados').click(function () {
    autosize(document.querySelectorAll('textarea'))
    setTimeout(() => {
        autosize.update(document.querySelectorAll('textarea'));
    }, 200);
    $('#modalSubirInterpretacion').modal('show')
})

//BTN PARA SUBIR LOS DATOS DE ESPIROMETRIA 

$('#btn-resultados-espiro-pdf').click(function () {
    $('#ModalSubirResultadosEspiro').modal('show');
})

$('#btn-resultados-audi-pdf').click(function () {
    $('#ModalSubirResultadosAudio').modal('show');
})


$('#btn-ver-reporte').click(function () {
    switch (areaActiva) {
        case 3:
        case '3':
            area_nombre = 'oftalmo'
            break;
        case 8:
        case 11:
        case '8':
        case '11':
            area_nombre = 'imagenologia'
            break;
        case 10:
        case '10':
            area_nombre = 'electro'
            break;
        case 5:
        case '5':
            area_nombre = 'espiro'
            break;
        case 4:
        case '4':
            area_nombre = 'audiometria'
            break;
        default:
            break;
    }

    api = encodeURIComponent(window.btoa(area_nombre));
    turno = encodeURIComponent(window.btoa(dataSelect.array['turno']));
    area = encodeURIComponent(window.btoa(areaActiva));


    window.open(`${http}${servidor}/${appname}/visualizar_reporte/?api=${api}&turno=${turno}&area=${area}`, "_blank");
})

function chooseEstudio(row, modal, tip) {
    let html = '';

    try {
        switch (tip) {
            case 1:
                return false
                for (var i = 0; i < row.length; i++) {
                    if (row[i]['INTERPRETACION'] == null) {
                        html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(` + row[i]['ID_SERVICIO'] + `, '` + modal + `')" type="button">` + row[i]['SERVICIO'] + `</button>`;
                    }
                }
                if (html) {
                    Swal.fire({
                        html: '<h4>Seleccione el estudio a guardar</h4>' +
                            '<div class="d-grid gap-2">' + html + '</div>',
                        showCloseButton: true,
                        showConfirmButton: false,
                    });
                } else {
                    alertSelectTable('Se han guardado todas sus interpretaciones')
                }
                break;
            case 2:
                for (var i = 0; i < row.length; i++) {
                    try {
                        if (row[i]['CAPTURAS'].length == 0) {
                            html += `<button class="btn btn-cancelar" onClick = "estudioSeleccionado(` + row[i]['ID_SERVICIO'] + `, '` + modal + `', '` + row[i]['SERVICIO'] + `')" type="button">` + row[i]['SERVICIO'] + `</button>`;
                        }
                    } catch (error) {
                        // alertMensaje('error', 'Oops...', 'Hubo un error con las capturas, intentelo mas tarde', 'Reporte este mensaje a la area de TI : )')
                    }
                }
                if (html) {
                    Swal.fire({
                        html: '<h4>Seleccione el estudio a capturar</h4>' +
                            '<div class="d-grid gap-2">' + html + '</div>',
                        showCloseButton: true,
                        showConfirmButton: false,
                    });
                } else {
                    alertSelectTable('Se han guardado todas sus capturas', 'success')
                }
                break;
            default:
        }
    } catch (error) {
        alertToast('Area no compatible', 'error', 4000)
        return false
    }

}

function estudioSeleccionado(id, modal, serv) {
    selectEstudio.selectID = id;
    Swal.close();
    servicio_nombre = serv;
    $(modal).modal("show");
}


$('#reporte_equipo').on('change', function (event) {
    let file = event.target.files[0];

    if (file.type === 'application/pdf') {
        let reader = new FileReader();
        reader.onload = function (ev) {
            let pdfData = new Uint8Array(ev.target.result);
            pdfjsLib.getDocument({data: pdfData}).promise.then(function (pdf) {
                pdf.getPage(1).then(function (page) {
                    let viewport = page.getViewport({scale: 2});
                    let canvas = document.createElement('canvas');
                    let ctx = canvas.getContext('2d');
                    canvas.width = viewport.width;
                    canvas.height = viewport.height;

                    let renderTask = page.render({
                        canvasContext: ctx,
                        viewport: viewport
                    });

                    renderTask.promise.then(function () {
                        $('#viewer').html('<img id="pdfImage" src="' + canvas.toDataURL() + '">');
                        cropper = new Cropper(document.getElementById('pdfImage'), {
                            viewMode: 1,
                            dragMode: 'move',
                            aspectRatio: NaN, // libre
                            restore: false,
                            ready: function () {
                                // Establecer el tamaño y posición del cropBox según los porcentajes predeterminados
                                setCropBoxByPercentage(defaultCropBoxPercentages);
                            }
                            // ready: function () {
                            //   // Definir en automatico donde quieres que capture el usuario las tablas
                            //   let cropBoxData = {
                            //     height: 300,
                            //     left: 394.63131313131316,
                            //     top: 127,
                            //     width: 452
                            //   };
                            //   cropper.setCropBoxData(cropBoxData);
                            // },
                            // cropmove: function () {
                            //   let cropBoxData = cropper.getCropBoxData();
                            //   let containerData = cropper.getContainerData();
                            //   let percentages = calculatePercentageValues(cropBoxData, containerData);
                            //   console.log('Porcentajes:', percentages);
                            // }
                        });
                    });
                });
            });
        };
        reader.readAsArrayBuffer(file);
    } else if (['image/jpeg', 'image/png'].includes(file.type)) {
        let reader = new FileReader();
        reader.onload = function (e) {
            $('#viewer').html('<img id="uploadedImage" src="' + e.target.result + '">');
            cropper = new Cropper(document.getElementById('uploadedImage'), {
                viewMode: 1,
                dragMode: 'move',
                aspectRatio: NaN, // libre
                restore: false
            });
        };
        reader.readAsDataURL(file);
    }
});

$('#capture').on('click', function () {
    if (cropper) {
        let canvas = cropper.getCroppedCanvas();
        let croppedImage = canvas.toDataURL('image/png');

        let imageContainer = $('<div>', {class: 'position-relative d-inline-block m-2'});

        let img = $('<img>', {
            src: croppedImage,
            class: 'img-thumbnail lightbox-image'  // Estilo de Bootstrap
        });

        let deleteButton = $('<button>', {
            class: 'btn btn-danger btn-sm position-absolute top-0 end-0',
            style: 'translate(48%, -21%);',  // Posicionar en la esquina superior derecha
            html: '<i class="bi-trash"></i>',  // Icono de Bootstrap Icons
            click: function () {
                $(this).closest('div').remove();  // Borrar el contenedor de la imagen
            }
        });

        imageContainer.append(img, deleteButton);
        $('#captures').append(imageContainer);

        // Para enviar la imagen a través de AJAX como archivo:
        // let blob = dataURLtoBlob(croppedImage);
        // let formData = new FormData();
        // formData.append('croppedImage', blob, 'cropped.png');

        // Aqui se pondra la funcion para cerrar el modal de capturar la tabla y volver abrir el modal de interpretacion

        CapturarTablaModalConfig("hide");

        // Ejemplo de AJAX con jQuery para enviar el archivo
        // $.ajax({
        //   url: '/tu_endpoint',  // Ruta a la cual deseas enviar el archivo
        //   method: 'POST',
        //   data: formData,
        //   processData: false,
        //   contentType: false,
        //   success: function (response) {
        //     console.log('Imagen enviada y guardada!', response);
        //   },
        //   error: function (error) {
        //     console.error('Error al guardar la imagen', error);
        //   }
        // });
    }
});

// Convertir DataURL a Blob para poder enviarlo como archivo
function dataURLtoBlob(dataurl) {
    var arr = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new Blob([u8arr], {type: mime});
}

// Para saber posicion exacta (sin uso)
function calculatePercentageValues(cropBoxData, containerData) {
    let widthPercentage = cropBoxData.width / containerData.width;
    let heightPercentage = cropBoxData.height / containerData.height;
    let leftPercentage = cropBoxData.left / containerData.width;
    let topPercentage = cropBoxData.top / containerData.height;

    return {
        width: widthPercentage,
        height: heightPercentage,
        left: leftPercentage,
        top: topPercentage
    };
}


// Darle por defecto una posicion
function setCropBoxByPercentage(percentageValues) {
    let containerData = cropper.getContainerData();
    let cropBoxData = {
        left: containerData.width * percentageValues.left,
        top: containerData.height * percentageValues.top,
        width: containerData.width * percentageValues.width,
        height: containerData.height * percentageValues.height
    };
    cropper.setCropBoxData(cropBoxData);
}

// Si windows se recalcula, este mantiene por defecto el recuadro
$(window).resize(function () {
    if (cropper) {
        // Reajustar el cropBox al redimensionar
        setCropBoxByPercentage(defaultCropBoxPercentages);
    }
});