var hash = window.location.hash.substring(1);
var tableData;
switch (hash) {
    case "rechazados":
        tableData = tablaRecepcionPacientesIngrersados;
        break;
    case "pendientes":
        tableData = tablaRecepcionPacientes;
        break;
    default: tableData = false; break;
}

// if (tableData != false)
//     alertMensaje('info', 'No puede usar esta ventana', 'No es el area correcta', 'Este mensaje no deberia existir'); return false;



checkPacienteBeneficia


$('#checkPacienteBeneficia').change(function () {
    if ($(this).is(":checked")) {
        $('#datos-nuevo-trabajador').fadeIn(200)
    } else {
        $('#datos-nuevo-trabajador').fadeOut(200)
    }

});


$('#checkCurpPasaporte').change(function () {
    if ($(this).is(":checked")) {
        $("#pasaporte-trabajador").focus();
        alertSelectTable('Use su pasaporte como identificación', 'info', 3000)
    } else {
        $("#ccurp-trabajador").focus();
        alertSelectTable('Use su CURP como identificación', 'info', 3000)
    }
    // $('#checkCurpPasaporte').val($(this).is(':checked'));
});

