<?php
function showOptionMenu($tipo, $ruta)
{
    $extracto_link = $_GET['ruta'] ?? '';
    $link = ($tipo == 0) ? explode('/', $extracto_link)[0] ?? $extracto_link : $extracto_link;

    return ($ruta == $link) ? (($tipo == 0) ? 'show' : 'active') : '';
}
?>
<script>
    var isFluid = JSON.parse(localStorage.getItem('isFluid'));
    if (isFluid) {
        var container = document.querySelector('[data-layout]');
        container.classList.remove('container');
        container.classList.add('container-fluid');
    }
</script>
<nav class="navbar navbar-light navbar-vertical navbar-expand-xl">
    <script>
        var navbarStyle = localStorage.getItem("navbarStyle");
        if (navbarStyle && navbarStyle !== 'transparent') {
            document.querySelector('.navbar-vertical').classList.add(`navbar-${navbarStyle}`);
        }
    </script>
    <div class="d-flex align-items-center">
        <div class="toggle-icon-wrapper">

            <button class="btn navbar-toggler-humburger-icon navbar-vertical-toggle" data-bs-toggle="tooltip" data-bs-placement="left" title="Toggle Navigation"><span class="navbar-toggle-icon"><span class="toggle-line"></span></span></button>

        </div>
        <a class="navbar-brand" href="<?= HTTP_HOST ?>">
            <div class="d-flex align-items-center py-3"><img class="me-2" src="<?= isset($_SESSION['scl']['ctr_logo']) ? $_SESSION['scl']['ctr_logo'] : "" ?>" alt="" width="150" /><span class="font-sans-serif"></span>
            </div>
        </a>
    </div>
    <div class="collapse navbar-collapse" id="navbarVerticalCollapse">
        <div class="navbar-vertical-content scrollbar">
            <ul class="navbar-nav flex-column mb-3" id="navbarVerticalNav">
                <?php if ($_SESSION['usr']['usr_perfil'] == 'Super administrador') : ?>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#suscripciones" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="suscripciones">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-filter"></span></span><span class="nav-link-text ps-1">Suscripciones</span>
                            </div>
                        </a>
                        <ul class="nav collapse <?= showOptionMenu(0, 'suscripciones') ?> " id="suscripciones">
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'suscripciones/create') ?> " href="<?= HTTP_HOST . 'suscripciones/create' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Crear suscriptor</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'suscripciones/list') ?>  " href="<?= HTTP_HOST . 'suscripciones/list' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Listar</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#pacientes" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="pacientes">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-user-injured"></span></span><span class="nav-link-text ps-1">Pacientes</span>
                        </div>
                    </a>
                    <ul class="nav collapse <?= showOptionMenu(0, 'pacientes') ?> " id="pacientes">
                        <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'pacientes/create') ?> " href="<?= HTTP_HOST . 'pacientes/create' ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Nuevo paciente</span>
                                </div>
                            </a>
                        </li>
                        <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'pacientes/list') ?>  " href="<?= HTTP_HOST . 'pacientes/list' ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Listar</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-indicator" href="#citas" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="citas">
                        <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-calendar-alt"></span></span><span class="nav-link-text ps-1">Citas</span>
                        </div>
                    </a>
                    <ul class="nav collapse <?= showOptionMenu(0, 'citas') ?> " id="citas">
                        <!-- <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'citas/create') ?> " href="<?= HTTP_HOST . 'citas/create' ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Nuevo paciente</span>
                                </div>
                            </a>
                        </li> -->
                        <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'citas/list') ?>  " href="<?= HTTP_HOST . 'citas/list' ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Listar</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if ($_SESSION['usr']['usr_perfil'] == 'Doctor') : ?>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#consultas" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="consultas">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-notes-medical"></span></span><span class="nav-link-text ps-1">Consultas</span>
                            </div>
                        </a>
                        <ul class="nav collapse <?= showOptionMenu(0, 'consultas') ?> " id="consultas">
                            <!-- <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'consultas/create') ?> " href="<?= HTTP_HOST . 'consultas/create' ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Nuevo paciente</span>
                                </div>
                            </a>
                        </li> -->
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'consultas/list') ?>  " href="<?= HTTP_HOST . 'consultas/list' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Listar</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#ultrasonidos" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="ultrasonidos">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-file-medical-alt"></span></span><span class="nav-link-text ps-1">Ultrasonidos</span>
                            </div>
                        </a>
                        <ul class="nav collapse <?= showOptionMenu(0, 'ultrasonidos') ?> " id="ultrasonidos">
                            <!-- <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'ultrasonidos/create') ?> " href="<?= HTTP_HOST . 'ultrasonidos/create' ?>">
                                <div class="d-flex align-items-center">
                                    <span class="nav-link-text ps-1">Nuevo paciente</span>
                                </div>
                            </a>
                        </li> -->
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'ultrasonidos/list') ?>  " href="<?= HTTP_HOST . 'ultrasonidos/list' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Listar</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#consultorios" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="consultorios">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fas fa-stethoscope"></span></span><span class="nav-link-text ps-1">Consultorios</span>
                            </div>
                        </a>
                        <ul class="nav collapse <?= showOptionMenu(0, 'consultorios') ?> " id="consultorios">
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'consultorios/create') ?> " href="<?= HTTP_HOST . 'consultorios/create' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Nuevo consultorio</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'consultorios/list') ?>  " href="<?= HTTP_HOST . 'consultorios/list' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Listar</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link dropdown-indicator" href="#usuarios" role="button" data-bs-toggle="collapse" aria-expanded="false" aria-controls="usuarios">
                            <div class="d-flex align-items-center"><span class="nav-link-icon"><span class="fa fa-user"></span></span><span class="nav-link-text ps-1">Usuarios</span>
                            </div>
                        </a>
                        <ul class="nav collapse <?= showOptionMenu(0, 'usuarios') ?> " id="usuarios">
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'usuarios/create') ?> " href="<?= HTTP_HOST . 'usuarios/create' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Crear usuario</span>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item"><a class="nav-link <?= showOptionMenu(1, 'usuarios/list') ?>  " href="<?= HTTP_HOST . 'usuarios/list' ?>">
                                    <div class="d-flex align-items-center">
                                        <span class="nav-link-text ps-1">Listar</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>