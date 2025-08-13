// Catalogos de Recursos Humanos
// Registrar/Editar Departamento
$("#registrarDepartamentoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarDepartamentoForm");
  var formData = new FormData(form);

  $("#departamentoDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarDepartamentoForm #departamentoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let departamentoIdValue = $("#departamentoId").val();
  let esEdicion = departamentoIdValue && departamentoIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este departamento?"
        : "¿Está a punto de registrar un nuevo departamento?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 4,
          activo: activo,
        },
        "recursos_humanos_api",
        "registrarDepartamentoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarDepartamentoForm")[0].reset();
            $("#registrarDepartamentoModal").modal("hide");
            alertToast(
              esEdicion
                ? "Departamento actualizado!"
                : "Departamento registrado!",
              "success",
              4000
            );
            if (tableCatDepartamentos) tableCatDepartamentos.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

//Filtrar Departamentos

// Variable para controlar el estado del filtro de Departamentos
let mostrarActivosDepartamentos = true;

// Función para configurar el toggle de filtro para Departamentos
function setupToggleFiltroDepartamentos() {
    // Event listener específico para el toggle de Departamentos
    $(document).on('click', '#toggleFiltroActivosDep', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const toggle = $(this);
        

        
        if (mostrarActivosDepartamentos) {
            // Cambiar a mostrar inactivos
            toggle.removeClass('bi-toggle-on text-secondary')
                  .addClass('bi-toggle-off text-secondary')
                  .attr('title', 'Mostrando inactivos - Click para ver activos');
            
            mostrarActivosDepartamentos = false;
            
            // Cambiar el API para mostrar inactivos
            dataTableCatDepartamentos = { api: 25 };
            
            console.log("Departamentos: Mostrando INACTIVOS");
            alertToast("Mostrando Departamentos inactivos", "info", 2000);
            
        } else {
            // Cambiar a mostrar activos
            toggle.removeClass('bi-toggle-off text-secondary')
                  .addClass('bi-toggle-on text-secondary')
                  .attr('title', 'Mostrando activos - Click para ver inactivos');
            
            mostrarActivosDepartamentos = true;
            
            // Cambiar el API para mostrar activos
            dataTableCatDepartamentos = { api: 5 };
            
            console.log("Departamentos: Mostrando ACTIVOS");
            alertToast("Mostrando Departamentos activos", "success", 2000);
        }
        
        // Recargar la tabla con el nuevo API
        tableCatDepartamentos.ajax.reload();
        
        // Actualizar el texto del botón
        updateFilterButtonTextDepartamentos();
    });
}

// Función para actualizar el texto del botón de filtro de Departamentos
function updateFilterButtonTextDepartamentos() {
    const iconoToggle = mostrarActivosDepartamentos ? 
        '<i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosDep" style="cursor: pointer; margin-left: 8px;" title="Mostrando activos - Click para ver inactivos"></i>' :
        '<i class="bi bi-toggle-off fs-5 text-secondary" id="toggleFiltroActivosDep" style="cursor: pointer; margin-left: 8px;" title="Mostrando inactivos - Click para ver activos"></i>';
    
    const botonCompleto = `<i class="bi bi-funnel me-2" id="iconoFiltroDepartamentos" title="Restablecer filtros"></i>Filtrar ${iconoToggle}`;
    
    // Buscar específicamente el botón de Departamentos y actualizar su contenido
    $('#tableCatDepartamentos_wrapper .btn.bg-gradient-filter').html(botonCompleto);
}

// Función para configurar el reset de filtros de Departamentos
function setupResetFiltrosDepartamentos() {
    // Event listener para el icono de funnel (reset) de Departamentos
    $(document).on('click', '#iconoFiltroDepartamentos', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Verificar si hay filtros aplicados
        if (mostrarActivosDepartamentos && dataTableCatDepartamentos.api === 6) {
            alertToast("No hay filtros aplicados para restablecer", "info", 3000);
            return;
        }
        
        // Mostrar confirmación
        alertMensajeConfirm(
            {
                title: "¿Restablecer filtros de Departamentos?",
                text: "Esto volverá a mostrar todos los Departamentos activos.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Sí, restablecer",
                cancelButtonText: "Cancelar"
            },
            function () {
                // Callback cuando el usuario confirma
                resetearFiltrosDepartamentos();
            },
            2 // Tipo 2 para mostrar botón de cancelar
        );
    });
}

