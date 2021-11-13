<?=$head?>

<?=$header?>
<?=$sidebar?>

<?php
$_id = $usuario['id_usuario'];
$_usuario = $usuario['usuario'];
$_nombre = $usuario['nombre'];
$_apellido = $usuario['apellido'];
$_correo = $usuario['correo'];
$_rol = $usuario['rol_nombre'];
$errores = \Config\Services::validation();
?>

<main id="main" class="main">

    <div class="pagetitle my-4">
        <h1>Mi Perfil</h1>        
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-12">
                
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-overview">Descripción</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar
                                    Perfil</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-settings">Ajustes</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab"
                                    data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                <h5 class="card-title">Detalles del Perfil</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Usuario</div>
                                    <div class="col-lg-9 col-md-8"><?=$_usuario;?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Nombre</div>
                                    <div class="col-lg-9 col-md-8"><?=$_nombre;?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Apellido</div>
                                    <div class="col-lg-9 col-md-8"><?=$_apellido;?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Correo</div>
                                    <div class="col-lg-9 col-md-8"><?=$_correo;?></div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Rol</div>
                                    <div class="col-lg-9 col-md-8"><?=$_rol;?></div>
                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="<?=base_url('usuario/editar')?>" method="POST">
                                    <input type="hidden" name="id" id="id" value="<?=$_id;?>">
                                    <div class="row mb-3">
                                        <label for="usuario" class="col-md-4 col-lg-3 col-form-label">Usuario</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="usuario" type="text" class="form-control" id="usuario"
                                                value="<?=$_usuario;?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="nombre" type="text" class="form-control" id="nombre"
                                                value="<?=$_nombre;?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="apellido" class="col-md-4 col-lg-3 col-form-label">Apellido</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="apellido" type="text" class="form-control" id="apellido"
                                                value="<?=$_apellido;?>">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="correo" class="col-md-4 col-lg-3 col-form-label">Correo</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="correo" type="email" class="form-control" id="correo"
                                                value="<?=$_correo;?>">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </form><!-- End Profile Edit Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <!-- Settings Form -->
                                <form action="" method="GET">

                                    <div class="row mb-3">
                                        <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Email
                                            Notifications</label>
                                        <div class="col-md-8 col-lg-9">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="changesMade"
                                                    checked>
                                                <label class="form-check-label" for="changesMade">
                                                    Changes made to your account
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="newProducts"
                                                    checked>
                                                <label class="form-check-label" for="newProducts">
                                                    Information on new products and services
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="proOffers">
                                                <label class="form-check-label" for="proOffers">
                                                    Marketing and promo offers
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="securityNotify"
                                                    checked disabled>
                                                <label class="form-check-label" for="securityNotify">
                                                    Security alerts
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form><!-- End settings Form -->

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">
                                <!-- Change Password Form -->
                                <form action="<?=base_url('usuario/CambiarClave')?>" method="POST">
                                    <input type="hidden" name="id" id="id" value="<?=$_id;?>">
                                    <div class="row mb-3">
                                        <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña
                                            Actual</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="claveActual" type="password" class="form-control"
                                                id="claveActual">
                                            <?php if ($errores->getError('claveActual')): ?>
                                            <div class="muted text-danger">
                                                <i class="bi bi-exclamation-diamond-fill"></i> <?=$errores->getError('claveActual');?>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva
                                            Contraseña</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="clave" type="password" class="form-control" id="clave">
                                            <?php if ($errores->getError('clave')): ?>
                                            <div class="muted text-danger">
                                            <i class="bi bi-exclamation-diamond-fill"></i> <?=$errores->getError('clave');?>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar
                                            Nueva contraseña</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="clave2" type="password" class="form-control" id="clave2">
                                            <?php if ($errores->getError('clave2')): ?>
                                            <div class="muted text-danger">
                                            <i class="bi bi-exclamation-diamond-fill"></i>  <?=$errores->getError('clave2');?>
                                            </div>
                                            <?php endif;?>
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Cambiar Contraseña</button>
                                    </div>
                                </form><!-- End Change Password Form -->

                            </div>

                        </div><!-- End Bordered Tabs -->

                    </div>
                </div>

            </div>
        </div>
    </section>

</main><!-- End #main -->

<?=$footer?>