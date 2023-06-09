tablaSignos = $('#TablaSignos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 330),
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaPaciente);
        },
        method: 'POST',
        url: '../../../api/turnos_api.php',
        beforeSend: function () { loader("In") },
        complete: function () {
            loader("Out")
            loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos', 0);
            $('.informacion-Signos').fadeOut()
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.CONFIRMADO_SOMA == 1) {
            $(row).addClass('bg-success text-white');
        }
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'PREFOLIO' },
        { data: 'CLIENTE' },
        { data: 'EDAD' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { "width": "10px", "targets": 0 },
    ],

})

loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos');
selectTable('#TablaSignos', tablaSignos, { unSelect: true }, (selectTR, array) => {
    // selectDatatable('TablaSignos', tablaSignos, 0, 0, 0, 0, function (selectTR = null, array = null) {
    selectListaSignos = array;
    // console.log(selectListaSignos)
    if (selectTR == 1) {
        //   if (selectListaSignos.MUESTRA_TOMADA == 1) {
        //     $('#muestra-tomado').prop('disabled', true)
        //     $('#omitir-paciente').prop('disabled', true)
        //   }else {
        //     $('#muestra-tomado').prop('disabled', false)
        //     $('#omitir-paciente').prop('disabled', false)
        //   }
        getPanel('.informacion-Signos', '#loader-Signos', '#loaderDivSignos', selectListaSignos, 'In', async function (divClass) {
            await obtenerPanelInformacion(selectListaSignos['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')
            await obtenerResultadosSignos(selectListaSignos['ID_TURNO'])
            loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos');
            // console.log(divClass)
            $(divClass).fadeIn(100);
        });
    } else {
        getPanel('.informacion-Signos', '#loader-Signos', '#loaderDivSignos', selectListaSignos, 'Out')
    }
})

inputBusquedaTable('TablaSignos', tablaSignos, [{
    msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
    place: 'top'
}], [], 'col-12')

async function obtenerResultadosSignos(id) {
    return new Promise(resolve => {
        $.ajax({
            url: http + servidor + "/nuevo_checkup/api/somatometria_api.php",
            dataType: 'json',
            method: 'POST',
            data: { id_turno: id, api: 2 },
            success: function (data) {
                if (mensajeAjax(data)) {
                    let row = data.response.data;
                    if (Object.keys(row).length > 2) {
                        bloquearBotones(1)
                        $('#frecuenciaCardiaca').val(row['FRECUENCIA CARDIACA']['VALOR'])
                        $('#frecuenciaRespiratoria').val(row['FRECUENCIA RESPIRATORIA']['VALOR'])
                        $('#sistolica').val(row['SISTOLICA']['VALOR'])
                        $('#diastolica').val(row['DIASTOLICA']['VALOR'])
                        $('#saturacionOxigeno').val(row['SATURACION DE OXIGENO']['VALOR'])
                        $('#temperatura').val(row['TEMPERATURA']['VALOR'])
                        $('#estatura').val(row['ESTATURA']['VALOR'])
                        $('#peso').val(row['PESO']['VALOR'])
                        $('#masaCorporal').val(row['MASA CORPORAL']['VALOR'])
                        $('#masaMuscular').val(row['MASA MUSCULAR']['VALOR'])
                        $('#porcentajeGrasaVisceral').val(row['PORCENTAJE DE GRASA VISCERAL']['VALOR'])
                        $('#huesos').val(row['HUESOS']['VALOR'])
                        $('#metabolismo').val(row['METABOLISMO']['VALOR'])
                        $('#edadCuerpo').val(row['EDAD DEL CUERPO']['VALOR'])
                        $('#perimetroCefalico').val(row['PERIMETRO CEFALICO']['VALOR'])
                        $('#porcentajeProteinas').val(row['PORCENTAJE DE PROTEINAS']['VALOR'])
                        $('#porcentajeAgua').val(row['PORCENTAJE DE AGUA']['VALOR'])
                        $('#sistolica').val(row['SISTOLICA']['VALOR'])
                        if (row['RUTA_REPORTE']) {
                            $('#button_reporte').html('<a type="button" target="_blank" class="btn btn-borrar me-2" href="' + row['RUTA_REPORTE'] + '" style="margin-bottom:4px">' +
                                '<i class="bi bi-file-earmark-pdf"></i>' +
                                '</a>');
                        } else {
                            $('#button_reporte').html('');
                        }
                    } else {
                        bloquearBotones(2)
                    }
                }
            },
            complete: function () {
                resolve(1);
            }
        })
    })
}

function bloquearBotones(val) {
    switch (val) {
        case 1:
            // $('#omitir-paciente').prop('disabled', true);
            $('#btn-form-resultado').prop('disabled', true);
            $('#form-resultados-somatometria :input').prop('disabled', true);
            $('#collapseSOMATOMETRIABOTON').prop('disabled', false);
            break;
        case 2:
            // $('#omitir-paciente').prop('disabled', false);
            $('#btn-form-resultado').prop('disabled', false);
            $('#form-resultados-somatometria :input').prop('disabled', false);
            $('input[data-id="calculoMasaCorpo"]').prop('disabled', true);
            $('#form-resultados-somatometria :input').val('');
            $('#collapseSOMATOMETRIABOTON').prop('disabled', false);
            break;

        default:
            break;
    }
}
