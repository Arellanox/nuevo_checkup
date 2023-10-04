//Tbla donde se vizualiza los Médicos tratantes ya registrados en la base de datos
tablaPacientesTratantes = $("#tablaPacientesTratantes").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataPacientesTratantes);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/medicos_tratantes_api.php`,
        beforeSend: function () {
        },
        complete: function () {
            tablaPacientesTratantes.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        {
            data: 'COUNT'
        },
        {
            data: 'PX'
        },
        {
            data: 'CLIENTE'
        },
        {
            data: 'FECHA_RECEPCION'
        },
        {
            data: 'PREFOLIO'
        },
        {
            data: 'ID_TURNO'
        },
        {
            data: 'GENERO'
        },
        {
            data: 'EDAD'
        },
        {
            data: 'CLIENTE_ID', render: function (data) {
                return `<i class="bi bi-trash eliminar-diagnostico" data-id = "${data}" style = "cursor: pointer"
                onclick="desactivarTablaMedicosTratantes.call(this)"></i>`;

            }
        },
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Nombre del Paciente', className: 'all' },
        { target: 2, title: 'Procedencia', className: 'all' },
        { target: 3, title: 'Fecha de recepcion', className: 'all' },
        { target: 4, title: 'Prefolio', className: 'all' },
        { target: 5, title: 'Turno', className: 'none' },
        { target: 6, title: 'Edad', className: 'none' },
        { target: 7, title: 'Sexo', className: 'none' },
        {
            targets: 8,
            title: '#',
            className: 'all actions',
            width: '1%',
            data: null,
            defaultContent: `
        <div class="d-flex d-lg-block align-items-center" style="max-width: max-content; padding: 0px;">
            <div class="d-flex flex-wrap flex-lg-nowrap align-items-center">
                <i class="bi bi-clipboard btn-vizu-reporte d-block" style="cursor: pointer; font-size:16px;padding: 2px 4px;"></i>
            </div>
        </div>
    `
        }
    ]
})


inputBusquedaTable('tablaPacientesTratantes', tablaPacientesTratantes, [], [], 'col-18')

//Funcion para eliminar los medicos tratantes
// function desactivarTablaMedicosTratantes() {
//     var id_medico = $(this).data("id");
// btn-vizu-reporte

selectTable('#TablaRecepcionPacientes-Ingresados', tablaRecepcionPacientesIngrersados,
    {
        unSelect: true, dblClick: true, movil: true, reload: ['col-12 col-xl-9'],
        tabs: [
            {
                title: 'Pacientes',
                element: '#tab-paciente',
                class: 'active',
            },
            {
                title: 'Información',
                element: '#tab-informacion',
                class: 'disabled tab-select'
            },
        ],
        ClickClass: [
            {
                class: 'btn-editar',
                callback: function (data) {
                    if (array_selected != null) {
                        $("#ModalEditarPaciente").modal('show');
                    } else {
                        alertSelectTable();
                    }
                },
                selected: true,
            },
            {
                class: 'btn-cargar-documentos',
                callback: function (data) {
                    alertMsj({
                        icon: '',
                        title: 'Documentación del paciente <i class="bi bi-info-circle" data-bs-toggle="tooltip" data-bs-placement="top" title="Cargue/Guarde la documentación del paciente"></i>',
                        footer: 'Seleccione una opción.',
                        html: `
                <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px;" id="btn-perfil-paciente">
                  <i class="bi bi-person-bounding-box"></i> Foto de Perfil
                </button>
                <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-credencial-paciente">
                  <i class="bi bi-person-vcard-fill"></i> Credencial
                </button> 
                <button type="button" class="btn btn-hover me-2" style="margin-bottom:4px" id="btn-ordenes-paciente">
                  <i class="bi bi-files"></i> Ordenes médicas
                </button> 
            `,
                        showCancelButton: false,
                        showConfirmButton: false,
                        allowOutsideClick: true,
                    })
                },
                selected: true,
            },
            {
                class: 'btn-offcanva',
                callback: function (data) {
                    dobleClickSelectTableRecepcion(data);
                },
                selected: true,
            },
        ]
    },

    async function (select, data, callback) {
        if (select) {
            // return false;
            $(`#${'buttonBeneficiario'}`).attr('disabled', ifnull(data, false, ['CLIENTE_ID']) == '18' ? false : true)
            $(`#${'btn_recepcionTicket'}`).attr('disabled', ifnull(data, false, ['COMPLETADO']) == '1' && ifnull(data, false, ['CLIENTE_ID']) == '1' ? false : true)

            // if (select['CLIENTE_ID'] == 18) {
            //   $('#buttonBeneficiario').attr('disabled', false)
            // } else {
            //   $('#buttonBeneficiario').attr('disabled', true);
            // }

            obtenerPanelInformacion(data['ID_TURNO'], 'paciente_api', 'paciente')
            obtenerPanelInformacion(data['ID_TURNO'], 'consulta_api', 'listado_resultados', '#panel-resultados')
            obtenerPanelInformacion(data['ID_TURNO'], false, 'area_faltantes', '#panel-areas-faltantes')
            await obtenerPanelInformacion(1, false, 'Estudios_Estatus', '#estudios_concluir_paciente')

            if (data['COMPLETADO'] == 1) {
                $('#contenedor-btn-cerrar-paciente').html(`
        <button type="button" class="btn btn-pantone-325 me-2" style="margin-bottom:4px" disabled>
            <i class="bi bi-person-check"></i> Paciente Cerrado
        </button>
        `)
            } else if (data['COMPLETADO'] == 2) {
                $('#contenedor-btn-cerrar-paciente').html(`
        <button type="button" class="btn btn-borrar me-2" style="margin-bottom:4px" id="btn-facturar"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Necesita actualizar datos de factura">
            <i class="bi bi-person-check"></i> Actualizar Factura
        </button>
    `)
            } else {
                $('#contenedor-btn-cerrar-paciente').html(`
        <button type="button" class="btn btn-pantone-325 me-2" style="margin-bottom:4px" id="btn-concluir-paciente"
            data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="Finaliza el proceso del paciente">
            <i class="bi bi-person-check"></i> Finalizar Paciente
        </button>
    `)
            }

            callback('In')
        } else {
            callback('Out')
            $(`#${'buttonBeneficiario'}`).attr('disabled', true);
            $(`#${'btn_recepcionTicket'}`).attr('disabled', true);
            obtenerPanelInformacion(0, 'paciente_api', 'paciente')
            obtenerPanelInformacion(0, 'consulta_api', 'listado_resultados', '#panel-resultados')
            obtenerPanelInformacion(0, false, 'Estudios_Estatus', '#estudios_concluir_paciente')
            obtenerPanelInformacion(0, false, 'area_faltantes', '#panel-areas-faltantes')
        }
    }, function (select, data) {
        dobleClickSelectTableRecepcion(data);
    }
)
//         ajaxAwait(dataJson_eliminarMedico, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
//             alertToast('Médico tratante eliminado!', 'success', 4000)
//             tablaPacientesTratantes.ajax.reload();
//         })
//     }, 1)
// }