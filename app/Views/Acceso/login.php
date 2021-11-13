    <!-- head Page -->
    <?= $head ?>

    <main>
        <div class="container">

            <section
                class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <div class="logo d-flex align-items-center w-auto">
                                    <img src="https://santatecla.gob.sv/images/amst_logo.png"
                                        alt="ALCALDIA DE SANTA TECLA" class="img-fluid">
                                </div>
                            </div><!-- End Logo -->

                            <div class="card mb-3">

                                <div class="card-body">

                                    <div class="pt-4 pb-2">
                                        <h5 class="card-title text-center pb-0 fs-4">Accede a tu cuenta</h5>
                                        <p class="text-center small">Ingresa tu usuario y contraseña para acceder</p>
                                    </div>

                                    <form action="<?=base_url('acceso/autentificar');?>" method="POST"
                                        class="row g-3 needs-validation" novalidate>

                                        <div class="col-12">
                                            <label for="usuario" class="form-label">Usuario</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"> <i
                                                        class="bx bxs-user"></i> </span>
                                                <input type="text" name="usuario" class="form-control" id="usuario"
                                                    required>                                                    
                                                <div class="invalid-feedback">Por favor ingresa el usuario.</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="clave" class="form-label">Contraseña</label>
                                            <div class="input-group has-validation">
                                                <span class="input-group-text" id="inputGroupPrepend"> <i
                                                        class="bx bxs-key"></i> </span>
                                                <input type="password" name="clave" class="form-control" id="clave"
                                                    required>                                                
                                                <span class="input-group-text bg-light" id="inputGroupPrepend">
                                                    <i class="bi bi-eye-slash" id="togglePassword"></i>
                                                </span>
                                                <div class="invalid-feedback">Por favor ingrese la contraseña.</div>
                                            </div>
                                        </div>

                                        <?php if (session()->getFlashdata('msg')): ?>
                                        <div class="col-12 my-3">
                                            <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center"
                                                role="alert">
                                                <div>
                                                    <i class="bx  bxs-message-alt-error"></i>
                                                </div>
                                                <div>
                                                    <?=session()->getFlashdata('msg')?>
                                                </div>
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close"></button>
                                            </div>
                                        </div>
                                        <?php endif;?>



                                        <div class="col-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remember"
                                                    value="true" id="rememberMe">
                                                <label class="form-check-label" for="rememberMe">Recordar
                                                    usuario.</label>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <button class="btn btn-primary w-100" type="submit">Acceder</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </main><!-- End #main -->

    <!-- Footer Page -->
    <?= $footer ?>