tablaSignos = $('#TablaSignos').DataTable({
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
        beforeSend: function () { loader("In") },
        complete: function () {
            loader("Out")
            loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos', 0);
            $('.informacion-Signos').fadeOut()
        },
        dataSrc: 'response.data'
    },
    // createdRow: function( row, data, dataIndex ){
    //     if ( data.MUESTRA_TOMADA == 1 ){
    //         $(row).addClass('bg-success text-white');
    //     }
    // },
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
selectDatatable('TablaSignos', tablaSignos, 0, 0, 0, 0, function (selectTR = null, array = null) {
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
            await obtenerPanelInformacion(selectListaSignos['ID_PACIENTE'], 'pacientes_api', 'paciente')
            await obtenerResultadosSignos(selectListaSignos['ID_TURNO'])
            loaderDiv("Out", null, "#loader-Signos", '#loaderDivSignos');
            // console.log(divClass)
            $(divClass).fadeIn(100);
        });
    } else {
        getPanel('.informacion-Signos', '#loader-Signos', '#loaderDivSignos', selectListaSignos, 'Out')
    }
})

$("#BuscarTablaListaSignos").keyup(function () {
    tablaSignos.search($(this).val()).draw();
});



async function obtenerResultadosSignos(id) {
    return new Promise(resolve => {
        $.ajax({
            url: http + servidor + "/nuevo_checkup/api/somatometria_api.php",
            dataType: 'json',
            method: 'POST',
            data: { id_turno: id, api: 2 },
            success: function (data) {
                if (mensajeAjax(data)) {
                    let datarow = data.response.data;
                    if (datarow.length > 0) {
                        for (let i = 0; i < datarow.length; i++) {
                            const row = datarow[i];
                            $("#form-resultados-somatometria :input").eq(i).val(row['VALOR']);
                        }
                        bloquearBotones(1)
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
            $('#omitir-paciente').prop('disabled', true);
            $('#btn-form-resultado').prop('disabled', true);
            $('#form-resultados-somatometria :input').prop('disabled', true);
            break;
        case 2:
            $('#omitir-paciente').prop('disabled', false);
            $('#btn-form-resultado').prop('disabled', false);
            $('#form-resultados-somatometria :input').prop('disabled', false);
            $('input[data-id="calculoMasaCorpo"]').prop('disabled', true);
            $('#form-resultados-somatometria :input').val('');
            break;

        default:
            break;
    }
}