// Función para resetear los filtros de Departamentos
function resetearFiltrosDepartamentos() {
    console.log("Restableciendo filtros de Departamentos...");
    
    // Resetear variables globales
    mostrarActivosDepartamentos = true;
    
    // Restablecer API por defecto (activos)
    dataTableCatDepartamentos = { api: 5 };
    
    // Actualizar el botón visualmente
    updateFilterButtonTextDepartamentos();
    
    // Recargar la tabla
    tableCatDepartamentos.ajax.reload(function() {
        // Callback después de recargar
        alertToast("Filtros de Departamentos restablecidos correctamente", "success", 3000);
    });
}

// Inicializar configuraciones de filtro al cargar las tablas
function inicializarFiltrosDepartamentos() {
    // Configurar los event listeners
    setupToggleFiltroDepartamentos();
    setupResetFiltrosDepartamentos();
}

// Llamar a la inicialización después de que se configuren las DataTables
$(document).ready(function() {
    // Esperar un momento para que las tablas se inicialicen
    setTimeout(function() {
        inicializarFiltrosDepartamentos();
    }, 1000);
});

// Registrar/Editar Puesto
$("#registrarPuestoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarPuestoForm");
  var formData = new FormData(form);

  $("#puestoDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarPuestoForm #puestoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let puestoIdValue = $("#puestoId").val();
  let esEdicion = puestoIdValue && puestoIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este puesto?"
        : "¿Está a punto de registrar un nuevo puesto?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      // Obtener las habilidades seleccionadas del sistema de tags
      let habilidadesSeleccionadas = { blandas: [], tecnicas: [] };
      if (window.habilidadesManager && typeof window.habilidadesManager.obtenerHabilidadesSeleccionadas === 'function') {
        habilidadesSeleccionadas = window.habilidadesManager.obtenerHabilidadesSeleccionadas();
      }

      // Convertir arrays de IDs a formato JSON para enviar al backend
      // Si el array está vacío, enviar null en lugar de "[]"
      const habilidadesBlandasJson = habilidadesSeleccionadas.blandas.length > 0 
        ? JSON.stringify(habilidadesSeleccionadas.blandas) 
        : null;
      const habilidadesTecnicasJson = habilidadesSeleccionadas.tecnicas.length > 0 
        ? JSON.stringify(habilidadesSeleccionadas.tecnicas) 
        : null;

      console.log("=== DEBUG ENVÍO DE HABILIDADES ===");
      console.log("Habilidades Blandas:", habilidadesSeleccionadas.blandas);
      console.log("Habilidades Técnicas:", habilidadesSeleccionadas.tecnicas);
      console.log("Habilidades Blandas JSON:", habilidadesBlandasJson);
      console.log("Habilidades Técnicas JSON:", habilidadesTecnicasJson);

      ajaxAwaitFormData(
        {
          api: 6,
          activo: activo,
          id_blanda: habilidadesBlandasJson,
          id_tecnica: habilidadesTecnicasJson
        },
        "recursos_humanos_api",
        "registrarPuestoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarPuestoForm")[0].reset();
            $("#registrarPuestoModal").modal("hide");
            alertToast(
              esEdicion ? "Puesto actualizado!" : "Puesto registrado!",
              "success",
              4000
            );
            if (tableCatPuestos) tableCatPuestos.ajax.reload();
            
            // Limpiar las habilidades seleccionadas
            if (window.habilidadesManager && typeof window.habilidadesManager.establecerHabilidadesSeleccionadas === 'function') {
              window.habilidadesManager.establecerHabilidadesSeleccionadas([], []);
            }
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

// Registrar/Editar Motivo
$("#registrarMotivoForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarMotivoForm");
  var formData = new FormData(form);

  $("#motivoDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarMotivoForm #motivoActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let motivoIdValue = $("#motivoId").val();
  let esEdicion = motivoIdValue && motivoIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar este motivo?"
        : "¿Está a punto de registrar un nuevo motivo?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 10,
          activo: activo,
        },
        "recursos_humanos_api",
        "registrarMotivoForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            $("#registrarMotivoForm")[0].reset();
            $("#registrarMotivoModal").modal("hide");
            console.log("Motivo ID:", motivoIdValue);
            alertToast(
              esEdicion ? "Motivo actualizado!" : "Motivo registrado!",
              "success",
              4000
            );
            if (tableCatMotivos) tableCatMotivos.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

//Filtrar Motivos

// Variable para controlar el estado del filtro de motivos
let mostrarActivosMotivos = true;

// Función para configurar el toggle de filtro para motivos
function setupToggleFiltroMotivos() {
    // Event listener específico para el toggle de motivos
    $(document).on('click', '#toggleFiltroActivosMov', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const toggle = $(this);
        

        
        if (mostrarActivosMotivos) {
            // Cambiar a mostrar inactivos
            toggle.removeClass('bi-toggle-on text-secondary')
                  .addClass('bi-toggle-off text-secondary')
                  .attr('title', 'Mostrando inactivos - Click para ver activos');
            
            mostrarActivosMotivos = false;
            
            // Cambiar el API para mostrar inactivos
            dataTableCatMotivos = { api: 22 };
            
            console.log("Motivos: Mostrando INACTIVOS");
            alertToast("Mostrando motivos inactivos", "info", 2000);
            
        } else {
            // Cambiar a mostrar activos
            toggle.removeClass('bi-toggle-off text-secondary')
                  .addClass('bi-toggle-on text-secondary')
                  .attr('title', 'Mostrando activos - Click para ver inactivos');
            
            mostrarActivosMotivos = true;
            
            // Cambiar el API para mostrar activos
            dataTableCatMotivos = { api: 11 };
            
            console.log("Motivos: Mostrando ACTIVOS");
            alertToast("Mostrando motivos activos", "success", 2000);
        }
        
        // Recargar la tabla con el nuevo API
        tableCatMotivos.ajax.reload();
        
        // Actualizar el texto del botón
        updateFilterButtonTextMotivos();
    });
}

