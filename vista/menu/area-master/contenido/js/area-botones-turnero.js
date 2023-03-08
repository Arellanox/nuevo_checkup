// Control de turnos
$('#omitir-paciente').on('click', function () {
    omitirPaciente(control_turnos); //case 3
})

$('#llamar-paciente').on('click', function () {
    llamarPaciente(control_turnos); //case 2
})

$('#liberar-paciente').on('click', function () {
    if (selectListaMuestras) {
        liberarPaciente(control_turnos, tablaContenido['ID_TURNO']); //case 1
    } else {
        alertMensaje('info', 'Paciente no seleccionado', 'Necesita seleccionar el paciente actual para liberar su turno')
    }
})

console.log('js turnero')