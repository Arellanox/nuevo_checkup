<!-- Contenido de la pagina -->
<!-- BODY -->
<div class="rounded p-3 card shadow mt-3">
    <!-- informacion paciente -->
    <h3 class="" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">Información personal</h3>
    <div class="row">
        <div class="col-12 col-md-auto d-flex justify-content-center">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="perfil" class="imagen-perfil" style="width:150px !Important; height:150px !Important">
        </div>
        <div class="col-auto col-md-6 info-detalle">
            <div class="row" id="header_paciente"></div>
        </div>
        <!-- <p>Pagina en mantenimiento :)</p>
            <p>Vuelva pronto para validar sus resultados correctamente.</p> -->
    </div>
</div>

<!-- Texto plano con la informacion que tiene que leer el paciente para dar su consentimiento -->
<div class="rounded p-3 card shadow mt-3">
    <div class="row my-4">
        <div class="col-12">
            <!-- Header de la segunda carta -->
            <div class="">
                <h3 class="" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">Consentimiento del paciente</h3>
                <p>Por favor, lea cuidadosamente el texto a continuación antes de firmar su consentimiento.</p>
            </div>
            <!-- <div id="texto_consentimiento">

            </div>
            <hr> -->
        </div>
    </div>
</div>

<!-- Texto plano con la informacion de los consentimientos -->
<div class="row p-3" id="texto_consentimiento">
</div>



<!-- Canva para firmar o Boton para visualizar los PDF -->
<div class="rounded p-3 card shadow my-3">
    <div class="row">
        <div class="col-12">
            <!-- Canvas para firmar -->
            <div class="mt-3" id="firma_div" style="display: none;">
                <div class="row">
                    <div class="col-12 d-flex justify-content-between">
                        <!-- Titulo y instrucciones de la firma -->
                        <div>
                            <h3 class="" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">Firma:</h3>
                            <p>Dibuje su Firma en el recuadro, su firma se guardara automaticamente</p>
                        </div>
                        <!-- Boton para reiniciar el canva de la firmas -->
                        <div>
                            <button class="btn btn-hover" onclick="resetFirma()" data_tipo="guardar" type="button">Reiniciar
                                Firma</button>
                        </div>
                    </div>
                    <!-- Canvas el cual contendra la firma -->
                    <div class="col-12 d-flex justify-content-center mt-3">
                        <canvas id="firmaCanvas" class="border shadow-sm" width="400" height="300"></canvas required>
                        <input type="hidden" id="firma" name="firma" required />
                    </div>
                    <!-- Boton para enviar la firma y guardarla -->
                    <div class="col-12 d-flex justify-content-end mt-3">
                        <button class="btn btn-pantone-3165" id="enviar_firma_btn">
                            Enviar firma
                        </button>
                    </div>
                </div>
            </div>

            <!-- Aviso que ya firmo y boton de visualizar reporte -->
            <div class="mt-3" id="aviso_reporte" style="display: none;">
                <div class="row">
                    <div class="col-12">
                        <!-- Titulo en caso de que ya haya firmado -->
                        <div class="d-flex justify-content-center my-auto">
                            <h3 class="my-auto" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">La firma ya ha sido guardada</h3>
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            <button type="click" class="btn btn-borrar" id="btn-mostrar-formato-consentimiento" data-bs-toggle='tooltip' data-bs-placement='top' title="Visualizar el reporte con sus datos y firma">
                                <i class="bi bi-file-earmark-pdf-fill"></i> Vista Previa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<style>
    #texto_consentimiento p {
        color: rgb(000, 078, 89) !important;
        font-weight: normal;
        font-size: 1.25rem;
        letter-spacing: 0px !important;
        text-align: justify !important;
    }

    .opcion {
        background-color: rgb(152 219 228);
        border-radius: 5px;
    }
</style>