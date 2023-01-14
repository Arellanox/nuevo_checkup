tablaContenido = $('#TablaContenidoResultados').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: "55vh",
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaPaciente);
        },
        method: 'POST',
        url: '../../../api/turnos_api.php',
        beforeSend: function () {
            loader("In"), limpiarCampos(), selectListaLab = null;
            loaderDiv("Out", null, "#loader-paciente", '#loaderDivPaciente', 0);
            $('.informacion-paciente').fadeOut()
            estadoFormulario()
        },
        complete: function () {
            loader("Out")
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        switch (areaActiva) {
            case 3: if (data.CONFIRMADO_OFTAL == 1) $(row).addClass('bg-success text-white'); break;
            case 8: if (data.CONFIRMADO_RX == 1) $(row).addClass('bg-success text-white'); break;
            case 11: if (data.CONFIRMADO_ULTRASO == 1) $(row).addClass('bg-success text-white'); break;

            default:
                break;
        }
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO' },
        { data: 'CLIENTE' },
        { data: 'SEGMENTO' },
        { data: 'turno' },
        { data: 'GENERO' },
        { data: 'EXPEDIENTE' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})

$("#inputBuscarTableListaPacientes").keyup(function () {
    tablaContenido.search($(this).val()).draw();
});


selectDatatable('TablaContenidoResultados', tablaContenido, 0, 0, 0, 0, function (selectTR = null, array = null) {
    let datalist = array;

    if (selectTR == 1) {
        dataSelect = new GuardarArreglo({
            select: true,
            nombre_paciente: datalist['NOMBRE_COMPLETO'],
            turno: datalist['ID_TURNO']
        })
        getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', datalist, 'In', async function (divClass) {
            await obtenerPanelInformacion(datalist['ID_PACIENTE'], 'pacientes_api', 'paciente_lab')
            await obtenerPanelInformacion(1, null, 'resultados-areaMaster', '#panel-resultadosMaster')
            await obtenerServicios(areaActiva, datalist['ID_TURNO'])

            //Obtener resultado de cada area 
            estadoFormulario(0) //Activa el formulario
            switch (areaActiva) {
                case 3:
                    if (datalist.CONFIRMADO_OFTAL == 1) estadoFormulario(1)
                    if (selectEstudio.array.length)
                        await obtenerResultadosOftalmo(selectEstudio.array)
                    break;
                case 4:
                    if (datalist.CONFIRMADO == 1) estadoFormulario(1)
                    break;
                case 5:
                    if (datalist.CONFIRMADO == 1) estadoFormulario(1)
                    break;
                case 8: //Rayos X
                    await ObtenerResultadosUltrsonido(selectEstudio.array);
                    if (datalist.CONFIRMADO_RX == 1) estadoFormulario(1)
                    break;
                case 11: //Ultrasonido
                    await ObtenerResultadosUltrsonido(selectEstudio.array);
                    if (datalist.CONFIRMADO_ULTRASO == 1) estadoFormulario(1)
                    break;
                case 10: //Electrocardiograma
                    if (datalist.CONFIRMADO_ELECTRO == 1) estadoFormulario(1)
                    // ObtenerResultadosUltrsonido(selectEstudio.array);
                    break;
                default:
                    botonesResultados('activar');
                    break;
            }



            bugGetPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente')
        })
    } else {
        dataSelect = new GuardarArreglo({
            select: false,
            nombre_paciente: 'Sin paciente',
            turno: 0
        })

        $('#btnResultados').fadeOut('100');
        getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', datalist, 'Out')
    }


    // let dataajax;
    // let url;
    // botonesResultados('desactivar')
    // datalist = array;
    // console.log(datalist)
    // if (selectTR == 1) {
    //     obtenerPanelInformacion(datalist['ID_PACIENTE'], 'pacientes_api', 'paciente')
    //     if (areaActiva == 3) {
    //         url = 'oftalmologia_api';
    //         data = {
    //             turno_id: datalist['ID_TURNO'],
    //             api: 3
    //         }
    //     } else {
    //         data = {
    //             api: 11,
    //             id_turno: datalist['ID_TURNO'],
    //             id_area: areaActiva
    //         }
    //         url = 'servicios_api'
    //     }
    //     $.ajax({
    //         url: http + servidor + "/nuevo_checkup/api/" + url + ".php",
    //         data: data,
    //         type: "POST",
    //         datatype: 'json',
    //         success: function (data) {
    //             data = jQuery.parseJSON(data)
    //             console.log(data);
    //             selectEstudio = new GuardarArreglo(data.response.data);
    //             panelResultadoPaciente(data.response.data);
    //             botonesResultados('activar', areaActiva)
    //         },
    //         complete: function () {

    //         }
    //     })
    // } else {
    //     limpiarCampos()
    // }
})


