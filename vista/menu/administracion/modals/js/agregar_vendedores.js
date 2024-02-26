$('#btn-guardar_vendedores').on('click', function(e){
    e.preventDefault();

    alertMensajeConfirm({
        title: '¿Esta seguro que los datos estan correctos?',
        text: 'No se podra modificar despues',
        icon: 'info'
    }, function(){
        ajaxAwaitFormData({api: 1}, 'vendedores_api', 'form-vendedores', { callbackAfter: true }, false, function(){
            alertToast('Los datos se guardaron correctamente', 'success');
        })
    },1)
})