<div class="px-3 py-3">
    <table class="table table-hover display" id="TablaMaquilaasPorAprobar">
        <thead>
        <tr>
            <th>Folio</th>
            <th>Prefolio</th>
            <th>Laboratorio</th>
            <th>Servicio</th>
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

<style>
    #TablaMaquilaasPorAprobar_filter{
        width: 100% !important;

    }
    #TablaMaquilaasPorAprobar_filter input{
        width: 100% !important;
    }
    div.dataTables_wrapper div.dataTables_filter input{
        margin-left: 0 !important;
        display: block !important;
        width: 100% !important;
        height: 30px !important;
    }
    div.dataTables_wrapper div.dataTables_filter label{
        width: 100% !important;
        display: block !important;
        margin-bottom: 10px !important;
        color: #2b2b2b;
    }
    #TablaMaquilaasPorAprobar_wrapper .row:first-child .col-sm-12.col-md-6:last-child{
        width: 100% !important;
    }

    .btnRechazar,
    .btnEliminar,
    .btnAprobar,
    .btn-generar-reporte,
    .btn-aprobar-all{
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 4px 10px;
        cursor: pointer;
        color: white;
        border-radius: 4px;
        border: none;
    }

    .btnAprobar,
    .btnRechazar,
    .btnEliminar{
        box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.25);
    }

    .btnRechazar:disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    .btnAprobar:disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    .btnEliminar:disabled {
        opacity: .5;
        cursor: not-allowed;
    }

    .btn-aprobar-all:hover{ color: #004f5a; }
    .btn-generar-reporte:hover{ color: #761c19; }
    .btn-aprobar-all, .btn-generar-reporte{ color: #2b2b2b; }

    .btnEliminar{ background-color: #761c19; }
    .btnAprobar{ background-color: #004f5a; }
    .btnRechazar{ background-color: #aa4b28; }
</style>