<div class="container">
    <div class="row flex-center min-vh-100 py-6">
        <div class="col-xl-5 col-md-5 col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Iniciar sesión</h4>
                    <form id="formIniciarSesion" class="row g-3" method="POST">
                        <div class="col-12">
                            <label for="usr_correo" class="form-label">Correo</label>
                            <input type="email" class="form-control" name="usr_correo" id="usr_correo" required />
                        </div>
                        <div class="col-12">
                            <label for="usr_clave" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" name="usr_clave" id="usr_clave" required />
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary float-end" name="btnLogin">
                                Iniciar
                            </button>
                        </div>
                        <?php
                        $login = new LoginController();
                        $login->ctrIngresoUsuario();
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>