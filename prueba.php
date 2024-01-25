<!doctype html>
<html lang="en">

<head>
    <title>Prueba tipos de pago</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 200px;">
            <button class="btn btn-primary" id="agregarFormaDePago">Agregar forma de pago</button>
            <select class="form-control" id="formaDePagoSelect">
                <option value="1">Efectivo</option>
                <option value="2">Tarjeta Credito</option>
                <option value="3">Cheques</option>
                <!-- Agrega más opciones aquí según tus necesidades -->
            </select>

            <!-- Aquí se mostrarán los tipos de pago y los campos de entrada de monto -->
            <div id="tiposDePagoContainer"></div>

            <button class="btn btn-danger" id="guardarFormasDePago">Guardar</button>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function() {
            var tiposPagos = [{
                    tipo: 1,
                    descripcion: "Efectivo"
                },
                {
                    tipo: 2,
                    descripcion: "Tarjeta Credito"
                },
                {
                    tipo: 3,
                    descripcion: "Cheques"
                }
            ];

            var formasPagos = []; // Array para guardar las formas de pago

            // Función para crear un nuevo elemento de tipo de pago con botón de eliminación
            function agregarTipoDePago(tipoDePagoDescripcion) {
                var tipoDePagoDiv = $("<div>");
                tipoDePagoDiv.text("Tipo: " + tipoDePagoDescripcion);

                var montoInput = $("<input>");
                montoInput.attr("type", "number");
                montoInput.attr("placeholder", "Monto");

                var eliminarBoton = $("<button>");
                eliminarBoton.text("Eliminar");
                eliminarBoton.click(function() {
                    tipoDePagoDiv.remove(); // Eliminar el elemento de tipo de pago
                });

                tipoDePagoDiv.append(montoInput, eliminarBoton);
                $("#tiposDePagoContainer").append(tipoDePagoDiv);
            }

            // Evento click para el botón "Agregar forma de pago"
            $("#agregarFormaDePago").click(function() {
                var tipoDePago = parseInt($("#formaDePagoSelect").val(), 10); // Obtener el tipo de pago como número entero

                if (tipoDePago) {
                    // Buscar la descripción del tipo de pago en el diccionario
                    var tipoDePagoEncontrado = tiposPagos.find(function(tipo) {
                        return tipo.tipo === tipoDePago;
                    });

                    if (tipoDePagoEncontrado) {
                        agregarTipoDePago(tipoDePagoEncontrado.descripcion);
                    } else {
                        alert("Tipo de pago no encontrado en el diccionario.");
                    }
                } else {
                    alert("Selecciona un tipo de pago válido.");
                }
            });

            // Evento click para el botón "Guardar"
            $("#guardarFormasDePago").click(function() {
                formasPagos = []; // Limpiar el array antes de guardar

                // Recorrer los elementos en el contenedor y obtener la información
                $("#tiposDePagoContainer > div").each(function() {
                    var tipo = $(this).text().split(":")[1].trim(); // Obtener el tipo de pago
                    var monto = $(this).find("input").val(); // Obtener el monto

                    formasPagos.push({
                        tipo: tipo,
                        monto: parseFloat(monto).toFixed(2)
                    });
                });

                // Crear un objeto JSON con la información
                var jsonFormasPagos = JSON.stringify(formasPagos);

                // Mostrar el objeto JSON en la consola (puedes ajustar esta parte según tus necesidades)
                console.log(jsonFormasPagos);
            });
        });
    </script>

</body>

</html>