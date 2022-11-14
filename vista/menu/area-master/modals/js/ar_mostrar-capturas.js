const CapturasdeArea = document.getElementById('CapturasdeArea')
CapturasdeArea.addEventListener('show.bs.modal', event => {
    $('#capturasIMG').html('')
    $('#capturasPDF').html('')
    $('#NombrePacienteCapturas').html(selectPacienteArea['NOMBRE_COMPLETO']);
    let rowImg = selectEstudio.array['img'], htmlImg = '', htmlPdf = '';
    for (let index = 0; index < rowImg.length; index++) {
        let row = rowImg;
        if (row.tipo == 'pdf') {
            htmlPdf += '<div class="col-auto d-flex justify-content-center">'+
            '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="'+row[i]['INTERPRETACION']+'" style="margin-bottom:4px">'+
              '<i class="bi bi-file-earmark-pdf"></i>'+
            '</a>'+
          '</div>';
        }else{
            htmlImg += '<img src="http://localhost/nuevo_checkup/archivos/reportes/IMAGENOLOGIA/turnos/rx1.jpg" class="img-thumbnail" alt="">';
        }
        $('#capturasPDF').html(htmlImg);
        $('#capturasIMG').html(htmlPdf);
    }

})
