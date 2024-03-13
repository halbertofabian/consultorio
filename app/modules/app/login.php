<main class="main" id="top">
    <div class="container" data-layout="container">
        <div class="row flex-center min-vh-100 py-6">
            <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                <div class="card">
                    <div class="card-body p-4 p-sm-5">
                        <a class="d-flex flex-center" href="<?= HTTP_HOST ?>"><img class="me-2" src="<?= HTTP_HOST ?>app/assets/img/consultorio_logo.png" alt="" width="150" /></a>
                        <div class="row flex-between-center mb-2">
                            <div class="col-auto">
                                <h5>Iniciar sesión</h5>
                            </div>
                        </div>
                        <form class="row g-3" method="POST">
                            <div class="col-12">
                                <label for="usr_correo" class="form-label">Correo</label>
                                <input type="email" class="form-control" name="usr_correo" id="usr_correo" placeholder="Correo electronico" required />
                            </div>
                            <div class="col-12">
                                <label for="usr_clave" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" name="usr_clave" id="usr_clave" placeholder="Contraseña" required />
                            </div>
                            <!-- <div class="row flex-between-center">
                                <div class="col-auto">
                                    <div class="form-check mb-0">
                                        <input class="form-check-input" type="checkbox" id="basic-checkbox" checked="checked" />
                                        <label class="form-check-label mb-0" for="basic-checkbox">Remember me</label>
                                    </div>
                                </div>
                                <div class="col-auto"><a class="fs-10" href="../../../pages/authentication/simple/forgot-password.html">Forgot Password?</a></div>
                            </div> -->
                            <div class="mb-3">
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit" name="btnLogin">Iniciar</button>
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
</main>