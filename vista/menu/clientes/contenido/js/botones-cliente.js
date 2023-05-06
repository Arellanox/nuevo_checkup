$("#btn-cliente-editar").click(function () {
  if (array_selected != null) {
    $("#ModalActualizarCliente").modal("show");
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
});


$('#generar-codigoqr').click(async function () {
  if (array_selected != null) {
    let data = await ajaxAwait({
      api: 5, id_cliente: array_selected['ID_CLIENTE']
    }, 'clientes_api', { response: false })

    if (data) {
      fileName = 'códigoQR_' + array_selected['NOMBRE_COMERCIAL'];
      Swal.fire({
        html: `<div><div class="d-flex justify-content-center"><img src="` + data.url + `" alt="" style="width:100%"></div>` +
          `<a href="${data.url_qr}">${data.url_qr}</a>
                    <div class="d-flex justify-content-center"> 
                    <button type="button" class="btn btn-borrar" name="button" style="width: 50%" onClick="DownloadFromUrl('` + data.url + `', '` + fileName + `')"> <i class="bi bi-image"></i> Descargar</button>` +
          '</div></div>',
        showCloseButton: true,
        showConfirmButton: false,
      })
    }
  } else {
    alertSelectTable('No ha seleccionado un cliente');
  }
})
