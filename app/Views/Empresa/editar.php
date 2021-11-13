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
                    <h1 class="card-title bg-dark text-center text-white fw-bold text-uppercase">Editar Empresa
                    </h1>
                    <h2 class="card-title bg-primary text-center text-white">DATOS DE LA EMPRESA</h2>
                    <div class="card-body">
                    <?=var_dump(session()->getFlashdata())?>
                        <form action="<?=base_url('/empresa/modificar')?>" method="POST">
                            <input type="hidden" name="id_empresa" value="<?=old('id_empresa', $empresas['id_empresa']);?>">
                            <input type="hidden" name="id_empresa_actividad" value="<?=old('id_empresa_actividad', $empresas['id_empresa_actividad']);?>">
                            <div class="my-3">
                                <div class="row">
                                    <div class="col">
                                        <div class="row">
                                            <label for="sRubro" class="col-sm-2"><span
                                                    class="badge bg-primary badge-label">Actividad
                                                    Económica</span>
                                            </label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="sRubro" name="sRubro"
                                                    value="<?=old('sRubro', $empresas['id_rubro']);?>">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php foreach ($rubros as $rubro): ?>

                                                    <option value="<?=$rubro['idRubro']?>"><?=$rubro['nombre'];?>
                                                    </option>

                                                    <?php endforeach;?>
                                                </select>
                                                <?php if ($errores->getError('sRubro')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('sRubro');?>
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
                                            <label for="sActividad" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Giro comercial o
                                                    actividad
                                                    principal:
                                                </span></label>
                                            <div class="col-sm-10">
                                                <select class="form-select" id="sActividad" name="sActividad"
                                                    value="<?= old('sActividad', $empresas['id_actividad'])?>">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                </select>
                                                <?php if ($errores->getError('sActividad')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('sActividad');?>
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
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row align-items-center">
                                            <label for="nombre_juridico" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Nombre de la
                                                    empresa</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre_juridico"
                                                    name="nombre_juridico" value="<?=old('nombre_juridico', $empresas['nombre_juridico']);?>">

                                                <?php if ($errores->getError('nombre_juridico')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('nombre_juridico');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="telefono_empresa" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label">Telefono</span></label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="telefono_empresa"
                                                    name="telefono_empresa" value="<?=old('telefono_empresa', $empresas['telefono_empresa']);?>">
                                                    <?php if ($errores->getError('telefono_empresa')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('telefono_empresa');?>
                                                </div>
                                                <?php endif;?>
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
                                            <label for="nombre_comercial" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Denominación
                                                    Comercial</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre_comercial"
                                                    name="nombre_comercial" value="<?=old('nombre_comercial', $empresas['nombre_comercial']);?>">
                                                    <?php if ($errores->getError('nombre_comercial')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('nombre_comercial');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="correo_empresa" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Correo
                                                    electronico</span></label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="correo_empresa"
                                                    name="correo_empresa" value="<?=old('correo_empresa', $empresas['correo_empresa']);?>">
                                                    <?php if ($errores->getError('correo_empresa')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('correo_empresa');?>
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
                                            <label for="direccion_empresa" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label">Direccion</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="direccion_empresa"
                                                    name="direccion_empresa"></textarea>
                                                    <?php if ($errores->getError('direccion_empresa')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('direccion_empresa');?>
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
                                            <label for="direccion_contacto" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-primary badge-label">Direccion
                                                    Contacto</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="direccion_contacto"
                                                    name="direccion_contacto"></textarea>
                                                    <?php if ($errores->getError('direccion_contacto')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('direccion_contacto');?>
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
                                            <label for="sColonia" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label">Colonia</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-select" id="sColonia" name="sColonia">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php foreach ($colonias as $colonia): ?>

                                                    <option value="<?=$colonia['id_colonia']?>">
                                                        <?=$colonia['nombre'];?>
                                                    </option>

                                                    <?php endforeach;?>
                                                </select>
                                                <?php if ($errores->getError('sColonia')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('sColonia');?>
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
                                                <input type="text" class="form-control" id="creado" name="creado" value="<?=$empresas['creado_el']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="editado" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Editado
                                                </span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="editado" name="editado" value="<?=$empresas['editado_el']?>" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="desactivado" class="col-sm-4 col-form-label"><span
                                                    class="badge bg-primary badge-label text-wrap">Desactivado
                                                </span></label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" id="desactivado" name="desactivado" value="<?=$empresas['desactivado_el']?>" readonly>                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="dropdown-divider">
                            <div class="text-muted">
                                <p>Nota: Las fechas mostrados son en formato de 24 horas.</p>
                            </div>
                            <h2 class="card-title bg-secondary text-center text-white">DATOS DEL REPRESENTANTE LEGAL O
                                PROPIETARIO</h2>
                            <hr class="dropdown-divider">
                            <div class="my-3">
                                <input type="hidden" name="id_persona" value="<?= old('id_persona', $empresas['id_persona'])?>">
                                <div class="row">
                                    <div class="col-sm-12 col-md-8">
                                        <div class="row align-items-center">
                                            <label for="nombre_persona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-secondary badge-label text-wrap">Nombre
                                                    completo</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="nombre_persona"
                                                    name="nombre_persona" value="<?=old('nombre_persona', $empresas['nombre_persona']);?>">
                                                    <?php if ($errores->getError('nombre_persona')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('nombre_persona');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4">
                                        <div class="row align-items-center">
                                            <label for="telefono_persona" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-secondary badge-label">Telefono</span></label>
                                            <div class="col-sm-9">
                                                <input type="tel" class="form-control" id="telefono_persona"
                                                    name="telefono_persona" value="<?=old('telefono_persona', $empresas['telefono_persona']);?>">
                                                    <?php if ($errores->getError('telefono_persona')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('telefono_persona');?>
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
                                            <label for="correo_persona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-secondary badge-label text-wrap">Correo</span></label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="correo_persona"
                                                    name="correo_persona" value="<?=old('correo_persona', $empresas['correo_persona']);?>">
                                                    <?php if ($errores->getError('correo_persona')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('correo_persona');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="sTipoPersona" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-secondary badge-label">Tipo Persona</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-select" id="sTipoPersona" name="sTipoPersona" value="<?= old('sTipoPersona', $empresas['id_tipo_persona'])?>">
                                                    <option value="" disabled selected>Seleccionar...</option>
                                                    <?php foreach ($tipoPersonas as $tipo): ?>

                                                    <option value="<?=$tipo['id_tipoP']?>"><?=$tipo['nombre'];?>
                                                    </option>

                                                    <?php endforeach;?>
                                                </select>
                                                <?php if ($errores->getError('sTipoPersona')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('sTipoPersona');?>
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
                                            <label for="direccion_persona" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-secondary badge-label">Direccion</span></label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" id="direccion_persona"
                                                    name="direccion_persona"></textarea>
                                                    <?php if ($errores->getError('direccion_persona')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('direccion_persona');?>
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
                                            <label for="" class="col-sm-2 col-form-label"><span
                                                    class="badge bg-secondary badge-label text-wrap">DUI</span></label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="dui" name="dui"
                                                    value="<?=old('dui', $empresas['dui']);?>">
                                                    <?php if ($errores->getError('dui')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('dui');?>
                                                </div>
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="row align-items-center">
                                            <label for="" class="col-sm-3 col-form-label"><span
                                                    class="badge bg-secondary badge-label">NIT</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="nit" name="nit"
                                                    value="<?=old('nit', $empresas['nit']);?>">
                                                    <?php if ($errores->getError('nit')): ?>
                                                <div class="muted text-danger">
                                                    <i class="bi bi-exclamation-diamond-fill"></i>
                                                    <?=$errores->getError('nit');?>
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
                                                        class="bi bi-building"></i> Editar</button>
                                            </div>
                                            <div class="ms-3">
                                                <a href="<?=base_url(session()->get('rol').'/empresa/index')?>" class="btn btn-dark"><i
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

<script>
$('select[name="sRubro"]').val('<?=old('sRubro', $empresas['id_rubro']);?>').change();

$('select[name="sTipoPersona"]').val('<?=old('sTipoPersona', $empresas['id_tipoP']);?>').change();
$('select[name="sColonia"]').val('<?=old('sColonia', $empresas['id_colonia']);?>').change();
$('textarea[name="direccion_empresa"]').val('<?=old('direccion_empresa', $empresas['direccion']);?>');
$('textarea[name="direccion_contacto"]').val('<?=old('direccion_contacto', $empresas['direccion_contacto']);?>');
$('textarea[name="direccion_persona"]').val('<?=old('direccion_persona', $empresas['direccion_persona']);?>');

</script>

<script>
$(document).ready(function() {

    var idr = $("#sRubro").val();

        $.ajax({
            url: "<?php echo site_url('empresa/obtenerActividad'); ?>",
            method: "POST",
            data: {
                id: idr
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                //$("#sActividad").attr('disabled', false);
                var html = '<option value="" disabled selected>Seleccionar...</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].idActividad + '>' + data[i]
                        .actividad +
                        '</option>';
                }
                $('#sActividad').html(html);
                console.log(html)
                $('select[name="sActividad"]').val('<?=old('sActividad', $empresas['id_actividad']);?>').change();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                mostrarAlerta('info', 'No se encontra la actividad economica.');
                //$("#sActividad").attr('disabled', true);
            }
        });
        return false;
    
    $('#sRubro').change(function() {
        var idr = $(this).val();

        $.ajax({
            url: "<?php echo site_url('empresa/obtenerActividad'); ?>",
            method: "POST",
            data: {
                id: idr
            },
            async: true,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                //$("#sActividad").attr('disabled', false);
                var html = '<option value="" disabled selected>Seleccionar...</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].idActividad + '>' + data[i]
                        .actividad +
                        '</option>';
                }
                $('#sActividad').html(html);
                console.log(html)

            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.log(jqXHR);
                mostrarAlerta('info', 'No se encontra la actividad economica.');
                //$("#sActividad").attr('disabled', true);
            }
        });
        return false;
    });
});
</script>