tablaSignos = $('#TablaSignos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '61vh',
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
            //Para ocultar segunda columna
            reloadSelectTable()
        },
        error: function (jqXHR, exception, data) {
            alertErrorAJAX(jqXHR, exception, data)
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
selectTable('#TablaSignos', tablaSignos, { unSelect: true, movil: true, reload: ['col-xl-9'] }, async (selectTR, array, callback) => {
    // selectDatatable('TablaSignos', tablaSignos, 0, 0, 0, 0, function (selectTR = null, array = null) {
    selectListaSignos = array;
    if (selectTR == 1) {

        await obtenerPanelInformacion(selectListaSignos['ID_TURNO'], 'pacientes_api', 'paciente', '#panel-informacion', '_lab')
        await obtenerResultadosSignos(selectListaSignos['ID_TURNO'])
        loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos');

        callback('In')
    } else {
        callback('Out')
    }
})

inputBusquedaTable('TablaSignos', tablaSignos, [{
    msj: 'Los pacientes con muestras tomadas se visualizarán confirmados de color verde',
    place: 'top'
}], [], 'col-12')

async function obtenerResultadosSignos(id) {
    return new Promise(resolve => {
        ajaxAwait({ id_turno: id, api: 2 }, 'somatometria_api', { callbackAfter: true }, false, (row) => {
            row = row.response.data;
            if (Object.keys(row).length > 2) {
                bloquearBotones(1)
                console.log(row);
                const elementMap = {
                    'frecuenciaCardiaca': 'FRECUENCIA CARDIACA',
                    'frecuenciaRespiratoria': 'FRECUENCIA RESPIRATORIA',
                    'sistolica': 'SISTOLICA',
                    'diastolica': 'DIASTOLICA',
                    'saturacionOxigeno': 'SATURACION DE OXIGENO',
                    'temperatura': 'TEMPERATURA',
                    'estatura': 'ESTATURA',
                    'peso': 'PESO',
                    'masaCorporal': 'ÍNDICE DE MASA CORPORAL',
                    'masaMuscular': 'MASA LIBRE DE GRASA',
                    'porcentajeGrasaVisceral': 'NIVEL DE GRASA VISCERAL',
                    'huesos': 'MÚSCULO ESQUELÉTICO',
                    'metabolismo': 'TASA METABÓLICA BASAL',
                    'perimetroCefalico': 'PERIMETRO CEFALICO',
                    'porcentajeProteinas': 'PROTEÍNAS',
                    'porcentajeAgua': 'AGUA CORPORAL TOTAL',
                    'masagrasaCorportal': 'MASA GRASA CORPORAL',
                    'minerales': 'MINERALES'
                };

                // Iterar sobre el mapeo para establecer los valores de los elementos
                for (const [elementID, rowKey] of Object.entries(elementMap)) {
                    // console.log($(`#${elementID}`), rowKey, row[`${rowKey}`][['VALOR']]);
                    $(`#${elementID}`).val(ifnull(row, '', { [rowKey]: 'VALOR' }));
                }

                // Manejar el botón de reporte
                const reportPath = ifnull(row, '', ['RUTA_REPORTE']);
                if (reportPath) {
                    $('#button_reporte').html(`<a type="button" target="_blank" class="btn btn-borrar me-2" href="${reportPath}" style="margin-bottom:4px"><i class="bi bi-file-earmark-pdf"></i></a>`);
                } else {
                    $('#button_reporte').html('');
                }
            } else {
                bloquearBotones(2)
            }

            resolve(1);
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
