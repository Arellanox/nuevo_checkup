var tablaMuestras, dataListaPaciente = {}, selectListaMuestras;

if (validarVista('LABORATORIO_MUESTRA_CHECKUPS')) {
    contenidoMuestras()
}

async function contenidoMuestras() {
    await obtenerTitulo("Toma de muestras Checkups");
    $.post("contenido/muestras.php", function (html) {
        $("#body-js").html(html);
    }).done(function () {
        dataListaPaciente = {
            api: 1,
            id_area: 6,
            fecha_agenda: $('#fechaListadoAreaMaster').val(),
            con_paquete: 1 // indica que el paciente debe tener un paquete cargado.
        };
        // DataTable
        $.getScript('contenido/js/muestras-tabla.js')
        // Botones
        $.getScript('contenido/js/muestras-botones.js')
    })
}