function limpiarCampos() {
    selectEstudio = new GuardarArreglo();
    botonesResultados('desactivar')
    obtenerPanelInformacion(0, 0, 'paciente')
    obtenerPanelInformacion(0, null, 'resultados-areaMaster', '#panel-resultadosMaster')
    $('#TablaContenidoResultados').removeClass('selected');
}

async function obtenerServicios(area, turno) {
    return new Promise(resolve => {
        if (area == 3) {
            // url = 'oftalmologia_api';
            data = {
                turno_id: turno,
                api: 2
            }
        } else {
            data = {
                api: 3,
                id_turno: turno,
            }
            // url = 'servicios_api'
        }
        $.ajax({
            url: http + servidor + "/nuevo_checkup/api/" + url_api + ".php",
            data: data,
            type: "POST",
            dataType: 'json',
            success: function (data) {
                if (mensajeAjax(data)) {
                    selectEstudio = new GuardarArreglo(data.response.data);
                    let row = [data.response.data];

                    if (row.length)
                        panelResultadoPaciente(row, area);
                    botonesResultados('activar', area)
                }
            },
            complete: function () {
                resolve(1)
            }
        })
    })
}
async function panelResultadoPaciente(row, area) {
    console.log(row)
    let html = '';
    let itemStart = '<div class="accordion-item bg-acordion">';
    let itemEnd = '</div>';

    let bodyStart = '<div class="accordion-body"> <div class="row">';
    let bodyEnd = '</div>  </div>';
    html += '';
    let truehtml = false;

    switch (area) {
        case 3:
            if (row[0].length) {
                for (const i in row) {

                    // console.log(row[i]);
                    html += itemStart;
                    html += '<h2 class="accordion-header" id="collap-historial-estudios' + i + '">' +
                        '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio' + i + '-Target" aria-expanded="false" aria-controls="accordionEstudios">' +
                        '<div class="row">' +
                        '<div class="col-12">' +
                        '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>' + ifnull(row[i][0]['CARGADO_POR']) + '</strong>' +
                        '</div>' +
                        '<div class="col-12">' +
                        '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>' + formatoFecha2(row[i][0]['FECHA_RESULTADO'], [3, 1, 2, 2, 1, 1, 1]) + '</strong> ' + //<strong>12:00 '+i+'</strong>
                        '</div>' +
                        '</div>' +
                        '</button>' +
                        '</h2>' +
                        //Dentro del acordion
                        '<div id="collapse-estudio' + i + '-Target" class="accordion-collapse collapse " aria-labelledby="collap-historial-estudios' + i + '" > '; //overflow-auto style="max-height: 70vh"


                }

                $('#divAreaMasterResultados').fadeIn()
                $('#resultadosServicios-areas').append(html);
            }
            break;

        default:

            for (const i in row) {
                // console.log(row[i]);
                html += itemStart;
                html += '<h2 class="accordion-header" id="collap-historial-estudios' + i + '">' +
                    '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio' + i + '-Target" aria-expanded="false" aria-controls="accordionEstudios">' +
                    '<div class="row">' +
                    '<div class="col-12">' +
                    '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>' + ifnull(row[i][0]['CARGADO_POR']) + '</strong>' +
                    '</div>' +
                    '<div class="col-12">' +
                    '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>' + formatoFecha2(row[i][0]['FECHA_RESULTADO'], [3, 1, 2, 2, 1, 1, 1]) + '</strong> ' + //<strong>12:00 '+i+'</strong>
                    '</div>' +
                    '</div>' +
                    '</button>' +
                    '</h2>' +
                    //Dentro del acordion
                    '<div id="collapse-estudio' + i + '-Target" class="accordion-collapse collapse " aria-labelledby="collap-historial-estudios' + i + '" > '; //overflow-auto style="max-height: 70vh"

                html += bodyStart;
                //Campos existentes
                // html += '<p class="none-p"> <strong>Observaciones: </strong>' +
                //     ifnull(row[i]['OBSERVACIONES']) +
                //     '</p>';
                //
                //Boton de interpretacion
                if (row[i][0]['INTERPRETACION']) {
                    html += '<div class="col-12 d-flex justify-content-center">' +
                        '<a type="button" target="_blank" class="btn btn-borrar me-2" href="' + row[i][0]['INTERPRETACION'] + '" style="margin-bottom:4px">' +
                        '<i class="bi bi-file-earmark-pdf"></i> Interpretación generado' +
                        '</a>' +
                        '</div>';
                    //Busca si existe interpretación o imagen
                    truehtml = true;
                }

                if (row[i][0]['RUTA_REPORTE']) {
                    html += '<div class="col-12 d-flex justify-content-center">' +
                        '<a type="button" target="_blank" class="btn btn-borrar me-2" href="' + row[i][0]['RUTA_REPORTE'] + '" style="margin-bottom:4px">' +
                        '<i class="bi bi-file-earmark-pdf"></i> Interpretación bimo' +
                        '</a>' +
                        '</div>';
                    //Busca si existe interpretación o imagen
                    truehtml = true;
                }
                //Boton de capturas
                // console.log(row[i]['CAPTURAS'])
                // if (row[i]['CAPTURAS'].legnth) {
                //     html += '<div class="col-5 d-flex justify-content-center">' +
                //         '<a type="button" class="btn btn-option me-2" data-bs-toggle="modal" data-bs-target="#CapturasdeArea" style="margin-bottom:4px">' +
                //         '<i class="bi bi-images"></i> Capturas' +
                //         '</a>' +
                //         '</div>';
                // }


                let img = false;
                for (const im in row[i]) {
                    // console.log(row[i][im]['CAPTURAS'])
                    if (row[i][im]['CAPTURAS'].length) img = true;
                }
                if (img) {
                    html += '<div class="col-12 d-flex justify-content-center">' +
                        '<a type="button" class="btn btn-option me-2" data-bs-toggle="modal" data-bs-target="#CapturasdeArea" style="margin-bottom:4px">' +
                        '<i class="bi bi-images"></i> Capturas' +
                        '</a>' +
                        '</div>';
                    //Busca si existe interpretación o imagen
                    truehtml = true;
                }

                console.log(img);
                html += bodyEnd + '</div>';
                html += itemEnd;
            }
            if (truehtml) {
                $('#resultadosServicios-areas').html(html)
                $('#divAreaMasterResultados').fadeIn()
            } else {
                $('#resultadosServicios-areas').html('<div class="alert alert-info" role="alert"> A simple info alert—check it out!</div > ')
            }
            break;
    }

    '<div class="row"><div class="col-12"><i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>Aurora  </strong></div><div class="col-12"><i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>jueves, 29 de dic de 2022 6:15 p.&nbsp;m.</strong> </div></div>'

    // if (row['area_id'] == 3) {
    //     let html = '<hr> <div class="row" style="padding-left: 15px;padding-right: 15px;">' + +
    //         '<p style="padding-bottom: 10px">Of:</p>' + //'+row[i]['SERVICIO']+'
    //         '<div class="col-12 d-flex justify-content-center">' +
    //         '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="' + row['url'] + '" style="margin-bottom:4px" id="btn-analisis-pdf">' +
    //         '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
    //         '</a>' +
    //         '</div>' +
    //         '</div> <hr>';
    //     $('#resultadosServicios-areas').append(html);
    // } else {
    //     for (var i = 0; i < row.length; i++) {
    //         console.log(row)
    //         if (row[i]['INTERPRETACION']) {
    //             let html = '<hr> <div class="row" style="padding-left: 15px;padding-right: 15px;">' +
    //                 '<p style="padding-bottom: 10px">' + row[i]['SERVICIO'] + ':</p>' +
    //                 '<p class="none-p">(' + formatoFecha2(row[i]['FECHA_INTERPRETACION']) + '):<br> ' + row[i]['COMENTARIOS'] + '</p>' +
    //                 '<div class="col-7 d-flex justify-content-center">' +
    //                 '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="' + row[i]['INTERPRETACION'] + '" style="margin-bottom:4px">' +
    //                 '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
    //                 '</a>' +
    //                 '</div>';
    //             if (row[i]['IMAGENES'].length > 0) {
    //                 html += '<div class="col-5 d-flex justify-content-center">' +
    //                     '<button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#CapturasdeArea" style="margin-bottom:4px">' +
    //                     '<i class="bi bi-images"></i> Capturas' +
    //                     '</button>' +
    //                     '</div>';
    //             }
    //             html += '</div> <hr>';
    //             $('#resultadosServicios-areas').append(html);
    //         }
    //     }
    // }

}


