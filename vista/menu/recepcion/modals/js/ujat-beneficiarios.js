var hash = window.location.hash.substring(1);
var tableData;
switch (hash) {
    case "rechazados": tableData = tablaRecepcionPacientesIngrersados; break;
    case "pendientes": tableData = tablaRecepcionPacientes; break;
    default: tableData = false; break;
}

if (tableData != false)
    alertMensaje('info', 'No puede usar esta ventana', 'No es el area correcta', 'Este mensaje no deberia existir'); return false;

