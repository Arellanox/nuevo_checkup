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

//Registrar una entrada
$("#registrarEntradaForm").submit(function(event){
    event.preventDefault();
    var form = document.getElementById('registrarEntradaForm');
    var formData = new FormData(form);

    var activo;

    if($("#registrarEntradaForm #estatus").is(':checked')){
        activo = 1;
    } else {
        activo = 0;
    }
    
    alertMensajeConfirm(
        {
            title: "¿Está a punto de registrar esta entrada?",
            text: "Asegúrate que los datos sean correctos.",
            icon: "warning"
        },
        function (){
            ajaxAwaitFormData(
                { 
                    api: 6,
                    id_articulo: rowSelected.ID_ARTICULO
                    
                },
                "inventarios_api",
                "registrarEntradaForm",
                { callbackAfter: true },
                false,
                function(data){
                    if(data.response.code == 1){
                        $("#registrarEntradaForm")[0].reset();
                        $("#registrarEntradaModal").modal('hide');
                        alertToast("Artículo actualizado!", "success", 4000)
                        tableCatEntradas.ajax.reload();
                    }
                }
            )
        }
    )

});

$("#filtrarArticuloForm").submit(function(event){
    event.preventDefault();

    // Solo asigna el filtro si hay selección, si no, elimina la propiedad
    let activo = $('input[name="activo"]:checked').val();
    let redFrio = $('input[name="redFrio"]:checked').val();
    let tipoArticulo = $('#tipoArticulo').val();
    let manejaCaducidad = $('input[name="manejaCaducidad"]:checked').val();
    let area = $('#area').val();

    // Limpia el objeto antes de asignar
    dataTableCatArticulos = { api: 3 };

    if (activo !== undefined) dataTableCatArticulos.estatus = activo;
    if (redFrio !== undefined) dataTableCatArticulos.red_frio = redFrio;
    if (tipoArticulo !== "" && tipoArticulo !== null) dataTableCatArticulos.tipo_articulo = tipoArticulo;
    if (manejaCaducidad !== undefined) dataTableCatArticulos.maneja_caducidad = manejaCaducidad;
    if (area !== "" && area !== null) dataTableCatArticulos.area_id = area;

    console.log(dataTableCatArticulos);

    tableCatArticulos.ajax.reload();
    $("#filtrarArticuloModal").modal('hide');
});

// Restablecer filtros
$("#resetFiltrosBtn").click(function() {
    $("#filtrarArticuloForm")[0].reset();
    // Limpia los filtros del objeto
    dataTableCatArticulos = { api: 3 };
    tableCatArticulos.ajax.reload();
    $('#resetFiltrosBtn').hide(); // Oculta el botón inmediatamente después de resetear
    $("#filtrarArticuloModal").modal('hide'); // Cierra el modal
    alertToast("Filtros restablecidos", "success", 4000)

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
toggleFieldset('#ignorarArea','#area');

$('input[type=radio]').change(function() {
    const checkboxId = $(this).closest('.card-body').find('.form-check-input').attr('id');
    $('#' + checkboxId).prop('checked', false);
});

function toggleResetButton() {
    const anyRadioChecked = $('input[name="activo"]:checked').length > 0 ||
                            $('input[name="redFrio"]:checked').length > 0 ||
                            $('input[name="manejaCaducidad"]:checked').length > 0;
    const tipoArticuloSelected = $('#tipoArticulo').val() !== "" && $('#tipoArticulo').val() !== null;
    const areaSelected = $('#area').val() !== "" && $('#area').val() !== null;

    if (anyRadioChecked || tipoArticuloSelected || areaSelected) {
        $('#resetFiltrosBtn').show();
    } else {
        $('#resetFiltrosBtn').hide();
    }
}

// Inicialmente ocultar el botón
$('#resetFiltrosBtn').hide();

// Mostrar/ocultar al cambiar radios o select
$('input[type=radio][name="activo"], input[type=radio][name="redFrio"], input[type=radio][name="manejaCaducidad"]').on('change', toggleResetButton);
$('#tipoArticulo').on('change', toggleResetButton);
$('#area').on('change', toggleResetButton);

