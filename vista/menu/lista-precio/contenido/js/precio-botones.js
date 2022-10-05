$("#btn-perfil").click(function () {
  alert();
});

$("#seleccion-cliente").select2({
  tags: false,
  width: "15%",
  placeholder: "Selecciona un registro",
});
rellenarSelect("#seleccion-cliente", "clientes_api", 2, 0, 1);