// Función para actualizar el texto del botón de filtro de motivos
function updateFilterButtonTextMotivos() {
    const iconoToggle = mostrarActivosMotivos ? 
        '<i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosMov" style="cursor: pointer; margin-left: 8px;" title="Mostrando activos - Click para ver inactivos"></i>' :
        '<i class="bi bi-toggle-off fs-5 text-secondary" id="toggleFiltroActivosMov" style="cursor: pointer; margin-left: 8px;" title="Mostrando inactivos - Click para ver activos"></i>';
    
    const botonCompleto = `<i class="bi bi-funnel me-2" id="iconoFiltroMotivos" title="Restablecer filtros"></i>Filtrar ${iconoToggle}`;
    
    // Buscar específicamente el botón de motivos y actualizar su contenido
    $('#tableCatMotivos_wrapper .btn.bg-gradient-filter').html(botonCompleto);
}

// Función para configurar el reset de filtros de motivos
function setupResetFiltrosMotivos() {
    // Event listener para el icono de funnel (reset) de motivos
    $(document).on('click', '#iconoFiltroMotivos', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Verificar si hay filtros aplicados
        if (mostrarActivosMotivos && dataTableCatMotivos.api === 12) {
            alertToast("No hay filtros aplicados para restablecer", "info", 3000);
            return;
        }
        
        // Mostrar confirmación
        alertMensajeConfirm(
            {
                title: "¿Restablecer filtros de motivos?",
                text: "Esto volverá a mostrar todos los motivos activos.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Sí, restablecer",
                cancelButtonText: "Cancelar"
            },
            function () {
                // Callback cuando el usuario confirma
                resetearFiltrosMotivos();
            },
            2 // Tipo 2 para mostrar botón de cancelar
        );
    });
}

// Función para resetear los filtros de motivos
function resetearFiltrosMotivos() {
    console.log("Restableciendo filtros de motivos...");
    
    // Resetear variables globales
    mostrarActivosMotivos = true;
    
    // Restablecer API por defecto (activos)
    dataTableCatMotivos = { api: 11 };
    
    // Actualizar el botón visualmente
    updateFilterButtonTextMotivos();
    
    // Recargar la tabla
    tableCatMotivos.ajax.reload(function() {
        // Callback después de recargar
        alertToast("Filtros de motivos restablecidos correctamente", "success", 3000);
    });
}

// Inicializar configuraciones de filtro al cargar las tablas
function inicializarFiltrosMotivos() {
    // Configurar los event listeners
    setupToggleFiltroMotivos();
    setupResetFiltrosMotivos();
}

// Llamar a la inicialización después de que se configuren las DataTables
$(document).ready(function() {
    // Esperar un momento para que las tablas se inicialicen
    setTimeout(function() {
        inicializarFiltrosMotivos();
    }, 1000);
});

// Registrar/Editar Blandas
$("#registrarBlandasForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarBlandasForm");
  var formData = new FormData(form);

  $("#blandasDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarBlandasForm #blandasActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let blandasIdValue = $("#blandasId").val();
  let esEdicion = blandasIdValue && blandasIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta habilidad blanda?"
        : "¿Está a punto de registrar una nueva habilidad blanda?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 17,
          activo: activo,
        },
        "recursos_humanos_api",
        "registrarBlandasForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            console.log("Blanda ID:", blandasIdValue);
            $("#registrarBlandasForm")[0].reset();
            $("#registrarBlandasModal").modal("hide");
            alertToast(
              esEdicion ? "Habilidad blanda actualizada!" : "Habilidad blanda registradoa!",
              "success",
              4000
            );
            if (tableCatBlandas) tableCatBlandas.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

