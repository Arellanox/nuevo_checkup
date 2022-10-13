$("#btn-perfil").click(function () {
  alert();
});

$("#seleccion-cliente").select2({
  tags: false,
  width: "auto",
  placeholder: "Selecciona un cliente",
});
rellenarSelect("#seleccion-cliente", "clientes_api", 2, 0, 1);
