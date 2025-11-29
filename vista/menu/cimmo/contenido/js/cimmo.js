
// Inicializar DataTable
tablaPacientes = $('#tablaPacientes').DataTable({
    language: {
        url: "https://cdn.datatables.net/plug-ins/1.10.15/i18n/Spanish.json",
    },
    lengthChange: false,
    info: true,
    paging: false,
    sorting: false,
    scrollY: '50vh',
    scrollCollapse: true,
    ajax: {
        dataType: 'json',
        data: function (d) {
            return $.extend(d, dataTablePacientes);
        },
        method: 'POST',
        url: `../../../api/cimmo_api.php`,
        beforeSend: function () { 
       
        },
        complete: function () {
            // getResumen(TablaPacientesCaja);
        },
        dataSrc: 'response.data'
    },
    columns: [
        { data: 'ID_PACIENTE' },
        { data: 'PACIENTE' },
        { 
            data: 'REPORTE', render: function(data){
               // Si viene vacío, null o undefined → icono deshabilitado
                if (!data || data.trim() === "") {
                    return `
                        <i class="fa-solid fa-cloud-arrow-down" 
                            style="font-size:18px; color:#bfbfbf; cursor:not-allowed;" 
                            title="Sin archivo disponible"></i>
                    `;
                }

                // Si trae URL válida → icono clicable
                return `
                    <a href="${data}" download target="_blank" style="text-decoration:none;">
                        <i class="fa-solid fa-cloud-arrow-down" 
                            style="font-size:18px; color:#0f4e91;" 
                            title="Descargar archivo"></i>
                    </a>
                `;
            }
        }
    ],
    columnDefs: [
        { target: 0, className: 'all', title: 'ID' },
        { target: 1, className: 'all', title: 'Paciente' },
        { target: 2, className: 'all', title: 'Download'},
    ],
})

selectTable('#tablaPacientes', tablaPacientes, {
        unSelect: true, ClickClass: [
            {
                callback: async function (data) {

                    id_cimmo = 0;

                }, selected: true
            },

        ], dblClick: true, reload: ['col-xl-9']
    },
    // un solo click 
    async function (select, data, callback) {
        //
        id_cimmo = data.ID_CIMO;
        $("#spanNombrePaciente").html(data.PACIENTE);
        $("#spanIdPaciente").html(data.ID_PACIENTE);

        const panel = $("#panelResultados");
        panel.addClass("highlight");
        setTimeout(() => panel.removeClass("highlight"), 700);

        // carga resultados si existen
        $("#vih").val(data.VIH_1_2);
        $("#vhb").val(data.VHB);
        $("#vhc").val(data.VHC);
        $("#observaciones").val(data.OBSERVACIONES);

        //manipular acordeon
        $("#formPaciente")[0].reset();
        $("#nuevoPaciente").collapse("hide");

        // Mostrar icono de reporte o boton de confirmar
        if(data.CONFIRMADO == 1){
            $("#verPDF").css("display", "block");
            $("#linkPDF").attr("href", data.REPORTE);

            $("#verBtnConfirmar").css("display", "none");
        } else {
            $("#verPDF").css("display", "none");
            $("#linkPDF").attr("href", "#");
            $("#verBtnConfirmar").css("display", "block");
        }

                
    },
    // doble click
    async function (select, data, callback){
        id_cimmo = data.ID_CIMO;

        const mapaSexo = {
            "MASCULINO": 1,
            "FEMENIMO": 2
        };


        if(select){
            $("#id_paciente").val(data.ID_PACIENTE);
            $("#paciente").val(data.PACIENTE);
            $("#sexo").val(mapaSexo[data.SEXO] || "");
            $("#nacimiento").val(data.FECHA_NACIMIENTO);
            $("#edad").val(data.EDAD);

            // Abrir acordeón
            $("#nuevoPaciente").collapse("show");

            // Scroll suave
            $("html, body").animate({
                scrollTop: $("#nuevoPaciente").offset().top - 100
            }, 500);

            // Enfocar el primer input (opcional)
            setTimeout(() => {
                $("#id_paciente").focus();
            }, 600);
            
        }
    }
)


$("#formPaciente").submit(function(event){
    event.preventDefault();

    $("#btnGuardarPaciente").prop("disabled", true).text("Guardando...");

    ajaxAwaitFormData({ api: 1}, 'cimmo_api', 'formPaciente', { callbackAfter: true }, false,
            (data) => {

                if(data.response.code){
                    alertToast('Paciente agregado!', 'success', 4000);

                    // refrescar el listado de pacientes
                    tablaPacientes.ajax.reload();
                } else {
                    alertToast("Error al registrar... " + data.response.data, 'error', 4000);
                }

                this.reset();
                $("#btnGuardarPaciente").prop("disabled", false).text("Guardar");

            })
})

// Guardar resultados
$("#formResultados").submit(function(event){
    event.preventDefault();

    ajaxAwaitFormData({ api: 2, id_cimmo: id_cimmo }, 'cimmo_api', 'formResultados', { callbackAfter: true }, false,
        (data) => {
            if(data.response.code){
                alertToast("Resultados guardados!", "success", 4000);
                // refrescar el listado de pacientes
                tablaPacientes.ajax.reload();
            } else {
                alertToast("Ha ocurrido un error. No se guardaron los resultados", "error", 4000);
            }
        }
    )
})


// Confirmar el resultados y cerrar
$("#btnConfirmar").on("click", function(){
     ajaxAwait({api: 4, id_cimmo: id_cimmo}, 'cimmo_api', {callbackAfter: true}, false, (data) => {

        if (data.response.code) {
            alertToast("Resultados CONFIRMADOS!", "success", 4000);
            tablaPacientes.ajax.reload();
        } else {
            alertToast("ERROR", "error", 4000);
        }
    })
})


// filtrar la lista de pacientes

$("#filtroFecha").on("change", function(){
    dataTablePacientes['fecha_inicio'] = $(this).val();

    tablaPacientes.ajax.reload();
})


$("#btnDescargarZip").on('click', function(){
    var fecha = $("#filtroFecha").val();

  window.open('http://localhost/nuevo_checkup/api/cimmo_api.php?api=6&fecha_inicio='+fecha)
})