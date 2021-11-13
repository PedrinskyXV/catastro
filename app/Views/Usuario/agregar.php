<?=$head?>
<?=$header?>
<?=$sidebar?>

<?php
    $errores = \Config\Services::validation();
?>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow p-3">
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">Registrar usuario</h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DEL USUARIO</h2>
                    <div class="card-body">
                        <form action="<?= base_url('usuario/insertar')?>" method="POST">

                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="usuario" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Usuario
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="usuario" name="usuario">
                                                <?php if ($errores->getError('usuario')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('usuario');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="sRol" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Rol
                                                </span></label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="sRol" name="sRol">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php foreach($roles as $rol): ?>
                                                    <?php if($rol['id_rol'] != 1): ?>
                                                    <option value="<?= $rol['id_rol'] ?>"><?= $rol['rol']; ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if ($errores->getError('sRol')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('sRol');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="usuario_nombre" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Nombre
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre">
                                                <?php if ($errores->getError('usuario_nombre')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('usuario_nombre');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="usuario_apellido" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Apellido
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido">
                                                <?php if ($errores->getError('usuario_apellido')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('usuario_apellido');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="usuario_correo" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Correo
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="usuario_correo" class="form-control" id="usuario_correo" name="usuario_correo">
                                                <?php if ($errores->getError('usuario_correo')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('usuario_correo');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex justify-content-center">
                                            <div class="ms-3">
                                                <button type="submit" class="btn btn-success align-center fw-bold"><i
                                                        class="bi bi-person-plus-fill"></i> Agregar</button>
                                            </div>
                                            <div class="ms-3">
                                                <a href="<?=base_url('usuario/index')?>" class="btn btn-dark"><i
                                                        class="bi bi-house-fill"></i> Regresar</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>


<?=$footer?>