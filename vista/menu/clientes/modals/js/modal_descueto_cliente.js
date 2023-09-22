//Mensaje para cambiar de are, se puede utilizar depues
// alertMensaje('info', 'Se esta cambiando descuento', '', null, null, 2000)

//Verifica si se a seleccionado algun cliente
$("#btn-descuentoCliente").click(function () {
    if (array_selected != null) {
        $("#modalDescuentoCliente").modal("show");
        setTimeout(() => {
            $.fn.dataTable
                .tables({
                    visible: true,
                    api: true
                })
                .columns.adjust();

        }, 200);
    } else {
        alertSelectTable('No ha seleccionado un cliente');
    }
});

//Busca todas las areas en descuento por área
select2('#selectDescuentoCliente', "modalDescuentoCliente", 'Cargando...')
rellenarSelect('#selectDescuentoCliente', 'areas_api', 2, 'ID_AREA', 'DESCRIPCION')


//check para bloquear los descuentos ya sea por area o general
var id_check = 3 //<- Su valor sera asi para que se guarde sin descuento.
$('.check').change(function () {
    id_check = $(this).val()

    switch (id_check) {
        case '1':
            //case de descuento general
            if ($(this).is(':checked')) {
                $('#divDescuentoGeneral, #btn-descuentoClienteGeneral').removeClass('disable-element')
                $('#divDescuentoArea').addClass('disable-element')

            } else
                $('#divDescuentoGeneral, #divDescuentoArea').removeClass('disable-element')
            break;

        case '2':
            //case de descuento por area
            if ($(this).is(':checked')) {
                $('#divDescuentoArea').removeClass('disable-element')
                $('#divDescuentoGeneral, #btn-descuentoClienteGeneral').addClass('disable-element')

                $('#TablaDescuentoCliente').removeClass('disable-element')

            } else
                $('#divDescuentoGeneral, #divDescuentoArea').removeClass('disable-element')
            break;

        case '3':
            //Bloquea los div de descuento general y area
            $('#divDescuentoGeneral, #divDescuentoArea').addClass('disable-element')
            $('#btn-descuentoClienteGeneral').removeClass('disable-element')
            TablaDescuentoCliente.clear().draw();

            break

        default:
            alertToast('No se ha selecciona ningun Descuento', 'info', 2000)
            break;
    }
})

//Bloquea por default todos los div
$('#divDescuentoGeneral, #divDescuentoArea').addClass('disable-element');


//Tabla de descuentos de clientes
TablaDescuentoCliente = $("#TablaDescuentoCliente").DataTable({
    language: { url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json", },
    lengthChange: false,
    info: false,
    paging: false,
    scrollY: '38vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataDescuentoTable);

        },
        method: 'POST',
        url: `${http}${servidor}/${appname}/api/clientes_api.php`,
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
        {
            data: null, render: function (meta) {
                return ifnull(meta, null, ['COUNT']);
            }
        },
        {
            data: null, render: function (meta) {
                return ifnull(meta, null, ['CLIENTE']);
            }
        },
        {
            data: null, render: function (data) {
                //si estan vacios por el datos de descuento general los pone vacios
                return ifnull(data, false, ['AREA']) ? data.AREA : ''
            }
        },
        {
            data: null, render: function (data) {
                //si estan vacios por el datos de descuento general los pone vacios
                return ifnull(data, false, ['DESCUENTO']) ? data.DESCUENTO : ''

            }
        },
        {
            data: null, render: function (data) {
                //si estan vacios por el datos de descuento general los pone vacios
                return ifnull(data, false, ['ID_AREA']) ? `<i class="bi bi-trash eliminar-cliente-area" data-id = "${data.ID_AREA}" style = "cursor: pointer" 
                        onclick = "desactivarTablaClienteArea.call(this)"></i>`: ''

            }
        }
    ],
    columnDefs: [
        { target: 0, title: '#', className: 'all' },
        { target: 1, title: 'Cliente', className: 'all' },
        { target: 2, title: 'Area', className: 'all' },
        { target: 3, title: 'Descuento', className: 'all' },
        { target: 4, title: '<i class="bi bi-trash"></i>', className: 'all', width: '5px' }
    ],
    createdRow: function (row, data, dataIndex) {
        let row2 = data.ES_DESCUENTO_GENERAL

        buscarDescuento(row2)
        //Los que son por descuento general los pone vacios en la tabla
        var countValue = data.ES_DESCUENTO_GENERAL;
        if (countValue == 1) {
            $(row).find('td').eq(0).html('');
            $(row).find('td').eq(1).html('');
            $(row).find('td').eq(2).html('');
            $(row).find('td').eq(3).html('');
            $(row).find('td').eq(4).html('');

            $('#inputDescuentoGeneral').val(data.DESCUENTO)
        } else {
            //si es por area todos sigue normal y quita el campo que se lleno anteriormente de descuento general
            $('#inputDescuentoGeneral').val('')
        }
    }
})


