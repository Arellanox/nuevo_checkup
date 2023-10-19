<!-- Contenido de la pagina -->
<!-- BODY -->
<div class="rounded p-3 shadow-sm mt-3">
    <!-- informacion paciente -->
    <h3 class="" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">Información personal</h3>
    <div class="row">
        <div class="col-12 col-md-auto d-flex justify-content-center">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png" alt="perfil" class="imagen-perfil" style="width:150px !Important">
        </div>
        <div class="col-auto col-md-6 info-detalle">
            <div class="row" id="header_paciente"></div>
        </div>
        <!-- <p>Pagina en mantenimiento :)</p>
            <p>Vuelva pronto para validar sus resultados correctamente.</p> -->
    </div>
</div>

<!-- Texto plano con la informacion que tiene que leer el paciente para dar su consentimiento -->
<div class="rounded p-3 shadow-sm mt-3">
    <div class="row my-4">
        <div class="col-12">
            <!-- Header de la segunda carta -->
            <div class="mb-3">
                <h3 class="" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">Consentimiento del paciente</h3>
                <p>Por favor, lea cuidadosamente el texto a continuación antes de firmar su consentimiento.</p>
            </div>
            <!-- Cuerpo del texto del consentimiento -->
            <div id="texto de consentimiento mt-3">
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ullam ea maiores quod dolorum velit molestiae culpa. Aliquam nesciunt tenetur facilis quis perferendis blanditiis modi quo saepe, tempora dolorum possimus. Illum?
                <br>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Non voluptates minima autem deleniti sunt. Repudiandae suscipit, eaque perspiciatis odit similique, quis molestias quas quod sapiente, nesciunt cupiditate fugit dignissimos nostrum.
                <br>
                <br>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Hic tempora nesciunt assumenda unde distinctio perferendis suscipit ipsum magnam repellendus. Quasi, rem nisi deserunt saepe consectetur reprehenderit vitae autem fugiat obcaecati!

                <br>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Omnis rerum, quasi, assumenda consequuntur aut odit quae ducimus architecto dolor doloribus nam quod, exercitationem esse laudantium facilis porro repellendus. Repudiandae, aliquid?

                <br>
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quidem sint aut laudantium at labore delectus, totam, vitae facere voluptates porro ipsum, sequi fugiat voluptate maxime! Qui aperiam molestiae in ullam.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure quod repudiandae tenetur inventore repellat placeat nostrum aspernatur ullam tempora ut libero a ex perferendis, at consequuntur odio, nulla ab vero.
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sit fuga, eaque libero quae odio, vero ad ducimus quo repudiandae adipisci ab magni reiciendis neque vel impedit officiis eius eum quod.
                <br>

            </div>
            <hr>
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
                        <div class="my-auto">
                            <h3 class="my-auto" style="font-size: 20px; font-weight: bold; margin-bottom: 15px;">La firma ya ha sido guardada</h3>
                        </div>
                        <div class="mt-3">
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