var columnasRecepcionPacientesFranquicia = [
    {data: 'COUNT'},
    {data: 'NOMBRE_COMPLETO'},
    {
        data: null, render: function () {
            let html = '';

            if (hash === 'pendientes') {
                // Render buttons for accepting or rejecting a pending item.
                html = `<div class="row">
                            <div class="col-6" style="padding: 0">
                              <button type="button" class="btn-aceptar btn btn-pantone-7408" style="font-size: 20px;margin: 0;padding: 1px 8px 1px 8px;">
                                <i class="bi bi-person-check-fill btn-aceptar"></i> 
                              </button>
                            </div>
                            <div class="col-6" style="padding: 0">
                              <button type="button" class="btn-rechazar btn btn-borrar" style="font-size: 20px; margin: 0; padding: 1px 8px 1px 8px;">
                               <i class="bi bi-person-dash-fill btn-rechazar"></i>
                              </button>
                            </div>
                          </div>`;
            } else {
                // Render button for marking an item as pending.
                html = `<div class="row">
                         <div class="col-6" style="padding: 0">
                           <button type="button" class="btn-pendiente btn btn-pantone-7408" style="font-size: 20px; margin: 0; padding: 1px 8px 1px 8px;">
                            <i class="bi bi-person-lines-fill btn-pendiente"></i>
                           </button>
                         </div>
                       </div>`;
            }

            return html;
        }
    },
    {data: 'PREFOLIO'},
    {data: 'NOMBRE_COMERCIAL'},
    {
        data: 'FECHA_AGENDA',
        render: function (data) {
            return formatoFecha2(data, [0, 1, 5, 1, 0, 0, 0], null);
        }
    },
    {
        data: null, render: function () {
            return `
                    <div class="row">
                      <div class="col-12" style="max-width: max-content; padding: 0;">
                          <i class="bi bi-pencil-square btn-editar" style="cursor: pointer; font-size:18px;padding: 2px 5px;"></i>
                      </div>
                    </div>
                `
        }
    },
    {data: 'GENERO'}
];

var columasDefRecepcionPacientesFranquicia = [
    {target: 0, title: '#', width: '1%', class: 'all'},
    {target: 1, title: 'Nombre', width: '13%', class: 'all'},
    {target: 2, title: 'Ingreso', width: '1%', class: 'all'},
    {target: 3, title: 'Prefolio', width: '8%', class: 'min-tablet'},
    {target: 4, title: 'Procedencia', width: '14%', class: 'min-tablet'},
    {target: 5, title: 'Agenda', width: '6%', class: 'min-tablet'},
    {target: 6, title: '...', width: '1%', class: 'all'},
    {target: 7, title: 'Genero', width: '6%', class: 'none'},
]

tablaRecepcionPacientes = $('#TablaRecepcionPacientes').DataTable({
    language: {url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",},
    scrollY: '65vh',
    scrollCollapse: true,
    deferRender: true,
    lengthMenu: [
        [10, 15, 20, 25, 30, 35, 40, 45, 50, -1],
        [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]
    ],
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataRecepcion);
        },
        method: 'POST',
        url: '../../../api/recepcion_api.php',
        beforeSend: function () {
            loader("In")

            array_selected = null
        },
        complete: function () {
            loader("Out")
            tablaRecepcionPacientes.columns.adjust().draw()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            loader("Out")
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: isFranquisiario ? columnasRecepcionPacientesFranquicia : [
        {data: 'COUNT'},
        {data: 'NOMBRE_COMPLETO'},
        {
            data: null, render: function () {
                let html = '';
                if (hash === 'pendientes') {
                    html = `<div class="row">
          <div class="col-6" style="padding: 0px">
            <button type="button" class="btn-aceptar btn btn-pantone-7408" style="font-size: 20px;margin: 0px;padding: 1px 8px 1px 8px;">
              <i class="bi bi-person-check-fill btn-aceptar"></i> 
            </button>
          </div>
          <div class="col-6" style="padding: 0px">
            <button type="button" class="btn-rechazar btn btn-borrar" style="font-size: 20px; margin: 0px; padding: 1px 8px 1px 8px;">
             <i class="bi bi-person-dash-fill btn-rechazar"></i>
            </button>
          </div>
        </div>`;
                } else {
                    html = `<div class="row">
          <div class="col-6" style="padding: 0px">
            <button type="button" class="btn-pendiente btn btn-pantone-7408" style="font-size: 20px; margin: 0px; padding: 1px 8px 1px 8px;">
             <i class="bi bi-person-lines-fill btn-pendiente"></i>
            </button>
          </div>
        </div>`;
                }

                return html;
            }
        },
        {data: 'PREFOLIO'},
        {data: 'NOMBRE_COMERCIAL'},
        {data: 'DESCRIPCION_SEGMENTO'},
        {
            data: 'FECHA_AGENDA',
            render: function (data) {
                return formatoFecha2(data, [0, 1, 5, 1, 0, 0, 0], null);
            }
        },
        {
            data: null, render: function () {
                let html = `
          <div class="row">
            <div class="col-12" style="max-width: max-content; padding: 0px;">
              <i class="bi bi-pencil-square btn-editar" style="cursor: pointer; font-size:18px;padding: 2px 5px;"></i>
            </div>
        `;
                html += `</div>`;
                return html
            }
        },
        {data: 'GENERO'}
    ],
    columnDefs: isFranquisiario ? columasDefRecepcionPacientesFranquicia : [
        {target: 0, title: '#', width: '1%', class: 'all'},
        {target: 1, title: 'Nombre', width: '13%', class: 'all'},
        {target: 2, title: 'Ingreso', width: '1%', class: 'all'},
        {target: 3, title: 'Prefolio', width: '8%', class: 'min-tablet'},
        {target: 4, title: 'Procedencia', width: '14%', class: 'min-tablet'},
        {target: 5, title: 'Segmento', width: '6%', class: 'desktop'},
        {target: 6, title: 'Agenda', width: '6%', class: 'min-tablet'},
        {target: 7, title: '...', width: '1%', class: 'all'},
        {target: 8, title: 'Genero', width: '6%', class: 'none'},
    ],
});

