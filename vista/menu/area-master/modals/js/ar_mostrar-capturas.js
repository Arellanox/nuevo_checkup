const CapturasdeArea = document.getElementById('CapturasdeArea')
CapturasdeArea.addEventListener('show.bs.modal', event => {
    // $('#capturasIMG').html('')
    $('#NombrePacienteCapturas').html(selectPacienteArea['NOMBRE_COMPLETO']);
    // let rowImg = selectEstudio.array[0]['IMAGENES'], htmlImg = '', htmlPdf = '';
    console.log(selectEstudio.array);
    let html = '';
    for (const i in selectEstudio.array) {
        let row = selectEstudio.array[i]
        if (row.CAPTURAS.length) {
            html += '<h4>' + row.SERVICIO + '</h4>';
            console.log(row);
            let rowInf = row.CAPTURAS[0]
            let rowImg = row.CAPTURAS[0].CAPTURAS[0]
            let htmlPDF = '';
            let htmlimg = '';
            console.log(rowImg)
            let pdf = 0;
            let img = 0;
            for (const im in rowImg) {
                switch (rowImg[im]['tipo']) {
                    case 'pdf':
                        pdf = 1;
                        htmlPDF += '<div class="col-auto">' +
                            '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="' + rowImg[im]['url'] + '" style="margin-bottom:4px">' +
                            '<i class="bi bi-file-earmark-pdf"></i>' +
                            '</a>' +
                            '</div>';
                        break;

                    default:
                        img = 0;
                        htmlimg += '<div class="col-12 d-flex justify-content-center"><img src="' + rowImg[im]['url'] + '" class="img-thumbnail" alt=""></div>';
                        break;
                }
            }

            if (pdf == 1) {
                html += '<div class="col-12 d-flex justify-content-left"> <p>Capturas por documento pdf: </p> <div class="row d-flex justify-content-center">' +
                    htmlPDF +
                    '</div > </div >';
            }
            // html += htmlPDF;
            html += htmlimg;
        }

    }
    $('#capturasIMG').html(html)
    // for (let i = 0; i < rowImg.length; i++) {
    //     let row = rowImg;
    //     if (row[i]['EXTENSION'] == 'pdf') {
    //         htmlPdf += '<p style="font-size:25px">Capturas por documento pdf:</p> <div class="col-12 d-flex justify-content-center">'+
    //         '<a type="button"a target="_blank" class="btn btn-borrar me-2" href="'+row[i]['URL']+'" style="margin-bottom:4px">'+
    //           '<i class="bi bi-file-earmark-pdf"></i>'+
    //         '</a>'+
    //       '</div>';
    //     }else{
    //         htmlImg += '<div class="col-12 d-flex justify-content-center"><img src="'+row[i]['URL']+'" class="img-thumbnail" alt=""></div>';
    //     }
    //     $('#capturasPDF').html(htmlPdf);
    //     $('#capturasIMG').html(htmlImg);
    // }

})
