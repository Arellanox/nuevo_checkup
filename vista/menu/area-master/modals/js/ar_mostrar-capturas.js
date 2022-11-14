const CapturasdeArea = document.getElementById('CapturasdeArea')
CapturasdeArea.addEventListener('show.bs.modal', event => {
    $('#capturasIMG').html('')
    $('#capturasPDF').html('')
    $('#NombrePacienteCapturas').html(selectPacienteArea['NOMBRE_COMPLETO']);
    let rowImg = selectEstudio.array[0]['IMAGENES'], htmlImg = '', htmlPdf = '';
    console.log(rowImg);
    for (let i = 0; i < rowImg.length; i++) {
        let row = rowImg;
        if (row[i]['EXTENSION'] == 'pdf') {
            htmlPdf += '<p style="font-size:25px">Capturas por documento pdf:</p> <div class="col-12 d-flex justify-content-center">'+
            '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="'+row[i]['URL']+'" style="margin-bottom:4px">'+
              '<i class="bi bi-file-earmark-pdf"></i>'+
            '</a>'+
          '</div>';
        }else{
            htmlImg += '<div class="col-12 d-flex justify-content-center"><img src="'+row[i]['URL']+'" class="img-thumbnail" alt=""></div>';
        }
        $('#capturasPDF').html(htmlPdf);
        $('#capturasIMG').html(htmlImg);
    }

})