//Filtrar Blandas

// Variable para controlar el estado del filtro de blandas
let mostrarActivosBlandas = true;

// Función para configurar el toggle de filtro para Blandas
function setupToggleFiltroBlandas() {
    // Event listener específico para el toggle de blandas
    $(document).on('click', '#toggleFiltroActivosBla', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const toggle = $(this);
        

        
        if (mostrarActivosBlandas) {
            // Cambiar a mostrar inactivos
            toggle.removeClass('bi-toggle-on text-secondary')
                  .addClass('bi-toggle-off text-secondary')
                  .attr('title', 'Mostrando inactivos - Click para ver activos');
            
            mostrarActivosBlandas = false;
            
            // Cambiar el API para mostrar inactivos
            dataTableCatBlandas = { api: 23 };
            
            console.log("Blandas: Mostrando INACTIVOS");
            alertToast("Mostrando Blandas inactivos", "info", 2000);
            
        } else {
            // Cambiar a mostrar activos
            toggle.removeClass('bi-toggle-off text-secondary')
                  .addClass('bi-toggle-on text-secondary')
                  .attr('title', 'Mostrando activos - Click para ver inactivos');
            
            mostrarActivosBlandas = true;
            
            // Cambiar el API para mostrar activos
            dataTableCatBlandas = { api: 16 };
            
            console.log("Blandas: Mostrando ACTIVOS");
            alertToast("Mostrando Blandas activos", "success", 2000);
        }
        
        // Recargar la tabla con el nuevo API
        tableCatBlandas.ajax.reload();
        
        // Actualizar el texto del botón
        updateFilterButtonTextBlandas();
    });
}

// Función para actualizar el texto del botón de filtro de blandas
function updateFilterButtonTextBlandas() {
    const iconoToggle = mostrarActivosBlandas ? 
        '<i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosBla" style="cursor: pointer; margin-left: 8px;" title="Mostrando activos - Click para ver inactivos"></i>' :
        '<i class="bi bi-toggle-off fs-5 text-secondary" id="toggleFiltroActivosBla" style="cursor: pointer; margin-left: 8px;" title="Mostrando inactivos - Click para ver activos"></i>';
    
    const botonCompleto = `<i class="bi bi-funnel me-2" id="iconoFiltroBlandas" title="Restablecer filtros"></i>Filtrar ${iconoToggle}`;
    
    // Buscar específicamente el botón de blandas y actualizar su contenido
    $('#tableCatBlandas_wrapper .btn.bg-gradient-filter').html(botonCompleto);
}

// Función para configurar el reset de filtros de blandas
function setupResetFiltrosBlandas() {
    // Event listener para el icono de funnel (reset) de blandas
    $(document).on('click', '#iconoFiltroBlandas', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Verificar si hay filtros aplicados
        if (mostrarActivosBlandas && dataTableCatBlandas.api === 18) {
            alertToast("No hay filtros aplicados para restablecer", "info", 3000);
            return;
        }
        
        // Mostrar confirmación
        alertMensajeConfirm(
            {
                title: "¿Restablecer filtros de blandas?",
                text: "Esto volverá a mostrar todos los blandas activos.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Sí, restablecer",
                cancelButtonText: "Cancelar"
            },
            function () {
                // Callback cuando el usuario confirma
                resetearFiltrosBlandas();
            },
            2 // Tipo 2 para mostrar botón de cancelar
        );
    });
}

// Función para resetear los filtros de blandas
function resetearFiltrosBlandas() {
    console.log("Restableciendo filtros de Blandas...");
    
    // Resetear variables globales
    mostrarActivosBlandas = true;
    
    // Restablecer API por defecto (activos)
    dataTableCatBlandas = { api: 16 };
    
    // Actualizar el botón visualmente
    updateFilterButtonTextBlandas();
    
    // Recargar la tabla
    tableCatBlandas.ajax.reload(function() {
        // Callback después de recargar
        alertToast("Filtros de Blandas restablecidos correctamente", "success", 3000);
    });
}

// Inicializar configuraciones de filtro al cargar las tablas
function inicializarFiltrosBlandas() {
    // Configurar los event listeners
    setupToggleFiltroBlandas();
    setupResetFiltrosBlandas();
}

// Llamar a la inicialización después de que se configuren las DataTables
$(document).ready(function() {
    // Esperar un momento para que las tablas se inicialicen
    setTimeout(function() {
        inicializarFiltrosBlandas();
    }, 1000);
});

