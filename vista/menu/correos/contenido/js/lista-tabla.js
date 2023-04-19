tablaListaPaciente = $('#TablaLaboratorio').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 244),
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
            getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', datalist, 'Out')
        },
        complete: function () {
            loader("Out", 'bottom')
            getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', datalist, 'Out')
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
    datalist = array;
    dataSelect = new GuardarArreglo({
        select: true,
        nombre_paciente: datalist['NOMBRE_COMPLETO'],
        turno: datalist['ID_TURNO']
    })
    // console.log(dataSelect)
    if (selectTR == 1) {
        estadoBotones(0) //Habilitar botones
        $('#height-card-pdf').css('height', autoHeightDiv(0, 100))
        try {
            getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', datalist, 'In', async function (divClass) {
                // vistaPDF('adobe-dc-view', 'url', 'resultado_laboratorio_test.pdf')
                // await obtenerPanelInformacion(datalist['ID_TURNO'], 'pacientes_api', 'paciente_lab')
                // await generarHistorialResultados(datalist['ID_PACIENTE'])
                await getResultadoPaciente(datalist['ID_TURNO']);

                // await generarFormularioPaciente(datalist['ID_TURNO'])

                // console.log(selectEstudio)
                if (datalist.DOBLE_CHECK == 1 || selectEstudio.getguardado() == 1)
                    estadoBotones(1) //Desactivar si ya fue enviado
                // console.log(selectEstudio.array.RUTA)
                try {
                    vistaPDF('#pdfviewer', selectEstudio.array.RUTA, selectEstudio.array.NOMBRE_ARCHIVO)
                } catch (error) {

                }
                bugGetPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab')

            });
            // getPanelLab('In', datalist['ID_TURNO'], datalist['ID_PACIENTE'])
        } catch (error) {
            console.log(error)
        }
    } else {
        // console.log('rechazado')
        getPanel('.informacion-labo', '#loader-Lab', '#loaderDivLab', datalist, 'Out')
        // getPanelLab('Out', 0, 0)
    }
})


$("#BuscarTablaListaLaboratorio").keyup(function () {
    tablaListaPaciente.search($(this).val()).draw();
});


function getResultadoPaciente(turno) {
    return new Promise(resolve => {
        $.ajax({
            url: `${http}${servidor}/${appname}/api/turnos_api.php`,
            dataType: 'json',
            data: { id_turno: turno, api: 14 },
            method: "POST",
            success: function (data) {
                selectEstudio = new GuardarArreglo(data.response.data);
                // console.log(selectEstudio)
                let row = [data.response.data];

                if (row['DOBLE_CHECK'])
                    selectEstudio.setguardado(1)
            },
            complete: function () {
                resolve(1);
            }
        })
    });
}

function estadoBotones(estado) {
    switch (estado) {
        case 1:
            // $('#btn-rechazar-resultado').prop('disabled', true);
            // $('#btn-confirmarenviar-resultado').prop('disabled', true);
            break;
        case 0:
            $('#btn-rechazar-resultado').prop('disabled', false);
            $('#btn-confirmarenviar-resultado').prop('disabled', false);
        default:
            break;
    }
}