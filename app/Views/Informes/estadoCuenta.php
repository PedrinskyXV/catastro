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
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">GENERAR REPORTE DE CUENTA</h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DE LA EMPRESA</h2>
                    <div class="card-body">
                        <form action="<?php echo base_url('informes/informeEstado') ?>" method="POST">

                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="sEmpresa" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">
                                                    Empresas
                                                </span></label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="sEmpresa" name="sEmpresa">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php 
                                                    //var_dump($empresas);?>
                                                    <?php foreach($empresas as $tipo): ?>
                                                    <option value="<?= $tipo['nombre_comercial'] ?>"><?= $tipo['nombre_comercial']; ?>
                                                    </option>
                                                    <?php endforeach; ?>
                                                </select>
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
                                                        class="bi bi-person-plus-fill"></i> Generar</button>
                                            </div>
                                            <div class="ms-3">
                                                <a href="<?=base_url('Inicio/index')?>" class="btn btn-dark"><i
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