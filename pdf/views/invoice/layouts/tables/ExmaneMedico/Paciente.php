<div class="paciente_info_container">
    <table class="paciente_info" cellpadding="5">
        <tr>
            <th colspan="12">
                <div style="position: relative">
                    Nombre: <div>
                        <?= $resultados[0]->nombre_cliente ?>
                    </div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="5">
                <div style="position: relative">
                    CURP: <div><?= 'SIN INFORMACIÓN' ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Fecha de Nacimiento: <div><?= $resultados[0]->NACIMIENTO ?></div>
                </div>
            </th>
            <th colspan="3">
                <div style="position: relative">
                    Edad: <div><?= $resultados[5]->EDAD  ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="6">
                <div style="position: relative">
                    Dirección: <div><?= $resultados[0]->domicilio_cliente . ','. $resultados[5]->LUGAR_NACIMIENTO ?></div>
                </div>
            </th>
            <th colspan="6">
                <div style="position: relative">
                    Teléfono: <div><?= $resultados[5]->CELULAR ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="6">
                <div style="position: relative">
                    Correo Electrónico: <div><?= '' ?></div>
                </div>
            </th>
            <th colspan="6">
                <div style="position: relative">
                    Sexo: <div><?= $resultados[0]->GENERO ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="4">
                <div style="position: relative">
                    Estado Civil: <div><?= $resultados[5]->ESTADO_CIVIL ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Tipo de Sangre: <div><?= 'SIN INFORMACIÓN' ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Número de IMSS: <div><?= $resultados[5]->NO_IMSS ?></div>
                </div>
            </th>
        </tr>
    </table>
</div>