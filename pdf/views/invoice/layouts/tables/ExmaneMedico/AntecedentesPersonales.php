<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="6">
                <span>Ha recibido alguno de los siguientes tratamientos médicos</span>
            </th>
        </tr>
        <tr>
            <th style="width: 90px"><span></span></th>
            <th style="width: 30px"><span>Sí</span></th>
            <th style="width: 30px"><span>No</span></th>
            <th><span>Fecha (Año)</span></th>
            <th><span>Motivo</span></th>
            <th style="padding-left: 20px; padding-right: 20px"><span>Observaciones</span></th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result">
                <span>Cirugías</span>
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{17}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{17}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{246}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{17}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result">
                <span>Transfusiones</span>
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{9}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{9}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{247}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{9}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result">
                <span>Hospitalizaciónes</span>
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{16}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{16}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{248}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[1]->{16}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result">
                <span>Usa lentes</span>
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[4]->{249}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[4]->{249}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span><?= $resultados[4]->{249}->NOTAS ?? '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>                 </span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result">
                <span>Alergias</span>
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{1}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span class="center"><?= $resultados[1]->{1}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td colspan="3">
                <table cellpadding="5">
                    <thead class="table_head_transparent_in">
                    <tr>
                        <th colspan="2" style="width: 100px;"><span>Medicamentos</span></th>
                        <th colspan="2" style="width: 100px;"><span>Climatologicos</span></th>
                        <th colspan="2" style="width: 100px;"><span>Alimenticios</span></th>
                        <th colspan="3" style="width: 250px;"><span>Observaciones</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align: center;">
                        <td class="text-table-result" colspan="2" style="width: 100px; border: none">
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">Sí</span>
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">No</span>
                        </td>
                        <td class="text-table-result" colspan="2" style="width: 100px; border: none">
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">Sí</span>
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">No</span>
                        </td>
                        <td class="text-table-result" colspan="2" style="width: 100px; border: none">
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">Sí</span>
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">No</span>
                        </td>
                        <td class="text-table-result" colspan="3" style="width: 250px; max-width: 250px; border: none">
                            <span><?= $resultados[1]->{1}->NOTAS ?? '' ?></span> <!-- RELLENAR -->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <table cellpadding="5">
                    <thead class="table_head_transparent_in">
                        <tr>
                            <th colspan="2" style="width: 100px;"><span>Vacunación en la infancia: </span></th>
                            <th colspan="4" style="width: 250px; text-align: left"><span>Observaciones</span></th>
                        </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align: center;">
                        <td class="text-table-result" colspan="2" style="border: none">
                            <span class="checked <?= $resultados[1]->{239}->RESPUESTA == 'Sí'? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                            <span class="checked-label">Sí</span>
                            <span class="checked <?= $resultados[1]->{239}->RESPUESTA == 'No'? '' : 'empty' ?>">X</span> <!-- RELLENAR -->
                            <span class="checked-label">No</span>
                        </td>
                        <td class="text-table-result" colspan="4" style=" border: none">
                            <span><?= $resultados[1]->{239}->NOTAS ?></span> <!-- RELLENAR -->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <table cellpadding="5">
                    <thead class="table_head_transparent_in">
                    <tr>
                        <th colspan="2" style="width: 100px;"><span>Vacunación Influenza: </span></th>
                        <th colspan="4" style="width: 250px; text-align: left"><span>Observaciones</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align: center;">
                        <td class="text-table-result" colspan="2" style="border: none">
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">Sí</span>
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">No</span>
                        </td>
                        <td class="text-table-result" colspan="4" style=" border: none">
                            <span>                      </span> <!-- RELLENAR -->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="6">
                <table cellpadding="5">
                    <thead class="table_head_transparent_in">
                    <tr>
                        <th colspan="2" style="width: 100px;"><span>Vacunación Covid: </span></th>
                        <th colspan="4" style="width: 250px; text-align: left"><span>Observaciones</span></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr style="text-align: center;">
                        <td class="text-table-result" colspan="2" style="border: none">
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">Sí</span>
                            <span class="checked empty">X</span> <!-- RELLENAR -->
                            <span class="checked-label">No</span>
                        </td>
                        <td class="text-table-result" colspan="4" style=" border: none">
                            <span>                      </span> <!-- RELLENAR -->
                        </td>
                    </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th><span>Sólo mujeres</span></th>
            <th><span>Sí</span></th>
            <th><span>No</span></th>
            <th><span></span></th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result" style="width: 100px">
                <span>Dismenorrea:</span>
            </td>
            <td class="text-table-result" style="width: 50px">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="width: 50px">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>Menarquia: <?= $resultados[1]->{192}->NOTAS ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" style="width: 100px">
                <span>Cesáreas:</span>
            </td>
            <td class="text-table-result" style="width: 50px">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="width: 50px">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>Ritmo menstrual: <?= $resultados[1]->{197}->NOTAS ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" style="width: 100px">
                <span>Partos:</span>
            </td>
            <td class="text-table-result" style="width: 50px">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="width: 50px">
                <span>             </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>Vida sexual activa: <?= $resultados[1]->{23}->RESPUESTA ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" style="width: 100px">
                <span>Embarazos: <?= $resultados[1]->{194}->NOTAS ?></span>
            </td>
            <td class="text-table-result" style="width: 50px">
                <span class="center">
                     <?= (($resultados[1]->{194}->NOTAS) && $resultados[1]->{194}->NOTAS > 0) ? 'X' : '' ?>
                </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="width: 50px">
                <span class="center">
                    <?= (($resultados[1]->{194}->NOTAS) && $resultados[1]->{194}->NOTAS == 0) ? 'X' : '' ?>
                </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>Fecha última menstruación: <?= $resultados[1]->{193}->NOTAS ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" style="width: 100px">
                <span>Abortos: <?= $resultados[1]->{202}->NOTAS ?> </span>
            </td>
            <td class="text-table-result" style="width: 50px">
                <span class="center">
                     <?= (($resultados[1]->{202}->NOTAS) && $resultados[1]->{202}->NOTAS > 0) ? 'X' : '' ?>
                </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" style="width: 50px">
                <span class="center">
                    <?= (($resultados[1]->{202}->NOTAS) && $resultados[1]->{202}->NOTAS > 0) ? '' : 'X' ?>
                </span><!-- RELLENAR -->
            </td>
            <td class="text-table-result">
                <span>Fecha último papanicolau C V: <?= $resultados[1]->{200}->NOTAS ?></span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>
