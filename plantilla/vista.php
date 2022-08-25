<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <?php include "" ?>
    <title>Bimo-Lab | Antigeno</title>
  </head>
  <header id="encabezadoHTML">

  </header>
  <body>
    <div class="" id="body">

    </div>
  </body>
  <footer>
    <script>
      $(document).ready(function () {
        //Usar links
        $.post("./encabezado.php", function(result){
          $("#encabezadoHTML").html(result);
        });
        // Obtener tabla

        $( "#body" ).load( "tabla.php", function(){
          var tablaPrincipal = $('#TablaEjemplo').DataTable({
            language: {
              url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json"
            },
            lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
            columnDefs: [
              { "width": "5px", "targets": 0 },
            ]
          })
        });


      });
    </script>
  </footer>
</html>
