<div class="d-block gap-2">
    <div class="rounded p-3 shadow-sm my-2 table-responsive bg-white mx-4 my-4" style="flex: 1; ">
        <table class="table table-hover display responsive" id="TablaMaquilaasPorAprobar">
            <thead>
            <tr>
                <th>Prefolio</th>
                <th>Laboratorio</th>
                <th>Servicio</th>
                <th>Total Estudios</th>
                <th>Paciente</th>
                <th>Solicitado Por</th>
                <th>Estado</th>
                <th>Fecha de Registro</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<style>
    .btn-generar-reporte,
    .btn-aprobar-all{
        display: flex;
        align-items: center;
        padding: 4px 10px;
        cursor: pointer;
        border-radius: 4px;
        margin-right: 10px;
        color: #2b2b2b;
        gap: 8px;
    }

    .btnAprobar,
    .btnRechazar,
    .btnEliminar {
        background: #004f5a;
        color: white;
    }

    .btnAprobar:hover,
    .btnRechazar:hover,
    .btnEliminar:hover {
        background: #007587;
        color: white;
    }

    .btn-aprobar-all:hover{ background: #004f5a; color: white; }
    .btn-generar-reporte:hover{ background: #761c19; color: white }

    #modal-body-maquila-estudios-table {
        min-height: 400px;
    }
    #empty_message{
        padding: 10px 20px;
        display: flex;
        flex-direction: column;
        height: 400px;
        align-items: center;
        justify-content: center;
    }

    .btn-confirmar-laboratorios {
        border: none;
        border-radius: 10px;
        height: 40px;
        padding: 0 20px;
        color: white;
        background: #d58512;
        transition: all;
        transition-duration: 300s;
    }
    .btn-confirmar-laboratorios:hover{
        background: #12d58a !important;
    }
    .btn-confirmar-laboratorios.active{
        background: #12d58a !important;
    }


    /* Estilos para la tabla de servicios expandible */
    tr.servicio-row {
        background: white !important;
    }

    .servicio-row:hover {
        background-color: #e3f2fd !important;
    }

    .estudio-row:hover {
        background-color: #f8f9fa !important;
    }

    .expand-icon {
        transition: transform 0.2s ease;
        color: #004e59;
    }

    .badge-sm {
        font-size: 0.75em;
        padding: 0.25em 0.5em;
    }

    /* Animación suave para los iconos */
    .bi-chevron-right, .bi-chevron-down, .bi-chevron-up {
        transition: transform 0.2s ease;
    }

    /* Estilos para los badges de tipo de servicio */
    .badge-primary {
        background-color: rgba(0, 78, 89, 0.78);
        color: white;
    }

    .badge-secondary {
        background-color: #6c757d;
        color: white;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    /* Mejoras visuales para la información de estudios */
    .estudio-row small {
        line-height: 1.4;
    }

    .estudio-row .bi {
        margin-right: 3px;
    }

    .not-hover:hover{
        background: white !important;
    }
</style>