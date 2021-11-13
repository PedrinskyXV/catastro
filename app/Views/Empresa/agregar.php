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
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">Registrar nueva empresa
                    </h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DE LA EMPRESA</h2>
                    <div class="card-body">
                        <form action="<?= base_url('/empresa/insertar') ?>">
                            <div class="my-3 align-items-center">
                                <label for="actividadEconomica" class="col-sm-2"><span
                                        class="badge bg-primary badge-label">Actividad
                                        Económica</span>
                                </label>
                                <div class="form-check form-check-inline col-sm-2">
                                    <input class="form-check-input" type="checkbox" id="actividadEconomica"
                                        name="actividadEconomica" value="Comercial">
                                    <label class="form-check-label" for="actividadEconomica">Comercial</label>
                                </div>
                                <div class="form-check form-check-inline col-sm-2">
                                    <input class="form-check-input" type="checkbox" id="actividadEconomica"
                                        name="actividadEconomica" value="Industrial">
                                    <label class="form-check-label" for="actividadEconomica">Industrial</label>
                                </div>
                                <div class="form-check form-check-inline col-sm-2">
                                    <input class="form-check-input" type="checkbox" id="actividadEconomica"
                                        name="actividadEconomica" value="Servicio">
                                    <label class="form-check-label" for="actividadEconomica">Servicio</label>
                                </div>
                                <div class="form-check form-check-inline col-sm-2">
                                    <input class="form-check-input" type="checkbox" id="actividadEconomica"
                                        name="actividadEconomica" value="Financiera">
                                    <label class="form-check-label" for="actividadEconomica">Financiera</label>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <label for="giroEmpresa" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Giro comercial o
                                                    actividad
                                                    principal:
                                                </span></label>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="giroEmpresa"
                                                    name="giroEmpresa">
                                            </div>
                                            <div class="col-sm-5">
                                                <input type="text" class="form-control" id="giroEmpresa"
                                                    name="giroEmpresa">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row align-items-center">
                                            <label for="nombreEmpresa" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Nombre de la
                                                    empresa</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombreEmpresa"
                                                    name="nombreEmpresa">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="telEmpresa" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label">Telefono</span></label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="telEmpresa"
                                                    name="telEmpresa">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row d-flex">
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row align-items-center">
                                            <label for="denominacionComercial" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Denominación
                                                    Comercial</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="denominacionComercial"
                                                    name="denominacionComercial">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="correoEmpresa" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Correo
                                                    electronico</span></label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="correoEmpresa"
                                                    name="correoEmpresa">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <label for="direccionEmpresa" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label">Direccion</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="direccionEmpresa"
                                                    name="direccionEmpresa"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">

                            <h2 class="card-title bg-primary text-center text-white">DATOS DEL REPRESENTANTE LEGAL O
                                PROPIETARIO</h2>
                            <div class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="row align-items-center">
                                            <label for="direccionEmpresa" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label">Buscar persona</span></label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input type="search" name="buscar" id="buscar" class="form-control"
                                                        placeholder="DUI o NIT">
                                                    <div class="input-group-text">
                                                        <a class="btn btn-danger" onclick="buscarPersona()"><i
                                                                class="bi bi-search"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <input type="hidden" name="idPersona">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row align-items-center">
                                            <label for="nombrePersona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Nombre
                                                    completo</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombrePersona"
                                                    name="nombrePersona">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="telPersona" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label">Telefono</span></label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="telPersona"
                                                    name="telPersona">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <input type="hidden" name="idPersona">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="nombrePersona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Correo</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="correoPersona"
                                                    name="correoPersona">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="telPersona" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label">Tipo Persona</span></label>
                                            <div class="col-sm-9">
                                            <select class="form-select" id="tipoPersona" name="tipoPersona">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php foreach($tipoPersonas as $tipo): ?>
                                                    
                                                    <option value="<?= $tipo['id_tipoP'] ?>"><?= $tipo['nombre']; ?></option>
                                                    
                                                    <?php endforeach; ?>
                                                </select>
                                                <?php if ($errores->getError('tipoPersona')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('tipoPersona');?>
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
                                        <div class="row align-items-center">
                                            <label for="direccionPersona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label">Direccion</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="direccionPersona"
                                                    name="direccionPersona"></textarea>
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
                                            <label for="" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">DUI</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="dui" name="dui">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label">NIT</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nit" name="nit">
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

<script>
function buscarPersona() {

    const id = $("#buscar").val();

    console.log("-> ", id);

    $.ajax({
        url: "<?php echo base_url('/empresa/buscarPersona/')?>/" + id,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            console.log(data);
            $('[name="idPersona"]').val(data.id_persona);
            $('[name="nombrePersona"]').val(data.nombre);
            $('[name="telPersona"]').val(data.telefono);
            $('[name="direccionPersona"]').val(data.direccion);
            $('[name="dui"]').val(data.dui);
            $('[name="nit"]').val(data.nit);
            mostrarAlerta('success', 'Persona encontrada.');
        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            mostrarAlerta('info', 'No se encontra a la persona.');
        }
    });
}
</script>