// Registrar/Editar Técnicas
$("#registrarTecnicasForm").submit(function (event) {
  event.preventDefault();

  var form = document.getElementById("registrarTecnicasForm");
  var formData = new FormData(form);

  $("#tecnicasDescripcion").removeClass("is-invalid");

  var activo;
  if ($("#registrarTecnicasForm #tecnicasActivoCheck").is(":checked")) {
    activo = 1;
  } else {
    activo = 0;
  }

  let tecnicasIdValue = $("#tecnicasId").val();
  let esEdicion = tecnicasIdValue && tecnicasIdValue !== "";

  alertMensajeConfirm(
    {
      title: esEdicion
        ? "¿Está a punto de editar esta habilidad técnica?"
        : "¿Está a punto de registrar una nueva habilidad técnica?",
      text: "Asegúrate que los datos sean correctos.",
      icon: "warning",
    },
    function () {
      ajaxAwaitFormData(
        {
          api: 20,
          activo: activo,
        },
        "recursos_humanos_api",
        "registrarTecnicasForm",
        { callbackAfter: true },
        false,
        function (data) {
          if (data.response.code == 1) {
            console.log("Técnica ID:", tecnicasIdValue);
            $("#registrarTecnicasForm")[0].reset();
            $("#registrarTecnicasModal").modal("hide");
            alertToast(
              esEdicion ? "Habilidad técnica actualizada!" : "Habilidad técnica registrada!",
              "success",
              4000
            );
            if (tableCatTecnicas) tableCatTecnicas.ajax.reload();
          } else {
            alertToast(
              data.response.message || "Error al procesar la solicitud",
              "error",
              4000
            );
          }
        }
      );
    }
  );

  return false;
});

//Filtrar Técnicas

// Variable para controlar el estado del filtro de técnicas
let mostrarActivosTecnicas = true;

// Función para configurar el toggle de filtro para técnicas
function setupToggleFiltroTecnicas() {
    // Event listener específico para el toggle de técnicas
    $(document).on('click', '#toggleFiltroActivosTec', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        const toggle = $(this);
        

        
        if (mostrarActivosTecnicas) {
            // Cambiar a mostrar inactivos
            toggle.removeClass('bi-toggle-on text-secondary')
                  .addClass('bi-toggle-off text-secondary')
                  .attr('title', 'Mostrando inactivos - Click para ver activos');
            
            mostrarActivosTecnicas = false;
            
            // Cambiar el API para mostrar inactivos
            dataTableCatTecnicas = { api: 24 };
            
            console.log("Tecnicas: Mostrando INACTIVOS");
            alertToast("Mostrando Tecnicas inactivos", "info", 2000);
            
        } else {
            // Cambiar a mostrar activos
            toggle.removeClass('bi-toggle-off text-secondary')
                  .addClass('bi-toggle-on text-secondary')
                  .attr('title', 'Mostrando activos - Click para ver inactivos');
            
            mostrarActivosTecnicas = true;
            
            // Cambiar el API para mostrar activos
            dataTableCatTecnicas = { api: 19 };
            
            console.log("Tecnicas: Mostrando ACTIVOS");
            alertToast("Mostrando Tecnicas activos", "success", 2000);
        }
        
        // Recargar la tabla con el nuevo API
        tableCatTecnicas.ajax.reload();
        
        // Actualizar el texto del botón
        updateFilterButtonTextTecnicas();
    });
}

// Función para actualizar el texto del botón de filtro de Tecnicas
function updateFilterButtonTextTecnicas() {
    const iconoToggle = mostrarActivosTecnicas ? 
        '<i class="bi bi-toggle-on fs-5 text-secondary" id="toggleFiltroActivosTec" style="cursor: pointer; margin-left: 8px;" title="Mostrando activos - Click para ver inactivos"></i>' :
        '<i class="bi bi-toggle-off fs-5 text-secondary" id="toggleFiltroActivosTec" style="cursor: pointer; margin-left: 8px;" title="Mostrando inactivos - Click para ver activos"></i>';
    
    const botonCompleto = `<i class="bi bi-funnel me-2" id="iconoFiltroTecnicas" title="Restablecer filtros"></i>Filtrar ${iconoToggle}`;
    
    // Buscar específicamente el botón de Tecnicas y actualizar su contenido
    $('#tableCatTecnicas_wrapper .btn.bg-gradient-filter').html(botonCompleto);
}

// Función para configurar el reset de filtros de Tecnicas
function setupResetFiltrosTecnicas() {
    // Event listener para el icono de funnel (reset) de Tecnicas
    $(document).on('click', '#iconoFiltroTecnicas', function(e) {
        e.preventDefault();
        e.stopPropagation();
        
        // Verificar si hay filtros aplicados
        if (mostrarActivosTecnicas && dataTableCatTecnicas.api === 21) {
            alertToast("No hay filtros aplicados para restablecer", "info", 3000);
            return;
        }
        
        // Mostrar confirmación
        alertMensajeConfirm(
            {
                title: "¿Restablecer filtros de Tecnicas?",
                text: "Esto volverá a mostrar todos los Tecnicas activos.",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Sí, restablecer",
                cancelButtonText: "Cancelar"
            },
            function () {
                // Callback cuando el usuario confirma
                resetearFiltrosTecnicas();
            },
            2 // Tipo 2 para mostrar botón de cancelar
        );
    });
}

