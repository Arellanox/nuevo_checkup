
enfriadorData = {}
var DataMes = {};

// rellenarSelect("#Termometro", "equipos_api", 1, "ID_EQUIPO", "DESCRIPCION", { id_tipos_equipos: 4 })

//Tabla de temperaturas por mes
tablaTemperaturaFolio = $("#TablaTemperaturasFolio").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '75vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, DataEquipo);
        },
        // data: { api: 2, equipo: id_equipos },
        method: 'POST',
        url: '../../../api/temperatura_api.php',
        beforeSend: function () {
            fadeRegistro('Out')
            loader("In")
            selectTableFolio = false
            tablaTemperaturaFolio.clear().draw();
        },
        complete: function () {
            //Para ocultar segunda columna
            loader("Out", 'bottom')
            reloadSelectTable()
            fadeRegistro('In')
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
            // $("#lista-meses-temperatura").fadeIn('fast');

            // Hacer clic en la primera fila
            var firstRow = tablaTemperaturaFolio.row(0).node(); // La fila 0 es la primera fila
            $(firstRow).click(); // Simula un clic en la fila
            $("#loader-TablaTemperaturasFolio").fadeOut('fast');

        },
        // error: function (jqXHR, textStatus, errorThrown) {
        //     alertErrorAJAX(jqXHR, textStatus, errorThrown);
        // },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'FOLIO' },
        {
            data: 'FECHA_REGISTRO', render: function (data) {
                // Mes
                return formatoFecha2(data, [0, 1, 3, 0]).toUpperCase();
            }
        },
        {
            data: null, render: function (data) {
                let html = `<i class="bi bi-file-earmark-pdf-fill generarPDF" style="cursor: pointer; color: red;font-size: 23px;"></i>`
                return session['permisos']['SupTemp'] == '1' ? html : '';
            }
        },
        {
            data: 'FECHA_REGISTRO', render: function (data) {
                // ANHO
                return formatoFecha2(data, [0, 1, 0, 0]).toUpperCase();
            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all', width: '10px' },
        { target: 1, title: 'FECHA', className: 'all', width: '80%' },
        { target: 2, title: 'PDF', className: 'all', width: '10px', visible: session['permisos']['SupTemp'] == '1' ? true : false },
        { target: 3, title: 'AÑO', className: 'none' }

    ],
    // dom: 'Bfrtip',
    // buttons: [
    //     {
    //         text: '<i class="bi bi-file-earmark-pdf-fill"></i> Generar PDF',
    //         className: 'btn btn-borrar',
    //         action: function (data) {

    //         }
    //     }
    // ]
})


inputBusquedaTable("TablaTemperaturasFolio", tablaTemperaturaFolio, [{
    msj: 'Tabla de registro de temperatura mensual',
    place: 'top'
}], {
    msj: "Filtre los resultados por el folio que escriba",
    place: 'top'
}, "col-12")

loaderDiv("Out", null, "#loader-temperatura", '#loaderDivtemperatura');
loaderDiv("Out", null, "#loader-temperatura2", '#loaderDivtemperatura2');

