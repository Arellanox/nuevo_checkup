<div class="rounded p-3 shadow-sm my-2 table-responsive bg-white mx-4 my-4">
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
</style>