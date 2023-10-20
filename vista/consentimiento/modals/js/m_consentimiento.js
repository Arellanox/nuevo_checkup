$(document).on("click", "#btn-mostrar-formato-consentimiento", function () {
    MostrarReportePDF();
})

// Function para mostrar en el modal el visualizador de reporte, obvio con el reporte seleccionado xd
async function MostrarReportePDF() {
    const RUTA = "null";
    const NOMBRE = "null";

    if (RUTA === null) {
        alertMsj({
            title: '¡No se pudo obtener su reporte!', text: 'Hubo un problema al obtener su reporte, por favor de contactar al soporte de bimo',
            icon: 'error', allowOutsideClick: true, showCancelButton: false, showConfirmButton: true
        })
        $("#consentimiento_paciente_modal").modal("hide");
        return false;
    } else {
        await construirReportes()
        $("#consentimiento_paciente_modal").modal("show");
    }

}


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

        let div = $('.carousel-inner'); // <-- contenedor

        // Limpiamos el contenedor si es que llega a tener algo que no necesitamos
        div.html("");

        // Se inicializa una variable para contar cuantas veces esta haciendo el for
        let i = 0;
        // Recorremos el arreglo para acceder a la informacion
        for (const key in data) {
            if (Object.hasOwnProperty.call(data, key)) {
                const element = data[key];

                // Se setea la variable de la clase del carousel para que funcione
                var $class = "carousel-item";

                // Se evalue si el, elemento que esta pasando es el primero
                if (i === 0) {
                    // Si es el primero se le pone la clase de active
                    $class = "carousel-item active"
                } else {
                    // Si no es el primero se le pone la clase por defecto
                    $class = $class
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
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="consentimiento_check_${element.id_servicio}">
                                    <label class="form-check-label" for="consentimiento_check_${element.id_servicio}" data-bs-toggle='tooltip' data-bs-placement='top' title="Si estas de acuerdo en dar tu consentimiento da click a esta casilla">
                                        Doy mi consentimiento.
                                    </label>
                                </div>
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