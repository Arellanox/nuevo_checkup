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
                    Edad: <div><?= $resultados[0]->EDAD ?? $encabezado->EDAD  ?></div>
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
                    Teléfono: <div><?= $resultados[0]->CELULAR ?? $encabezado->CELULAR ?></div>
                </div>
            </th>
        </tr>
        <tr>
            <th colspan="6">
                <div style="position: relative">
                    Correo Electrónico: <div><?= $resultados[0]->CORREO ?? $encabezado->CORREO ?></div>
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
                    Estado Civil: <div><?= $resultados[0]->ESTADO_CIVIL ?? 'No Aplica' ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Tipo de Sangre: <div><?= 'No Aplica' ?></div>
                </div>
            </th>
            <th colspan="4">
                <div style="position: relative">
                    Número de IMSS: <div><?= $resultados[0]->NO_IMSS ?? 'No Aplica' ?></div>
                </div>
            </th>
        </tr>
    </table>
</div>
