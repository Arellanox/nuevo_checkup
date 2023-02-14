class CatalogoModal {

    CONTENT;
    dataSelect;
    columnsData;
    ajax;
    columnsDefData;
    tagTable;
    createdRow;

    constructor(
        CONTENT = {
            divContenedor,
            titulos: {
                IDSDIVS: 'Nuevo',
                HeaderTitle: 'Catalogo de especialidades',
            },
            formLabels: {
                DESCRIPCION: {
                    LABEL: 'Nombre de especialidad',
                    STRING: 'DESCRIPCION',
                    CLASS: {
                        input: '',
                        div: 'col-12'
                    }
                }
            },
            tableContent: {
                COUNT: {
                    HEADER: '#',
                    ID: 'COUNT',
                    CLASS: ''
                },
                DESCRIPCION: {
                    HEADER: 'DESCRIPCION',
                    ID: 'DESCRIPCION',
                    CLASS: ''
                },
                ACTIVO: {
                    HEADER: '<i class="bi bi-collection"></i>',
                    ID: 'ACTIVO',
                    CLASS: ''
                }
            },
            diseño: {
                MODALCLASS: 'modal-lg modal-dialog-centered modal-dialog-scrollable',
            },
        },
        columnsData = [
            { data: 'COUNT' },
            { data: 'DESCRIPCION' },
            {
                data: 'ACTIVO', render: function (data) {
                    if (data == 1) {
                        return '<i class="bi bi-check-circle"></i>';
                    } else {
                        return '<i class="bi bi-x-circle"></i>';
                    }
                }
            }
        ],

        //Automatico
        ajax = {
            data: {
                api: 2, ACTIVO: 1
            },
            api_url: '',
            dataSrc: 'response.data',
        },
        ID
        columnsDefData = [
            {
                "width": "3px",
                "targets": 0
            },
        ],
        tagTable = {
            table_id: `Tabla${this.CONTENT['titulos']['IDSDIVS']}`,
            titulo: `${this.CONTENT['titulos']['IDSDIVS']}`

        },
        configTable = {
            processing: true,
            autoWidth: false,
            searching: false,
            info: false,
            paging: false,
            scrollY: '30vh',
            scrollCollapse: true,
        },

        createdRow = {
            IDCOMPARADOR: 'ACTIVO',
            VALUE: 1,
            CLASSTRUE: 'bg-success text-white',
            CLASSFALSE: 'bg-danger text-white'
        }

    ) {
        this.CONTENT = CONTENT;
        this.columnsData = columnsData;
        this.ajax = ajax;
        this.columnsDefData = columnsDefData;
        this.tagTable = tagTable;
        this.createdRow = createdRow;


        this.getHTMLCatalogo(this.CONTENT['divContenedor'], this.CONTENT['titulos'], this.CONTENT['formLabels'], this.CONTENT['tableContent'], this.CONTENT['diseño'])

        setTimeout(() => {
            this.getTableControlador(this.tagTable, this.ajax, this.createdRow, this.columnsData, this.columnsDefData)
        }, 200);
    }



    //Modal de catalogos
    getHTMLCatalogo(divContenedor, titulos, formLabels, tableContent, diseño,) {
        return new Promise(resolve => {
            //Plantilla 
            html = '<div class="modal fade" id="modalRegistrar' + titulos['IDSDIVS'] + '" tabindex="-1" aria-hidden="true" data-bs-backdrop="static"' +
                'data-bs-keyboard="false">' +
                '<div class="modal-dialog' + diseño['MODALCLASS'] + '">' +
                '<div class="modal-content">';

            //Header
            html += '<div class="modal-header header-modal">' +
                '<h5 class="modal-title">' + firstMayus(titulos['HeaderTitle']) + '</h5>' +
                '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>' +
                '</div>';

            //Cuerpo
            html += '<div class="modal-body" id="' + titulos['IDSDIVS'] + '-body">' +
                '<p class="none-p">Edite un registro dando doble click <i class="bi bi-pencil"></i></p>' +
                '<div class="row mt-3">' +

                //Tabla contenido
                '<div class="col-6">' +
                '<table class="table table-hover tableContenido" id="Tabla' + titulos['IDSDIVS'] + '" style="width:100%">' +
                '<thead class="">' +
                '<tr>';

            //th
            for (const key in tableContent) {
                if (Object.hasOwnProperty.call(tableContent, key)) {
                    const th = tableContent[key];
                    html += '<th scope="col d-flex justify-content-center" class="' + th['CLASS'] + '">' + th['HEADER'] + '</th>';
                    // '<th scope="col d-flex justify-content-center">' + firstMayus(titulo) + '</th>' +
                    // '<th scope="col d-flex justify-content-center"><i class="bi bi-collection"></i></th>';
                }
            }

            //Cierre tabla
            html += '</tr> </thead>' +
                '<tbody>' +
                '</tbody>' +
                '</table>' +
                '</div>' +
                //

                //Formularios Registrar
                '<div class="col-6" id="RegistrarMetodo' + titulos['IDSDIVS'] + '">' +
                '<p>Crear nuevo registro:</p>' +
                '<form class="row" id="formRegistrar' + titulos['IDSDIVS'] + '">';

            //LABELS
            for (const key in formLabels) {
                if (Object.hasOwnProperty.call(formLabels, key)) {
                    const input = formLabels[key];
                    html += '<div class="' + input['CLASS']['div'] + '">' +
                        '<label for="' + input['STRING'] + '" class="form-label">' + input['LABEL'] + '</label>' +
                        '<input type="text" name="' + input['STRING'] + '" required value="" class="form-control input-form">' +
                        '</div>';
                }
            }

            //Botones
            html += '<div class="text-center">' +
                '<button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">' +
                '<i class="bi bi-send-plus"></i> Guardar' +
                '</button>' +
                '</div>' +
                '</form>' +
                '</div>' +
                //

                //Formulario Actualizar
                '<div class="col-6" id="editarMetodo' + titulos['IDSDIVS'] + '" style="display:none">' +
                '<p>Actualizar registro:</p>' +
                '<form class="row" id="formEditar' + titulos['IDSDIVS'] + '">';

            //LABELS
            for (const key in formLabels) {
                if (Object.hasOwnProperty.call(formLabels, key)) {
                    const input = formLabels[key];
                    html += '<div class="col-12">' +
                        '<label for="' + input['STRING'] + '" class="form-label">' + input['LABEL'] + '</label>' +
                        '<input type="text" name="' + input['STRING'] + '" required id="edit-' + formLabels['DESCRIPCION']['STRING'] + '-input" class="form-control input-form">' +
                        '</div>';
                }
            }

            //Botones
            html += '<div class="text-center">' +
                '<button type="submit" class="btn btn-hover me-2" style="margin-bottom:4px">' +
                '<i class="bi bi-pencil-square"></i> Actualizar' +
                '</button>' +
                '<button type="button" class="btn btn-hover btn-activo me-2" style="margin-bottom:4px; display: none" id="desactivar-' + titulos['IDSDIVS'] + '">' +
                '<i class="bi bi-collection"></i> Desactivar' +
                '</button>' +
                '<button type="button" class="btn btn-hover btn-activo me-2" style="margin-bottom:4px; display: none" id="activar-' + titulos['IDSDIVS'] + '">' +
                '<i class="bi bi-collection"></i> Activar' +
                '</button>' +
                '</div>' +
                '</form>' +
                '</div>' +
                //

                '</div>' + // Etiquetas de cierres
                '</div>';

            //Footer
            html += '<div class="modal-footer">' +
                '<button type="button" class="btn btn-cancelar" data-bs-dismiss="modal"><i class="bi bi-arrow-left-short"></i>' +
                'Cerrar</button>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            //Crea el html en DOM
            $(divContenedor).html(html);
        })
    }

    getTableControlador(tagTable, ajax, createdRow, columnsData, columnsDefData) {
        let TablaContenido = $(tagTable['table_id']).DataTable({
            processing: configTable['processing'],
            language: {
                url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
                loadingRecords: '&nbsp;',
                processing: '<div class="spinner"></div>'
            },
            lengthMenu: [
                [5, 10, -1],
                [5, 10, "All"]
            ],
            autoWidth: configTable['autoWidth'],
            searching: configTable['searching'],
            lengthChange: configTable[''],
            info: configTable['info'],
            paging: configTable['paging'],
            scrollY: configTable['scrollY'],
            scrollCollapse: configTable['scrollCollapse'],
            ajax: {
                dataType: 'json',
                data: ajax['data'],
                method: 'POST',
                url: http + servidor + "/nuevo_checkup/api/" + ajax['api_url'] + ".php",
                beforeSend: function () { },
                // success: function (data) { mensajeAjax(data) },
                complete: function () { this.cambiarFormMetodo(0, titulo, "formEditar" + titulo); },
                dataSrc: ajax['dataSrc']
            },
            createdRow: function (row, data, dataIndex) {
                // mensajeAjax(data)
                if (data[createdRow['IDCOMPARADOR']] == createdRow['VALUE']) {
                    $(row).addClass(createdRow['CLASSTRUE']);
                } else {
                    $(row).addClass(createdRow['CLASSFALSE']);
                }
            },
            columns: columnsData,
            columnDefs: columnsDefData,

        });


        selectDatatabledblclick(function (select, data) {
            this.dataSelect = data;
            $('.btn-activo').fadeOut()
            $('.btn-activo').prop('disabled', true);
            if (!select) {
                this.cambiarFormMetodo(0, tagTable['titulo'], "formEditar" + tagTable['titulo']);
            } else {
                switch (this.dataSelect.ACTIVO) {
                    case 1: case '1':
                        $('#desactivar-' + tagTable['titulo']).fadeIn(100);
                        setTimeout(() => {
                            $('#desactivar-' + tagTable['titulo']).prop('disabled', false);
                        }, 100);
                        break;
                    case 0: case '0':
                        $('#activar-' + tagTable['titulo']).fadeIn(100);
                        setTimeout(() => {
                            $('#activar-' + tagTable['titulo']).prop('disabled', false);
                        }, 100);
                        break;
                }
                document.getElementById("edit-" + tagTable['titulo'] + "-descripcion").value = this.dataSelect['DESCRIPCION'];
                this.cambiarFormMetodo(1, tagTable['titulo']);
            }
        }, tagTable['table_id'], TablaContenido)

        //Correccion de header
        let modal = $('#modalRegistrar' + tagTable['titulo']);
        modal.on('shown.bs.modal', function (e) {
            TablaContenido.ajax.reload();
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        })
    }


    getButtonAccion(titulo, api_url,) {
        //Formulario de registro de cargo
        $("#formRegistrar" + titulo).submit(function (event) {
            event.preventDefault();
            /*DATOS Y VALIDACION DEL REGISTRO*/
            var form = document.getElementById("formRegistrar" + titulo);
            var formData = new FormData(form);
            formData.set('api', 1);

            alertMensajeConfirm({
                title: '¿Está seguro que todos los datos están correctos?',
                text: "No podrá eliminar el registro",
                icon: 'warning'
            }, function () {
                $.ajax({
                    data: formData,
                    url: http + servidor + "/nuevo_checkup/api/" + api_url + ".php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (data) {
                        if (mensajeAjax(data)) {
                            alertToast('¡' + firstMayus(titulo) + ' registrado!', 'success')
                            document.getElementById("formRegistrar" + titulo).reset();
                            TablaContenido.ajax.reload();
                            cambiarFormMetodo(0, titulo, "formEditar" + titulo);
                            // selectMetodo()
                        }
                    },
                    error: function (jqXHR, exception, data) {
                        alertErrorAJAX(jqXHR, exception, data)
                    },
                });
            }, 1)
            event.preventDefault();
        });


        //Formulario de actualizar cargo
        $("#formEditar" + titulo).submit(function (event) {
            event.preventDefault();
            /*DATOS Y VALIDACION DEL REGISTRO*/
            var form = document.getElementById("formEditar" + titulo);
            var formData = new FormData(form);
            formData.set(registro_id, this.dataSelect[registro_id])
            formData.set('api', 1);

            alertMensajeConfirm({
                title: '¿Está seguro de cambiar la descripcion?',
                text: "¡Se cambiará en todas las vistas!",
                icon: 'warning'
            }, function () {
                //$("#btn-registrarse").prop('disabled', true);
                // Esto va dentro del AJAX
                $.ajax({
                    data: formData,
                    url: http + servidor + "/nuevo_checkup/api/" + api_url + ".php",
                    type: "POST",
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    success: function (data) {
                        if (mensajeAjax(data)) {
                            alertToast('¡' + firstMayus(titulo) + ' actualizado!', 'success')
                            document.getElementById("formEditar" + titulo).reset();
                            TablaContenido.ajax.reload();
                            cambiarFormMetodo(0, titulo, "formEditar" + titulo);
                            // selectMetodo()
                        }
                    },
                    error: function (jqXHR, exception, data) {
                        alertErrorAJAX(jqXHR, exception, data)
                    },
                });
            }, 1)
            event.preventDefault();
        });

        //Desactivar valor
        $('#desactivar-' + titulo).click(function () {
            if (this.dataSelect != null) {
                alertMensajeConfirm({
                    title: "¿Está seguro que desea desactivar este registro?",
                    text: "No podrán volver a elegir el registro",
                    icon: 'warning',
                }, function () {
                    $.ajax({
                        data: {
                            id: this.dataSelect[registro_id],
                            api: 4,
                            ACTIVO: 0
                        },
                        url: http + servidor + "/nuevo_checkup/api/" + api_url + ".php",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if (mensajeAjax(data)) {
                                alertToast('¡' + firstMayus(titulo) + ' eliminado!', 'success')
                                document.getElementById("formEditar" + titulo).reset();
                                TablaContenido.ajax.reload();
                                cambiarFormMetodo(0, titulo, "formEditar" + titulo);
                            }
                        },
                        error: function (jqXHR, exception, data) {
                            alertErrorAJAX(jqXHR, exception, data)
                        },
                    });
                }, 1)
            } else {
                alertSelectTable();
            }
        })

        //Desactivar valor
        $('#activar-' + titulo).click(function () {
            if (this.dataSelect != null) {
                alertMensajeConfirm({
                    title: "¿Está seguro que desea desactivar este registro?",
                    text: "No podrán volver a elegir el registro",
                    icon: 'warning',
                }, function () {
                    $.ajax({
                        data: {
                            id: this.dataSelect[registro_id],
                            api: 4,
                            ACTIVO: 1
                        },
                        url: http + servidor + "/nuevo_checkup/api/" + api_url + ".php",
                        type: "POST",
                        dataType: 'json',
                        success: function (data) {
                            if (mensajeAjax(data)) {
                                alertToast('¡' + firstMayus(titulo) + ' eliminado!', 'success')
                                document.getElementById("formEditar" + titulo).reset();
                                TablaContenido.ajax.reload();
                                cambiarFormMetodo(0, titulo, "formEditar" + titulo);
                            }
                        },
                        error: function (jqXHR, exception, data) {
                            alertErrorAJAX(jqXHR, exception, data)
                        },
                    });
                }, 1)
            } else {
                alertSelectTable();
            }
        })
    }


    cambiarFormMetodo(fade, titulo, form = "formEditar") {
        if (fade == 1) {
            $('#RegistrarMetodo' + titulo).fadeOut();
            setTimeout(function () {
                $('#editarMetodo' + titulo).fadeIn();
            }, 400);
        } else {
            document.getElementById(form).reset();
            $('#editarMetodo' + titulo).fadeOut();
            setTimeout(function () {
                $('#RegistrarMetodo' + titulo).fadeIn();
            }, 400);
        }
    }

}
