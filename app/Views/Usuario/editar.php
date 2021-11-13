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
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">Editar usuario</h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DEL USUARIO</h2>
                    <div class="card-body">
                        <form action="<?=base_url('usuario/modificar')?>" method="POST">
                            <input type="hidden" name="id" value="<?=$usuario['id_usuario']?>">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="usuario" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Usuario
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?=$usuario['usuario']?>">
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
                                                    <option value="" selected>Seleccionar...</option>
                                                    <?php foreach ($roles as $rol): ?>
                                                        <?php if ($rol['id_rol'] == $usuario['id_rol']): ?>
                                                        <option value="<?=$rol['id_rol']?>" selected><?=$rol['rol'];?></option>
                                                        <?php else: ?>
                                                        <option value="<?=$rol['id_rol']?>"><?=$rol['rol'];?></option>
                                                        <?php endif;?>
                                                    <?php endforeach;?>
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
                                                <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" value="<?=$usuario['nombre']?>">
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
                                                <input type="text" class="form-control" id="usuario_apellido" name="usuario_apellido" value="<?=$usuario['apellido']?>">
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
                                                <input type="usuario_correo" class="form-control" id="usuario_correo" name="usuario_correo" value="<?=$usuario['correo']?>">
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
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="creado" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Creado
                                                </span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="creado" name="creado" value="<?=$usuario['creado_el']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="editado" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Editado
                                                </span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="editado" name="editado" value="<?=$usuario['editado_el']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="usuario_correo" class="col-sm-4 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Desactivado
                                                </span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="desactivado" name="desactivado" value="<?=$usuario['desactivado_el']?>" readonly>
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
                                                <button type="submit" class="btn btn-primary align-center fw-bold"><i
                                                        class="bi bi-person-plus-fill"></i> Editar</button>
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