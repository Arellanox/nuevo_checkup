// $('#TablaEstatusTurnos tfoot th').each(function () {
//     var title = $(this).text();
//     switch (title) {
//         case '#': return;
//         case 'Recepción': return;
//     }
//     $(this).html('<input type="text" placeholder="Search ' + title + '" />');
// });;

tablaMenuPrincipal = $('#TablaEstatusTurnos').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    scrollY: '66vh',
    scrollCollapse: true,
    // paging: false,
    lengthMenu: [
        [15, 20, 25, 30, 35, 40, 45, 50, -1],
        [15, 20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: { api: 5 },
        method: 'POST',
        url: '../../../api/turnero_api.php',
        beforeSend: function () {
            array_selected = null, carga = false;
        },
        complete: function () {
            carga = true
            reloadTrackingPatients()
        },
        dataSrc: 'response.data'
    },
    createdRow: function (row, data, dataIndex) {
        if (data.REAGENDADO == 1) {
            $(row).addClass('bg-info');
        }

        // $('td', row).addClass('bg-info');
    },
    columns: [
        // {
        //     data: 'AREA_FISICA_ID', render: function () {
        //         return '';
        //     }
        // },
        { data: 'PACIENTE' },
        {
            data: 'ETIQUETA_TURNO', render: function (data) {
                return `<p class="fw-bold" style="letter-spacing: normal !important;">${data}</p>`;
            }
        },
        {
            data: 'MODULO', render: function (data) {
                switch (data) {
                    case 'EN ESPERA':
                        return `<p class="fw-bold" style="letter-spacing: normal !important;color:#E74C3C;">${data}</p>`;
                    default:
                        return `<p class="fw-bold pantone-3165-color" style="letter-spacing: normal !important;">${data}</p>`;
                }
            }
        },
        //Pendientes
        {
            data: 'AREAS_PENDIENTES', render: function (data, type) {
                if (!data)
                    return '';

                let html = '';
                // console.log(data);

                let filter = data.filter((data) => {
                    return data.FINALIZADO === 0;
                });

                for (const key in filter) {
                    if (Object.hasOwnProperty.call(filter, key)) {
                        const element = filter[key];
                        html += `${element.AREA}, `;
                    }
                }

                let items = html.split(',');
                items.pop();
                let spans = items.map(item => `
                <span style="
                    display: inline-block;
                    padding: 0.25em 0.4em;
                    font-size: 75%;
                    font-weight: 700;
                    line-height: 1;
                    color: #fff;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: baseline;
                    border-radius: 0.375rem;
                    background-color: #ffc107;
                    margin-right: 0.25em;
                    margin-bottom: 0.25em;
                ">${item.trim()}</span>`);
                
                
                return spans.join(' ');
                //return html
            }
        },

        //Terminadas
        {
            data: 'AREAS_PENDIENTES', render: function (data, type) {
                if (!data)
                    return '';

                let html = '';
                // console.log(data);

                let filter = data.filter((data) => {
                    return data.FINALIZADO === 1;
                });

                for (const key in filter) {
                    if (Object.hasOwnProperty.call(filter, key)) {
                        const element = filter[key];
                        html += `${element.AREA}, `;
                    }
                }

                let items = html.split(',');
                items.pop();

                let spans = items.map(item => `
                <span style="
                    display: inline-block;
                    padding: 0.25em 0.4em;
                    font-size: 75%;
                    font-weight: 700;
                    line-height: 1;
                    color: #fff;
                    text-align: center;
                    white-space: nowrap;
                    vertical-align: baseline;
                    border-radius: 0.375rem;
                    background-color: #28a745;
                    margin-right: 0.25em;
                    margin-bottom: 0.25em;
                ">${item.trim()}</span>`);
                
                return spans.join(' ');
            }
        },
    ],
    columnDefs: [
        { targets: 0, title: 'Paciente', width: '40%' },
        { targets: 1, title: 'Turno', width: '10%' },
        { targets: 2, title: 'Area Actual', width: '10%' },
        //Pendientes
        { target: 3, title: 'Pendiente', width: '20%' },
        //Terminadas
        { target: 4, title: 'Finalizado', width: '20%' },
    ],
    dom: 'Bfrtip',
    buttons: [
        {
            text: '<i class="bi bi-arrow-clockwise"></i> Actualizar',
            className: 'btn btn-success',
            action: function () {
                tablaMenuPrincipal.ajax.reload()
                carga = false
            }
        }
    ]
})

function reloadTrackingPatients(){
    setTimeout(
        tablaMenuPrincipal.ajax.reload(), 30000
    );
}

selectTable('#TablaEstatusTurnos', tablaMenuPrincipal, { dblClick: true, unSelect: true }, (select, data, callback, row, tr) => { }, async (select, data) => {
    let dataInfo = data;
    alertToast('Espere un momento', 'info', 4000);
    if (select) {
        await obtenerPanelInformacion(1, 'toma_de_muestra_api', 'estudios_muestras', '#panel-muestras-estudios')
        var myOffcanvas = document.getElementById('offcanvasInfoPrincipal')
        var bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
        bsOffcanvas.show()

    }
})

inputBusquedaTable('TablaEstatusTurnos', tablaMenuPrincipal, [
    {
        msj: 'Filtra la tabla con palabras u oraciones que coincidan',
        place: 'right'
    }
], false, 'col-12')