// Función para resetear los filtros de Tecnicas
function resetearFiltrosTecnicas() {
    console.log("Restableciendo filtros de Tecnicas...");
    
    // Resetear variables globales
    mostrarActivosTecnicas = true;
    
    // Restablecer API por defecto (activos)
    dataTableCatTecnicas = { api: 19 };
    
    // Actualizar el botón visualmente
    updateFilterButtonTextTecnicas();
    
    // Recargar la tabla
    tableCatTecnicas.ajax.reload(function() {
        // Callback después de recargar
        alertToast("Filtros de Tecnicas restablecidos correctamente", "success", 3000);
    });
}

// Inicializar configuraciones de filtro al cargar las tablas
function inicializarFiltrosTecnicas() {
    // Configurar los event listeners
    setupToggleFiltroTecnicas();
    setupResetFiltrosTecnicas();
}

// Llamar a la inicialización después de que se configuren las DataTables
$(document).ready(function() {
    // Esperar un momento para que las tablas se inicialicen
    setTimeout(function() {
        inicializarFiltrosTecnicas();
    }, 1000);
});



// Registrar una nueva requisición de vacante - CON VALIDACIÓN DE PERMISOS
$("#formRegistrarVacante").submit(function (event) {
    event.preventDefault();

    var form = document.getElementById("formRegistrarVacante");
    var formData = new FormData(form);

    // Validaciones básicas usando los campos que SÍ existen en el formulario
    var id_departamento = $("#departamento").val();
    var id_motivo = $("#motivo").val();
    var prioridad = $("#prioridad").val();
    var justificacion = $("#justificacion").val().trim();
    var tipo_contrato = $("#tipo_contrato").val();
    var tipo_jornada = $("#tipo_jornada").val();
    var tipo_modalidad = $("#tipo_modalidad").val();
    var dias_trabajo = $("#dias_trabajo").val();
    var hora_inicio = $("#hora_inicio").val();
    var hora_fin = $("#hora_fin").val();

    // Validar campos obligatorios
    if (!id_departamento) {
        alertToast("Debe seleccionar un departamento", "warning", 3000);
        return;
    }

    if (!id_motivo) {
        alertToast("Debe seleccionar un motivo", "warning", 3000);
        return;
    }

    if (!prioridad) {
        alertToast("Debe seleccionar una prioridad", "warning", 3000);
        return;
    }

    if (!justificacion) {
        alertToast("La justificación es obligatoria", "warning", 3000);
        return;
    }

    if (!tipo_contrato) {
        alertToast("Debe seleccionar el tipo de contrato", "warning", 3000);
        return;
    }

    if (!tipo_jornada) {
        alertToast("Debe seleccionar el tipo de jornada", "warning", 3000);
        return;
    }

    if (!tipo_modalidad) {
        alertToast("Debe seleccionar el tipo de modalidad", "warning", 3000);
        return;
    }

    if (!dias_trabajo) {
        alertToast("Debe seleccionar los días de trabajo", "warning", 3000);
        return;
    }

    // Validar horarios solo si se seleccionaron días
    if (dias_trabajo && (!hora_inicio || !hora_fin)) {
        alertToast("Debe especificar el horario de trabajo", "warning", 3000);
        return;
    }

    // Agregar el usuario_id al FormData para validación de permisos
    formData.append('usuario_id', window.userId || 0);

    console.log("=== DEBUG FORMULARIO REQUISICIÓN ===");
    console.log("Usuario ID para permisos:", window.userId);
    console.log("ID Departamento:", id_departamento);
    console.log("ID Motivo:", id_motivo);
    
    // Mostrar todos los datos del formulario
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    alertMensajeConfirm(
        {
            title: "¿Está a punto de registrar esta requisición?",
            text: "Verifique que todos los datos sean correctos.",
            icon: "warning",
        },
        function () {
            ajaxAwaitFormData(
                {
                    api: 1, // API para crear/actualizar requisiciones
                },
                "recursos_humanos_api",
                "formRegistrarVacante",
                { callbackAfter: true },
                false,
                function (data) {
                    console.log("=== RESPUESTA DEL SERVIDOR ===");
                    console.log("Respuesta completa:", data);
                    
                    if (data.response.code == 1) {
                        // Limpiar formulario
                        $("#formRegistrarVacante")[0].reset();
                        $("#registrarVacanteModal").modal("hide");

                        alertToast(
                            `Requisición registrada exitosamente!`,
                            "success",
                            4000
                        );

                        // Recargar tabla de requisiciones si existe
                        if (typeof tableCatRequisiciones !== 'undefined' && tableCatRequisiciones) {
                            tableCatRequisiciones.ajax.reload();
                        }
                        
                        if (typeof tableRequisiciones !== 'undefined' && tableRequisiciones) {
                            tableRequisiciones.ajax.reload();
                        }
                    } else {
                        console.error("Error en la respuesta:", data);
                        
                        // Verificar si es error de permisos
                        let mensajeError = "Error al registrar la requisición";
                        if (data.response && data.response.message) {
                            mensajeError = data.response.message;
                        }
                        
                        // Mensaje específico para permisos
                        if (mensajeError.includes("No tiene permisos")) {
                            alertToast(
                                "No tiene permisos para registrar requisiciones de vacantes. Contacte al administrador.",
                                "error",
                                5000
                            );
                        } else {
                            alertToast(mensajeError, "error", 4000);
                        }
                        
                        // Mostrar debug si está disponible
                        if (data.response && data.response.debug) {
                            console.error("Debug del servidor:", data.response.debug);
                        }
                    }
                }
            );
        },
        1
    );

    return false;
});

