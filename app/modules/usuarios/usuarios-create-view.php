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
                                <label for="" class="form-label">Perfil</label>
                                <select class="form-select" name="usr_perfil" id="" required>
                                    <option value="">-Seleccionar-</option>
                                    <option value="Doctor">Doctor</option>
                                    <option value="Secretaria">Secretaria</option>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="">Foto de perfil</label>
                                <div class="d-flex align-items-center">
                                    <div class="avatar avatar-3xl">
                                        <img class="rounded-circle usr_foto" src="<?= HTTP_HOST ?>app/assets/img/team/4.jpg" alt="FOTO" />
                                    </div>
                                    <div class="ms-2 w-100"><input type="file" class="form-control" name="usr_foto" id="usr_foto"></div>
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
    $('#usr_foto').on('change', function() {
        var archivo = $(this).val();
        var extensiones = archivo.substring(archivo.lastIndexOf("."));
        if (extensiones != ".jpeg" && extensiones != ".jpg" && extensiones != ".png" && extensiones != ".webp" && extensiones != ".svg") {
            toastr.error("El archivo de tipo <strong>" + extensiones + "</strong> no es válido", 'ERROR')
            $(this).val("");
        } else {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.usr_foto').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        }
    });
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