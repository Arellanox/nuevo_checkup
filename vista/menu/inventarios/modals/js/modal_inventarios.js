
// Registrar una articulo
$("#registrarArticuloForm").submit(function(event){
    event.preventDefault();

    var form = document.getElementById('registrarArticuloForm');
    var formData = new FormData(form);

    var activo;

    if($("#regitrarArticuloForm #estatus").is(':checked')){
        activo = 1;
    } else {
        activo = 0;
    }

    alertMensajeConfirm({
        title: "¿Está a punto de registrar un artículo?",
        text: "Seleccione una opción.",
        icon: "warning"
    },
    function(){
      ajaxAwaitFormData(
        { api: 1,
            estatus: activo
        },
        'inventarios_api', 
        'registrarArticuloForm',
        { callbackAfter: true },
        false,
        function(data){
            if(data.response.code == 1){
                $("#registrarArticuloForm")[0].reset();
                $("#registrarArticuloModal").modal('hide');
                alertToast("Artículo registrado", "success", 4000)
                tableCatArticulos.ajax.reload();
            }
        }

    );
    },1);

    return false;

});

// editar un articulo
$("#editarArticuloForm").submit(function(event){
    event.preventDefault();
    var form = document.getElementById('editarArticuloForm');
    var formData = new FormData(form);

    var activo;

    if($("#editarArticuloForm #estatus").is(':checked')){
        activo = 1;
    } else {
        activo = 0;
    }
    
    alertMensajeConfirm(
        {
            title: "¿Está a punto de editar este artículo?",
            text: "Asegúrate que los datos sean correctos.",
            icon: "warning"
        },
        function (){
            ajaxAwaitFormData(
                { 
                    api: 1,
                    id_articulo: rowSelected.ID_ARTICULO
                    
                },
                "inventarios_api",
                "editarArticuloForm",
                { callbackAfter: true },
                false,
                function(data){
                    if(data.response.code == 1){
                        $("#editarArticuloForm")[0].reset();
                        $("#editarArticuloModal").modal('hide');
                        alertToast("Artículo actualizado!", "success", 4000)
                        tableCatArticulos.ajax.reload();
                    }
                }
            )
        }
    )

});


$("#filtrarArticuloForm").submit(function(event){
    event.preventDefault();
    if (!$('#ignorarActivo').is(':checked')) {
        dataTableCatArticulos.estatus = $('input[name="activo"]:checked').val() || null;
    }
    if (!$('#ignorarRedFrio').is(':checked')) {
        dataTableCatArticulos.red_frio = $('input[name="redFrio"]:checked').val() || null;
    }
    if (!$('#ignorarTipoArticulo').is(':checked')) {
        dataTableCatArticulos.tipo_articulo = $('#tipoArticulo').val();
    }
    if (!$('#ignorarManejaCaducidad').is(':checked')) {
        dataTableCatArticulos.maneja_caducidad = $('input[name="manejaCaducidad"]:checked').val() || null;
    }
    console.log(dataTableCatArticulos);

    // recargamos la tabla con los nuevos parametros
    tableCatArticulos.ajax.reload();
    $("#filtrarArticuloModal").modal('hide');
    
    // reestablecemos el valor de dataTableCatArticulos
    dataTableCatArticulos = { api: 3 };

});

function toggleFieldset(checkbox, fieldset) {
    $(checkbox).change(function() {
        const isChecked = $(this).is(':checked');
        $(fieldset).find('input, select').prop('disabled', isChecked);
    });
}

toggleFieldset('#ignorarActivo', '#activoRadios');
toggleFieldset('#ignorarRedFrio', '#redFrioRadios');
toggleFieldset('#ignorarTipoArticulo', '#tipoArticulo');
toggleFieldset('#ignorarManejaCaducidad', '#manejaCaducidadRadios');

$('input[type=radio]').change(function() {
    const checkboxId = $(this).closest('.card-body').find('.form-check-input').attr('id');
    $('#' + checkboxId).prop('checked', false);
});