// === ENVÍO DEL FORMULARIO DE EDICIÓN ===
$(document).on('submit', '#formEditarRequisicion', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const idRequisicion = formData.get('id_requisicion');
    
    console.log("Enviando formulario de edición para requisición:", idRequisicion);
    
    // Preparar datos para la API usando los nombres correctos del stored procedure
    // Obtener el valor de días de trabajo y ajustarlo si es null o vacío
    let diasTrabajo = formData.get('dias_trabajo');
    if (diasTrabajo === null || diasTrabajo === "") {
      diasTrabajo = "otro";
    }
    const datosActualizacion = {
      api: 1, // Case 1 para crear/actualizar requisiciones
      id_requisicion: idRequisicion,
      id_departamento: formData.get('departamento') || $("#editarDepartamento").val(),
      id_motivo: formData.get('motivo') || $("#editarMotivo").val(),
      usuario_solicitante_id: formData.get('usuario_solicitante_id'), // El usuario original que solicitó
      prioridad: formData.get('prioridad'),
      justificacion: formData.get('justificacion'),
      estatus: formData.get('estatus'),
      id_puesto: formData.get('puesto') || $("#editarPuesto").val(),
      tipo_contrato: formData.get('tipo_contrato'),
      tipo_jornada: formData.get('tipo_jornada'),
      tipo_modalidad: formData.get('tipo_modalidad') || null,
      // idiomas: formData.get('idiomas') || null,
      dias_trabajo: diasTrabajo,
      dias_personalizados: formData.get('dias_personalizados') || null,
      hora_inicio: formData.get('hora_inicio'),
      hora_fin: formData.get('hora_fin'),
      observaciones_aprobacion: formData.get('observaciones_aprobacion') || null
    };
    
    console.log("Datos para actualización:", datosActualizacion);
    
    $.ajax({
        url: '../../../api/recursos_humanos_api.php',
        type: 'POST',
        data: datosActualizacion,
        beforeSend: function() {
            $('button[type="submit"]').html('<i class="spinner-border spinner-border-sm me-2"></i>Actualizando...');
            $('button[type="submit"]').prop('disabled', true);
        },
        success: function(response) {
            try {
                const data = JSON.parse(response);
                console.log("Respuesta de actualización:", data);
                
                if (data.response && data.response.code === 1) {
                    alertToast("¡Requisición actualizada exitosamente!", "success", 3000);
                    
                    // Cerrar modal
                    $("#editarRequisicionModal").modal("hide");
                    
                    // Recargar tabla
                    if (typeof tableCatRequisiciones !== 'undefined') {
                        tableCatRequisiciones.ajax.reload();
                    }
                    
                } else {
                    alertToast(data.response?.message || "Error al actualizar la requisición", "error", 4000);
                }
            } catch (error) {
                console.error("Error al procesar respuesta:", error);
                alertToast("Error al procesar la respuesta del servidor", "error", 3000);
            }
        },
        error: function(xhr, status, error) {
            console.error("Error AJAX:", error);
            alertToast("Error de conexión al actualizar", "error", 3000);
        },
        complete: function() {
            $('button[type="submit"]').html('<i class="bi bi-check-circle me-2"></i>Actualizar Requisición');
            $('button[type="submit"]').prop('disabled', false);
        }
    });
});

