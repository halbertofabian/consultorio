<?php
ComponentesControlador::getBreadCrumb('usuarios', 'Usuarios', 'Actualizar usuario');
$usr_id = $rutas[2];
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar usuario</h4>
                <div class="row">
                    <div class="col-12">
                        <form id="formActualizarUsuario" class="row g-3">
                            <div class="col-md-6 col-12">
                                <label for="usr_nombre" class="form-label"><?= OBL ?> Nombre</label>
                                <input type="hidden" name="usr_id" id="usr_id">
                                <input type="text" class="form-control text-uppercase" name="usr_nombre" id="usr_nombre" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label"><?= OBL ?> Correo</label>
                                <input type="email" class="form-control" name="usr_correo" id="usr_correo" placeholder="" required />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="usr_clave1" id="" placeholder="" />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label">Confirmar contraseña</label>
                                <input type="password" class="form-control" name="usr_clave2" id="" placeholder="" />
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="" class="form-label"><?= OBL ?> Perfil</label>
                                <select class="form-select" name="usr_perfil" id="usr_perfil" required>
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
                            <div class="col-md-6 col-12">
                                <label for="usr_ctr_id" class="form-label">Consultorio</label>
                                <select class="form-select" name="usr_ctr_id" id="usr_ctr_id">
                                    <option value="">-Seleccionar-</option>
                                    <?php
                                    $consultorios = ConsultoriosModelo::mdlMostrarConsultorios($_SESSION['usr']['tenantid']);
                                    foreach ($consultorios as $ctr) :
                                    ?>
                                        <option value="<?= $ctr['ctr_id'] ?>"><?= $ctr['ctr_nombre'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 col-12">
                                <label for="usr_turno" class="form-label"><?= OBL ?> Turno</label>
                                <select class="form-select" name="usr_turno" id="usr_turno" required>
                                    <option value="">-Seleccionar-</option>
                                    <option value="Matutino">Matutino</option>
                                    <option value="Vespertino">Vespertino</option>
                                </select>
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
            url: '<?= HTTP_HOST ?>' + 'api/v1/usuarios/get?usr_id=<?= $usr_id ?>',
            dataType: 'json',
            processData: false,
            contentType: false,
            success: function(res) {
                $("#usr_id").val(res.usr_id);
                $("#usr_nombre").val(res.usr_nombre);
                $("#usr_correo").val(res.usr_correo);
                $("#usr_perfil").val(res.usr_perfil);
                $(".usr_foto").attr('src', res.usr_foto);
                $("#usr_ctr_id").val(res.usr_ctr_id);
                $("#usr_turno").val(res.usr_turno);
            }
        });
    }

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
    $('#formActualizarUsuario').on('submit', function(e) {
        e.preventDefault();
        var datos = new FormData(this)
        $.ajax({
            type: 'POST',
            url: '<?= HTTP_HOST ?>' + 'api/v1/usuarios/update',
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
                        if (res.actualizacion) {
                            window.location.href = '<?= HTTP_HOST ?>' + 'login/salir';;
                        } else {
                            window.location.href = '<?= HTTP_HOST ?>' + 'usuarios/list';;
                        }
                    });
                } else {
                    swal('Oops', res.mensaje, 'error');
                }
            }
        });
    });
</script>