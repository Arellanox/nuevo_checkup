
// Cuando le de click al botonn de abrir informacion clinica va a ejecturar la función para configurar el modal
$(document).on('click', '#abrirModalInformacionClinica', configurarModalInformacionClinica);

// Funcion para configurar el modal antes de que se muestre
function configurarModalInformacionClinica() {

    // Sacamos el genero del paciente
    const $genero = array_selected.GENERO;
    $('#cuestionarioMujer').fadeOut(0)
    $('#cuestionarioHombre').fadeOut(0)

    // Se valida si el genero es hombre o mujer
    if ($genero === "FEMENINO") /* El genero es femenino */ {
        // console.log("entro al de mujer")
        $('#cuestionarioMujer').fadeIn(0)
    } else /* El genero es Masculino */ {
        // console.log("entro al masculinos")
        $('#cuestionarioHombre').fadeIn(0)
    }


    $('#modalInformacionClinica').modal('show');
}