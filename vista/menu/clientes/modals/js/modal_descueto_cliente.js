//Mensaje para cambiar de are, se puede utilizar depues
// alertMensaje('info', 'Se esta cambiando descuento', '', null, null, 2000)

//Verifica si se a seleccionado algun cliente
$("#btn-descuentoCliente").click(function () {
    if (array_selected != null) {
        $("#modalDescuentoCliente").modal("show");
        console.log(array_selected)
    } else {
        alertSelectTable('No ha seleccionado un cliente');
    }
});

//Busca todas las areas
select2('#selectDescuentoCliente', "modalDescuentoCliente", 'Cargando...')
rellenarSelect('#selectDescuentoCliente', 'areas_api', 2, 'ID_AREA', 'DESCRIPCION')

//check para bloquear los descuentos ya sea por area o general
$('.check').change(function () {
    var id_check = $(this).attr('id')

    switch (id_check) {

        case 'checkDescuentoGeneral':
            if ($(this).is(':checked')) {
                //Alert que diga que se esta cambiando al otro()

                $('#divDescuentoGeneral').removeClass('disable-element')
                $('#divDescuentoArea').addClass('disable-element')
            } else
                $('#divDescuentoGeneral, #divDescuentoArea').removeClass('disable-element')

            break;

        case 'checkDescuentoArea':
            //Bloqeua el descuento general
            if ($(this).is(':checked')) {

                $('#divDescuentoArea').removeClass('disable-element')
                $('#divDescuentoGeneral').addClass('disable-element')

                $('#TablaDescuentoCliente').removeClass('disable-element')
            } else
                $('#divDescuentoGeneral, #divDescuentoArea').removeClass('disable-element')
            break;

        case 'checkDescuentoNo':
            //Bloquea los div de descuento general y area
            $('#divDescuentoGeneral, #divDescuentoArea').addClass('disable-element')
            break

        default:
            alertToast('No se ha selecciona ningun Descuento', 'info', 2000)
            break;
    }
})

//Bloquea por default todos los div
$('#divDescuentoGeneral, #divDescuentoArea').addClass('disable-element');


//Tabla de descuentos de clientes
const TablaDescuentoCliente = $("#TablaDescuentoCliente").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: { api: 2 },
        method: 'POST',
        // url: `${http}${servidor}/${appname}/api/`,
        beforeSend: function () {
        },
        complete: function () {
            TablaDescuentoCliente.columns.adjust().draw()
            // obtenerBTNEstudios()
        },
        error: function (jqXHR, textStatus, errorThrown) {
            alertErrorAJAX(jqXHR, textStatus, errorThrown);
        },
        dataSrc: 'response.data'
    },
    columns: [
        // { data: 'COUNT' },
        // { data: 'DESCRIPCION' },
        // { data: 'ABREVIATURA' },
        // {
        //     data: 'SERVICIO_ID', render: function (data) {


        //         return `<i class="bi bi-trash eliminar-estudio" data-id = "${data}" style = "cursor: pointer"
        //     onclick="desactivarTablaEstudio.call(this)"></i>`;

        //     }
        // }

    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Usuario', className: 'all' },
        { target: 2, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ]
})
inputBusquedaTable('TablaDescuentoCliente', TablaDescuentoCliente, [], [], 'col-18')

// $('input[name="flexRadioDefault"]').change(function () {
// const input = $(this)
// const val = $(input).val()
// switch (key) {
//     case value:

//         break;

//     default:
//         break;
// }

// if ($('#checkDescuentoGeneral').is(':checked')) {
//     $('#contentDescuento').slideDown();
// } else {
//     $('#contentDescuento').slideUp();

// }
// });