inputBusquedaTable('TablaDescuentoCliente', TablaDescuentoCliente, [], [], 'col-18')

//Desativa los descuentos por área
function desactivarTablaClienteArea() {
    var id_descuento_area = $(this).data("id");

    alertMensajeConfirm({
        title: '¿Está seguro que desea desactivar el descuento?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {

        dataJson_eliminarDescuentoArea = {
            api: 8,
            id_cliente: array_selected['ID_CLIENTE'],
            area_id: id_descuento_area

        }

        ajaxAwait(dataJson_eliminarDescuentoArea, 'clientes_api', { callbackAfter: true }, false, function (data) {
            alertToast('Descuento eliminado!', 'success', 4000)

            TablaDescuentoCliente.ajax.reload();
        })
    }, 1)

}

//Agrega Nuevos datos a clientes por area
$('#btn-descuentoClienteArea').on('click', function (e) {
    e.preventDefault()

    alertMensajeConfirm({
        title: '¿Está seguro que desea guardar el descuento por Área?',
        text: 'No podrá actualizarlo',
        icon: 'info',
    }, function () {
        dataJson_Clientes_area = {
            api: 6,
            id_cliente: array_selected['ID_CLIENTE'],
            descuento_area: $('#inputDescuentoArea').val(),
            area_id: $('#selectDescuentoCliente').val(),
            descuento: 2
        }

        ajaxAwait(dataJson_Clientes_area, 'clientes_api', { callbackAfter: true }, false, function (data) {
            alertToast('Descuento por área guardado', 'success', 4000)
            TablaDescuentoCliente.ajax.reload();

            $('#inputDescuentoArea').val('')
            // $("#modalDescuentoCliente").hide();

        })
    }, 1)
})

//Agregar Nuevos datos a clientes General o a sin descuento
$('#btn-descuentoClienteGeneral').on('click', function (e) {
    e.preventDefault()

    //compara si esta en el check de no
    if (id_check == 3) {
        alertMensajeConfirm({
            title: '¿Está seguro que desea guardar sin descuento?',
            text: 'No podrá actualizarlo',
            icon: 'info',
        }, function () {
            dataJson_Clientes_sinDescuento = {
                api: 6,
                id_cliente: array_selected['ID_CLIENTE'],
                descuento: 3
            }

            ajaxAwait(dataJson_Clientes_sinDescuento, 'clientes_api', { callbackAfter: true }, false, function (data) {
                alertToast('Sin descuento guardado', 'success', 4000)

                // TablaDescuentoCliente.ajax.reload();
                TablaDescuentoCliente.clear().draw();
                $('#inputDescuentoGeneral').val('')

            })
        }, 1)

        //si no esta en el check de no, entonces es un descuento genereal
    } else {
        alertMensajeConfirm({
            title: '¿Está seguro que desea guardar el descuento general?',
            text: 'No podrá actualizarlo',
            icon: 'info',
        }, function () {
            dataJson_Clientes_general = {
                api: 6,
                id_cliente: array_selected['ID_CLIENTE'],
                descuento_general: $('#inputDescuentoGeneral').val(),
                descuento: 1
            }

            ajaxAwait(dataJson_Clientes_general, 'clientes_api', { callbackAfter: true }, false, function (data) {
                alertToast('Descuento general guardado', 'success', 4000)
                TablaDescuentoCliente.ajax.reload();

                $('#inputDescuentoGeneral').val('')
            })
        }, 1)
    }
})

//funcion que busca en que estado se encuentra el descuento (tiene tres estados y cambia el check)
function buscarDescuento(row2) {
    //Descuento general (primer estado)
    if (row2 == 1) {
        id_check = $('#checkDescuentoGeneral').prop("checked", true) //<- al check que esta se le agrega el valor en el cual estra

        $('#divDescuentoGeneral, #btn-descuentoClienteGeneral').removeClass('disable-element')
        $('#divDescuentoArea').addClass('disable-element')

        //Descuento por area (segundo estado)
    } else if (row2 == 2) {

        id_check = $('#checkDescuentoArea').prop("checked", true)

        $('#divDescuentoArea').removeClass('disable-element')
        $('#divDescuentoGeneral, #btn-descuentoClienteGeneral').addClass('disable-element')

        $('#TablaDescuentoCliente').removeClass('disable-element')

        //Sin descuento (tercer estado)
    } else {

        id_check = $('#checkDescuentoNo').prop("checked", true)

        $('#divDescuentoGeneral, #divDescuentoArea').addClass('disable-element')
        $('#btn-descuentoClienteGeneral').removeClass('disable-element')
    }
    // else {
    //     alertToast('No esta entrando en ningun lado', 'warning', 2000)
    // }
}

