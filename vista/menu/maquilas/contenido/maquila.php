<div class="px-3 py-3">
    <table class="table table-hover display" id="TablaMaquilaasPorAprobar">
        <thead>
        <tr>
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
</style>