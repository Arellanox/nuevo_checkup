// ==============================================================================

// ###################### Variables #############################################

// ==============================================================================




// ==============================================================================

// ###################### Eventos y Botones  ####################################

// ==============================================================================

$('#btn-subir-medico-tratante').on('click', function () {
    alertMensajeConfirm({
        title: '¿Está seguro que desea agregar este médico?',
        text: 'No podrá modificarlo despues',
        icon: 'warning',
    }, function () {
        usuario_id = $('#select-usuarios-medicos-tratantes').val()

        dataJson_insertMedicos = {
            api: 1,
            nombre_medico: $('#nombre-medicoTrarante').val(),
            email: $('#email-medicoTratante').val(),
            usuario_id: ifnull(usuario_id, 'null', usuario_id),
            ignorarALevenshtein: 0 //Busca al coincidencia
        }
        ajaxAwait(dataJson_insertMedicos, 'medicos_tratantes_api', { callbackAfter: true }, false, function (data) {
            //Metemos lo que trae data en una variable en este caso lo que nos recupera es el arreglo
            const row = data.response.data;

            // Creamos una variable donde se inicializa como vacia donde se guardara los nombres de los medicos
            let html = '';

            // Iterar a través de los objetos en el row
            for (const clave in row) {
                if (row.hasOwnProperty(clave)) {
                    const campos = row[clave];
                    if (campos.hasOwnProperty("NOMBRE_MEDICO")) { //<- verifica si la propiedad actual (clave) realmente pertenece al objeto row
                        const nombreMedico = campos["NOMBRE_MEDICO"];
                        html += `<li style = "list-style-type: none;">${nombreMedico}</li>`; // Usar \n para el salto de línea
                    }
                }
            }

            if (typeof (row) === 'object') { //<- Verificamos que sea un objeto

                // Si se encontraron nombres de médicos, mostrar el mensaje
                alertMensaje('warning', 'Este médico tiene coincidencias', 'Verifique que no sea el mismo', `${html}`, null);
            } else {
                // Si no se encontraron nombres de médicos
                VolverConstruirPagina(1)
            }




        })
    }, 1)
})

// Escuchar los cambios del checkbox #usuario_check_g
$(document).on('change', '#usuario_check_g', function () {
    SwitchCheckboxUsuariosG('usuario_check_g');
})

// ==============================================================================

// ###################### FUNCIONES #############################################

// ==============================================================================



// Para el formulario de registro:
// La constante en la operacion sera el correo, ese siempre se va a poner
// El nombre se pondra automaticamente del usuario que eliga del select
//  SIEMPRE Y CUANDO EL CHECKBOX ESTE DESACTIVADO
//  si el checkbox esta activado entonces el usuario podra ingresar el nombre del medico pero tambien el select de los usuarios se va a desactivar

function SwitchCheckboxUsuariosG(ELEMENT) {

    let btn = $(`#${ELEMENT}`).is(':checked');

    if (btn) {
        $('#select-usuarios-medicos-tratantes').prop('disabled', false);
        $('#nombre-medicoTrarante').prop('disabled', true);
    } else {
        $('#select-usuarios-medicos-tratantes').prop('disabled', true);
        $('#nombre-medicoTrarante').prop('disabled', false);
    }
}

// ==============================================================================

// ###################### OTROS #################################################

// ==============================================================================

SwitchCheckboxUsuariosG('usuario_check_g');
