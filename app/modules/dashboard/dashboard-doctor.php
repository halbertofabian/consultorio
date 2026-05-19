<?php
require_once(__DIR__ . '/../app/conexion.php');

$tenantid = $_SESSION['usr']['tenantid'];
$doctorId = $_SESSION['usr']['usr_id'];
$hoy = date('Y-m-d');

$con = Conexion::conectar();

$sqlPacientes = "SELECT COUNT(*) AS total FROM tbl_pacientes_pte WHERE tenantid = ? AND pte_estado_borrado = 1";
$ppsPacientes = $con->prepare($sqlPacientes);
$ppsPacientes->bindValue(1, $tenantid);
$ppsPacientes->execute();
$totalPacientes = (int)$ppsPacientes->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasPendientes = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND cts_usr_id = ? AND cts_estado = 'Pendiente'";
$ppsCitasPendientes = $con->prepare($sqlCitasPendientes);
$ppsCitasPendientes->bindValue(1, $tenantid);
$ppsCitasPendientes->bindValue(2, $doctorId);
$ppsCitasPendientes->execute();
$totalCitasPendientes = (int)$ppsCitasPendientes->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasActivas = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND cts_usr_id = ? AND cts_estado = 'Pendiente' AND cts_fecha_inicio >= ?";
$ppsCitasActivas = $con->prepare($sqlCitasActivas);
$ppsCitasActivas->bindValue(1, $tenantid);
$ppsCitasActivas->bindValue(2, $doctorId);
$ppsCitasActivas->bindValue(3, date('Y-m-d H:i:s'));
$ppsCitasActivas->execute();
$totalCitasActivas = (int)$ppsCitasActivas->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasVencidas = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND cts_usr_id = ? AND cts_estado = 'Pendiente' AND cts_fecha_inicio < ?";
$ppsCitasVencidas = $con->prepare($sqlCitasVencidas);
$ppsCitasVencidas->bindValue(1, $tenantid);
$ppsCitasVencidas->bindValue(2, $doctorId);
$ppsCitasVencidas->bindValue(3, date('Y-m-d H:i:s'));
$ppsCitasVencidas->execute();
$totalCitasVencidas = (int)$ppsCitasVencidas->fetch(PDO::FETCH_ASSOC)['total'];

$sqlConsultas = "SELECT COUNT(*) AS total FROM tbl_consultas_cta WHERE tenantid = ? AND cta_usr_id = ? AND cta_estado_borrado = 1";
$ppsConsultas = $con->prepare($sqlConsultas);
$ppsConsultas->bindValue(1, $tenantid);
$ppsConsultas->bindValue(2, $doctorId);
$ppsConsultas->execute();
$totalConsultas = (int)$ppsConsultas->fetch(PDO::FETCH_ASSOC)['total'];

$sqlProximas = "SELECT c.cts_id, c.cts_fecha_inicio, c.cts_estado, p.pte_nombres, p.pte_ap_paterno, p.pte_ap_materno
FROM tbl_citas_cts c
JOIN tbl_pacientes_pte p ON p.pte_id = c.cts_pte_id
WHERE c.tenantid = ? AND c.cts_usr_id = ? AND c.cts_estado IN ('Pendiente', 'AsistiÃ³') AND c.cts_fecha_inicio >= ?
ORDER BY c.cts_fecha_inicio ASC
LIMIT 5";
$ppsProximas = $con->prepare($sqlProximas);
$ppsProximas->bindValue(1, $tenantid);
$ppsProximas->bindValue(2, $doctorId);
$ppsProximas->bindValue(3, $hoy . ' 00:00:00');
$ppsProximas->execute();
$proximasCitas = $ppsProximas->fetchAll(PDO::FETCH_ASSOC);

$ocupacionAgenda = $totalPacientes > 0 ? round(($totalCitasPendientes / $totalPacientes) * 100) : 0;

