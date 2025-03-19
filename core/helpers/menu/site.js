function obtenerHeader(menu, tip) {
    $.post(`${current_url}/vista/include/header/header.php`, {menu: menu, tip: tip}, function(html) {
        $("#header-js").html(html);
    });
}

function obtenerTitulo(menu, tipo = null) { //Usar async await para no tener problemas con inputs de fecha
    return new Promise(resolve => {
        $.post(`${current_url}/vista/include/header/titulo.php`, {menu: menu, tipo: tipo}, function(html) {
            $("#titulo-js").html(html);
        }).done(function() { resolve(1); });
    });
}

//==============================================
//Cargador de Vistas para entrar a los servicios
//==============================================
function obtenerAreaActiva() {
    return typeof areaActual === 'undefined' ? areaActiva : areaActual;
}

function cargarVistaServiciosPorArea(hash) {
    if (event?.preventDefault) event.preventDefault();

    const subarea = obtenerAreaActiva();
    if (!subarea) return;

    const areasConBase64 = new Set([3, 4, 5, 7, 8, 9]);

    if (subarea === 6) {
        cargarVistaServiciosPorAreaURL(hash, 'laboratorio-servicios');
    } else if (areasConBase64.has(subarea)) {
        const s = new Base64().encode(subarea);
        cargarVistaServiciosPorAreaURL(hash, 'area-servicios', `?var=${s}`);
    }
}

function cargarVistaServiciosPorAreaURL(hash, ubicacion, variables = '') {
    switch (hash) {
        case 'Estudios':
            window.location.href = `${current_url}/vista/menu/${ubicacion}/${variables}#Estudios`;
            break;
        case 'Grupos':
            window.location.href = `${current_url}/vista/menu/${ubicacion}/${variables}#Grupos`;
            break;
    }
}
