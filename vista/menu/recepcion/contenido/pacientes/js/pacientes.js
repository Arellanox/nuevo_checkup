tablaPacientesActuales = $('#tablaPacientesActuales').DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    scrollY: '60vh',
    scrollCollapse: true,
    deferRender: true,
    lengthMenu: [
        [20, 25, 30, 35, 40, 45, 50, -1],
        [20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: {
            api: 2,
        },
        method: 'POST',
        url: '../../../api/pacientes_api.php',
        beforeSend: function () {
            loader("In")

            array_selected = null
        },
        complete: function () {
            loader("Out")

            tablaPacientesActuales.columns.adjust().draw()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'COUNT' },
        { data: 'NOMBRE_COMPLETO' },
        { data: 'GENERO' },
        {
            data: null, render: function (row) {
                let edad = calcularEdad2(row.NACIMIENTO);

                return `${edad.numero} ${edad.tipo}`
            }
        },
        {
            data: 'NACIMIENTO', render: (data) => {
                return formatoFecha2(data, [0, 1, 5, 2, 0, 0, 0])
            }
        },

        { data: 'NACIONALIDAD' },


        // { data: 'CURP' },
        // // {
        // //     data: null, render: (row) => {
        // //         return `${ifnull(row.CORREO)} <br> ${ifnull(row.CORREO_2)}`
        // //     }
        // // },
        // { data: 'RFC' },
        // { data: 'NACIONALIDAD' },
        // { data: 'CELULAR' },
        // {
        //     data: null, render: (row) => {
        //         return `${row.CALLE}, ${row.COLONIA}, ${row.MUNICIPIO}, ${row.ESTADO}, ${row.POSTAL}`;
        //     }
        // },
        {
            data: null, render: function () {
                let html = `
                            <i class="bi bi-pencil-square btn-editar" style="cursor: pointer; font-size:18px;padding: 2px 5px;"></i>
                        `;

                return html
            }
        },

        { data: 'CURP' },
        { data: 'RFC' },
        { data: 'CELULAR' },
        {
            data: null, render: (row) => {
                return `${row.CALLE}, ${row.COLONIA}, ${row.MUNICIPIO}, ${row.ESTADO}, ${row.POSTAL}`;
            }
        },
        {
            data: null, render: (row) => {
                return `${ifnull(row.CORREO)} <br> ${ifnull(row.CORREO_2)}`
            }
        },
        // {defaultContent: 'En progreso...'}
    ],
    columnDefs: [
        { target: 0, title: '#', class: 'all', width: '1%' },
        { target: 1, title: 'Nombre', class: 'all', width: '30%' },
        { target: 2, title: 'Genero', class: 'all' },
        { target: 3, title: 'Edad', class: 'min-tablet' },
        { target: 4, title: 'Nacimiento', class: 'min-tablet' },
        { target: 5, title: 'Nacionalidad', class: 'min-tablet' },
        { target: 6, title: '#', class: 'all', width: '1%' },

        { target: 7, title: 'CURP', class: 'none' },
        { target: 8, title: 'RFC', class: 'none' },
        { target: 9, title: 'Celular', class: 'none' },
        { target: 10, title: 'Dirección', class: 'none' },
        { target: 11, title: 'Correo', class: 'none' },

        // { target: 0, title: '#', class: 'all', width: '1%' }, // Ajustado a un valor más realista
        // { target: 1, title: 'Nombre', class: 'all', width: '30%' }, // Ajustado para compensar el ancho de la columna 0
        // { target: 2, title: 'Genero', class: 'all' }, // Un poco más de espacio para "Genero"
        // { target: 3, title: 'Edad', class: 'all' }, // Ajustado a un valor más realista
        // { target: 4, title: 'Nacimiento', class: 'none' },
        // { target: 5, title: 'CURP', class: 'none' },
        // { target: 6, title: 'RFC', class: 'none' },
        // { target: 7, title: 'Nacionalidad', class: 'none' }, // Aumentado para un mejor ajuste
        // { target: 8, title: 'Celular', class: 'none' }, // Ajustado para la suma total
        // { target: 9, title: 'Dirección', class: 'none' },
        // { target: 10, title: '#', class: 'all', width: '1%' }, // Ajustado a un valor más realista
        // { target: 11, title: 'Correo', class: 'none' },

    ],

    dom: 'Blfrtip',
    buttons: [
        {
            text: '<i class="bi-email"></i> Confirmación',
            className: 'btn btn-success btn-confirmacion',
            action: () => {
                var selectedRows = tablaPacientesActuales.rows('.selected').data();
                selectedRows = selectedRows[0]

                if (selectedRows) {
                    alertMensajeConfirm({
                        title: '¿Deseas confirmar sus datos?',
                        text: 'Enviaremos los correos registrados del paciente para confirmar sus datos.'
                    }, () => {
                        if (ifnull(selectedRows, false, ['ID_PACIENTE'])) {
                            ajaxAwait({ api: 16, id_paciente: selectedRows['ID_PACIENTE'] }, 'recepcion_api', { callbackAfter: true }, false, () => {
                                alertMensaje('success', 'Correo enviado', 'Los datos de paciente fueron enviarons correctamente a los correo de contactos');
                            });
                        } else {
                            alertToast('Parece que hubo un error con el registro, vuelve a intentarlo o reporta este error');
                        }
                    }, 1)


                } else {
                    alertToast('No ha seleccionado ningún registro')
                }

            }
        },
    ],
})


inputBusquedaTable('tablaPacientesActuales', tablaPacientesActuales, [
    {
        msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
        place: 'left'
    },
], [], 'col-12')


selectTable('#tablaPacientesActuales', tablaPacientesActuales, {
    noColumns: true,
    ClickClass: [
        {
            class: 'btn-editar',
            callback: function (data) {
                if (data != null) {
                    array_selected = data
                    $("#ModalEditarPaciente").modal('show');
                } else {
                    alertSelectTable();
                }
            },
            selected: true,
        },
        {
            class: "btn-confirmacion",
            callback: function (data) {
                console.log(ifnull(data));
                alert(1)
            }

        }
    ],
    timeOut: { time: 600 } // estable tiempo de esperar [probablemente aun sin configurar pero funcional]
})
