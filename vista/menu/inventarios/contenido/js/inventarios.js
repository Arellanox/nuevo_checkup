$(document).ready(function(){

     // Oculta el botón de agregar al cargar la página
        $('#btnAgregar').hide();

    // Al hacer clic en un enlace del menú
    $('.vertical-menu a').on('click', function(e) {
        e.preventDefault(); // Evita que el enlace navegue

        // Obtiene el ID del div que debe mostrarse
        var targetDiv = $(this).data('target');

        // Oculta todos los divs con la clase 'content-module'
        $('.content-module').hide();

       // Oculta el menú principal
        $('#tab-menu').hide();

        // Muestra el botón de agregar solo si el div es 'moduloCatArticulos'
        if (targetDiv == 'moduloCatArticulos') {
            $('#btnAgregar').show();
        } else {
            $('#btnAgregar').hide();
        }
        
        // Muestra el div correspondiente al enlace clicado
        $('#' + targetDiv).show();

    });

     // Agrega el botón para regresar a cada módulo de contenido
    $('.content-module').each(function() {
        if ($(this).find('.btn-back-menu').length === 0) {
            $(this).prepend('<div class="text-start"><button type="button" class="btn btn-secondary btn-back-menu"><i class="bi bi-arrow-left"></i> Regresar</button></div>');
        }
    });

    // Al hacer clic en el botón regresar
    $(document).on('click', '.btn-back-menu', function() {
        $('.content-module').hide();
        $('#tab-menu').show();
        $('#btnAgregar').hide();
    });

    // ocultar/mostrar fecha de caducidad segun el checkbox y que sea obligatorio
    $('#maneja_caducidad').trigger('change');
});

$('#maneja_caducidad').on('change', function() {
    if ($(this).val() == '1') {
        $('#fechaCaducidadDiv').show();
        $('#fecha_caducidad').attr('required', true);
    } else {
        $('#fechaCaducidadDiv').hide();
        $('#fecha_caducidad').val('');
        $('#fecha_caducidad').removeAttr('required');
        $('#fecha_caducidad').removeClass('is-invalid');
    }
});

