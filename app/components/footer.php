<?php
$scs = SuscripcionesModelo::mdlMostrarSuscriptoresById($_SESSION['scs']['scs_id']);
?>
<footer class="footer">
    <div class="row g-0 justify-content-between fs--1 mt-1 mb-2">
        <?php if ($scs['scs_tipo_cliente'] == 'PROSPECTO' && $scs['scs_estado'] == 1) : ?>
            <div class="col-12">
                <div class="alert alert-warning" role="alert">
                    <strong>Tu prueba grátis vence el <?= ComponentesControlador::fechaCastellano($scs['scs_fecha_fin']) ?></strong>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 text-600">Diseñado y desarrollado por <span class="d-none d-sm-inline-block"></span><br class="d-sm-none" /><a href="https://softmor.com">Softmor Studios</a> 2024 &copy;</p>
        </div>
        <div class="col-12 col-sm-auto text-center">
            <p class="mb-0 text-600">v1.0.0</p>
        </div>
    </div>
</footer>