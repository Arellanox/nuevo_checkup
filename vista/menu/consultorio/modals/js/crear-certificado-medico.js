//Nuevo formulario crear certificado BIMO
const modealCertificadoBIMO = document.getElementById("modalCrearCertificadoBIMO");
modalMotivoConsulta.addEventListener("show.bs.modal", (event) => function (array) {
    alert('open');
});


document.addEventListener("DOMContentLoaded", function () {
    const btnAgregarEstudio = document.getElementById("btnAgregarEstudio");
    const listaEstudios = document.getElementById("listaEstudios");

    btnAgregarEstudio.addEventListener("click", function () {
        // Crear contenedor del nuevo estudio
        const nuevoEstudio = document.createElement("div");
        nuevoEstudio.classList.add("row", "mt-2");
        // Crear el campo de selección de estudios
        const colEstudio = document.createElement("div");
        colEstudio.classList.add("col-6");
        colEstudio.innerHTML = `
            <label class="form-label">Seleccionar Estudio</label>
            <select name="estudios[]" class="form-select-estudios form-select input-form" required>
                <option value="">Seleccione un estudio</option>
                <option value="Sangre">Análisis de Sangre</option>
                <option value="Rayos X">Rayos X</option>
                <option value="Electrocardiograma">Electrocardiograma</option>
            </select>
        `;

        // Crear el campo de diagnóstico
        const colDiagnostico = document.createElement("div");
        colDiagnostico.classList.add("col-6");
        colDiagnostico.innerHTML = `
            <label class="form-label">Diagnósticos</label>
            <input type="text" name="diagnosticos[]" class="form-set-diagnostico form-control input-form" required>
        `;

        // Botón para eliminar el estudio agregado
        const colEliminar = document.createElement("div");
        colEliminar.classList.add("col-12", "text-end", "mt-1");
        const btnEliminar = document.createElement("button");
        btnEliminar.classList.add("btn", "btn-danger", "btn-sm");
        btnEliminar.innerHTML = "Eliminar";
        btnEliminar.addEventListener("click", function () {
            listaEstudios.removeChild(nuevoEstudio);
        });
        colEliminar.appendChild(btnEliminar);

        // Agregar elementos al contenedor
        nuevoEstudio.appendChild(colEstudio);
        nuevoEstudio.appendChild(colDiagnostico);
        nuevoEstudio.appendChild(colEliminar);

        // Agregar nuevo estudio a la lista
        listaEstudios.appendChild(nuevoEstudio);

    });

});