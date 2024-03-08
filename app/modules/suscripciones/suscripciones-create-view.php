<?php
ComponentesControlador::getBreadCrumb('suscripciones', 'Suscripciones', 'Nuevo suscriptor');
?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nuevo suscriptor</h4>
                <div class="row">
                    <div class="col-12">
                        <form id="formAgregarSuscriptor" class="row g-3">
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Nombre</label>
                                <input type="text" class="form-control text-uppercase" name="scs_nombre" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="scs_correo" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Telefono</label>
                                <input type="number" class="form-control" name="scs_telefono" id="" placeholder="" required />
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-end">
                                    Agregar
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
    $('#formAgregarSuscriptor').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/create',
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