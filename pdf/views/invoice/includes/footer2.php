  <style>
    .page-number {
    position: center;
    bottom: 0;
    text-align: center;
}
</style>

  <table>
      <tbody>
          <tr class="col-foot-one">
              <td colspan="12" style="text-align: right; padding-right: 0;"><strong style="font-size: 12px;">Atentamente</strong></td>
          </tr>
          <tr class="col-foot-two">
              <td colspan="10">
              </td>
              <td colspan="2" style="text-align: left;">
                  <?php
                    if ($preview == 0) {
                        echo "<img style='position:absolute; right:25px; margin-top: -15px ' src='data:image/png;base64, " . $encode_firma . "' height='80px'> ";
                    }
                    ?>
              </td>
          </tr>
          <tr class="col-foot-three" style="font-size: 13px;">
              <td colspan="6" style="text-align: center; width: 50%">
                  <?php
                    if ($preview == 0) {
                    ?>
                        <a target="_blank" href="<?= $qr[0] ?>"> <img src='<?= $qr[1] ?>' alt='QR Code' width='110' height='110'> </a>
                    <?php
                        //echo "<a target='_blank' href='" . $validacion . "'> <img src='" . $qr[1] . "' alt='QR Code' width='110' height='110'> </a>";
                    }
                    ?>
              </td>
              <td colspan="6" style="text-align: right; width: 50%; padding-top: 30px; margin-bottom: -25px">
                  <strong style="font-size: 12px;">
                      <?php
                        echo $pie_data_1;
                        $indice = 1;
                        foreach ($pie_especialidad as $key => $value) {
                            // $contador = count($value);
                            $indice++;
                            echo '<br>' . $value['CARRERA'] . ' / ' . $value['UNIVERSIDAD'];
                            if ($value['CEDULA'] != 0) {
                                echo  ' / '  . $value['CEDULA'];
                            }

                            echo '<br>';

                            if ($value['CERTIFICADO_POR'] != 0)
                                echo 'Certificado por: ' . $value['CERTIFICADO_POR'];
                        }
                        ?>
                  </strong>
              </td>
          </tr>
      </tbody>
  </table>
  <hr style="height: 0.5px; background-color: black ;">
  <p style="text-align: center;"><small>
          <strong style="font-size: 11px;">Avenida José Pagés Llergo No. 150 Interior 1, Colonia Arboledas,
              Villahermosa Tabasco, C.P. 86079</strong> <br>
          <strong style="font-size: 11px;">Teléfonos: </strong>
          <strong style="font-size: 11px;">993 634 0250, 993 634 6245</strong>
          <strong style="font-size: 11px;">Correo electrónico:</strong>
          <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">resultados@</strong>
          <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">bimo-lab</strong>
          <strong style="font-size: 11px;color: rgb(000, 078, 089); margin-left: -1.5px; margin-right: -1.5px">.com</strong>
      </small></p>

 <!-- /* Paginacion en reportes */ -->
<div class="page-number">Página: <span class="page"></span></div>      