// ARTICULOS
tableCatArticulos = $('#tableCatArticulos').DataTable({
    autoWidth: true,
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: true,
    sorting: true,
    scrollY: '68vh',
    scrollX: true,
    scrollCollapse: true,
    fixedHeader: true,
    ajax: {
        dataType: 'json',
        data: function(d){
            return $.extend(d, dataTableCatArticulos);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/inventarios_api.php',
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    // createdRow: function (row, data, dataIndex) {
    //     if (data.FINALIZADO == 0) {
    //         $(row).addClass('bg-warning text-black');
    //     } else if (data.FINALIZADO == 1) {
    //     }
    // },
    columns: [
        { data: 'NO_ART' },
        { data: 'CLAVE_ART' },
        {
            data: 'IMAGEN',
            render: function(data, type, row) {
                if (data) {
                    return '<a href="' + data + '" target="_blank"><img src="' + data + '" alt="Imagen del Artículo" style="width: 50px; height: auto;"/></a>';
                } else {
                    return '';
                }
            },
            className: 'text-center'
        },
        { data: 'NOMBRE_COMERCIAL' },
        { 
            data: 'COSTO_ULTIMA_ENTRADA',
            render: function(data, type, row) {
                if ($.isNumeric(data)) {
                    return '$' + Number(data).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                } else {
                    return '$0.00';
                }
            }
        },
        {
            data: 'FECHA_ULTIMA_ENTRADA',
            render: function(data, type, row) {
                if (
                    data &&
                    data !== "0000-00-00" &&
                    data !== "0000-00-00 00:00:00"
                ) {
                    return data.split(' ')[0];
                } else {
                    return '';
                }
            }
        },
        //{ data: 'ESTATUS' },
        {
            data: 'ESTATUS',
            render: function(data, type, row){
                if (data == 0) {
                    return '<i class="bi bi-toggle-off fs-4"></i>';
                } else {
                    return '<i class="bi bi-toggle-on fs-4 text-success"></i>';
                }
            }
        },
        {
            data: 'RED_FRIO',
            render: function(data, type, row) {
                if (data == 1) {
                    return '<i class="bi bi-snow2 text-primary fs-4" title="Refrigerado"></i>';  // Ícono de copo de nieve en azul
                } else {
                    return '<i class="bi bi-thermometer-half text-warning fs-4" title="Temperatura ambiente"></i>';  // Ícono de termómetro en rojo
                }
            },
            className: 'text-center'
        },
        { data: 'UNIDAD_VENTA' },
        { data: 'UNIDAD_MINIMA' },
        { data: 'CONTENIDO' },
        { data: 'TIPO_DESCRIPCION' },
        {
            data: 'MANEJA_CADUCIDAD',
            render: function (data, type, row) {
                if (data == 1) {
                    return '<i class="bi bi-check-circle-fill text-success"></i>';
                } else {
                    return '<i class="bi bi-x-circle-fill text-danger"></i>';
                }
            },
            className: 'text-center'
        },
        {
            data: 'FECHA_CADUCIDAD',
            render: function(data, type, row) {
                if (
                    data &&
                    data !== "0000-00-00" &&
                    data !== "0000-00-00 00:00:00"
                ) {
                    return data;
                } else {
                    return '';
                }
            }
        },
        { data: 'AREA' },
        { 
            data: 'COSTO_MAS_ALTO',
            render: function(data, type, row) {
                if ($.isNumeric(data)) {
                    return '$' + Number(data).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                } else {
                    return '$0.00';
                }
            }
        },
        { 
            data: 'INSERTO',
            render: function(data, type, row) {
                if (data) {
                    return '<a href="' + data + '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></a>';
                } else {
                    return data;
                }
            },
            className: 'text-center'
        },
        { 
            data: 'PROCEDIMIENTO_PRUEBA',
            render: function(data, type, row) {
                if (data) {
                    return '<a href="' + data + '" target="_blank"><i class="bi bi-file-earmark-pdf-fill text-danger fs-4"></i></a>';
                } else {
                    return '';
                }
            },
            className: 'text-center'
        },
 
        // { data: 'MONTO_ACTUAL' },
        // // {
        // //     data: 'FECHA_CREACION', render: function (data) {
        // //         return formatoFecha2(data, [0, 1, 3, 1]);
        // //     }
        // // },
        // {
        //     data: 'RESPONSABLE_NOMBRE'
        // }
       
    ],
    columnDefs: [
        { target: 0, title: 'No. Art', className: 'all' },
        { target: 1, title: 'Clave Art', className: 'all' },
        { target: 2, title: 'Artículo', className: 'all'},
        { target: 3, title: 'Nombre comercial', className: 'all' },
        { target: 4, title: 'Costo última entrada', className: 'all' },
        { target: 5, title: 'Fecha última entrada', className: 'all' },
        { target: 6, title: 'Estatus', className: 'all' },
        { target: 7, title: 'Red frío', className: 'all' },
        { target: 8, title: 'Unid. venta', className: 'all' },
        { target: 9, title: 'Unid. mínima', className: 'all'},
        { target: 10, title: 'Contenido', className: 'all'},
        { target: 11, title: 'Tipo', className: 'all'},
        { target: 12, title: 'Maneja caducidad', className: 'all'},
        { target: 13, title: 'Fecha caducidad', className: 'all'},
        { target: 14, title: 'Área', className: 'all'},
        { target: 15, title: 'Costo más alto', className: 'all'},
        { target: 16, title: 'Inserto', className: 'all'},
        { target: 17, title: 'Proc. de prueba', className: 'all'},
    ],
    dom: 'Bl<"dataTables_toolbar">frtip',
    buttons: [
        {
            // BOTON PARA EDITAR
            text: '<i class="bi bi-pencil-square"></i> Editar',
            className: 'btn btn-secondary',
            attr: {
              //disabled: true,
              id: 'btnEditarArticulo',
              'data-bs-toggle': "tooltip",
              'data-bs-placement': "top",
              title: "Editar el artículo seleccionado",
              disabled: !userPermissions.canEdit
            },
            action: function () {
                if (rowSelected) {      
                    $("#editarArticuloModal").modal('show');
                    $('#editandoArticulo').text(` ${rowSelected.CLAVE_ART}`);

                    // Colocar los valores al formulario
                    $('#editarArticuloForm #no_art').val(rowSelected.NO_ART);
                    $('#editarArticuloForm #clave_art').val(rowSelected.CLAVE_ART);
                    $('#editarArticuloForm #nombre_comercial').val(rowSelected.NOMBRE_COMERCIAL);

                    if(rowSelected.ESTATUS == 1){
                        $('#editarArticuloForm #estatus').prop("checked", true);
                    } else {
                        $('#editarArticuloForm #estatus').prop("checked", false);
                    }
                    $('#editarArticuloForm #red_frio').val(rowSelected.RED_FRIO);
                    $('#editarArticuloForm #unidad_venta').val(rowSelected.UNIDAD_VENTA);
                    $('#editarArticuloForm #unidad_minima').val(rowSelected.UNIDAD_MINIMA);
                    $('#editarArticuloForm #contenido').val(rowSelected.CONTENIDO);
                    $('#editarArticuloForm #tipo_articulo').val(rowSelected.TIPO_ARTICULO_ID);
                    $('#editarArticuloForm #maneja_caducidad').val(rowSelected.MANEJA_CADUCIDAD);
                    
                    $('#editarArticuloForm #fecha_caducidad').val(rowSelected.FECHA_CADUCIDAD);
                    
                    //para mostrar la fecha de caducidad traida de la bd y si no maneja caducidad ocultar el campo
                    if (rowSelected.MANEJA_CADUCIDAD == 1) {
                        $('#editarArticuloForm #fecha_caducidad').closest('.mb-3').show();
                    } else {
                        $('#editarArticuloForm #fecha_caducidad').closest('.mb-3').hide();
                        $('#editarArticuloForm #fecha_caducidad').val('');
                    }
                    $('#editarArticuloForm #maneja_caducidad').off('change').on('change', function() {
                        if ($(this).val() == "1") {
                            $('#editarArticuloForm #fecha_caducidad').closest('.mb-3').show();
                        } else {
                            $('#editarArticuloForm #fecha_caducidad').closest('.mb-3').hide();
                            $('#editarArticuloForm #fecha_caducidad').val('');
                        }
                    });

                    $('#editarArticuloForm #fecha_ultima_entrada').val(
                        rowSelected.FECHA_ULTIMA_ENTRADA ? rowSelected.FECHA_ULTIMA_ENTRADA.split(' ')[0] : ''
                    );

                    $("#editarArticuloForm #area_id").val(rowSelected.AREA_ID);
                    $("#editarArticuloForm #costo_mas_alto").val(rowSelected.COSTO_MAS_ALTO);
                    $("#editarArticuloForm #costo_ultima_entrada").val(rowSelected.COSTO_ULTIMA_ENTRADA);
                    $("#editarArticuloForm #rendimiento_estimado").val(rowSelected.RENDIMIENTO_ESTIMADO);

                } else {
                    alertToast('Por favor, seleccione un artículo', 'info', 4000)
                }
            }
          },
          {
            // BOTON PARA ELIIMAR
            text: '<i class="bi bi-trash-fill"></i> Eliminar',
            className: 'btn btn-secondary',
            attr: {
                id: "btnEliminarArticulo",
                'data-bs-toggle': "tooltip",
                'data-bs-placement': "top",
                title: "Borrar un artículo permanentemente",
                disabled: !userPermissions.canDelete
            },
            action: function () {
                if(rowSelected){
                    // procedimiento para eliminar un articulo 
                    alertMensajeConfirm({
                        title: "Estás eliminando " + rowSelected.NOMBRE_COMERCIAL + "",
                        text: "¿Desea continuar?.",
                        icon: "warning"
                    },
                    function(){
                      ajaxAwait(
                        { 
                            api: 4,
                            id_articulo: rowSelected.ID_ARTICULO
                        },
                        'inventarios_api', 
                        { callbackAfter: true },
                        false,
                        function(data){
                            if(data.response.code == 1){
                                alertToast("Artículo eliminado!", "success", 4000)
                                tableCatArticulos.ajax.reload();
                            }
                        }
                
                    );
                    },1);

                } else {
                    alertToast('Por favor, seleccione un artículo', 'info', 4000)
                }
            }
          },
          {
            // BOTON PARA FILTRAR LA TABLA
            text: '<i class="bi bi-funnel"></i> Filtrar',
            className: 'btn btn-warning',
            attr: {
                id: "btnFiltrarArticulos",
                'data-bs-toggle': "tooltip",
                'data-bs-placement': "top",
                title: "Filtrar los artículos de la tabla"
            },
            action: function(){
                // procedimiento para filtrar la tabla
                $("#filtrarArticuloModal").modal('show');
            }
          }
    ]

});

selectDatatable('tableCatArticulos', tableCatArticulos,0,0,0,0, async function(select, dataClick){
    // CUANDO SELECCIONAN UNA FILA DE LA TABLA
    // ACTUALIZAMOS EL VALOR DE LA VARIABLE `rowSelected` con los de la fila seleccionada.
    rowSelected = dataClick;

}, async function(){
    // DOBLE CLICK
    // llenamos el modal de detalles para mostrarlo al usuario.
    $("#claveArticulo").text(rowSelected.CLAVE_ART);
    $("#costoUltimaEntrada").text(Number(rowSelected.COSTO_ULTIMA_ENTRADA).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));
    $("#costoMasAlto").text(Number(rowSelected.COSTO_MAS_ALTO).toLocaleString('es-MX', { minimumFractionDigits: 2, maximumFractionDigits: 2 }));

    //Ocultar la fecha de ultima entrada si no hay en detalles
    if (rowSelected.FECHA_ULTIMA_ENTRADA && rowSelected.FECHA_ULTIMA_ENTRADA !== "0000-00-00" && rowSelected.FECHA_ULTIMA_ENTRADA !== "0000-00-00 00:00:00") {
        $("#fechaUltimaEntrada").text(rowSelected.FECHA_ULTIMA_ENTRADA.split(' ')[0]);
    } else {
        $("#fechaUltimaEntrada").text('');
    }

    $("#unidadVenta").text(rowSelected.UNIDAD_VENTA);
    $("#unidadMinima").text(rowSelected.UNIDAD_MINIMA);
    $("#contenidoDetalle").text(rowSelected.CONTENIDO);
    $("#tipo").text(rowSelected.TIPO_DESCRIPCION);
    $("#manejaCaducidad").html(rowSelected.MANEJA_CADUCIDAD == 1 ? '<i class="bi bi-check-circle-fill text-success"></i>' : '<i class="bi bi-x-circle-fill text-danger"></i>');

    // Ocultar la fecha de caducidad si no maneja caducidad en detalles
    if (rowSelected.FECHA_CADUCIDAD && rowSelected.FECHA_CADUCIDAD !== "0000-00-00" && rowSelected.FECHA_CADUCIDAD !== "0000-00-00 00:00:00") {
        $("#fechaCaducidad").text(rowSelected.FECHA_CADUCIDAD);
    } else {
        $("#fechaCaducidad").text('');
    }
    
    $('#estatusArt').html(rowSelected.ESTATUS == 1 ? '<span>ACTIVO</span>' : '<span>INACTIVO</span>');
    if(rowSelected.ESTATUS == 1){
        $('#estatusArt').addClass('bg-success-subtle');
        $('#estatusArt').removeClass('bg-dark-subtle');
    } else {
        $('#estatusArt').addClass('bg-dark-subtle');
        $('#estatusArt').removeClass('bg-success-subtle');
    }



    // EDITAR que al editar aparezca la fecha actual de ese articulo en la bd
    $("#editarArticuloForm #fechaCaducidad").val(fechaCaducidad);
    $("#area").text(rowSelected.AREA);
    $("#rendimientoEstimado").text(rowSelected.RENDIMIENTO_ESTIMADO);
    $("#rendimientoPaciente").text(rowSelected.RENDIMIENTO_PACIENTE);
    $("#nombreComercial").html(`${rowSelected.NOMBRE_COMERCIAL} ${rowSelected.RED_FRIO == 1 ? '<span class="badge text-bg-primary"><i class="bi bi-snow2 fs-4" title="Refrigerado"></i></span>' : '<span class="badge text-bg-warning"><i class="bi bi-thermometer-half fs-4" title="Temperatura ambiente"></i></span>'}`);
    $('#imagenProducto').attr("src", rowSelected.IMAGEN);
    $('#verImagenArt').attr('href', rowSelected.IMAGEN);

    if(!rowSelected.INSERTO){
        $("#verInsertoBtn").attr('disabled', true);
        $('#verInsertoBtn').removeClass("btn-danger");
        $('#verInsertoBtn').addClass('btn-outline-danger');
        $('#verInsertoBtn').on('click', function(e) {
            if ($(this).attr('disabled')) {
                e.preventDefault(); // Evita que el enlace funcione
            }
        });
        
    } else {
        $('#verInsertoBtn').attr('disabled', false);
        $('#verInsertoBtn').attr('href', rowSelected.INSERTO);
        $('#verInsertoBtn').removeClass("btn-outline-danger");
        $('#verInsertoBtn').addClass('btn-danger');
    }

    if(!rowSelected.PROCEDIMIENTO_PRUEBA){
        $("#verProcedimientoBtn").attr('disabled', true);
        $('#verProcedimientoBtn').removeClass("btn-secondary");
        $('#verProcedimientoBtn').addClass('btn-outline-secondary');
        $('#verProcedimientoBtn').on('click', function(e) {
            if ($(this).attr('disabled')) {
                e.preventDefault(); // Evita que el enlace funcione
            }
        });
    } else {
        $('#verProcedimientoBtn').attr('disabled', false);
        $('#verProcedimientoBtn').removeClass("btn-outline-secondary");
        $('#verProcedimientoBtn').addClass('btn-secondary');
        $('#verProcedimientoBtn').attr('href', rowSelected.PROCEDIMIENTO_PRUEBA);
    }

    //mostrar el modal
    $('#detalleProductoModal').modal('show');
})

setTimeout(() => {
    inputBusquedaTable('tableCatArticulos', tableCatArticulos, [{
        msj: 'Filtre los registros por coincidencia',
        place: 'top'
    }], [], 'col-12');

    // resuelve el problema de ancho de las columnas en el titulo
    tableCatArticulos.columns.adjust().draw();
}, 1000);


// abrir modal para registrar un articulo
$('#btnNuevoArticulo').click(function() {
    $('#registrarArticuloModal').modal('show');
});

rellenarSelect('.tipo_articulo', 'inventarios_api', 2, 'ID_TIPO', 'DESCRIPCION');


$(document).ready(function () {
    // Desactivar checkbox al seleccionar un radio button
    $('input[type="radio"]').on('change', function () {
        let checkboxId = 'ignore_' + $(this).attr('name');
        $('#' + checkboxId).prop('checked', false);
    });
});

$('#detalleProductoModal').on('shown.bs.modal', function () {
    if(rowSelected.RED_FRIO == 1){
        createSnowflakes();
    } else {
        // createHeatWaves();
        // createWarmGlow();
        createThermometer();
    }
});

$('#detalleProductoModal').on('hidden.bs.modal', function () {
    $('#snowAnimation').empty(); // Remueve los copos al cerrar el modal
    $('#animation').empty();
    // $('#heatWaveAnimation').empty();
    // $('#warmGlowEffect').empty();

});

function createThermometer(){
    let svgContainer = $('#animation');
    let thermometer = $(`<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" width="200" height="200">
                      <!-- Termómetro -->
                      <g fill="#BDBDBD">
                          <rect x="28" y="8" width="8" height="40" rx="4" ry="4"/>
                          <circle cx="32" cy="52" r="12"/>
                      </g>
                      
                      <!-- Mercurio -->
                      <g fill="#FF5252">
                          <rect x="30" y="26" width="4" height="22" id="mercury"/>
                          <circle cx="32" cy="52" r="8"/>
                      </g>
                      
                      <!-- Animación del nivel de mercurio -->
                      <animate xlink:href="#mercury" attributeName="y" values="26;20;26" dur="3s" repeatCount="indefinite" />
                      <animate xlink:href="#mercury" attributeName="height" values="22;28;22" dur="3s" repeatCount="indefinite" />
                  </svg>`);
    let icono = $(``);
    svgContainer.append(thermometer);
}

function createSnowflakes() {
    let snowContainer = $('#snowAnimation');
    let snowflakeCount = 50; // Cantidad de copos de nieve

    for (let i = 0; i < snowflakeCount; i++) {
        let snowflake = $('<div class="snowflake"><i class="bi bi-snow2 text-primary fs-4" title="Refrigerado"></i></div>');
        let leftPosition = Math.random() * 100;  // Posición horizontal aleatoria
        let delay = Math.random() * 5;          // Retraso aleatorio en la animación
        let duration = 5 + Math.random() * 5;   // Duración aleatoria de la caída

        snowflake.css({
            left: `${leftPosition}%`,
            animationDelay: `${delay}s`,
            animationDuration: `${duration}s`
        });

        snowContainer.append(snowflake);
    }
}

function createWarmGlow() {
    let glowContainer = $('#warmGlowEffect');
    let glowCount = 10; // Cantidad de destellos

    for (let i = 0; i < glowCount; i++) {
        let glow = $('<div class="warm-glow"></div>');
        let topPosition = Math.random() * 100;
        let leftPosition = Math.random() * 100;
        let delay = Math.random() * 2; // Retraso aleatorio

        glow.css({
            top: `${topPosition}%`,
            left: `${leftPosition}%`,
            animationDelay: `${delay}s`
        });

        glowContainer.append(glow);
    }
}


function createHeatWaves() {
    let heatContainer = $('#heatWaveAnimation');
    let waveCount = 10; // Número de ondas

    for (let i = 0; i < waveCount; i++) {
        let heatwave = $('<div class="heatwave"></div>');
        let topPosition = Math.random() * 100;  // Posición vertical aleatoria
        let leftPosition = Math.random() * 100;  // Posición horizontal aleatoria
        let delay = Math.random() * 4;          // Retraso aleatorio en la animación

        heatwave.css({
            top: `${topPosition}%`,
            left: `${leftPosition}%`,
            animationDelay: `${delay}s`,
        });

        heatContainer.append(heatwave);
    }
}

// CSS for .btn-back-menu
$('.btn-back-menu').css({
    display: 'inline-block',
    width: 'auto',
    marginBottom: '16px',
    marginTop: '4px'
});
