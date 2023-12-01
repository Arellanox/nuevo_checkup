//Recupera y muestra la informacion del paciente
function datosPaciente(data) {
    $('#Nom_medico').val(data['MEDICO'])
    $('#cedula').val(data['CEDULA_MEDICO'])
    $('#nom_paciente').val(data['NOMBRE_PACIENTE'])
    $('#fech_nacimiento').val(data['FECHA_NACIMIENTO'])
    $('#segmento').val(data['SEGMENTO'])
    $('#categoria').val(data['CATEGORIA'])
}

// $('#btn-subirCertificadoSLB').on('click', function () {
//     // console.log('Click al btn de slb')
//     // dataJson = {}

//     // dataJson['']
//     // dataJson['add'] = $('#add-2').val()

//     // console.log(dataJson)

//     var formulario = document.getElementById('formSubirCertificadoSLB'); // Reemplaza 'tuFormulario' con el ID de tu formulario
//     var elementos = formulario.elements;

//     for (var i = 0; i < elementos.length; i++) {
//         console.log("Nombre del elemento:", elementos[i].name);
//         console.log("Tipo del elemento:", elementos[i].type);
//         // Puedes agregar más información según tus necesidades
//     }
// })


$('#btn-subirCertificadoSLB').on('click', function () {
    // Crear un objeto para almacenar los valores del formulario
    var formData = {};

    // Obtener los valores de los campos del formulario
    formData['medicamente'] = $("input[name='medicamente']:checked").val();
    // Obtener el comentario si existe
    formData['comentario'] = $("textarea[name='medicamente[comentario]']").val();
    
    formData['add'] = $("input[name='add']:checked").val();


    // Imprimir el objeto JSON en la consola
    console.log(JSON.stringify(formData));

    // Aquí puedes enviar formData a tu servidor usando AJAX o realizar otras acciones necesarias
});