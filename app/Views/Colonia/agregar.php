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
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">Registrar nueva colonia
                    </h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DE LA Colonia</h2>
                    <div class="card-body">
                        <form action="<?= base_url('/colonia/agregar') ?>" method="POST">
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="nombreColonia" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Nombre de la
                                                    colonia</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombreColonia"
                                                    name="nombreColonia">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                        <label for="sZona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Zonas</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="sZona" name="sZona">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php foreach($zonas as $tipo): ?>
                                                    <option value="<?= $tipo['id_zona'] ?>"><?= $tipo['nombre']; ?>
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
                                                        class="bi bi-building"></i> Agregar</button>
                                            </div>
                                            <div class="ms-3">
                                                <button type="reset" class="btn btn-secondary align-center fw-bold"><i
                                                        class="bi bi-house-fill"></i> Regresar</button>
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