

dataVistaVendedores = { api: 2 }
tablaVistaProveedores = $('#tablaVistaProveedores').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '73vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataVistaVendedores);
        },
        method: 'POST',
        url: '../../../api/proveedores_api.php',
        complete: function () {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
            loader("Out");
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT', },
        { data: 'NOMBRE_COMERCIAL', },
        { data: 'OBJETO_SOCIAL', },
        { data: 'RAZON_SOCIAL', },
        { data: 'TELEFONO', },
        { data: 'TIPO_PERSONA', },
        // { data: 'RAZON_SOCIAL' },
        { data: 'SITIO_WEB', },
        { data: 'EMAIL' },
        {
            data: 'ID_PROVEEDOR', render: function (data, type) {
                if (type === 'display') {
                    return `
                        <div class="row" style="width: 50px">

                            <div class="col-6"> 
                                <!-- Direcciones -->
                                <i class="bi bi-signpost-2-fill btn-direccion icons-btn d-block "
                                    data-bs-id="${data}">
                                </i>
                            </div>

                            <div class="col-6"> 
                                <!-- Contactos -->
                                <i class="bi bi-person-lines-fill btn-contantos icons-btn d-block" 
                                    data-bs-id="${data}">
                                </i>
                            </div>  
                                
                            <div class="col-6"> 
                                <!-- Creditos -->
                                <i class="bi bi-receipt btn-cargar-documentos icons-btn d-block" 
                                    data-bs-id="${data}">
                                </i>
                            </div>

                            <div class="col-6">
                                <!-- Archivos -->
                                <i class="bi bi-pencil-square btn-editar-proveedor icons-btn d-block" 
                                    data-bs-id="${data}">
                                </i>
                            </div>  
                        </div>
                        `;
                } else {
                    return '';
                }
            },
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '5px' },
        { target: 1, title: 'Nombre Comercial', className: 'all' },
        { target: 2, title: 'Objeto Social', className: 'desktop' },
        { target: 3, title: 'Razón Social', className: 'desktop' },
        { target: 4, title: 'Teléfono', className: 'min-tablet' },
        { target: 5, title: 'Tipo', className: 'min-tablet' },
        // { target: 6, title: 'Razon Social', className: 'all' },
        { target: 6, title: 'Sitio Web', className: 'desktop', },
        { target: 7, title: 'Correo', className: 'none', },
        { target: 8, title: '#', className: 'all', width: "50px" },
        { className: "text-vertical-center", "targets": "_all" }

    ]

})



inputBusquedaTable('tablaVistaProveedores', tablaVistaProveedores, [
    {
        msj: 'Visualiza todo los proveedores disponibles',
        place: 'top'
    },
    {
        msj: '',
        place: 'top'
    }
], [], 'col-12')



// Solo para eliminar o obtener comisiones
selectTable('#tablaVistaProveedores', tablaVistaProveedores, {
    noColumns: false, unSelect: true,
    ClickClass: [
        {
            class: 'btn-editar-proveedor',
            callback: (data) => {
                // para actualizar información del proveedor
                console.log(data);
                setFormProveedores = data.ID_PROVEEDOR;

                // Mostrar datos en el formulario
                setProveedorForm(data);
                $('#modalVistaProveedores').modal('show');


            },
            selected: true
        }
    ]
}, (select, data) => {
    if (select) {
        dataVistaPacientes['proveedor_id'] = data.ID_PROVEEDOR;
        $('#label-table-pacientes').html(`Pacientes del proveedor ${data.NOMBRE_COMERCIAL}`)

        $('#btn-subir-documentos').attr('data-bs-id', data.ID_PROVEEDOR)
    } else {
        dataVistaPacientes = { api: 15, }
        $('#label-table-pacientes').html(``)
        $('#btn-subir-documentos').attr('data-bs-id', 0)

    }
})
