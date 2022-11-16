var tablaUsuarios = $('#TablaUsuariosAdmin').DataTable({
  processing: true,
  language: {
    url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    loadingRecords: '&nbsp;',
    processing: '<div class="spinner"></div>'
  },
  scrollY: "60vh",
  scrollCollapse: true,
  lengthMenu: [[10, 15, 20, 25, 30, 35, 40, 45, 50, -1], [10, 15, 20, 25, 30, 35, 40, 45, 50, "All"]],
  ajax: {
      dataType: 'json',
      data: {api: 2},
      method: 'POST',
      url: '../../../api/usuarios_api.php',
      beforeSend: function() { loader("In") },
      complete: function(){loader("Out");},
      dataSrc:''
  },
  columns:[
      {data: 'count'},
      {data: 'nombrecompleto'},
      {data: 'USUARIO'},
      {data: '15.0.DESCRIPCION'},
      {data: '16.0.DESCRIPCION'},
      {data: 'ACTIVO'},
      {data: 'PROFESION'},
      {data: 'CEDULA'},
      {data: 'TELEFONO'},
      {data: 'CORREO'},
      // {defaultContent: 'En progreso...'}
  ],
  columnDefs: [
    { "width": "3px", "targets": 0 },
  ],

})
selectDatatable("TablaUsuariosAdmin", tablaUsuarios)
