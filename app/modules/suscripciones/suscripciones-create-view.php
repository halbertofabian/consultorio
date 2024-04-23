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
                                <label for="" class="form-label"><?= OBL ?> Nombre</label>
                                <input type="text" class="form-control text-uppercase" name="scs_nombre" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label"><?= OBL ?> Correo</label>
                                <input type="email" class="form-control" name="scs_correo" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label"><?= OBL ?> Clave</label>
                                <input type="password" class="form-control" name="scs_clave" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label"><?= OBL ?> Telefono</label>
                                <input type="number" class="form-control" name="scs_telefono" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label"><?= OBL ?> Pais</label>
                                    <select class="form-select selectpicker" name="scs_pais" id="" required>
                                        <option value>Seleciona tu país</option>
                                        <option value="México+521" selected>🇲🇽 México (+521)</option>
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