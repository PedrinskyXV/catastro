<?=$head?>
<?=$header?>
<?=$sidebar?>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card shadow p-3">
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">Informacion del usuario</h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DEL USUARIO</h2>
                    <div class="card-body">
                        <form>

                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="usuario" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Usuario
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="usuario" name="usuario" value="<?=$usuario['usuario']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="sRol" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Rol
                                                </span></label>
                                            <div class="col-sm-10">
                                            <input type="text" class="form-control" id="rolN" name="rolN" value="<?=$usuario['rol_nombre']?>" readonly>
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
                                            <label for="unombre" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Nombre
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="unombre" name="unombre" value="<?=$usuario['nombre']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="uapellido" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Apellido
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="uapellido" name="uapellido" value="<?=$usuario['apellido']?>" readonly>
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
                                            <label for="ucorreo" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Correo
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="ucorreo" name="ucorreo" value="<?=$usuario['correo']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="ucorreo" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Ultimo acceso
                                                </span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="acceso" name="acceso" value="<?=$usuario['ultimo_acceso']?>" readonly>
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
                                            <label for="ucorreo" class="col-sm-4 col-form-label"><span
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
                            <div class="text-muted">
                                <p>Nota: Las fechas mostrados son en formato de 24 horas.</p>
                            </div>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="d-flex justify-content-center">

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