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
        {
            data: 'COUNT'
        },
        {
            data: 'PX'
        },
        {
            data: 'CLIENTE'
        },
        {
            data: 'PREFOLIO'
        },
        {
            data: 'FECHA_RECEPCION'
        },
        {
            data: 'CLIENTE_ID', render: function (data) {
                return `<i class="bi bi-trash eliminar-diagnostico" data-id = "${data}" style = "cursor: pointer"
                onclick="desactivarTablaMedicosTratantes.call(this)"></i>`;

            }
        },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre del Paciente', className: 'all' },
        { target: 2, title: 'Prefolio', className: 'all' },
        { target: 3, title: 'Cliente', className: 'all' },
        { target: 4, title: 'Fecha de recepcion', className: 'all' },
        { target: 5, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ]
})


inputBusquedaTable('tablaPacientesTratantes', tablaPacientesTratantes, [], [], 'col-18')

//Funcion para eliminar los medicos tratantes
// function desactivarTablaMedicosTratantes() {
//     var id_medico = $(this).data("id");

//     alertMensajeConfirm({
//         title: '¿Está seguro que desea eliminar este médico?',
//         text: 'No podrá modificarlo despues',
//         icon: 'warning',
//     }, function () {

//         dataJson_eliminarMedico = {
//             api: 3,
//             id_medico: id_medico
//         }

//         ajaxAwait(dataJson_eliminarMedico, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
//             alertToast('Médico tratante eliminado!', 'success', 4000)
//             tablaPacientesTratantes.ajax.reload();
//         })
//     }, 1)
// }