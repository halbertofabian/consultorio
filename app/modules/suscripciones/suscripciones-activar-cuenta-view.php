<style>
    input[readonly] {
        background-color: #f8f9fa;
        /* Color gris por defecto de Bootstrap */
    }
</style>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Activar cuenta</h4>
                <form id="formActivarCuenta" class="row g-3">
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Correo suscriptor</label>
                        <select class="form-select selectpicker" name="scs_id" id="scs_id" required>
                            <option value="">-Seleccionar-</option>
                            <?php
                            $suscripciones = SuscripcionesModelo::mdlMostrarSuscriptores();
                            foreach ($suscripciones as $scs) :
                            ?>
                                <option value="<?= $scs['scs_id'] ?>"><?= $scs['scs_correo'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-12">
                        <hr>
                    </div>

                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Nombre</label>
                        <input type="text" class="form-control" name="" id="scs_nombre" placeholder="" readonly />
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Telefono</label>
                        <input type="text" class="form-control" name="" id="scs_telefono" placeholder="" readonly />
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Whatsapp</label>
                        <input type="text" class="form-control" name="" id="scs_whatsapp" placeholder="" readonly />
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Fecha inicio</label>
                        <input type="date" class="form-control" name="scs_fecha_inicio" id="scs_fecha_inicio" placeholder="" required />
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Fecha fin</label>
                        <input type="date" class="form-control" name="scs_fecha_fin" id="scs_fecha_fin" placeholder="" required />
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Tipo</label>
                        <input type="text" class="form-control" name="" id="scs_tipo_cliente" placeholder="" readonly />
                    </div>
                    <div class="col-xl-4 col-md-6 col-12">
                        <label for="" class="form-label">Pais</label>
                        <input type="text" class="form-control" name="" id="scs_pais" placeholder="" readonly />
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary float-end">
                            Activar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $('#scs_id').on('change', function() {
        var scs_id = $(this).val();
        $.ajax({
            type: 'GET',
            url: '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/get?scs_id=' + btoa(scs_id),
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#scs_id").val(res.scs_id);
                $("#scs_nombre").val(res.scs_nombre);
                $("#scs_telefono").val(res.scs_telefono);
                $("#scs_whatsapp").val(res.scs_whatsapp);
                $("#scs_fecha_inicio").val(res.scs_fecha_inicio);
                $("#scs_fecha_fin").val(res.scs_fecha_fin);
                $("#scs_tipo_cliente").val(res.scs_tipo_cliente);
                $("#scs_pais").val(res.scs_pais);
            }
        });
    });

    $('#formActivarCuenta').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/suscripciones/activar',
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
                        location.reload();
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });

    $("#scs_fecha_inicio").change(function() {
        // Obtener el valor actual del campo de entrada
        var scs_fecha_inicio = new Date($(this).val());

        // Sumar un año
        scs_fecha_inicio.setFullYear(scs_fecha_inicio.getFullYear() + 1);

        // Formatear la fecha para que sea compatible con el formato del campo de entrada "date"
        var scs_fecha_fin = scs_fecha_inicio.toISOString().split('T')[0];

        // Establecer el nuevo valor en el campo de entrada
        $('#scs_fecha_fin').val(scs_fecha_fin);

    })
</script>