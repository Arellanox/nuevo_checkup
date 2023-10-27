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

        let div = $('#consentimiento_paciente_modal .carousel-inner'); // <-- contenedor

        // Limpiamos el contenedor si es que llega a tener algo que no necesitamos
        div.html("");

        // Se inicializa una variable para contar cuantas veces esta haciendo el for
        let i = 0;
        // Recorremos el arreglo para acceder a la informacion
        for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
                const element = data[key];
                let $btn_modal_paginacion = $('.btn-modal-paginacion') // <-- Boton para la paginacion del modal

                // Se setea la variable de la clase del carousel para que funcione
                var $class = "carousel-item";

                // Se evalue si el, elemento que esta pasando es el primero
                if (i === 0) {
                    // Si es el primero se le pone la clase de active
                    $class = "carousel-item active"
                    $btn_modal_paginacion.fadeOut(0);
                } else {
                    // Si no es el primero se le pone la clase por defecto
                    $class = $class
                    $btn_modal_paginacion.fadeIn(0);
                }

                // Armamos el body del item
                let html = `
                <div class="${$class}">
                    <section class="page shadow-sm p-3">
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
                </div>`;

                // Lo renderizamos por cada objeto que este en el arreglo
                div.append(html);

                // Incrementamos la variable
                i++;
            }
        }

        resolve(1)
    })

}