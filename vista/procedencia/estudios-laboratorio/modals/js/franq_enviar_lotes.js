const EnvioLotesPacientes = document.getElementById('EnvioLotesPacientes')
EnvioLotesPacientes.addEventListener('show.bs.modal', event => {
    setTimeout(() => {
        $.fn.dataTable
            .tables({
                visible: true,
                api: true
            })
            .columns.adjust();
    }, 300);
})



// |----------------- Tabla 1 --------------------|

// Detalles de datos a api
let dataListaPaciente = { api: 3, id_cliente: session.id_cliente, bit_solitudes: 0 };
tablaPacientesFaltantes = $('#tablaPacientesFaltantes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataListaPaciente);
        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/maquilas_api.php`,
        complete: function () {
            if (tablaPacientesFaltantes_inicio)
                $('#EnvioLotesPacientes').modal('show');
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE' },
        { data: 'SIHO_CUENTA' },
        { data: 'FOLIO' },
        { data: 'FECHA_ALTA' },
        { data: 'USUARIO' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { targets: 0, className: 'all', title: '#', width: "0px", },
        { targets: 1, className: 'all', title: 'Paciente', width: '50%' }, // PACIENTE
        { targets: 2, className: 'all', title: 'Cuenta' }, // SIHO_CUENTA
        { targets: 3, className: 'none', title: 'Folio' }, // FOLIO
        // { targets: 4, className: 'none', title: 'Procedencia' },
        { targets: 4, className: 'none', title: 'Registro' }, // FECHA_ALTA
        { targets: 5, className: 'none', title: 'Quién registro' } // USUARIO
    ],

})

inputBusquedaTable('tablaPacientesFaltantes', tablaPacientesFaltantes, [], [], 'col-12')

let pacientesLeft = [];
selectTable('#tablaPacientesFaltantes', tablaPacientesFaltantes, { unSelect: true, multipleSelect: true, divPadre: '#false' }, (select, dataRow, callback) => {
    pacientesLeft = dataRow
})

// |-------------------------------------|


// |----------------- Tabla 2 --------------------|

// Detalles de datos a api
TablaPacientesNewGrupo = $('#TablaPacientesNewGrupo').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
    },
    lengthChange: false,
    info: true,
    paging: false,
    scrollY: '47vh',
    scrollCollapse: true,
    columns: [
        { data: 'COUNT' },
        { data: 'PACIENTE' },
        { data: 'SIHO_CUENTA' },
        { data: 'FOLIO' },
        { data: 'FECHA_ALTA' },
        { data: 'USUARIO' },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { targets: 0, className: 'all', title: '#', width: "0px", },
        { targets: 1, className: 'all', title: 'Paciente', width: '50%' }, // PACIENTE
        { targets: 2, className: 'all', title: 'Cuenta' }, // SIHO_CUENTA
        { targets: 3, className: 'none', title: 'Folio' }, // FOLIO
        // { targets: 4, className: 'none', title: 'Procedencia' },
        { targets: 4, className: 'none', title: 'Registro' }, // FECHA_ALTA
        { targets: 5, className: 'none', title: 'Quién registro' } // USUARIO
    ],

})


inputBusquedaTable('TablaPacientesNewGrupo', TablaPacientesNewGrupo, [], [], 'col-12')

let pacientesNewGroup
selectTable('#TablaPacientesNewGrupo', TablaPacientesNewGrupo, { unSelect: true, multipleSelect: true, divPadre: '#false' }, (select, dataRow, callback) => {
    pacientesNewGroup = dataRow
})



// -------------------------------------------------------- //

// -------------------Crear lista en tabla 2 --------------------//

$(document).on('click', '#AgregarPacientesGrupo', function () {
    if (pacientesLeft.length) {
        removeRows(tablaPacientesFaltantes)
        insertRowTable(pacientesLeft, TablaPacientesNewGrupo)
        pacientesLeft = []
    } else {
        alertToast('No ha seleccionado ningún registro.', 'info', 4000)
    }
})

$(document).on('click', '#QuitarPacientesGrupo', function () {
    if (pacientesNewGroup.length) {
        removeRows(TablaPacientesNewGrupo)
        insertRowTable(pacientesNewGroup, tablaPacientesFaltantes)
        pacientesNewGroup = []
    }
})





// Obtiene los pacientes de las tablas
function getPacientes(dataTable) {
    var valoresIDTurno = [];

    // Obtener los datos del DataTable sin importar si está filtrado
    var datos = dataTable.rows({ search: "applied" }).data();

    // Iterar sobre los datos y obtener los valores de la columna "ID_TURNO"
    datos.each(function (row) {
        var idTurno = row.ID_TURNO; // Reemplaza "ID_TURNO" con el nombre de la columna correspondiente en tu DataTable
        valoresIDTurno.push(idTurno);
    });

    return valoresIDTurno;
}


// Inserta nuevas filas
function insertRowTable(datosArray, table) {
    // Insertar cada conjunto de datos en la tabla
    // Obtener los datos existentes en la tabla de destino
    let existingData = table.rows().data().toArray();

    // Filtrar los nuevos datos para eliminar duplicados
    let uniqueData = datosArray.filter(function (newData) {
        return !existingData.some(function (existingRow) {
            return JSON.stringify(existingRow) === JSON.stringify(newData);
        });
    });

    // Agregar los datos únicos a la tabla de destino
    table.rows.add(uniqueData).draw();

    // Obtener los datos omitidos
    let omittedData = datosArray.filter(function (newData) {
        return existingData.some(function (existingRow) {
            return JSON.stringify(existingRow) === JSON.stringify(newData);
        });
    });

    // Mostrar una alerta con la información de los datos omitidos
    if (omittedData.length > 0) {
        alertToast('Se omitieron algunos pacientes repetidos', 'info', 4000);
        console.log('Datos omitidos:', omittedData);
    }
}

// Remueve filas seleccionadas
function removeRows(table) {
    // Obtener las filas seleccionadas
    let filasSeleccionadas = table.rows('.selected').indexes();

    // Remover las filas seleccionadas de la tabla
    table.rows(filasSeleccionadas).remove().draw();
}