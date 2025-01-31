

tableListaOportunidades = $('#tableListaOportunidades').DataTable({
    autoWidth: true,
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: true,
    sorting: true,
    scrollY: '68vh',
    scrollX: true,
    scrollCollapse: true,
    fixedHeader: true,
    ajax: {
        dataType : 'json',
        data: function(d){
            return $.extend(d, dataListaOportunidades)
        },
        method: 'POST',
        url: '../../../api/oportunidades_api.php',
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_OPORTUNIDAD' },
        { 
            data: 'MONTO_ESTIMADO',
            render: function(data, type, row) {
                // Verifica si el dato es numérico y formatea
                if ($.isNumeric(data)) {
                    return '$' + Number(data).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                } else {
                    return '$0.00';  // Valor predeterminado en caso de datos inválidos
                }
            }
            
        },
        { data: 'EMPRESA' }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Oportunidad', className: 'all'},
        { target: 2, title: 'Monto ($)', },
        { target: 3, title: 'Empresa', className: 'all'}
    ]
});




tableListaEmpresas = $('#tablaEmpresas').DataTable({
    autoWidth: true,
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: true,
    sorting: true,
    scrollY: '68vh',
    scrollX: true,
    scrollCollapse: true,
    fixedHeader: true,
    config: {
        unSelect: true
    },
    ajax: {
        dataType : 'json',
        data: function(d){
            return $.extend(d, dataListaEmpresas)
        },
        method: 'POST',
        url: '../../../api/oportunidades_api.php',
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'EMPRESA' },
        { data: 'TIPO' },
        { data: 'REGISTRADO_POR' }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Empresa', className: 'all'},
        { target: 2, title: 'Tipo', },
        { target: 3, title: 'Quien registró', className: 'all'}
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
        // editar empresas button
        {
            text: '<i class="bi bi-trash3"></i> Eliminar',
            className: 'btn btn-danger',
            attr: {
                id: "btnEliminarEmpresa",
                "data-bs-toggle": "tooltip",
                "data-bs-placement": "top",
                title: "Permite eliminar la empresa.",

            },
            action: function(){
                // ELIMINAR EMPRESA
                if(rowSelected != null){
                    alertMensajeConfirm({
                        title: `Estás a punto de eliminar ${rowSelected.EMPRESA}...`,
                        text: "¿Deseas continuar?",
                        icon: "warning"
                    },
                    function(){
                        ajaxAwait(
                            {
                                api: 4,
                                id_empresa: rowSelected.ID_EMPRESA
                            },
                            'oportunidades_api',
                            { callbackAfter: true },
                            false,
                            function(data){
                                if(data.response.code == 1){
                                    alertToast("Empresa eliminada!", "success", 400);
                                    rowSelected = null;
                                    tableListaEmpresas.ajax.reload();
                                } else {
                                    alertToast(data.response.message, "error", 400);
                                }
                            }
                        )
                    }, 1
                )
                } else {
                    alertToast("Necesita seleccionar una empresa", "warning", 4000);
                }
            }
        }
    ]
});

selectDatatable('tablaEmpresas', tableListaEmpresas,0,0,0,0, async function(select, dataClick){
    // CUANDO SELECCIONAN UNA FILA DE LA TABLA
    // ACTUALIZAMOS EL VALOR DE LA VARIABLE `rowSelected` con los de la fila seleccionada.
    rowSelected = dataClick;

}, async function(){
    // DOBLE CLICK
    $('#nombreEmpresa').val(rowSelected.EMPRESA);

    if(rowSelected.TIPO == "EMPRESA"){
        $("#tipoEmpresa").val(1);
    } else {
        $("#tipoEmpresa").val(2);
    }
})

setTimeout(() => {
    inputBusquedaTable('tablaEmpresas', tableListaEmpresas, [{
        msj: 'Filtre los registros por coincidencia',
        place: 'top'
    }], [], 'col-12');

    // resuelve el problema de ancho de las columnas en el titulo
    tableListaEmpresas.columns.adjust().draw();
    // tableListaEmpresas.ajax.reload();
}, 2000);

rellenarSelect('#cuentaAsignada', 'oportunidades_api', )

$("#btnCancelarEdicion").click(function(){
    rowSelected = null;
    tableListaEmpresas.ajax.reload();
    $("#formNuevaEmpresa")[0].reset();
})
