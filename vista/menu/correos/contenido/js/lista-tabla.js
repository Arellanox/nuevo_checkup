tablaListaPaciente = $('#TablaLaboratorio').DataTable({
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
            loader("In")
        },
        complete: function () {
            loader("Out")
            loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab', 0);
            $('.informacion-labo').fadeOut()
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.DOBLE_CHECK == 1) {
            $(row).addClass('bg-success text-white');
        } else {
            $(row).addClass('bg-warning');
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
loaderDiv("Out", null, "#loader-Lab", '#loaderDivLab');

selectDatatable('TablaLaboratorio', tablaListaPaciente, 0, 0, 0, 0, function (selectTR = null, array = null) {
    selectListaLab = array;
    if (selectTR == 1) {
        try {
            getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'In', async function (divClass) {
                await obtenerPanelInformacion(selectListaLab['ID_PACIENTE'], 'pacientes_api', 'paciente_lab')
                // await generarHistorialResultados(selectListaLab['ID_PACIENTE'])
                // await generarFormularioPaciente(selectListaLab['ID_TURNO'])

                if (selectListaLab.DOBLE_CHECK == 1) {
                    $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', true)
                    $('#formAnalisisLaboratorio :input').prop('disabled', true)
                } else {
                    $('button[type="submit"][form="formAnalisisLaboratorio"]').prop('disabled', false)
                    $('#formAnalisisLaboratorio :input').prop('disabled', false)
                }

                bugGetPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab')

            });
            // getPanelLab('In', selectListaLab['ID_TURNO'], selectListaLab['ID_PACIENTE'])
        } catch (error) {
            console.log(error)
        }
    } else {
        // console.log('rechazado')
        getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', selectListaLab, 'Out')
        // getPanelLab('Out', 0, 0)
    }
})
$("#BuscarTablaListaLaboratorio").keyup(function () {
    tablaListaPaciente.search($(this).val()).draw();
});
