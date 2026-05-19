<?php
require_once(__DIR__ . '/../app/conexion.php');

$tenantid = $_SESSION['usr']['tenantid'];
$hoy = date('Y-m-d');

$con = Conexion::conectar();

$sqlPacientes = "SELECT COUNT(*) AS total FROM tbl_pacientes_pte WHERE tenantid = ? AND pte_estado_borrado = 1";
$ppsPacientes = $con->prepare($sqlPacientes);
$ppsPacientes->bindValue(1, $tenantid);
$ppsPacientes->execute();
$totalPacientes = (int)$ppsPacientes->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasPendientes = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND cts_estado = 'Pendiente'";
$ppsCitasPendientes = $con->prepare($sqlCitasPendientes);
$ppsCitasPendientes->bindValue(1, $tenantid);
$ppsCitasPendientes->execute();
$totalCitasPendientes = (int)$ppsCitasPendientes->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasActivas = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND cts_estado = 'Pendiente' AND cts_fecha_inicio >= ?";
$ppsCitasActivas = $con->prepare($sqlCitasActivas);
$ppsCitasActivas->bindValue(1, $tenantid);
$ppsCitasActivas->bindValue(2, date('Y-m-d H:i:s'));
$ppsCitasActivas->execute();
$totalCitasActivas = (int)$ppsCitasActivas->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasVencidas = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND cts_estado = 'Pendiente' AND cts_fecha_inicio < ?";
$ppsCitasVencidas = $con->prepare($sqlCitasVencidas);
$ppsCitasVencidas->bindValue(1, $tenantid);
$ppsCitasVencidas->bindValue(2, date('Y-m-d H:i:s'));
$ppsCitasVencidas->execute();
$totalCitasVencidas = (int)$ppsCitasVencidas->fetch(PDO::FETCH_ASSOC)['total'];

$sqlCitasHoy = "SELECT COUNT(*) AS total FROM tbl_citas_cts WHERE tenantid = ? AND DATE(cts_fecha_inicio) = ? AND cts_estado IN ('Pendiente', 'AsistiÃ³')";
$ppsCitasHoy = $con->prepare($sqlCitasHoy);
$ppsCitasHoy->bindValue(1, $tenantid);
$ppsCitasHoy->bindValue(2, $hoy);
$ppsCitasHoy->execute();
$totalCitasHoy = (int)$ppsCitasHoy->fetch(PDO::FETCH_ASSOC)['total'];

$sqlProximas = "SELECT c.cts_fecha_inicio, c.cts_estado, u.usr_nombre, p.pte_nombres, p.pte_ap_paterno, p.pte_ap_materno
FROM tbl_citas_cts c
JOIN tbl_usuarios_usr u ON u.usr_id = c.cts_usr_id
JOIN tbl_pacientes_pte p ON p.pte_id = c.cts_pte_id
WHERE c.tenantid = ? AND c.cts_estado IN ('Pendiente', 'AsistiÃ³') AND c.cts_fecha_inicio >= ?
ORDER BY c.cts_fecha_inicio ASC
LIMIT 7";
$ppsProximas = $con->prepare($sqlProximas);
$ppsProximas->bindValue(1, $tenantid);
$ppsProximas->bindValue(2, $hoy . ' 00:00:00');
$ppsProximas->execute();
$proximasCitas = $ppsProximas->fetchAll(PDO::FETCH_ASSOC);

$citasOperativas = $totalCitasPendientes + $totalCitasHoy;
$ratioHoy = $citasOperativas > 0 ? round(($totalCitasHoy / $citasOperativas) * 100) : 0;

function estadoBadgeSecretaria($estado)
{
    if ($estado == 'Pendiente') {
        return 'badge bg-warning text-dark';
    }
    return 'badge bg-success';
}
?>