function estadoBadgeDoctor($estado)
{
    if ($estado == 'Pendiente') {
        return 'badge bg-warning text-dark';
    }
    return 'badge bg-success';
}
?>

<style>
    .db-wrap {
        --db-ink: #0f172a;
        --db-soft: #64748b;
        --db-line: #e2e8f0;
        --db-bg-1: #eff6ff;
        --db-bg-2: #fff7ed;
        --db-bg-3: #ecfeff;
    }

    .db-card-kpi {
        border: 1px solid var(--db-line);
        border-radius: 16px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
        position: relative;
        overflow: hidden;
    }

    .db-card-kpi::after {
        content: "";
        position: absolute;
        right: -40px;
        top: -40px;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .65);
    }

    .db-card-kpi.bg-1 { background: linear-gradient(135deg, var(--db-bg-1) 0%, #ffffff 70%); }
    .db-card-kpi.bg-2 { background: linear-gradient(135deg, var(--db-bg-2) 0%, #ffffff 70%); }
    .db-card-kpi.bg-3 { background: linear-gradient(135deg, var(--db-bg-3) 0%, #ffffff 70%); }

    .db-kpi-title {
        font-size: .75rem;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--db-soft);
        margin-bottom: .5rem;
        font-weight: 700;
    }

    .db-kpi-value {
        font-size: 2.15rem;
        line-height: 1;
        font-weight: 700;
        color: var(--db-ink);
        margin-bottom: .35rem;
    }

    .db-kpi-sub {
        font-size: .78rem;
        color: var(--db-soft);
        margin: 0;
    }

    .db-kpi-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .8rem;
        font-size: 1.05rem;
    }

    .db-kpi-icon.i1 { background: rgba(37, 99, 235, .12); color: #1d4ed8; }
    .db-kpi-icon.i2 { background: rgba(249, 115, 22, .14); color: #c2410c; }
    .db-kpi-icon.i3 { background: rgba(20, 184, 166, .14); color: #0f766e; }

    .db-panel {
        border: 1px solid var(--db-line);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
    }

    .db-panel .card-header {
        border-bottom: 1px solid var(--db-line);
        background: linear-gradient(90deg, #f8fafc 0%, #eef2ff 100%);
    }

    .db-panel-title {
        margin: 0;
        font-weight: 700;
        color: #0f172a;
    }

    .db-mini-tag {
        font-size: .72rem;
        color: var(--db-soft);
        background: #f1f5f9;
        border-radius: 999px;
        padding: .25rem .65rem;
    }

    .db-table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #475569;
        border-bottom: 1px solid var(--db-line);
        padding-top: .85rem;
        padding-bottom: .85rem;
    }

    .db-table tbody td {
        vertical-align: middle;
    }

    .db-quick-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: .65rem;
    }

    .db-quick-tile {
        border: 1px solid var(--db-line);
        border-radius: 12px;
        padding: .75rem;
        text-decoration: none;
        color: var(--db-ink);
        background: #fff;
        transition: .2s ease;
    }

    .db-quick-tile:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(15, 23, 42, .12);
        border-color: #93c5fd;
        color: var(--db-ink);
    }

    .db-quick-top {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin-bottom: .35rem;
    }

    .db-quick-ico {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
    }

    .db-quick-ico.q1 { background: #dbeafe; color: #1d4ed8; }
    .db-quick-ico.q2 { background: #e0f2fe; color: #0369a1; }
    .db-quick-ico.q3 { background: #dcfce7; color: #166534; }

    .db-quick-name {
        font-weight: 700;
        font-size: .86rem;
    }

    .db-quick-desc {
        font-size: .76rem;
        color: var(--db-soft);
        margin: 0;
    }
</style>

<div class="db-wrap">
<div class="row g-3 mt-1 mb-1">
    <div class="col-lg-3 col-md-6">
        <div class="card db-card-kpi bg-1 h-100">
            <div class="card-body">
                <span class="db-kpi-icon i1"><i class="fas fa-user-injured"></i></span>
                <p class="db-kpi-title">Pacientes activos</p>
                <p class="db-kpi-value"><?= $totalPacientes ?></p>
                <p class="db-kpi-sub">Base total del consultorio</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card db-card-kpi bg-2 h-100">
            <div class="card-body">
                <span class="db-kpi-icon i2"><i class="fas fa-calendar-check"></i></span>
                <p class="db-kpi-title">Citas activas</p>
                <p class="db-kpi-value"><?= $totalCitasActivas ?></p>
                <p class="db-kpi-sub">Pendientes con fecha futura</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card db-card-kpi bg-2 h-100">
            <div class="card-body">
                <span class="db-kpi-icon i2"><i class="fas fa-exclamation-triangle"></i></span>
                <p class="db-kpi-title">Citas vencidas</p>
                <p class="db-kpi-value"><?= $totalCitasVencidas ?></p>
                <p class="db-kpi-sub">Pendientes con fecha pasada</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card db-card-kpi bg-3 h-100">
            <div class="card-body">
                <span class="db-kpi-icon i3"><i class="fas fa-notes-medical"></i></span>
                <p class="db-kpi-title">Consultas registradas</p>
                <p class="db-kpi-value"><?= $totalConsultas ?></p>
                <p class="db-kpi-sub">Historial de atenciones</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-8">
        <div class="card db-panel">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="db-panel-title">Proximas citas</h6>
                <span class="db-mini-tag"><?= count($proximasCitas) ?> en lista</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 db-table">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proximasCitas)) : ?>
                                <?php foreach ($proximasCitas as $cita) : ?>
                                    <tr>
                                        <td><?= $cita['pte_nombres'] . ' ' . $cita['pte_ap_paterno'] . ' ' . $cita['pte_ap_materno'] ?></td>
                                        <td><?= $cita['cts_fecha_inicio'] ?></td>
                                        <td><span class="<?= estadoBadgeDoctor($cita['cts_estado']) ?>"><?= $cita['cts_estado'] ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="3" class="text-center">Sin citas proximas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card db-panel mb-3">
            <div class="card-header">
                <h6 class="db-panel-title">Estado de agenda</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-600">Pendientes vs pacientes</small>
                    <small class="fw-bold"><?= $ocupacionAgenda ?>%</small>
                </div>
                <div class="progress" style="height:8px;">
                    <div class="progress-bar bg-warning" style="width: <?= $ocupacionAgenda ?>%"></div>
                </div>
            </div>
        </div>
        <div class="card db-panel">
            <div class="card-header">
                <h6 class="db-panel-title">Accesos rapidos</h6>
            </div>
            <div class="card-body">
                <div class="db-quick-grid">
                    <a class="db-quick-tile" href="<?= HTTP_HOST ?>citas/list">
                        <div class="db-quick-top">
                            <span class="db-quick-ico q1"><i class="fas fa-calendar-alt"></i></span>
                            <span class="db-quick-name">Calendario de citas</span>
                        </div>
                        <p class="db-quick-desc">Consulta agenda semanal y diaria.</p>
                    </a>
                    <a class="db-quick-tile" href="<?= HTTP_HOST ?>pacientes/list">
                        <div class="db-quick-top">
                            <span class="db-quick-ico q2"><i class="fas fa-users"></i></span>
                            <span class="db-quick-name">Pacientes</span>
                        </div>
                        <p class="db-quick-desc">Busqueda rapida y gestion de expedientes.</p>
                    </a>
                    <a class="db-quick-tile" href="<?= HTTP_HOST ?>consultas/list">
                        <div class="db-quick-top">
                            <span class="db-quick-ico q3"><i class="fas fa-stethoscope"></i></span>
                            <span class="db-quick-name">Consultas</span>
                        </div>
                        <p class="db-quick-desc">Revisa atenciones y seguimiento clinico.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
