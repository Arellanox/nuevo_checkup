<div class="modal fade" id="ModalActualizarCliente" tabindex="-1" aria-labelledby="filtrador" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header header-modal">
                <h5 class="modal-title" id="filtrador">Editar Datos de Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="" id="formActualizarCliente" enctype="multipart/form-data"  novalidate>
                    <div class="panel-step-0 row">
                        <p class="text-center col-12 subtitle">Datos Generales</p>

                        <div class="col-6">
                            <label for="nombre_cliente" class="form-label">Nombre</label>
                            <input type="text" name="nombre_comercial" id="nombre_cliente" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="tipo_contribuyente" class="form-label">Tipo de contribuyente </label>
                            <select class="input-form" name="tipo_contribuyente" id="tipo_contribuyente">
                                <option value="Persona Física">Persona Física</option>
                                <option value="Persona Moral">Persona Moral</option>
                            </select>
                        </div>
                        <div class="col-3">
                            <label for="rfc_cliente" class="form-label">RFC</label>
                            <input type="text" name="rfc" id="rfc_cliente" class="form-control input-form">
                        </div>
                        <div class="col-3">
                            <label for="curp_cliente" class="form-label">CURP</label>
                            <input type="text" name="curp" id="curp_cliente" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="razon_social" class="form-label">Razon Social</label>
                            <input type="text" name="razon_social" id="razon_social" class="form-control input-form" required>
                        </div>
                        <div class="col-6">
                            <label for="selectRegimenFiscal-editar" class="form-label">Régimen fiscal</label>
                            <select class="form-control input-form" name="regimen" id="selectRegimenFiscal-editar">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="select-cfdi-editar" class="form-label">Uso de CFDI</label>
                            <select class="form-control input-form" name="cfdi" id="select-cfdi-editar">

                            </select>
                        </div>
                        <div class="col-6">
                            <label for="selectConvenio-editar" class="form-label">Convenio</label>
                            <select class="form-control input-form" name="convenio" id="selectConvenio-editar">
                                <option value="1">ASEGURADORAS </option>
                                <option value="2">INSTITUCIONES PUBLICAS </option>
                                <option value="3">INSTITUCIONES PRIVADAS </option>
                                <option value="4">CORTESIAS </option>
                            </select>
                        </div>
                        <div class="col-6" style="display: none">
                            <label for="nombre_sistema" class="form-label">Nombre del Sistema</label>
                            <input name="nombre_sistema" id="nombre_sistema" value="none" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="abreviatura_cliente" class="form-label">Abreviatura</label>
                            <input type="text" name="abreviatura" id="abreviatura_cliente" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="limite_credito_cliente" class="form-label">Limite de Credito</label>
                            <input type="number" name="limite" id="limite_credito_cliente" class="form-control input-form">
                        </div>
                        <div class="col-3">
                            <label for="tiempo_credito_cliente" class="form-label">Temporalidad de Credito</label>
                            <input type="text" name="tiempo_credito" class="form-control input-form" id="tiempo_credito_cliente">
                        </div>
                        <div class="col-3">
                            <label for="cuenta_contable_cliente" class="form-label">Cuenta Contable</label>
                            <input type="text" name="cuenta_contable" id="cuenta_contable_cliente" class="form-control input-form">
                        </div>
                    </div>
                    <div class="panel-step-1 row hidden">
                        <p class="text-center col-12 subtitle">Datos Fiscales</p>

                        <div class="col-6">
                            <label for="calle_fiscal" class="form-label">Calle</label>
                            <input type="text" name="calle_fiscal" id="calle_fiscal" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="numero_exterior" class="form-label">Número ext.</label>
                            <input type="text" name="numero_exterior" id="numero_exterior" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="numero_interior" class="form-label">Número int.</label>
                            <input type="text" name="numero_interior" id="numero_interior" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="codigo_postal" class="form-label">Codigo postal</label>
                            <input type="number" name="codigo_postal" id="codigo_postal" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="colonia_fiscal" class="form-label">Colonia</label>
                            <input type="text" name="colonia_fiscal" id="colonia_fiscal" class="form-control input-form">
                        </div>

                        <div class="col-6">
                            <label for="estado_fiscal" class="form-label">Estado</label>
                            <select name="estado_fiscal" id="estado_fiscal" class="form-control input-form">
                            </select>
                        </div>
                        <div class="col-6">
                            <label for="municipio_fiscal" class="form-label">Municipio</label>
                            <input type="text" name="municipio_fiscal" id="municipio_fiscal" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="referencia_direccion" class="form-label">Referencias</label>
                            <input type="text" name="referencia_direccion" id="referencia_direccion" class="form-control input-form">
                        </div>
                        <div class="col-6">
                            <label for="correo_fiscal" class="form-label">Correo electrónico</label>
                            <input type="text" name="correo_fiscal" id="correo_fiscal" class="form-control input-form">
                        </div>
                        <div class="col-2">
                            <label for="lada_numero_fiscal" class="form-label">Lada</label>
                            <input type="number" name="lada_numero_fiscal" id="lada_numero_fiscal" class="form-control input-form">
                        </div>
                        <div class="col-4">
                            <label for="numero_fiscal" class="form-label">Teléfono de contacto</label>
                            <input type="number" name="numero_fiscal" id="numero_fiscal" class="form-control input-form">
                        </div>
                    </div>
                    <div class="panel-step-2 row hidden">
                        <p class="text-center col-12 subtitle">Archivos Variados</p>

                        <div class="row">
                            <div class="col-12 pdf-uploads">
                                <label for="pdf_situacion_fiscal" class="form-label">PDF Situación Fiscal</label>
                                <a href="#" id="visualizar_pdf_situacion_fiscal" target="_blank"
                                   class="d-block py-4 text-center hidden view-pdf-btn">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    Visualizar PDF de Situación Fiscal
                                </a>
                                <input type="file" name="pdf_situacion_fiscal[]" accept="application/pdf"
                                       id="pdf_situacion_fiscal" class="form-control input-form">
                            </div>
                            <div class="col-12 pdf-uploads">
                                <label for="pdf_convenios" class="form-label">PDF Convenio</label>
                                <a href="#" id="visualizar_pdf_convenios" target="_blank"
                                   class="d-block py-4 text-center hidden view-pdf-btn">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    Visualizar PDF de Convenio
                                </a>
                                <input type="file" name="pdf_convenios[]" accept="application/pdf" id="pdf_convenios"
                                       class="form-control input-form">
                            </div>
                            <div class="col-12 pdf-uploads">
                                <label for="pdf_lista_precios" class="form-label">PDF Lista de Precios</label>
                                <a href="#" id="visualizar_pdf_lista_precios" target="_blank"
                                   class="d-block py-4 text-center hidden view-pdf-btn">
                                    <i class="bi bi-file-earmark-pdf"></i>
                                    Visualizar PDF de Lista de Precios
                                </a>
                                <input type="file" name="pdf_lista_precio[]" accept="application/pdf"
                                       id="pdf_lista_precios" class="form-control input-form">
                            </div>
                        </div>
                    </div>
                    <div class="panel-step-3 row hidden">
                        <p class="text-center col-12 subtitle">Otros Datos</p>

                        <div class="col-12">
                            <label for="comentarios_cliente" class="form-label">Comentarios</label>
                            <input type="text" name="comentarios_cliente" id="comentarios_cliente" class="form-control input-form">
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="pagina_web" class="form-label">Pagina Web</label>
                            <input name="pagina_web" id="pagina_web" placeholder="www.ejemplo.com" class="form-control input-form">

                        </div>
                        <div class="col-6 col-md-6">
                            <label for="facebook" class="form-label">Facebook</label>
                            <input class="md-textarea input-form" name="facebook" id="facebook" cols="45" rows="2" placeholder="www.facebook.com" />
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="twitter" class="form-label">Twitter</label>
                            <input class="md-textarea input-form" type="text" id="twitter" name="twitter" cols="45" rows="2" placeholder="www.x.com" />
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="instagram" class="form-label">Instagram</label>
                            <input class="md-textarea input-form" type="text" id="instagram" name="instagram" cols="45" rows="2" placeholder="www.instagram.com" />
                        </div>
                        <div class="col-6 col-md-6">
                            <label for="codigo" class="form-label">Codigo</label>
                            <input class="md-textarea input-form" name="indicaciones" type="text" id="codigo" cols="45" rows="2" placeholder="" />
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
                <button type="submit" form="formActualizarCliente" class="btn btn-confirmar hidden submit-formulario-modal">
                    <i class="bi bi-person-plus"></i> Actualizar
                </button>
                </div>
        </div>
    </div>
</div>