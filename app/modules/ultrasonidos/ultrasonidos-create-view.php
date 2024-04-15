<?php
ComponentesControlador::getBreadCrumb('ultrasonidos', 'Ultrasonidos', 'Agregar ultrasonido');
$pte_id = $rutas[2];
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Agregar ultrasonido</h4>
                <form id="formGuardarUltrasonidos" class="row g-3">
                    <div class="col-12">
                        <h6>Paciente: <?= ComponentesControlador::obtenerNombrePaciente(base64_decode($pte_id)) ?></h6>
                    </div>
                    <div class="col-xl-6 col-12">
                        <label for="uts_fecha" class="form-label"><?= OBL ?> Fecha</label>
                        <input type="hidden" name="uts_pte_id" id="uts_pte_id" value="<?= base64_decode($pte_id) ?>">
                        <input type="date" class="form-control" name="uts_fecha" id="uts_fecha" placeholder="" required />
                    </div>
                    <div class="col-xl-6 col-12">
                        <label for="uts_hora" class="form-label"><?= OBL ?> Hora</label>
                        <input type="time" class="form-control" name="uts_hora" id="uts_hora" placeholder="" required />
                    </div>
                    <div class="col-12">
                        <label for="uts_motivo" class="form-label">Motivo</label>
                        <textarea class="form-control tinymce-uts" name="uts_motivo" id="uts_motivo" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <label for="uts_conclusion" class="form-label">Conclusión</label>
                        <textarea class="form-control tinymce-uts" name="uts_conclusion" id="uts_conclusion" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-end">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        tinymce.init({
            selector: 'textarea.tinymce-uts',
            height: 900,
            // Resto de la configuración de TinyMCE...
        });
    });

    $('#formGuardarUltrasonidos').on('submit', function(e) {
        e.preventDefault();
        var uts_motivo = tinymce.get('uts_motivo').getContent();
        var uts_conclusion = tinymce.get('uts_conclusion').getContent();
        var datos = new FormData(this);
        datos.append('uts_motivo', uts_motivo);
        datos.append('uts_conclusion', uts_conclusion);
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/create',
            data: datos,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                if (res.status) {
                    swal({
                        title: '¡Bien!',
                        text: res.mensaje,
                        type: 'success',
                        icon: 'success'
                    }).then(function() {
                        location.href = '<?= HTTP_HOST ?>' + 'ultrasonidos/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>