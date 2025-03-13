<div class="modal fade" id="ModalRegistrarCliente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="filtrador">Añadir Nuevo Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="formRegistrarCliente" enctype="multipart/form-data" novalidate>
                    <div class="panel-step-0 row">
                        <p class="text-center col-12 subtitle">Datos Generales</p>

                        <div class="col-6">
                            <label for="nombre_cliente-registrar" class="form-label">Nombre</label>
                            <input type="text" name="nombre_comercial" id="nombre_cliente-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="tipo_contribuyente-registrar" class="form-label">Tipo de contribuyente </label>
                            <select class="input-form" name="tipo_contribuyente" id="tipo_contribuyente-registrar">
                                <option value="Persona Física">Persona Física</option>
                                <option value="Persona Moral">Persona Moral</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="rfc_cliente-registrar" class="form-label">RFC</label>
                            <input type="text" name="rfc" id="rfc_cliente-registrar" class="form-control input-form">
                        </div>
                        <div class="col-3">
                            <label for="curp-registrar" class="form-label">CURP</label>
                            <input type="text" name="curp" id="curp-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="razon_social-registrar" class="form-label">Razon Social</label>
                            <input type="text" name="razon_social" id="razon_social-registrar" class="form-control input-form" required>
                        </div>
                        <div class="col-6">
                            <label for="selectRegimenFiscal-agregar" class="form-label">Régimen fiscal</label>
                            <select class="form-control input-form" name="regimen" id="selectRegimenFiscal-agregar">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="select-cfdi-agregar" class="form-label">Uso de CFDI</label>
                            <select class="form-control input-form" name="cfdi" id="select-cfdi-agregar">

                            </select>
                        </div>
                        <div class="col-6">
                            <label for="selectConvenio-agregar" class="form-label">Convenio</label>
                            <select class="form-control input-form" name="convenio" id="selectConvenio-agregar">
                                <option value="1">ASEGURADORAS </option>
                                <option value="2">INSTITUCIONES PUBLICAS </option>
                                <option value="3">INSTITUCIONES PRIVADAS </option>
                                <option value="4">CORTESIAS </option>
                            </select>
                        </div>
                        <div class="col-6 col-md-6" style="display: none">
                            <label for="nombre_sistema-registrar" class="form-label">Nombre del Sistema</label>
                            <input name="nombre_sistema" id="nombre_sistema-registrar" value="none" class="form-control input-form">
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="abreviatura_cliente-registrar" class="form-label">Abreviatura</label>
                            <input type="text" name="abreviatura" id="abreviatura_cliente-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="limite_credito_cliente-registrar" class="form-label">Limite de Credito</label>
                            <input type="number" name="limite" id="limite_credito_cliente-registrar" class="form-control input-form">
                        </div>
                        <div class="col-3 col-md-3">
                            <label for="tiempo_credito_cliente-registrar" class="form-label">Temporalidad de Credito</label>
                            <input type="text" name="tiempo_credito" class="form-control input-form" id="tiempo_credito_cliente-registrar">
                        </div>
                        <div class="col-3 col-md-3">
                            <label for="cuenta_contable_cliente-registrar" class="form-label">Cuenta Contable</label>
                            <input type="text" name="cuenta_contable" id="cuenta_contable_cliente-registrar" class="form-control input-form">
                        </div>
                    </div>
                    <div class="panel-step-1 row hidden">
                        <p class="text-center col-12 subtitle">Datos Fiscales</p>

                        <div class="col-6">
                            <label for="calle_fiscal-registrar" class="form-label">Calle</label>
                            <input type="text" name="calle_fiscal" id="calle_fiscal-registrar" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="numero_exterior-registrar" class="form-label">Número ext.</label>
                            <input type="text" name="numero_exterior" id="numero_exterior-registrar" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="numero_interior-registrar" class="form-label">Número int.</label>
                            <input type="text" name="numero_interior" id="numero_interior-registrar" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="codigo_postal-registrar" class="form-label">Codigo postal</label>
                            <input type="number" name="codigo_postal" id="codigo_postal-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="colonia_fiscal-registrar" class="form-label">Colonia</label>
                            <input type="text" name="colonia_fiscal" id="colonia_fiscal-registrar" class="form-control input-form">
                        </div>

                        <div class="col-6">
                            <label for="estado_fiscal-registrar" class="form-label">Estado</label>
                            <select name="estado_fiscal" id="estado_fiscal-registrar" class="form-control input-form">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="municipio_fiscal-registrar" class="form-label">Municipio</label>
                            <input type="text" name="municipio_fiscal" id="municipio_fiscal-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="referencia_direccion-registrar" class="form-label">Referencias</label>
                            <input type="text" name="referencia_direccion" id="referencia_direccion-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="corre_fiscal-registrar" class="form-label">Correo electrónico</label>
                            <input type="text" name="correo_fiscal" id="corre_fiscal-registrar" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="lada_numero_fiscal-registrar" class="form-label">Lada</label>
                            <input type="number" name="lada_numero_fiscal" id="lada_numero_fiscal-registrar" class="form-control input-form">
                        </div>
                        <div class="col-4">
                            <label for="numero_fiscal-registrar" class="form-label">Teléfono de contacto</label>
                            <input type="number" name="numero_fiscal" id="numero_fiscal-registrar" class="form-control input-form">
                        </div>
                    </div>
                    <div class="panel-step-2 row hidden">
                        <p class="text-center col-12 subtitle">Archivos Variados</p>

                        <div class="row">
                            <div class="col-6">
                                <label for="pdf_situacion_fiscal-registrar" class="form-label">PDF Situación Fiscal</label>
                                <input type="file" name="pdf_situacion_fiscal[]" accept="application/pdf" id="pdf_situacion_fiscal-registrar" class="form-control input-form">
                            </div>
                            <div class="col-6">
                                <label for="pdf_convenios-registrar" class="form-label">PDF Conveio</label>
                                <input type="file" name="pdf_convenios[]" accept="application/pdf" id="pdf_convenios-registrar" class="form-control input-form">
                            </div>
                            <div class="col-6">
                                <label for="pdf_lista_precio-registrar" class="form-label">PDF Lista de Precios</label>
                                <input type="file" name="pdf_lista_precio[]" accept="application/pdf" id="pdf_lista_precio-registrar" class="form-control input-form">
                            </div>
                        </div>
                    </div>
                    <div class="panel-step-3 row hidden">
                        <p class="text-center col-12 subtitle">Otros Datos</p>

                        <div class="col-12">
                            <label for="comentarios_cliente-registrar" class="form-label">Comentarios</label>
                            <input type="text" name="comentarios_cliente" id="comentarios_cliente-registrar" class="form-control input-form">
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="pagina_web-registrar" class="form-label">Pagina Web</label>
                            <input name="pagina_web" id="pagina_web-registrar" placeholder="www.ejemplo.com" class="form-control input-form">
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="facebook-registrar" class="form-label">Facebook</label>
                            <input class="md-textarea input-form" name="facebook" id="facebook-registrar" cols="45" rows="2" placeholder="www.facebook.com" />
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="twitter-registrar" class="form-label">Twitter</label>
                            <input class="md-textarea input-form" type="text" id="twitter-registrar" name="twitter" cols="45" rows="2" placeholder="www.x.com" />
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="instagram-registrar" class="form-label">Instagram</label>
                            <input class="md-textarea input-form" type="text" id="instagram-registrar" name="instagram" cols="45" rows="2" placeholder="www.instagram.com" />
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="codigo-registrar" class="form-label">Codigo</label>
                            <input class="md-textarea input-form" name="indicaciones" type="text" id="codigo-registrar" cols="45" rows="2" placeholder="" />
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-cancelar btn-form-cancel"  data-bs-dismiss="modal">
                    <i class="bi bi-arrow-left-short"></i> Cancelar
                </button>
                <button type="button" class="btn btn-cancelar hidden btn-form-setps-back">
                    <i class="bi bi-arrow-left-short"></i> Volver
                </button>
                <button type="button" class="btn btn-confirmar btn-form-setps-next">
                    <i class="bi bi-person-plus"></i> Siguiente
                </button>
                <button type="submit" form="formRegistrarCliente" class="btn btn-confirmar hidden submit-formulario-modal">
                    <i class="bi bi-person-plus"></i> Regitrar
                </button>
            </div>
        </div>
    </div>
</div>
