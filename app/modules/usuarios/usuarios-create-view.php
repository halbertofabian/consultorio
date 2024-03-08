<?php
ComponentesControlador::getBreadCrumb('usuarios', 'Usuarios', 'Nuevo usuario');
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Nuevo usuario</h4>
                <div class="row">
                    <div class="col-12">
                        <form id="formAgregarUsuario" class="row g-3">
                            <div class="col-md-6 col-12">
                                <label for="usr_nombre" class="form-label">Nombre</label>
                                <input type="text" class="form-control text-uppercase" name="usr_nombre" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="usr_correo" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="usr_clave1" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="usr_clave2" id="" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Perfil</label>
                                    <select class="form-select" name="usr_perfil" id="" required>
                                        <option value="">-Seleccionar-</option>
                                        <option value="Super Administrador">Super Administrador</option>
                                        <option value="Doctor">Doctor</option>
                                        <option value="Secretaria">Secretaria</option>
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
    $('#formAgregarUsuario').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/usuarios/create',
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
                        location.href = '<?= HTTP_HOST ?>' + 'usuarios/list';
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>