<style>
    .dbs-wrap {
        --dbs-ink: #0f172a;
        --dbs-soft: #64748b;
        --dbs-line: #e2e8f0;
        --dbs-bg-1: #eff6ff;
        --dbs-bg-2: #fff7ed;
        --dbs-bg-3: #ecfeff;
    }

    .dbs-card-kpi {
        border: 1px solid var(--dbs-line);
        border-radius: 16px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, .08);
        position: relative;
        overflow: hidden;
    }

    .dbs-card-kpi::after {
        content: "";
        position: absolute;
        right: -40px;
        top: -40px;
        width: 130px;
        height: 130px;
        border-radius: 50%;
        background: rgba(255, 255, 255, .65);
    }

    .dbs-card-kpi.bg-1 { background: linear-gradient(135deg, var(--dbs-bg-1) 0%, #ffffff 70%); }
    .dbs-card-kpi.bg-2 { background: linear-gradient(135deg, var(--dbs-bg-2) 0%, #ffffff 70%); }
    .dbs-card-kpi.bg-3 { background: linear-gradient(135deg, var(--dbs-bg-3) 0%, #ffffff 70%); }

    .dbs-kpi-title {
        font-size: .78rem;
        letter-spacing: .04em;
        text-transform: uppercase;
        color: var(--dbs-soft);
        margin-bottom: .35rem;
        font-weight: 700;
    }

    .dbs-kpi-value {
        font-size: 2rem;
        line-height: 1;
        font-weight: 700;
        color: var(--dbs-ink);
        margin-bottom: .35rem;
    }

    .dbs-kpi-sub {
        font-size: .78rem;
        color: var(--dbs-soft);
        margin: 0;
    }

    .dbs-kpi-icon {
        width: 42px;
        height: 42px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .8rem;
        font-size: 1.05rem;
    }

    .dbs-kpi-icon.i1 { background: rgba(37, 99, 235, .12); color: #1d4ed8; }
    .dbs-kpi-icon.i2 { background: rgba(249, 115, 22, .14); color: #c2410c; }
    .dbs-kpi-icon.i3 { background: rgba(20, 184, 166, .14); color: #0f766e; }

    .dbs-panel {
        border: 1px solid var(--dbs-line);
        border-radius: 16px;
        box-shadow: 0 8px 24px rgba(15, 23, 42, .08);
    }

    .dbs-panel .card-header {
        border-bottom: 1px solid var(--dbs-line);
        background: linear-gradient(90deg, #f8fafc 0%, #ecfeff 100%);
    }

    .dbs-panel-title {
        margin: 0;
        font-weight: 700;
        color: #0f172a;
    }

    .dbs-mini-tag {
        font-size: .72rem;
        color: var(--dbs-soft);
        background: #f1f5f9;
        border-radius: 999px;
        padding: .25rem .65rem;
    }

    .dbs-table thead th {
        font-size: .72rem;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #475569;
        border-bottom: 1px solid var(--dbs-line);
        padding-top: .85rem;
        padding-bottom: .85rem;
    }

    .dbs-quick-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: .65rem;
    }

    .dbs-quick-tile {
        border: 1px solid var(--dbs-line);
        border-radius: 12px;
        padding: .75rem;
        text-decoration: none;
        color: var(--dbs-ink);
        background: #fff;
        transition: .2s ease;
    }

    .dbs-quick-tile:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(15, 23, 42, .12);
        border-color: #93c5fd;
        color: var(--dbs-ink);
    }

    .dbs-quick-top {
        display: flex;
        align-items: center;
        gap: .55rem;
        margin-bottom: .35rem;
    }

    .dbs-quick-ico {
        width: 30px;
        height: 30px;
        border-radius: 9px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: .85rem;
    }

    .dbs-quick-ico.q1 { background: #dbeafe; color: #1d4ed8; }
    .dbs-quick-ico.q2 { background: #e0f2fe; color: #0369a1; }
    .dbs-quick-ico.q3 { background: #dcfce7; color: #166534; }

    .dbs-quick-name {
        font-weight: 700;
        font-size: .86rem;
    }

    .dbs-quick-desc {
        font-size: .76rem;
        color: var(--dbs-soft);
        margin: 0;
    }
</style>

<div class="dbs-wrap">
<div class="row g-3 mt-1 mb-1">
    <div class="col-lg-3 col-md-6">
        <div class="card dbs-card-kpi bg-1 h-100">
            <div class="card-body">
                <span class="dbs-kpi-icon i1"><i class="fas fa-user-injured"></i></span>
                <p class="dbs-kpi-title">Pacientes activos</p>
                <p class="dbs-kpi-value"><?= $totalPacientes ?></p>
                <p class="dbs-kpi-sub">Padron vigente</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card dbs-card-kpi bg-2 h-100">
            <div class="card-body">
                <span class="dbs-kpi-icon i2"><i class="fas fa-calendar-check"></i></span>
                <p class="dbs-kpi-title">Citas activas</p>
                <p class="dbs-kpi-value"><?= $totalCitasActivas ?></p>
                <p class="dbs-kpi-sub">Pendientes con fecha futura</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card dbs-card-kpi bg-2 h-100">
            <div class="card-body">
                <span class="dbs-kpi-icon i2"><i class="fas fa-exclamation-triangle"></i></span>
                <p class="dbs-kpi-title">Citas vencidas</p>
                <p class="dbs-kpi-value"><?= $totalCitasVencidas ?></p>
                <p class="dbs-kpi-sub">Pendientes con fecha pasada</p>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6">
        <div class="card dbs-card-kpi bg-3 h-100">
            <div class="card-body">
                <span class="dbs-kpi-icon i3"><i class="fas fa-clock"></i></span>
                <p class="dbs-kpi-title">Citas de hoy</p>
                <p class="dbs-kpi-value"><?= $totalCitasHoy ?></p>
                <p class="dbs-kpi-sub">Agenda diaria</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mt-1">
    <div class="col-lg-8">
        <div class="card dbs-panel">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="dbs-panel-title">Agenda proxima</h6>
                <span class="dbs-mini-tag"><?= count($proximasCitas) ?> en lista</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm mb-0 dbs-table">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Doctor</th>
                                <th>Fecha</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($proximasCitas)) : ?>
                                <?php foreach ($proximasCitas as $cita) : ?>
                                    <tr>
                                        <td><?= $cita['pte_nombres'] . ' ' . $cita['pte_ap_paterno'] . ' ' . $cita['pte_ap_materno'] ?></td>
                                        <td><?= $cita['usr_nombre'] ?></td>
                                        <td><?= $cita['cts_fecha_inicio'] ?></td>
                                        <td><span class="<?= estadoBadgeSecretaria($cita['cts_estado']) ?>"><?= $cita['cts_estado'] ?></span></td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="4" class="text-center">Sin citas proximas</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card dbs-panel mb-3">
            <div class="card-header">
                <h6 class="dbs-panel-title">Carga de hoy</h6>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between mb-2">
                    <small class="text-600">Citas de hoy sobre operativas</small>
                    <small class="fw-bold"><?= $ratioHoy ?>%</small>
                </div>
                <div class="progress" style="height:8px;">
                    <div class="progress-bar bg-info" style="width: <?= $ratioHoy ?>%"></div>
                </div>
            </div>
        </div>
        <div class="card dbs-panel">
            <div class="card-header">
                <h6 class="dbs-panel-title">Accesos rapidos</h6>
            </div>
            <div class="card-body">
                <div class="dbs-quick-grid">
                    <a class="dbs-quick-tile" href="<?= HTTP_HOST ?>pacientes/list">
                        <div class="dbs-quick-top">
                            <span class="dbs-quick-ico q1"><i class="fas fa-plus-circle"></i></span>
                            <span class="dbs-quick-name">Agendar desde paciente</span>
                        </div>
                        <p class="dbs-quick-desc">Inicia una cita directo desde el expediente.</p>
                    </a>
                    <a class="dbs-quick-tile" href="<?= HTTP_HOST ?>citas/list">
                        <div class="dbs-quick-top">
                            <span class="dbs-quick-ico q2"><i class="fas fa-calendar-alt"></i></span>
                            <span class="dbs-quick-name">Ver calendario</span>
                        </div>
                        <p class="dbs-quick-desc">Gestiona agenda semanal y diaria.</p>
                    </a>
                    <a class="dbs-quick-tile" href="<?= HTTP_HOST ?>pacientes/list">
                        <div class="dbs-quick-top">
                            <span class="dbs-quick-ico q3"><i class="fas fa-users"></i></span>
                            <span class="dbs-quick-name">Ver pacientes</span>
                        </div>
                        <p class="dbs-quick-desc">Consulta y busca pacientes rapidamente.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