var URL_TABLA = {};
selectTable('#TablaTemperaturasFolio', tablaTemperaturaFolio, {
    unSelect: true, ClickClass: [
        {
            class: 'generarPDF',
            callback: async function (data) {
                console.log(data['FECHA_REGISTRO'])
                // e.preventDefault();
                if (session['permisos']['SupTemp'] != 1)
                    return false;

                // En SelectedFoliosData esta toda la informacion del mes
                FolioMesEquipo = data['FOLIO']
                $("#observaciones_pdf").val("");
                $("#Termometro_pdf").val("");

                await rellenarSelect("#Termometro_pdf", "temperatura_api", 16, "TERMOMETRO_ID", "DESCRIPCION", { folio: FolioMesEquipo }, function (data, html) {
                    URL_TABLA = data[0]['URL_TABLA'];
                    if (data[0])
                        $('#Termometro_pdf').val(data[0]['TERMOMETRO_PRINCIPAL'])
                })

                URL_TABLA != null ? $('#btn-mostrar-formato-temperatura').fadeIn('fast') : $('#btn-mostrar-formato-temperatura').fadeOut('fast');

                $("#temperaturaPdfTitle").html(`Generar Formato del Mes: <b>${formatoFecha2(data['FECHA_REGISTRO'], [0, 1, 3, 0])}</b> (Folio:<b>${FolioMesEquipo}</b>)`)

                $("#TemperaturaModalGeneralFirma").modal("show");

            }, selected: true

        },
    ], dblClick: true, reload: ['col-xl-9']
}, async function (select, data, callback) {
    if (select) {
        // Limpiar Elementos
        $("#grafica").html("");
        $("#Tabla-termometro").html('')
        $("#Tabla-equipos").html('')

        // Setear variables globales
        selectTableFolio = true
        DataFolio.folio = data['FOLIO']
        DataMes = data
        SelectedFoliosData = data;

        // Ejecutar Funciones
        CrearEncabezadoEquipos(data['FOLIO']);
        await CrearTablaPuntos(data['FOLIO']);


        fadeTabla('In')
        callback('In')
    } else {

        // Limpiar Elementos
        $("#Tabla-termometro").html('')
        $("#Tabla-equipos").html('')

        // Setear variables globales
        selectTableFolio = false
        DataFolio.folio = null
        DataMes = null
        SelectedFoliosData = null;

        // Ejecutar funciones
        fadeTabla('Out')
        callback('Out')
    }
}, async function (select, data, callback) {

    $('.detallesTemperaturatitle').html("");
    rellenarSelect("#Termometro_actualizar", "equipos_api", 1, "ID_EQUIPO", "DESCRIPCION", { id_tipos_equipos: 4 })
    $("#lectura_actualizar").val("")
    $("#observaciones_actualizar").val("")
    $('.detallesTemperaturatitle').html(`Detalles de las temperaturas del equipo (${DataEquipo.Descripcion}) - ${formatoFecha2(DataMes['FECHA_REGISTRO'], [0, 1, 3, 0]).toUpperCase()}`)
    $("#formActualizarTemperatura").addClass('disable-element');

    // setTimeout(async function () {
    // }, 500)
    tablaTemperatura.clear().draw();

    tablaTemperatura.ajax.reload()


    $('#detallesTemperaturaModal').modal('show');

})

var DataFolio = {
    api: 3,
    folio: 0
};



function fadeRegistro(type) {
    if (type == 'Out') {
        $("#lista-meses-temperatura").fadeOut('fast');
    } else if (type == 'In') {
        $("#lista-meses-temperatura").fadeIn('fast');
        // $('#btn-desbloquear-equipos').fadeIn('fast')
        $('#btn-desbloquear-equipos').removeClass('disable-element')
        $('#CapturarTemperaturabtn').removeClass('disable-element');
    }
}

function fadeTabla(type) {
    if (type == 'Out') {
        $('#grafica-container').fadeOut('fast')
        $("#Equipos_Termometros").fadeOut('fast');
    } else if (type == 'In') {
        $('#grafica-container').fadeIn('fast')
        $("#Equipos_Termometros").fadeIn('fast');
    }
}


