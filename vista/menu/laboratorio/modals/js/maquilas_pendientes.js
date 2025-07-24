let maquilas_pendientes = $('#TablaMaquilasPendientesAprovacion').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json" },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: autoHeightDiv(0, 300),
    scrollCollapse: true,
    ajax: {
        dataType: "json",
        data: {
            api: 2,
            MOSTRAR_OCULTOS: 1,
            FECHA_INICIO: dataListaPaciente['fecha_busqueda'] ?? rangoFechas[0] ?? null,
            FECHA_FIN: dataListaPaciente['fecha_busqueda_final'] ?? rangoFechas[1] ?? null
        },
        method: "POST",
        url: "../../../api/laboratorio_solicitud_maquila_api.php",
        dataSrc: "response.data",
        beforeSend: function () { console.info('📣 System: Obtencion de maquilas iniciada.') },
        complete: function () { console.info('📣 System: Obtencion de maquilas completada.') },
        error: function () { Toast.fire({icon: 'error', title: '¡Error al recuperar las maquilas!'}); }
    },
    columns: [
        {data: "SERVICIO"},
        {data: "LABORATORIO_NOMBRE"},
        {data: "SERVICIO_ABREVIATURA"},
        {data: "PACIENTE_NOMBRE"},
        {data: "USUARIO_SOLICITANTE"},
        {
            data: "LAB_MAQUILA_ESTATUS",
            render: function (data, type, row) {
                let text = "Desconocido: " + data;
                let className = "badge bg-secondary"; // Estilos por defecto

                if (data === null || data == 0) {
                    text = "Pendiente";
                    className = "badge bg-warning text-dark"; // Amarillo
                } else if (data == 1) {
                    text = "Aprobado";
                    className = "badge bg-success"; // Verde
                } else if (data == 2) {
                    text = "Rechazado";
                    className = "badge bg-danger"; // Rojo
                }

                return `<span class="${className}">${text}</span>`;
            }
        },
        {data: "LAB_MAQUILA_REGISTRO"}
    ],
    columnDefs: [ { width: "50px", targets: 0 } ]
});

maquilas_pendientes.ajax.reload();