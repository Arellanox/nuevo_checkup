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
    columns: [
        // {
        //   data: 'EDAD', render: function(){
        //     return '';
        //   }
        // },
        {
            data: 'COUNT'
        },
        {
            data: 'NOMBRE_COMPLETO'
        },
        {
            data: 'PREFOLIO',
            render: function (data, type, full, meta) {
                return "20221014JMC412";
            },
        },
        {
            data: 'EDAD'
        },
        {
            data: 'EDAD'
        },
        {
            data: 'GENERO'
        },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        // { width: "5%", title: "#", targets: 0 },
        // { title: "Nombre", targets: 1 },
        // { title: "Prefolio", targets: 2 },
        // { title: "Costo", targets: 3 },
        // { title: "Procedencia", targets: 4},
        // { title: "Edad", targets: 5 },
        // { title: "Sexo", targets: 6 }
    ]
    // columnDefs: [
    //   { "width": "10px", "targets": 0 },
    // ],

})

$("#inputBuscarTableListaPacientes").keyup(function () {
    tablaContenido.search($(this).val()).draw();
});


selectDatatable('TablaContenidoResultados', tablaContenido, 0, 0, 0, 0, function (selectTR = null, array = null) {
    selectPacienteArea = array;
    if (selectTR == 1) {
        getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', selectPacienteArea, 'In', async function (divClass) {
            await obtenerPanelInformacion(selectPacienteArea['ID_PACIENTE'], 'pacientes_api', 'paciente_lab')
            await obtenerPanelInformacion(1, null, 'resultados-areaMaster', '#panel-resultadosMaster')
            await obtenerServicios(areaActiva)

            //Obtener resultado de cada area 
            switch (areaActiva) {
                case 3:
                    if (selectPacienteArea.CONFIRMADO == 1) estadoFormulario(1)
                    await obtenerResultadosOftalmo(selectPacienteArea['ID_TURNO'])
                    break;
                case 4:
                    if (selectPacienteArea.CONFIRMADO == 1) estadoFormulario(1)
                    break;
                case 5:
                    if (selectPacienteArea.CONFIRMADO == 1) estadoFormulario(1)
                    break;
                case 7:
                    if (selectPacienteArea.CONFIRMADO == 1) estadoFormulario(1)
                    break;
                case 8:
                    if (selectPacienteArea.CONFIRMADO == 1) estadoFormulario(1)
                    break;
                default:
                    botonesResultados('activar');

                    break;
            }




            if (selectPacienteArea.CONFIRMADO == 1) {
                estadoFormulario(0)
            } else {
                $('button[type="submit"][form="' + formulario + '"]').prop('disabled', false)
                $('#' + formulario + ' :input').prop('disabled', false)
            }


            bugGetPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente')
        })
    } else {
        $('#btnResultados').fadeOut('100');
        getPanel('.informacion-paciente', '#loader-paciente', '#loaderDivPaciente', selectPacienteArea, 'Out')
    }


    // let dataajax;
    // let url;
    // botonesResultados('desactivar')
    // selectPacienteArea = array;
    // console.log(selectPacienteArea)
    // if (selectTR == 1) {
    //     obtenerPanelInformacion(selectPacienteArea['ID_PACIENTE'], 'pacientes_api', 'paciente')
    //     if (areaActiva == 3) {
    //         url = 'oftalmologia_api';
    //         data = {
    //             turno_id: selectPacienteArea['ID_TURNO'],
    //             api: 3
    //         }
    //     } else {
    //         data = {
    //             api: 11,
    //             id_turno: selectPacienteArea['ID_TURNO'],
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