<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="12">
                <span>
                    Padece o ha padecido alguna de las siguientes enfermedades (para ser llenado por Medico de Empresa)
                </span>
            </th>
        </tr>
        <tr>
            <th colspan="2"><span>Enf. Crónicas</span></th>
            <th colspan="1"><span>Sí</span></th>
            <th colspan="1"><span>No</span></th>
            <th colspan="2"><span>Enf. Infecciosas</span></th>
            <th colspan="1"><span>Sí</span></th>
            <th colspan="1"><span>No</span></th>
            <th colspan="2"><span>Neurológicas</span></th>
            <th colspan="1"><span>Sí</span></th>
            <th colspan="1"><span>No</span></th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result" colspan="2"><span>Hipertensión:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{4}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{4}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Tuberculósis:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{13}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{13}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Embolia cerebral:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{252}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{252}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Diabetes:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{3}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{3}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Hepatitis:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{250}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{250}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Dolor de cabeza intenso (Migraña):</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{253}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{253}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Colesterol alto:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{5}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{5}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Enf. Transm. Sexual:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{15}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{15}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Epilepsia / Convulsiones:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{254}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{254}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span> Enfermedades gastrointestinales:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{11}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{11}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Enf. Gastrointestinales</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{292}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{292}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Depresión:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{12}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{12}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Enfermedades del corazón:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{7}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{7}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Conjuntivitis:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{251}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{251}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Enf. Psiquiátricas:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{35}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{35}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
    </tbody>
</table>
<table>
    <thead class="table_head_common_with_padding">
        <tr>
            <th colspan="2"><span>Enf. del Trabajo</span></th>
            <th colspan="1"><span>Sí</span></th>
            <th colspan="1"><span>No</span></th>
            <th colspan="2"><span>Otras Enfermedades</span></th>
            <th colspan="1"><span>Sí</span></th>
            <th colspan="1"><span>No</span></th>
        </tr>
    </thead>
    <tbody class="table_body_common">
        <tr>
            <td class="text-table-result" colspan="2" style="width: 177px"><span>Dolores de Espalda o de Cintura:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{255}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{255}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2">
                <span>Fracturas o Torceduras (parte del Cuerpo lesionada, tratamiento, tiempo de resolución, secuela):</span>
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{258}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{258}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Dificultad para oír:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{260}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{260}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Enf. De los Riñones:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{259}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{259}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Enfermedades de la Piel:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{56}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{56}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Cancer o tumores:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{8}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{8}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Alteraciones de la Vista:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{256}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{256}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"><span>Obesidad IMC > 30</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{3}->VALOR >= 30 ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{3}->VALOR <= 29.9 ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
        </tr>
        <tr>
            <td class="text-table-result" colspan="2"><span>Enfermedades de los pulmones:</span></td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{257}->RESPUESTA == "Sí" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="1" style="width: 40px">
                <span class="center"><?= $resultados[1]->{257}->RESPUESTA == "No" ? 'X' : '' ?></span><!-- RELLENAR -->
            </td>
            <td class="text-table-result" colspan="2"></td><!-- NO RELLENAR -->
            <td class="text-table-result" colspan="1" style="width: 40px"></td><!-- NO RELLENAR -->
            <td class="text-table-result" colspan="1" style="width: 40px"></td><!-- NO RELLENAR -->
        </tr>
    </tbody>
</table>