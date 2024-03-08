<?php
ComponentesControlador::getBreadCrumb('suscripciones', 'Suscripciones', 'Editar suscriptor');
$scs_id = $rutas[2];
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar suscriptor</h4>
                <div class="row">
                    <div class="col-12">
                        <form id="formActualizarSuscriptor" class="row g-3">
                            <div class="col-md-6 col-12">
                                <label for="scs_nombre" class="form-label">Nombre</label>
                                <input type="hidden" id="scs_id" name="scs_id">
                                <input type="text" class="form-control text-uppercase" name="scs_nombre" id="scs_nombre" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="scs_correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="scs_correo" id="scs_correo" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="scs_telefono" class="form-label">Telefono</label>
                                <input type="number" class="form-control" name="scs_telefono" id="scs_telefono" placeholder="" required />
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-end">
                                    Actualizar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        cargarDatos();
    })

    function cargarDatos() {
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/get?scs_id=<?= $scs_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#scs_id").val(res.scs_id);
                $("#scs_nombre").val(res.scs_nombre);
                $("#scs_correo").val(res.scs_correo);
                $("#scs_telefono").val(res.scs_telefono);
            }
        });
    }

    $('#formActualizarSuscriptor').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this);
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/update',
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
                        location.href = '<?= HTTP_HOST ?>' + 'suscripciones/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>