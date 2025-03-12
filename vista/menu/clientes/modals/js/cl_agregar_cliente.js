const ModalRegistrarCliente = document.getElementById("ModalRegistrarCliente");
ModalRegistrarCliente.addEventListener("show.bs.modal", (event) => {
  rellenarSelect('#select-cfdi-agregar', 'cfdi_api', 1, 0, 'CLAVE.DESCRIPCION')
  rellenarSelect('#selectRegimenFiscal-agregar', 'sat_regimen_api', 1, 0, 'CLAVE.REGIMEN_FISCAL');
  cargarDireccionEstadosSelect('estado_fiscal-registrar');
});
ModalRegistrarCliente.addEventListener("hide.bs.modal", (event) => { restablecerPasosForm(); });

//Formulario Para agregar interpretacion
const formulariorRegistrarCliente = document.getElementById("formRegistrarCliente");
formulariorRegistrarCliente.addEventListener("submit", function(event) {
    //if (!validarFormulario("formRegistrarCliente")) {
        event.preventDefault();
    //    return;
    //}

    const form = document.getElementById("formRegistrarCliente");
    const formData = new FormData(form);
    formData.set('api', 1);

    Swal.fire({
        title: "¿Está seguro que todos los datos están correctos?",
        text: "¡Verifique los Nuevos datos antes de continuar!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                data: formData,
                url: "../../../api/clientes_api.php",
                type: "POST",
                processData: false,
                contentType: false,
                success: function (data) {
                    data = jQuery.parseJSON(data);
                    if (mensajeAjax(data)) {
                        Toast.fire({
                            icon: "success",
                            title: "Cliente agregado Correctamente!",
                            timer: 2000,
                        });
                        document.getElementById("formRegistrarCliente").reset();

                        $("#ModalRegistrarCliente").modal("hide");

                        tablaClientes.ajax.reload();
                    }
                },
            });
        }
    });
});