// Datatable para la tabla de TablaPacientesPrequirurgica
TablaPacientesPrequirurgica = $('#TablaPacientesPrequirurgica').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, DataPrequirurgico);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/prequirurgico_api.php',
        beforeSend: function () {
            // fadeRegistro('Out')
            loader("In")
            // selectTableFolio = false
        },
        complete: function () {
            //Para ocultar segunda columna
            loader("Out", 'bottom')
            // reloadSelectTable()
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        },
        // error: function (jqXHR, textStatus, errorThrown) {
        //     alertErrorAJAX(jqXHR, textStatus, errorThrown);
        // },
        dataSrc: 'response.data'
    },
    // columns: [
    //     { data: 'FOLIO' },
    //     {
    //         data: 'FECHA_REGISTRO', render: function (data) {
    //             // Mes
    //             return formatoFecha2(data, [0, 1, 3, 0]).toUpperCase();
    //         }
    //     },
    //     {
    //         data: null, render: function (data) {
    //             let html = `<i class="bi bi-file-earmark-pdf-fill generarPDF" style="cursor: pointer; color: red;font-size: 23px;"></i>`
    //             return session['permisos']['SupTemp'] == '1' ? html : '';
    //         }
    //     },
    //     {
    //         data: 'FECHA_REGISTRO', render: function (data) {
    //             // ANHO
    //             return formatoFecha2(data, [0, 1, 0, 0]).toUpperCase();
    //         }
    //     }
    // ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre', className: 'all' },
        { target: 2, title: 'Prefolio  ', className: 'all' },
        { target: 3, title: 'Procedencia', className: 'none' },
        { target: 4, title: 'Edad   ', className: 'none' },
        { target: 5, title: 'Sexo', className: 'none' }

    ],
    // dom: 'Bfrtip',
    // buttons: [
    //     {
    //         text: '<i class="bi bi-file-earmark-pdf-fill"></i> Generar PDF',
    //         className: 'btn btn-borrar',
    //         action: function (data) {

    //         }
    //     }
    // ]
})

// Input de busqueda
inputBusquedaTable("TablaPacientesPrequirurgica", TablaPacientesPrequirurgica, [{
    msj: 'Tabla de los pacientes para valoracion prequirurgica  ',
    place: 'top'
}], {
    msj: "Filtre los resultados por el folio que escriba",
    place: 'top'
}, "col-12")


// Select para la tabla
selectTable('#TablaPacientesPrequirurgica', TablaPacientesPrequirurgica, {
    unSelect: true, dblClick: true, reload: ['col-xl-9']
}, async function (select, data, callback) {
    if (select) {
    }
})

// evento change del checkbox para aparecer a todos los pacientes
$(document).on('change', '#checkDiaAnalisis', function () {

    let btn = $(this).is(':checked');

    // se valida si el checkbox esta chekeado
    if (btn) {
        DataPrequirurgico.fecha_busqueda = "";
        console.log(DataPrequirurgico)
        TablaPacientesPrequirurgica.ajax.reload()
    }
})