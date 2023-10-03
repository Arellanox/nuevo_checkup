TablaVistaMedicosTratantes = $("#TablaVistaMedicosTratantes").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataMedicosTratantes);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            TablaVistaMedicosTratantes.columns.adjust().draw()
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
            data: 'NOMBRE_MEDICO'
        },
        {
            data: 'EMAIL'
        },
        {
            data: 'ID_MEDICO', render: function (data) {
                return `<i class="bi bi-trash eliminar-diagnostico" data-id = "${data}" style = "cursor: pointer"
                onclick="desactivarTablaMedicosTratantes.call(this)"></i>`;

            }
        },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre del Médico', className: 'all' },
        { target: 2, title: 'Email', className: 'all' },
        { target: 3, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ]
})


inputBusquedaTable('TablaVistaMedicosTratantes', TablaVistaMedicosTratantes, [], [], 'col-18')


function desactivarTablaMedicosTratantes() {
    var id_medico = $(this).data("id");

    alertMensajeConfirm({
        title: '¿Está seguro que desea desactivar este médico?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        dataJson_eliminarMedico = {
            api: 3,
            id_medico: id_medico
        }

        ajaxAwait(dataJson_eliminarDiagnosticos, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
            alertToast('Médico tratante eliminado!', 'success', 4000)

            TablaVistaMedicosTratantes.ajax.reload();
        })
    }, 1)
}