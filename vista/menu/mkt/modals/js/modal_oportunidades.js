$(document).ready(function(){

})

// Registrar una empresa
$('#formNuevaEmpresa').submit(function(event){
    event.preventDefault();

    var form = document.getElementById('formNuevaEmpresa');
    var formData = new FormData(form);

    if(rowSelected){
        alertMensajeConfirm({
                title: `Estás editando ${rowSelected.EMPRESA}...`,
                text: "¿Deseas continuar?",
                icon: "warning"
            },
            function(){
                ajaxAwait(
                    {
                        api: 1,
                        id_empresa: rowSelected.ID_EMPRESA,
                        nombreEmpresa: $("#nombreEmpresa").val(),
                        tipoEmpresa: $("#tipoEmpresa").val()
                    },
                    'oportunidades_api',
                    { callbackAfter: true },
                    false,
                    function(data){
                        if(data.response.code == 1){
                            alertToast("Empresa editada!", "success", 400);
                            rowSelected = null;
                            tableListaEmpresas.ajax.reload();
                            $("#formNuevaEmpresa")[0].reset();
                        } else {
                            alertToast(data.response.message, "error", 400);
                        }
                    }
                )
            }, 1
        )
        return;
    }

    alertMensajeConfirm({
            title: "¿Está a punto de registrar una empresa?",
            text: "Seleccione una opción.",
            icon: "warning"
        },
        function(){
            ajaxAwaitFormData(
                {
                    api: 1,

                },
                'oportunidades_api',
                'formNuevaEmpresa',
                { callbackAfter: true },
                false,
                function(data){
                    if(data.response.code == 1){
                        $("#formNuevaEmpresa")[0].reset();
                        alertToast('Empresa registrada!', "success", 4000);
                        tableListaEmpresas.ajax.reload();
                    }
                }
            )
        }, 
        1
    );
})
