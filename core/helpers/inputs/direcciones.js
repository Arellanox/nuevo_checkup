function cargarDireccionEstadosSelect(id) {
    const estados = [
        "Tabasco", "Aguascalientes", "Baja California", "Baja California Sur", "Campeche", "Chiapas",
        "Chihuahua", "Coahuila", "Colima", "Ciudad de México", "Durango", "Estado de México",
        "Guanajuato", "Guerrero", "Hidalgo", "Jalisco", "Michoacán", "Morelos", "Nayarit",
        "Nuevo León", "Oaxaca", "Puebla", "Querétaro", "Quintana Roo", "San Luis Potosí",
        "Sinaloa", "Sonora", "Tamaulipas", "Tlaxcala", "Veracruz", "Yucatán", "Zacatecas"
    ];

    const selectEstado = document.getElementById(id);

    estados.forEach(estado => {
        let option = document.createElement("option");
        option.value = estado;
        option.textContent = estado;
        selectEstado.appendChild(option);
    });
}