async function obtenerServicios(area) {
    if (area == 3) {
        url = 'oftalmologia_api';
        data = {
            turno_id: selectPacienteArea['ID_TURNO'],
            api: 3
        }
    } else {
        data = {
            api: 11,
            id_turno: selectPacienteArea['ID_TURNO'],
            id_area: area
        }
        url = 'servicios_api'
    }
    $.ajax({
        url: http + servidor + "/nuevo_checkup/api/" + url + ".php",
        data: data,
        type: "POST",
        datatype: 'json',
        success: function (data) {
            data = jQuery.parseJSON(data)
            console.log(data);
            selectEstudio = new GuardarArreglo(data.response.data);
            panelResultadoPaciente(data.response.data);
            botonesResultados('activar', area)
        },
        complete: function () {

        }
    })
}
async function panelResultadoPaciente(row, area = areaActiva) {
    console.log(row)
    let html = '';
    switch (row['area_id']) {
        case 3:
            html += '<hr> <div class="row" style="padding-left: 15px;padding-right: 15px;">' +
                '<p style="padding-bottom: 10px">Of:</p>' + //'+row[i]['SERVICIO']+'
                '<div class="col-12 d-flex justify-content-center">' +
                '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="' + row['url'] + '" style="margin-bottom:4px" id="btn-analisis-pdf">' +
                '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
                '</a>' +
                '</div>' +
                '</div> <hr>';
            $('#resultadosServicios-areas').append(html);
            break;

        default:
            let itemStart = '<div class="accordion-item bg-acordion">';
            let itemEnd = '</div>';

            let bodyStart = '<div class="accordion-body">' +
                '<div class="row">';
            let bodyEnd = '</div>' +
                '</div>';
            html += '';

            for (var i = 0; i < row.length; i++) {
                html += itemStart;
                html += '<h2 class="accordion-header" id="collap-historial-estudios' + i + '">' +
                    '<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-estudio' + i + '-Target" aria-expanded="false" aria-controls="accordionEstudios">' +
                    '<div class="row">' +
                    '<div class="col-12">' +
                    '<i class="bi bi-box-seam"></i> &nbsp;&nbsp;&nbsp; Cargado: <strong>' + row[i]['NOMBRE_COMPLETO'] + '</strong>' +
                    '</div>' +
                    '<div class="col-12">' +
                    '<i class="bi bi-calendar3"></i> &nbsp;&nbsp;&nbsp; Fecha: <strong>' + formatoFecha2(row[i]['FECHA_CONFIRMADO']) + '</strong> ' + //<strong>12:00 '+i+'</strong>
                    '</div>' +
                    '</div>' +
                    '</button>' +
                    '</h2>' +
                    //Dentro del acordion
                    '<div id="collapse-estudio' + i + '-Target" class="accordion-collapse collapse overflow-auto" aria-labelledby="collap-historial-estudios' + i + '" style="max-height: 70vh"> ';

                html += bodyStart;
                //Campos existentes
                html += '<p class="none-p"> <strong>Observaciones: </strong>' +
                    '*COMENTARIO*' +
                    '</p>';
                //
                //Boton de interpretacion
                if (true) {
                    html += '<div class="col-7 d-flex justify-content-center">' +
                        '<a type="button" target="_blank" class="btn btn-borrar me-2" href="' + row[i]['INTERPRETACION'] + '" style="margin-bottom:4px">' +
                        '<i class="bi bi-file-earmark-pdf"></i> Interpretación' +
                        '</a>' +
                        '</div>';
                }
                //Boton de capturas
                if (true) {
                    html += '<div class="col-5 d-flex justify-content-center">' +
                        '<a type="button" class="btn btn-option me-2" data-bs-toggle="modal" data-bs-target="#CapturasdeArea" style="margin-bottom:4px">' +
                        '<i class="bi bi-images"></i> Capturas' +
                        '</a>' +
                        '</div>';
                }


                html += bodyEnd + '</div>';
                html += itemEnd;
            }
            $('#resultadosServicios-areas').html(html);
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
            $('button[type="submit"][form="' + formulario + '"]').prop('disabled', true)
            $('#' + formulario + '').find('textarea').prop('disabled', true)
            $('#' + formulario + '').find('input').prop('disabled', true)
            break;

        default:
            $('button[type="submit"][form="' + formulario + '"]').prop('disabled', false)
            $('#' + formulario + '').find('textarea').prop('disabled', false)
            $('#' + formulario + '').find('input').prop('disabled', false)
            break;
    }

}

async function obtenerResultadosOftalmo(id) {
    return new Promise(resolve => {
        $.ajax({
            url: http + servidor + "/nuevo_checkup/api/oftalmologia_api.php",
            data: {
                api: 2,
                id_turno: id
            },
            type: "POST",
            dataType: 'json',
            success: function (data) {
                console.log(data);
                let row = data.response.data[0];
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

                // botonesResultados('activar', areaActiva)
            },
            complete: function () {
                resolve(1);
            }
        })
    });
}