// === ENVÍO DEL FORMULARIO DE PUBLICACIÓN DE VACANTE ===
$(document).on('submit', '#formPublicarVacante', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Validaciones del formulario
    const idRequisicion = formData.get('id_requisicion');
    const tituloVacante = formData.get('titulo_vacante');
    const tipoPublicacion = formData.get('tipo_publicacion');
    const fechaLimite = formData.get('fecha_limite_publicacion');
    const maxPostulantes = formData.get('max_postulantes');
    
    // Validaciones
    if (!idRequisicion || !tituloVacante || !tipoPublicacion || !fechaLimite || !maxPostulantes) {
        alertToast('Por favor complete todos los campos obligatorios', 'error', 4000);
        return;
    }
    
    if (maxPostulantes < 1 || maxPostulantes > 500) {
        alertToast('La cantidad máxima de postulantes debe estar entre 1 y 500', 'error', 4000);
        return;
    }
    
    // Validar fecha no sea anterior a hoy
    const hoy = new Date().toISOString().split('T')[0];
    if (fechaLimite < hoy) {
        alertToast('La fecha límite no puede ser anterior a hoy', 'error', 4000);
        return;
    }
    
    // Convertir FormData a objeto para enviar a la función
    const formDataObj = {
        id_requisicion: idRequisicion,
        titulo_vacante: tituloVacante,
        tipo_publicacion: tipoPublicacion,
        estado_publicacion: 'publicada_normal', // SIEMPRE será 'publicada'
        fecha_limite_publicacion: fechaLimite,
        max_postulantes: maxPostulantes,
        descripcion_adicional: formData.get('descripcion_adicional') || ''
    };
    
    console.log('Datos del formulario de publicación:', formDataObj);
    
    // Mensaje de confirmación personalizado según el tipo
    let mensajeConfirmacion = '';
    switch(tipoPublicacion) {
        case 'interna':
            mensajeConfirmacion = '¿Confirma que desea publicar esta vacante SOLO INTERNAMENTE?';
            break;
        case 'externa':
            mensajeConfirmacion = '¿Confirma que desea publicar esta vacante SOLO EXTERNAMENTE?';
            break;
        case 'ambas':
            mensajeConfirmacion = '¿Confirma que desea publicar esta vacante INTERNA Y EXTERNAMENTE?';
            break;
    }
    
    Swal.fire({
        title: 'Confirmar Publicación',
        text: mensajeConfirmacion,
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, publicar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llamar a la función de publicación
            publicarVacanteConParametros(formDataObj);
        }
    });
});

// === ENVÍO DEL FORMULARIO DE EDICIÓN DE PUBLICACIÓN ===
$(document).on('submit', '#formEditarPublicacion', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    // Validaciones del formulario
    const idPublicacion = formData.get('id_publicacion');
    const idRequisicion = formData.get('id_requisicion');
    const tituloVacante = formData.get('titulo_vacante');
    const tipoPublicacion = formData.get('tipo_publicacion');
    const fechaLimite = formData.get('fecha_limite_publicacion');
    const maxPostulantes = formData.get('max_postulantes');
    
    // Validaciones
    if (!idPublicacion || !idRequisicion || !tituloVacante || !tipoPublicacion || !fechaLimite || !maxPostulantes) {
        alertToast('Por favor complete todos los campos obligatorios', 'error', 4000);
        return;
    }
    
    if (maxPostulantes < 1 || maxPostulantes > 500) {
        alertToast('La cantidad máxima de postulantes debe estar entre 1 y 500', 'error', 4000);
        return;
    }
    
    // Validar fecha no sea anterior a hoy
    const hoy = new Date().toISOString().split('T')[0];
    if (fechaLimite < hoy) {
        alertToast('La fecha límite no puede ser anterior a hoy', 'error', 4000);
        return;
    }
    
    // Convertir FormData a objeto para enviar a la función
    const formDataObj = {
        id_publicacion: idPublicacion,
        id_requisicion: idRequisicion,
        titulo_vacante: tituloVacante,
        tipo_publicacion: tipoPublicacion,
        estado_publicacion: 'publicada_editada', // Será edición siempre
        fecha_limite_publicacion: fechaLimite,
        max_postulantes: maxPostulantes,
        descripcion_adicional: formData.get('descripcion_adicional') || ''
    };
    
    console.log('Datos del formulario de edición:', formDataObj);
    
    // Mensaje de confirmación
    Swal.fire({
        title: 'Confirmar Actualización',
        text: '¿Confirma que desea guardar los cambios en esta publicación?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#ffc107',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Sí, guardar cambios',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            // Llamar a la función de actualización
            actualizarPublicacionVacante(formDataObj);
        }
    });
});