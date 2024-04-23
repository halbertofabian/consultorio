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
                                <label for="scs_nombre" class="form-label"><?= OBL ?> Nombre</label>
                                <input type="hidden" id="scs_id" name="scs_id">
                                <input type="text" class="form-control text-uppercase" name="scs_nombre" id="scs_nombre" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="scs_correo" class="form-label"><?= OBL ?> Correo</label>
                                <input type="email" class="form-control" name="scs_correo" id="scs_correo" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="scs_telefono" class="form-label"><?= OBL ?> Telefono</label>
                                <input type="number" class="form-control" name="scs_telefono" id="scs_telefono" placeholder="" required />
                            </div>
                            <!-- <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label"><?= OBL ?> Pais</label>
                                    <select class="form-select selectpicker" name="scs_pais" id="scs_pais" required>
                                        <option value>Seleciona tu país</option>
                                        <option value="México+521">🇲🇽 México (+521)</option>
                                        <option value="Argentina+54">🇦🇷 Argentina (+54)</option>
                                        <option value="Bolivia+591">🇧🇴 Bolivia (+591)</option>
                                        <option value="Brasil+55">🇧🇷 Brasil (+55)</option>
                                        <option value="Chile+56">🇨🇱 Chile (+56)</option>
                                        <option value="Colombia+57">🇨🇴 Colombia (+57)</option>
                                        <option value="Costa Rica+506">🇨🇷 Costa Rica (+506)</option>
                                        <option value="Cuba+53">🇨🇺 Cuba (+53)</option>
                                        <option value="Ecuador+593">🇪🇨 Ecuador (+593)</option>
                                        <option value="El Salvador+503">🇸🇻 El Salvador
                                            (+503)</option>
                                        <option value="Guatemala+502">🇬🇹 Guatemala (+502)</option>
                                        <option value="Honduras+504">🇭🇳 Honduras (+504)</option>
                                        <option value="México+52">🇲🇽 México (+52)</option>
                                        <option value="Nicaragua+505">🇳🇮 Nicaragua (+505)</option>
                                        <option value="Panamá+507">🇵🇦 Panamá (+507)</option>
                                        <option value="Paraguay+595">🇵🇾 Paraguay (+595)</option>
                                        <option value="Perú+51">🇵🇪 Perú (+51)</option>
                                        <option value="República Dominicana+1">🇩🇴 República
                                            Dominicana (+1)</option>
                                        <option value="Uruguay+598">🇺🇾 Uruguay (+598)</option>
                                        <option value="Venezuela+58">🇻🇪 Venezuela (+58)</option>
                                        <option value="España+34">🇪🇸 España (+34)</option>
                                        <option value="Estados Unidos+1">🇺🇸 Estados Unidos
                                            (+1)</option>
                                    </select>
                                </div>
                            </div> -->
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
                // $("#scs_pais").val(res.scs_telefono).trigger('change');
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