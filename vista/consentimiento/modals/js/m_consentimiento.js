$(document).on("click", "#btn-mostrar-formato-consentimiento", async function () {
    configurarModal()
})

// Function para configurar el modal
async function configurarModal() {

    let data = []; //<-- array que se le va a pasar a la funcion para armar el modal

    // Se obtiene el array donde esta toda la informacion de los formatos
    row = paciente_data.FORMATO;


    // Se recorre el array para acceder a sus keys
    for (const key in row) {
        if (Object.hasOwnProperty.call(row, key)) {
            const element = row[key];

            const $NOMBRE = element.NOMBRE_CONSENTIMIENTO;
            const $URL = element.URL_PDF;

            data[key] = {
                nombre_servicio: $NOMBRE,
                url: $URL
            }

        }
    }

    // Se le manda a la funcion el array armado para que se muestre en el modal
    await construirReportes(data);

    // Una vez se realizo todos los metodos se abre e   l modal
    $("#consentimiento_paciente_modal").modal("show");

    setTimeout(() => {
        const hammertime = new Hammer(document.querySelector('#consentimiento_paciente_modal .modal-body'));

        hammertime.on('swipeleft', function () {
            const $visiblePage = $('.page:visible');
            const $nextPage = $visiblePage.next('.page');
            if ($nextPage.length) {
                updatePage($nextPage, 'next');
            }
        });

        hammertime.on('swiperight', function () {
            const $visiblePage = $('.page:visible');
            const $prevPage = $visiblePage.prev('.page');
            if ($prevPage.length) {
                updatePage($prevPage, 'back');
            }
        });
    }, 200);
}


// Function para construir todo el cuerpo del modal
async function construirReportes(
    data = [
        {
            nombre_servicio: "BIOMETRIA HEMATICA",
            url: "http://www.ceamooax.org.mx/pdf/consentimiento_informado.pdf",
            id_servicio: 1
        },
        {
            nombre_servicio: "QUÍMICA SANGUÍNEA 4 PARÁMETROS",
            url: "http://www.ceamooax.org.mx/pdf/consentimiento_informado.pdf",
            id_servicio: 2
        }
    ]
) {

    return new Promise(function (resolve, reject) {

        let div = $('div.container-pages'); // <-- contenedor

        // Limpiamos el contenedor si es que llega a tener algo que no necesitamos
        div.html("");

        // Se inicializa una variable para contar cuantas veces esta haciendo el for
        let i = 0;
        // Recorremos el arreglo para acceder a la informacion
        for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
                const element = data[key];
                // Armamos el body del item
                let html = `
                    <section class="page shadow-sm p-3" style="display: none;">
                        <h3 class="text-center fw-bold">${element.nombre_servicio}</h3>
                        <hr>
                        <div class="row">
                            <!-- Checkbox para dar su consentimiento -->
                            <!-- Reporte del paciente con su firma y datos -->
                            <div class="col-12 mx-auto p-3">
                                <iframe src="${element.url}" style="width:100%; height:700px;" frameborder="0">
                                </iframe>
                            </div>

                        </div>
                    </section>
                `;

                // Lo renderizamos por cada objeto que este en el arreglo
                div.append(html);

                // Incrementamos la variable
                i++;
            }
        }

        // Inicializamos mostrando la primera página
        // 
        resolve(1)
    })

}

paginacion_div('#consentimiento_paciente_modal')