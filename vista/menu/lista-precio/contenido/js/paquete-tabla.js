var touchtime = 0;

$(tablePaquetesHTML).on("click", 'tr', function (event) {
    if (touchtime === 0) {
        // Primer toque, esperar 300 ms para un segundo toque
        touchtime = new Date().getTime();
    } else {
        // Segundo toque, comparar tiempos
        if (new Date().getTime() - touchtime < 300) {
            // Doble tap detectado
            if (!$("input[name='cantidad-paquete']").is(":focus")) {
                let data = tablaContenidoPaquete.row($(this)).data()

                dataEliminados.push(data[7])
                tablaContenidoPaquete.row($(this)).remove().draw();
                if (tablaContenidoPaquete.data().count()) {
                    calcularFilasPaqueteTR()
                }
            }

            touchtime = 0;
        } else {
            // No fue un doble tap, reiniciar el contador
            touchtime = new Date().getTime();
        }
    }
});