function CrearTablaPuntos(id_grupo) {
    return new Promise(resolve => {
        // console.log('se esta ejecutando esta funcion y quien sabe donde xd')
        $.post(`${http}${servidor}/${appname}/vista/include/funciones/TablaDePuntos_Temperatura/tabla.php`, { folio: id_grupo }, function (html) {
            $("#grafica").html(html);
        }).done(
            function () {
                setTimeout(function () {

                    var canvas = document.getElementById('canvas');
                    var ctx = canvas.getContext('2d');
                    var dots = document.getElementsByClassName('dot');

                    function connectDots(dot1, dot2) {
                        var rect1 = dot1.getBoundingClientRect();
                        var rect2 = dot2.getBoundingClientRect();
                        var x1 = (rect1.left + rect1.width / 2 - canvas.getBoundingClientRect().left) - 1.3;
                        var y1 = (rect1.top + rect1.height / 2 - canvas.getBoundingClientRect().top) + 6.3;
                        var x2 = (rect2.left + rect2.width / 2 - canvas.getBoundingClientRect().left) - 1.3;
                        var y2 = (rect2.top + rect2.height / 2 - canvas.getBoundingClientRect().top) + 6.3;


                        ctx.beginPath();
                        ctx.moveTo(x1, y1);
                        ctx.lineTo(x2, y2);
                        ctx.lineWidth = 3;
                        ctx.strokeStyle = "blue";
                        ctx.stroke();
                    }

                    // function getDotCenter(dot) {
                    //     var rect = dot.getBoundingClientRect();
                    //     var x = rect.left + rect.width / 2 - canvas.getBoundingClientRect().left;
                    //     var y = rect.top + rect.height / 2 - canvas.getBoundingClientRect().top;

                    //     return {
                    //         x: x,
                    //         y: y
                    //     };
                    // }

                    // function connectDots(dot1, dot2) {
                    //     var dot1Center = getDotCenter(dot1);
                    //     var dot2Center = getDotCenter(dot2);

                    //     var x1 = dot1Center.x;
                    //     var y1 = dot1Center.y;
                    //     var x2 = dot2Center.x;
                    //     var y2 = dot2Center.y;

                    //     var controlX = (x1 + x2) / 2;
                    //     var controlY = (y1 + y2) / 2 - Math.abs(x1 - x2) / 4;

                    //     ctx.beginPath();
                    //     ctx.moveTo(x1, y1);
                    //     ctx.quadraticCurveTo(controlX, controlY, x2, y2);
                    //     ctx.strokeStyle = "blue "; // Cambiar el color de la línea a rojo
                    //     ctx.lineWidth = 3; // Ajustar el ancho de línea
                    //     ctx.stroke();
                    // }


                    function positionDots() {
                        var dotCount = dots.length;
                        var containerWidth = dots[0].closest('table').offsetWidth;

                        // Ajustar el tamaño del canvas al ancho del contenedor
                        canvas.width = containerWidth;
                        canvas.height = dots[0].closest('table').offsetHeight;


                        for (var i = 0; i < dotCount; i++) {
                            var dot = dots[i];
                            var rect = dot.getBoundingClientRect();
                            var x = rect.left + rect.width / 2 - canvas.getBoundingClientRect().left;
                            var y = rect.top + rect.height / 2 - canvas.getBoundingClientRect().top;
                            dot.dataset.x = x; // Guardar la posición x en un atributo de datos
                            dot.dataset.y = y; // Guardar la posición y en un atributo de datos
                        }
                    }

                    function drawLines() {
                        ctx.clearRect(0, 0, canvas.width, canvas.height);

                        // var prevDot;
                        // for (var i = dotInicial; typeof (prevDot) != "object"; i++) {
                        //     for (var j = 1; j <= 2; j++) {
                        //         prevDot = document.getElementById('dot-' + i + '-' + j);

                        //         if (typeof (prevDot) == "object") {
                        //             // prevDot = document.getElementById('dot-' + i + '-' + j)
                        //             j = 3
                        //         }

                        //     }
                        // }

                        for (var i = dotInicial; i <= dotLast; i++) {
                            for (var j = 1; j < 3; j++) {
                                var currentDotId = 'dot-' + i + '-' + j;
                                var currentDot = document.getElementById(currentDotId);


                                if (currentDot == null) {
                                    prevDot = prevDot
                                } else {
                                    if (currentDot) {
                                        connectDots(prevDot, currentDot);
                                        prevDot = currentDot;
                                    } else {
                                        break;
                                    }

                                }



                            }
                        }
                    }

                    positionDots();
                    drawLines();

                }, 500)
                //Avisar cuando termine de cargar la tabla
                resolve(1);
            })
    });
}