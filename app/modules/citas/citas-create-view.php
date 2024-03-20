<?php
ComponentesControlador::getBreadCrumb('citas', 'Citas', 'Nueva cita');
$pte_id = $rutas[2];
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Agendar cita para <?= ComponentesControlador::obtenerNombrePaciente(base64_decode($pte_id)); ?></h4>
                <form id="formGuardarCita" class="row g-3">
                    <div class="col-xl-6 col-md-6 col-12">
                        <label for="cts_ctr_id" class="form-label"><?= OBL ?> Consultorio</label>
                        <input type="hidden" name="cts_pte_id" id="cts_pte_id" value="<?= base64_decode($pte_id) ?>">
                        <select class="form-select" name="cts_ctr_id" id="cts_ctr_id" required>
                            <option value="">-Seleccionar-</option>
                            <?php
                            $consultorios = ConsultoriosModelo::mdlMostrarConsultorios($_SESSION['usr']['tenantid']);
                            foreach ($consultorios as $ctr) :
                            ?>
                                <option value="<?= $ctr['ctr_id'] ?>"><?= $ctr['ctr_nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-xl-6 col-md-6 col-12">
                        <label for="cts_usr_id" class="form-label"><?= OBL ?> Doctor</label>
                        <select class="form-select" name="cts_usr_id" id="cts_usr_id" required>
                            <option value="">-Seleccionar-</option>
                        </select>
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <label for="cts_fecha_inicio" class="form-label"><?= OBL ?> Fecha inicio</label>
                        <input type="date" class="form-control" name="cts_fecha_inicio" id="cts_fecha_inicio" placeholder="" required />
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <label for="cts_hora_inicio" class="form-label"><?= OBL ?> Hora inicio</label>
                        <input type="time" class="form-control" name="cts_hora_inicio" id="cts_hora_inicio" placeholder="" required />
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <label for="cts_fecha_fin" class="form-label"><?= OBL ?> Fecha fin</label>
                        <input type="date" class="form-control" name="cts_fecha_fin" id="cts_fecha_fin" placeholder="" required />
                    </div>
                    <div class="col-xl-3 col-md-6 col-12">
                        <label for="cts_hora_fin" class="form-label"><?= OBL ?> Hora fin</label>
                        <input type="time" class="form-control" name="cts_hora_fin" id="cts_hora_fin" placeholder="" required />
                    </div>
                    <div class="col-xl-12 col-md-12 col-12">
                        <label for="cts_descripcion" class="form-label">Descripción</label>
                        <textarea class="form-control" name="cts_descripcion" id="cts_descripcion" rows="3"></textarea>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-end">
                            Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<script>
    $('#cts_ctr_id').on('change', function() {
        var usr_ctr_id = $(this).val();
        var tenantid = '<?= $_SESSION['usr']['tenantid'] ?>';
        var datos = new FormData();
        datos.append('usr_ctr_id', usr_ctr_id);
        datos.append('tenantid', tenantid);
        $('#cts_usr_id option').remove();
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/usuarios/consultorios',
            data: datos,
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $('#cts_usr_id').append(`<option value="">-Seleccionar-</option>`);
                res.forEach(usr => {
                    $('#cts_usr_id').append(`<option value="${usr.usr_id}">${usr.usr_nombre}</option>`);
                });
            }
        });
    });

    $('#formGuardarCita').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/citas/create',
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
                        location.href = '<?= HTTP_HOST ?>' + 'citas/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });

    $('#cts_fecha_inicio, #cts_hora_inicio').on('change', function() {
        var fechaInicio = $('#cts_fecha_inicio').val();
        var horaInicio = $('#cts_hora_inicio').val();

        if (fechaInicio && horaInicio) {
            var fechaHoraInicio = new Date(fechaInicio + 'T' + horaInicio);

            var fechaHoraFin = new Date(fechaHoraInicio.getTime() + (60 * 60 * 1000));

            var fechaFin = fechaHoraFin.toISOString().split('T')[0];
            var horaFin = fechaHoraFin.toTimeString().slice(0, 5);

            $('#cts_fecha_fin').val(fechaInicio);
            $('#cts_hora_fin').val(horaFin);
        }
    });
</script>