// Variables locales
var SelectEstudios = false;

var tablaServicio = $('#TablaEstudioServicio').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    scrollY: '58vh', //347px  scrollCollapse: true,
    lengthMenu: [[15, 20, 25, 30, 35, 40, 45, 50, -1], [15, 20, 25, 30, 35, 40, 45, 50, "All"]],
    ajax: {
        dataType: 'json',
        data: {api: 2, id_area: '6,12', tipgrupo: 0},
        method: 'POST',
        url: '../../../api/servicios_api.php',
        beforeSend: function () {
            loader("In")
        },
        complete: function () {
            loader("Out")
        },
        dataSrc: ''
    },
    columns: [
        {data: 'COUNT'},
        {data: 'DESCRIPCION'},
        {data: 'ABREVIATURA'},
        {data: 'CLASIFICACION_EXAMEN'},
        {data: 'DESCRIPCION_AREA'},
        {
            data: 'LABORATORIO', render: function (data, row, type) {
                if (row.LABORATORIO_ID == null) {
                    return ''
                } else {
                    return data
                }
            }
        },
        {
            data: 'SE_MAQUILA', render: function (data) {
                if (data === '0') {
                    return ''
                } else {
                    return 'Maquilado'
                }
            }
        },
        {data: 'ACTIVO'},
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        // { width: '100%' },
        {"width": "3px", "targets": [0, 4]},
    ],

    dom: 'Blfrtip',
    buttons: [
        {
            text: '<i class="bi bi-pencil-square"></i> Editar',
            className: 'btn btn-pantone-7408',
            action: function () {
                if (array_selected != null) {
                    getDataFirst(1, array_selected['ID_SERVICIO'])
                } else {
                    alertSelectTable();
                }
            }
        },
        {
            text: '<i class="bi bi-rulers"></i> Referencia',
            className: 'btn btn-pantone-325 ',
            action: function () {

                if (!SelectEstudios) {
                    alertSelectTable();
                    return false;
                }

                TablaValoresReferencia.clear().draw()
                TablaValoresReferencia.ajax.reload()
                $(myModal).trigger("reset");

                $('#titleValoresReferencia').html(`Asignar valores de referencia al servicio: (<b>${array_selected['DESCRIPCION']}</b>)`);

                $('#modalReferencia').modal('show');
            }
        },
        {
            extend: 'excelHtml5',
            text: '<i class="fa fa-file-excel-o"></i> Excel',
            className: 'btn btn-success',
            titleAttr: 'Excel',
            attr: {
                'data-bs-toggle': "tooltip",
                'data-bs-placement': "top",
                title: "Genere el formato por toda la tabla de pacientes o filtrado (Filtrado por: Fecha, Procedencia...)"
            }
            // exportOptions: {
            //   // Especifica las columnas que deseas exportar
            //   columns: [0, 1, 8, 3, 2, 4, 6, 7, 5, 9, 10, 11]
            // }

        }
    ],
})

selectDatatable("TablaEstudioServicio", tablaServicio, 0, 0, 0, 0, function (select, selectData) {

    if (select) {
        obtenerPanelInformacion(1, 'servicios_api', 'estudio');
        SelectEstudios = true;

        DataReferencia.servicio_id = array_selected['ID_SERVICIO']
        //   console.log(select);
        //   infoServicioEdit = getInfoServicioLab(select['ID_SERVICIO']);
        //   console.log(infoServicioEdit)
        //   // obtenerPanelInformacion(1, infoServicioEdit, 'signos-vitales', '#signos-vitales'); //<-- en la opcion 2 mando arreglo, pero deberia estar la api donde ira, pero el case necesita la info, no busca en ajax
    } else {
        SelectEstudios = false;

        //   infoServicioEdit = false;
        //   // obtenerPanelInformacion(0, null, 'signos-vitales', '#signos-vitales'); //<-- en la opcion 2 mando arreglo, pero deberia estar la api donde ira, pero el case necesita la info, no busca en ajax

    }

})


inputBusquedaTable('TablaEstudioServicio', tablaServicio, [], [], 'col-12')

