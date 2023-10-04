//Tbla donde se vizualiza los Médicos tratantes ya registrados en la base de datos
tablaPacientesTratantes = $("#tablaPacientesTratantes").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataPacientesTratantes);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            tablaPacientesTratantes.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PX' },
        { data: 'CLIENTE' },
        { data: 'FECHA_RECEPCION' },
        { data: 'PREFOLIO' },
        { data: 'ID_TURNO' },
        { data: 'GENERO' },
        { data: 'EDAD' },
        { data: null },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '1%' },
        { target: 1, title: 'Nombre del Paciente', className: 'all' },
        { target: 2, title: 'Procedencia', className: 'all' },
        { target: 3, title: 'Fecha de recepcion', className: 'all' },
        { target: 4, title: 'Prefolio', className: 'all' },
        { target: 5, title: 'Turno', className: 'none' },
        { target: 6, title: 'Edad', className: 'none' },
        { target: 7, title: 'Sexo', className: 'none' },
        {
            targets: 8,
            title: '#',
            className: 'all actions',
            width: '1%',
            data: null,
            defaultContent: `
                <button type="button" class="btn-vizu-reporte btn btn-pantone-325" style="font-size: 20px;margin: 0px;padding: 1px 8px 1px 8px;">
                    <i class="bi bi-clipboard2-pulse-fill btn-vizu-reporte"></i>
                </button>`
        }
    ]
})


inputBusquedaTable('tablaPacientesTratantes', tablaPacientesTratantes, [], [], 'col-18')

//Funcion para eliminar los medicos tratantes
// function desactivarTablaMedicosTratantes() {
//     var id_medico = $(this).data("id");
// btn-vizu-reporte

selectTable('#tablaPacientesTratantes', tablaPacientesTratantes,
    {
        // onlyData: true,
        ClickClass: [
            {
                class: 'btn-vizu-reporte',
                callback: function (data) {
                    // Cargar modal de estudios del paciente
                    $("#ModalVisualizarEstudiosPaciente").modal('show');
                },
                // selected: true,
            },
        ]
    }, false, function (select, data) {
        // Como en recepcion, ver estudios cargados
        // dobleClickSelectTableRecepcion(data);
    }
)
//         ajaxAwait(dataJson_eliminarMedico, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
//             alertToast('Médico tratante eliminado!', 'success', 4000)
//             tablaPacientesTratantes.ajax.reload();
//         })
//     }, 1)
// }