//Activa o desactiva los botones de capturas
function botonesResultados(estilo) {
    switch (estilo) {
        case 'desactivar':
            // $('#btn-analisis-pdf').prop('disabled', true)
            $('#btn-capturas-pdf').prop('disabled', true)
            break;
        case 'activar':
            // $('#btn-analisis-pdf').prop('disabled', false)
            $('#btn-capturas-pdf').prop('disabled', false)
            break;
        default:

    }
}

//Desactiva o activa el formulario si ya tiene resultado o si ya ha sido cargada
function estadoFormulario(estado) {
    switch (estado) {
        case 1:
            confirmado = 1;
            $('button[type="submit"][form="' + formulario + '"]').prop('disabled', true)
            $('#' + formulario + '').find('textarea').prop('disabled', true)
            $('#' + formulario + '').find('input').prop('disabled', true)
            break;

        default:
            confirmado = 0;
            $('button[type="submit"][form="' + formulario + '"]').prop('disabled', false)
            $('#' + formulario + '').find('textarea').prop('disabled', false)
            $('#' + formulario + '').find('input').prop('disabled', false)
            break;
    }

}

async function ObtenerResultadosUltrsonido(data) {
    return new Promise(resolve => {
        $('#formulario-estudios').html('')
        let endDiv = '</div>';

        let html = '';

        for (const k in data) {
            // console.log(data[k]);
            let row = data[k];

            //   <a class="aign-items-center rounded collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#board-facturacion'+k+'" aria-expanded="false">
            //     <i class="bi bi-calculator"></i> Facturación
            //   </a>
            //   <div class="collapse" id="board-facturacion'+k+'">
            //     
            //   </div>

            html += '<ul class = "list-group hover-list" style ="margin-top: 5px; margin-bottom: 5px">';
            html += '<a class="dropdown-a rounded collapsed" href="" onClick="return false;" data-bs-toggle="collapse" data-bs-target="#board-facturacion' + k + '" aria-expanded="false"> <div style = "display: block">' + //margin-bottom: 10px; 
                '<div style="border-radius: 8px;margin:0px;background: rgb(0 0 0 / 5%);width: 100%;padding: 10px 0px 10px 0px;text-align: center;"">' +
                '<h4 style="font-size: 20px !important;font-weight: 600 !important;padding: 0px;margin: 0px;">' + row['SERVICIO'] + '</h4> <!-- <p> </p> --> </div></div> </a>';

            html += '<div class="collapse" id="board-facturacion' + k + '">';
            //Cada textarea
            html += cargarForm('Técnica', row['ID_SERVICIO'], 'tecnica', row['TECNICA']);
            html += cargarForm('Hallazgos', row['ID_SERVICIO'], 'hallazgo', row['HALLAZGO']);
            html += cargarForm('Diagnóstico', row['ID_SERVICIO'], 'interpretacion', row['INTERPRETACION_DETALLE']);
            html += cargarForm('Comentario', row['ID_SERVICIO'], 'comentario', row['COMENTARIO']);
            // html += '<div class="d-flex justify-content-center"><div style="padding-top: 15px;">' +
            //     '<p style = "/* font-size: 18px; */" > Observaciones:</p>' +
            //     '<textarea name="observacionesServicios[ID_SERVICIO]" rows="2;" cols="90" class="input-form" value=""></textarea></div ></div > ';
            html += '</ul>';
            html += endDiv;
        }

        $('#formulario-estudios').html(html)
        autosize(document.querySelectorAll('textarea'))
        resolve(1)
    })
}

