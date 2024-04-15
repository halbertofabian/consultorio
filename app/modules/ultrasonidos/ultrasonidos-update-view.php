<?php
ComponentesControlador::getBreadCrumb('ultrasonidos', 'Ultrasonidos', 'Actualizar ultrasonido');
$uts_id = $rutas[2];
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar ultrasonido</h4>
                <form id="formActualizarUltrasonidos" class="row g-3">
                    <div class="col-12">
                        <h6>Paciente: <span id="paciente"></span></h6>
                    </div>
                    <div class="col-xl-6 col-12">
                        <label for="uts_fecha" class="form-label"><?= OBL ?> Fecha</label>
                        <input type="hidden" name="uts_id" id="uts_id">
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
                        <button type="submit" class="btn btn-primary float-end">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
     $(document).ready(function() {
        cargarDatos();
        tinymce.init({
            selector: 'textarea.tinymce-uts',
            height: 900,
            // Resto de la configuración de TinyMCE...
        });
    });
  
    function cargarDatos() {
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/get?uts_id=<?= $uts_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#uts_id").val(res.uts_id);
                $("#paciente").text(res.pte_nombre);
                var parts_fecha = res.uts_fecha.split(' ');
                var uts_fecha = parts_fecha[0];
                var uts_hora = parts_fecha[1];
                $("#uts_fecha").val(uts_fecha);
                $("#uts_hora").val(uts_hora);
                $("#uts_motivo").val(res.uts_motivo);
                $("#uts_conclusion").val(res.uts_conclusion);

            }
        });
    }
   

    $('#formActualizarUltrasonidos').on('submit', function(e) {
        e.preventDefault();
        var uts_motivo = tinymce.get('uts_motivo').getContent();
        var uts_conclusion = tinymce.get('uts_conclusion').getContent();
        var datos = new FormData(this);
        datos.append('uts_motivo', uts_motivo);
        datos.append('uts_conclusion', uts_conclusion);
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/ultrasonidos/update',
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
                        window.location.href = '<?= HTTP_HOST ?>' + 'ultrasonidos/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>