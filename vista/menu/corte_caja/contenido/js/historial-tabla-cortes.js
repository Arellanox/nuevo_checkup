var TablaHistorialCortes = $('#TablaHistorialCortesCaja').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: false,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    // ajax: {
    //     dataType: 'json',
    //     data: { api: 2 },
    //     method: 'POST',
    //     url: '../../../api/corte_caja_api.php',
    //     beforeSend: function () { loader("In") },
    //     complete: function () { loader("Out") },
    //     dataSrc: 'response.data'
    // },
    columns: [
        {
            
            data: null, render: function (data) {
                // Mes
                return "0001";
            }
        },
        {
            data: null, render: function (data) {

                return "12/12/2015";
            }
        },
                {
            data: null, render: function (data) {

                return "12/12/2015";
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'FECHA', className: 'all' },
        { target: 2, title: 'nose', className: 'none' }
    ],

})

inputBusquedaTable("TablaHistorialCortesCaja", TablaHistorialCortes, [{
    msj: 'Tabla de historial de cortes de caja',
    place: 'top'
}], {
    msj: "Filtre los resultados",
    place: 'top'
}, "col-12")


//Funcion para cambiar el estatus (funcion global)
selectTable('#TablaHistorialCortesCaja', TablaHistorialCortes, {
    unSelect: true, ClickClass: [
        { 
            callback: async function (data) {

                console.log(data)


            },selected: true
        }, 
    
    ], dblClick: true, reload: ['col-xl-9']
})
