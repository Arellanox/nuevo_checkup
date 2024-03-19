<?php

// Medicos Tratantes Actualizar
include "m_usuario.php";

// Usuario
include "user_agregar_usuario.html";
include "user_editar_usuario.html";
include "user_editar_permisos.html";
include "user_editar_vista.html";

// Modales de servicio
// include "ser_agregar_servicio.php";
// include "ser_editar_servicio.php";
// include "ser_relacion_servicio.php";

//Cargos, titulos, universidades
include "oneValue_crear.html";


//Form nuevo usuario
include "user_form_usuario.html";

// Select donde se eligira el vendedor para el medico seleccionado
include "medicos/select_agregar_vendedor.html";

//Vista de los vendedores y donde se podran agregar
include "vendedores/agregar_vendedores.html";
//Vista de los vendedores y donde se podran agregar
include "vendedores/comisiones_vendedor.html";


// Proveedores
include "proveedores/nuevo_proveedor.html";
include "proveedores/contactos.html";
include "proveedores/direccion.html";
