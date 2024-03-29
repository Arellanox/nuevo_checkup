$.post("modals/a_modals.php", function (html) {
   $("#modals-js").html(html);
}).done(function () {
   // Modal para registrar usuario
   $.getScript('modals/js/user_agregar_usuario.js');
   //Modal para form usuario
   $.getScript('modals/js/user_form_usuario.js');

   // Modal para registrar usuario
   $.getScript('modals/js/user_editar_usuario.js');
   // Modal para editar areas
   $.getScript('modals/js/user_editar_areas.js');
   // Modal para editar permisos
   $.getScript('modals/js/user_editar_permisos.js');
   // Modal para registrar cargo
   // $.getScript('modals/js/cargo_crear.js');
   // $.getScript('modals/js/cargo_modal.js');
   // $.getScript('modals/js/modal_html.js');

   // Modal para agregar y vizualizar los vendedores
   $.getScript('modals/vendedores/js/agregar_vendedores.js');
   // Modal para periodos del vendedor
   $.getScript('modals/vendedores/js/comisiones_vendedor.js');


   // Modal para agregar vendedores
   $.getScript('modals/medicos/js/select_agregar_vendedor.js');


   // Modal para agregar o actualizar el usuario de un medico
   $.getScript('modals/js/m_medicos.js');

   //Cargos, Universidades, Titulos
   getAreaUnValor('cargos', 'cargo', 'cargos_api', 'ID_CARGO', '#MODAL_CARGOS_VISTA')
   getAreaUnValor('titulos', 'titulo', 'titulos_api', 'ID_U_TITULO', '#MODAL_TITULOS_VISTA')
   getAreaUnValor('universidades', 'universidad', 'universidades_api', 'ID_UNIVERSIDAD', '#MODAL_UNIVERSIDADES_VISTA')
   getAreaUnValor('especialidades', 'especialidad', 'especialidades_api', 'ID_ESPECIALIDAD', '#MODAL_ESPECIALIDAD_VISTA')

});
