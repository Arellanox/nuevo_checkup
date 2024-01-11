dataAjax = {
    api: 8,
    // 
}
reportes_anteriores_personal = $('#reportes_anteriores_personal').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataAjax);
        },
        method: 'POST',
        url: '../../../api/checadorBimo_api.php',
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'FECHA_RANGO' },
        {
            data: 'RUTA_REEPORTE', render: function (data) {
                return `
                    <i class="bi bi-file-earmark-pdf-fill text-danger"></i>
                `;
            }
        }
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { "width": "10px", "targets": 0, title: '#', className: 'all' },
        { targets: 1, title: 'FECHA', className: 'all' },
        { targets: 2, title: 'PDF', className: 'all' }
    ],

})

inputBusquedaTable('reportes_anteriores_personal', reportes_anteriores_personal, [], [], 'col-12')

selectTable('#reportes_anteriores_personal', reportes_anteriores_personal, { unSelect: true }, async (selectTR, data, callback) => {
    if (selectTR == 1) {
        // Aqui llamarias al reporte
        // Ejemplo: data.REPORTE_PERSONAL
        const nombre = `Reporte: ${selectTR.FECHA_RANGO}-${usuarioSelected.USUARIO}`;
        const ruta = selectTR.RUTA_REPORTE;
        getNewView(ruta, nombre);
        callback('In')
    } else {
        limpiarAdobe();
        callback('Out')
    }
})


// Función que se ejecuta cuando se realiza una acción para obtener un nuevo PDF
function getNewView(url, filename) {
    // Destruir la instancia existente de AdobeDC.View
    // Crear una instancia inicial de AdobeDC.View
    let adobeDCView = new AdobeDC.View({ clientId: "cd0a5ec82af74d85b589bbb7f1175ce3", divId: "adobe-dc-view" });

    var nuevaURL = url;

    // Agregar un parámetro único a la URL para evitar la caché del navegador
    nuevaURL += "?timestamp=" + Date.now();

    // Cargar y mostrar el nuevo PDF en el visor
    adobeDCView.previewFile({
        content: { location: { url: nuevaURL } },
        metaData: { fileName: filename }
    });
}