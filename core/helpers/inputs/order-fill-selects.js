function orderAndFillSelects(
  select = false,
  api,
  apinum,
  valorKey,
  textoKey,
  valores = {},
  callback = () => {}
) {
  return new Promise((resolve) => {
    valores.api = apinum;
    limpiarSelect(select);

    $.ajax({
      url: `${http}${servidor}/${appname}/api/${api}.php`,
      data: valores,
      type: "POST",
      success: function (data) {
        data = procesarRespuesta(data);
        if (!data) return;

        let opciones = generarOpcionesOrdenadas(data, valorKey, textoKey);
        insertarOpciones(select, opciones);

        callback(opciones);
      },
      complete: () => resolve(1),
      error: alertErrorAJAX,
    });
  });
}

/**
 * Limpia el select antes de insertar nuevas opciones
 */
function limpiarSelect(select) {
  if (select) $(select).empty();
}

/**
 * Procesa la respuesta del servidor y la convierte en un array de objetos
 */
function procesarRespuesta(data) {
  if (typeof data === "string" && data.includes("response")) {
    data = JSON.parse(data);
    if (!mensajeAjax(data)) return false;
    return data["response"]["data"];
  }
  return JSON.parse(data);
}

/**
 * Genera las opciones ordenadas para el select
 */
function generarOpcionesOrdenadas(data, valorKey, textoKey) {
  return Object.values(data)
    .map((element) => ({
      value: element[valorKey],
      label: construirTextoLabel(element, textoKey),
    }))
    .sort((a, b) => a.label.localeCompare(b.label));
}

/**
 * Construye el texto del label para cada opción
 */
function construirTextoLabel(element, textoKey) {
  if (Array.isArray(textoKey)) {
    return textoKey
      .map((field) => element[field] || "")
      .filter(Boolean)
      .join(" - ");
  }
  return element[textoKey] || "";
}

/**
 * Inserta las opciones dentro del select
 */
function insertarOpciones(select, opciones) {
  if (!select) return;

  opciones.forEach(({ value, label }) => {
    $(select).append(new Option(label, value));
  });
}
