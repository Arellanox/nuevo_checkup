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
        margin: 2px 4px;
        cursor: pointer;
        color: white;
        border-radius: 8px;
    }

    .btn-aprobar-all:hover{ color: #004f5a; }
    .btn-generar-reporte:hover{ color: #761c19; }
    .btn-aprobar-all, .btn-generar-reporte{ color: #2b2b2b; }

    .btnEliminar{ background-color: #761c19; }
    .btnAprobar{ background-color: #004f5a; }
    .btnRechazar{ background-color: #dc3545; }
</style>