inputBusquedaTable('TablaRecepcionPacientes', tablaRecepcionPacientes, [
    {
        msj: 'Filtra la tabla con palabras u oraciones que coincidan en el campo de busqueda',
        place: 'left'
    },
])

selectTable('#TablaRecepcionPacientes', tablaRecepcionPacientes, {
    unSelect: true, reload: ['col-xl-9'], movil: true,
    tabs: [
        {
            title: 'Pacientes',
            element: '#tab-paciente-espera',
            elementClass: 'tab-first-espera',
            class: 'active',
        },
        {
            title: 'Información',
            element: '#tab-informacion-espera',
            elementClass: 'tab-second-espera',
            class: 'disabled tab-select'
        },
    ],
    ClickClass: [
        {
            class: 'btn-aceptar',
            callback: (data) => { onIngresarPaciente(data); },
            selected: true
        },
        {
            class: 'btn-rechazar',
            callback: function (data) {
                if (data != null) {
                    array_selected = data
                    $("#modalPacienteRechazar").modal('show');
                } else {
                    alertSelectTable();
                }
            }, selected: true
        },
        {
            class: 'btn-pendiente',
            callback: function (data) {
                //if (!validarPermiso('RepIngPaci', 1)) return false;

                array_selected = data

                alertMensajeConfirm({
                    title: '¿Está Seguro de regresar al paciente en espera?',
                    text: "¡Sus estudios anteriores no se cargarán!",
                    icon: 'warning',
                    confirmButtonText: 'Si, colocarlo en espera',
                }, () => {
                    ajaxAwait({
                        id_turno: data['ID_TURNO'],
                        api: 2
                    }, 'recepcion_api', {callbackAfter: true}, false, () => {
                        alertMensaje('info', '¡Paciente en espera!', 'El paciente se cargó en espera.');
                        try {
                            tablaRecepcionPacientes.ajax.reload();
                        } catch (e) {
                            console.log(e.message);
                        }

                        try {
                            tablaRecepcionPacientesIngrersados.ajax.reload();
                        } catch (e) {
                            console.log(e.message);
                        }
                    })
                }, 1);
            }
        },
        {
            class: 'btn-editar',
            callback: function (data) {
                if (data != null) {
                    array_selected = data
                    $("#ModalEditarPaciente").modal('show');
                } else alertSelectTable();
            },
            selected: true,
        },
    ],
    timeOut: {time: 600} // estable tiempo de esperar [probablemente aun sin configurar pero funcional]
}, async function (select, data, callback) {
    callback('In')
    if (select) {
        obtenerPanelInformacion(data['ID_TURNO'], 'pacientes_api', 'paciente')
    } else obtenerPanelInformacion(0, 'pacientes_api', 'paciente')

    if (array_selected['CLIENTE_ID'] === 18) {
        $('#buttonBeneficiario').fadeIn(200)
    } else $('#buttonBeneficiario').fadeOut(200);

})