//Actualiza los texareas
$('#' + formulario).click(function () {
    autosize.update(document.querySelectorAll('textarea'));
})

function cargarForm(campo, id, campoAjax, texto) {
    let colStart = '<div class="col-auto col-lg-12">';
    let colreStart = '<div class="col-auto col-lg-12 d-flex justify-content-end align-items-center">';
    let endDiv = '</div>';
    html = '';
    html += '<li class="list-group-item">';
    html += '<div class="row d-flex align-items-center">';

    html += colStart;
    html += '<p><i class="bi bi-box-arrow-in-right" style=""></i> ' + campo + ' </p>';
    html += endDiv;
    html += colreStart;
    html += '<div class="input-group">';
    html += '<textarea type="text" class="form-control input-form inputFormRequired" name="servicios[' + id + '][' + campoAjax + ']" autocomplete="off">' + ifnull(texto) + '</textarea>';
    html += '</div>';
    html += endDiv;

    html += endDiv;
    html += '</li>';
    return html;
}

async function obtenerResultadosOftalmo(data) {
    let row = data[0]
    $('#antecedentes_personales').val(row.ANTECEDENTES_PERSONALES);
    $('#antecedentes_oftalmologicos').val(row.ANTECEDENTES_OFTALMOLOGICOS);
    $('#padecimiento_actual').val(row.PADECIMIENTO_ACTUAL);
    $('#agudeza_visual').val(row.AGUDEZA_VISUAL_SIN_CORRECCION);
    $('#od').val(row.OD);
    $('#oi').val(row.OI);
    $('#jaeger').val(row.JAEGER);
    $('#refraccion').val(row.REFRACCION);
    $('#prueba').val(row.PRUEBA);
    $('#exploracion_oftalmologica').val(row.EXPLORACION_OFTALMOLOGICA);
    $('#forias').val(row.FORIAS);
    $('#campimetria').val(row.CAMPIMETRIA);
    $('#presion_intraocular_od').val(row.PRESION_INTRAOCULAR_OD);
    $('#presion_intraocular_oi').val(row.PRESION_INTRAOCULAR_OI);
    $('#diagnostico').val(row.DIAGNOSTICO);
    $('#plan').val(row.PLAN);
    $('#observaciones').val(row.OBSERVACIONES);
}