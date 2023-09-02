// $(document).on('click', '#ticketDataButton', function (event) {
//     event.preventDefault();
//     event.stopPropagation();






// })


$(document).on('click', '#modalGruposPacienteCredito', function (event) {
    dataFill_edit = { api: 3 }
    $('#title-grupo-factura').html('Nuevo Grupo de Factura para procedencia')
    grupoPacientesModificar = false
    tListPaciGrupo.clear().draw();
    $('#modalFiltroPacientesFacturacion').modal('show');
})


// $(document).on('click', '#GrupoInfoCreditoBtn', function (event) {
//     event.preventDefault();
//     event.stopPropagation();


// })

// $("#FacturarGruposCredito").on('click', function (e) {
//     e.preventDefault();
//     alertMensajeConfirm({
//         title: 'Requiere Factura?',
//         text: '',
//         icon: 'info',
//         confirmButtonText: "Si, Requiero Factura"
//     }, () => {
//         factura = true;
//         $("#ModalTicketCreditoFacturado").modal('show');
//     }, 1)

// })






