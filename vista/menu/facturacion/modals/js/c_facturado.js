rellenarSelect('#credito-tipo-pago', 'formas_pago_api', 2, 'ID_PAGO', 'DESCRIPCION', { activo: 1 })

$("#formFacturarGrupoCredito").on('submit', function (e) {
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Deseas facturar este grupo?',
        text: 'No podrás cambiar la factura.',
        icon: 'info',
    }, () => {

        id_grupo = SelectedGruposCredito['ID_GRUPO']
        FacturarGruposCredito(facturado, id_grupo)

        ajaxAwaitFormData({
            api: 1,
            num_factura: "",
            id_grupo: id_grupo,
            facturado: 1
        }, 'admon_grupos_api', 'formFacturarGrupoCredito', { callbackAfter: true }, false,
            function (data) {
                let modal = "#ModalTicketCreditoFacturado";
                $(modal).modal('hide');

                alertToast("Factura guardada con exito", "success", 3000)

                TablaGrupos.ajax.reload();

            })

    }, 1)

})