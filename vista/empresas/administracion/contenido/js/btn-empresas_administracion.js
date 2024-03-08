//Boton que abre el modal de las facturas
$('.btn-facturas').on('click', function () {

    // TablaFacturas()
    tablaFacturas.clear().draw()
    tablaFacturas.ajax.reload();

    setTimeout(() => {
        $('#modalFacturas').modal('show');
        setTimeout(() => {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        }, 300);
    }, 500);


})

//Boton que abre la lista de precios
$('.btn-lista_precios').on('click', function () {
    tablaListaFacturas.clear().draw();
    tablaListaFacturas.ajax.reload();

    setTimeout(() => {
        $('#modalListaFacturas').modal('show');
        setTimeout(() => {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();
        }, 300);
    }, 500);
})

// |------------------------- Lotes enviados -----------------------------|
// Abre el modal de la vista de los lotes enviados
$(document).on('click', '#btn-muestras_enviadas', async function (event) {
    event.preventDefault(); // Prevenimos los eventos
    event.stopPropagation(); // Prevenimos la propagacion

    $('#tab-reporte').fadeOut('fast');

    alertToast('Espere un momento...', 'info') // Mandamos una pequeña alerta
    TablaListaLotes.ajax.reload() //Recargamos la tabla de la lista de los lotes enviados


    // //Hacemos un retraso de un 1 segundo para que la tabla pueda recargar
    setTimeout(() => {
        $('#LotesEnviados').modal('show'); // Abrimos el modal una vez pasado el segundo de espera
    }, 1000);
})

// Abre el estado de los lotes
$(document).on('click', '#btn-envio_muestras', async function (event) {
    event.preventDefault();
    event.stopPropagation();
    // tablaPacientesFaltantes_inicio = true

    restartPages('page_control-envio_lotes')
    btnCambioPages(1)
    $('#folio_de_solicitud_muestras').html('')
    $('#formato_de_envio').attr('href', '#SinRellenar');


    // Configura y obten los datos antes de la tabla de lotes
    tablaPacientesFaltantes.ajax.reload();
    TablaPacientesNewGrupo.clear().draw();


    // alertToast('')

    $('#EnvioLotesPacientes').modal('show');
    // Una vez obtenido, abre el modal (esto desde el complete del ajax de la tabla)
})
