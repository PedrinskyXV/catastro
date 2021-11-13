<?=$head?>

<?=$header?>
<?=$sidebar?>

<main id="main" class="main">
    <section class="section">
        <div class="card table-responsive p-5">            
            <h1 class="fw-bold text-dark">Administrar Usuarios</h1>
            <hr>
            <div class="text-muted">
                <p><i class="bi bi-info-circle-fill"></i> Al restablecer la contraseña se establece por defecto
                    '<b>alcaldia123</b>'
                    &nbsp;&nbsp;<i class="bi bi-info-circle-fill"></i> Se puede filtrar por los campos 'usuario',
                    'nombre', 'apellido', 'correo' .</p>
            </div>

            <div class="row my-3">
                <div class="d-grid d-md-block">
                    <a class="btn btn-primary float-end w-25" href="<?= base_url('/usuario/agregar')?>"><i class="bi bi-plus-circle"></i> Agregar</a>
                </div>
            </div>

            <div class="row">
            <table class="table mt-5" id="tbl-usuario-data">
                <thead class="table-primary">
                    <tr>
                        <th>No.Registro</th>
                        <th>IDUsuario</th>
                        <th>Usuario</th>
                        <th>Rol</th>
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Acceso</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </section>
</main>


<?=$footer?>

<script>
var site_url = "<?php echo site_url(); ?>";

$(document).ready(function() {

    var table = $('#tbl-usuario-data').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json'
        },
        buttons: [{
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="bi bi-file-excel"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger',
                text: '<i class="bi bi-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                }
            },
        ],
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        order: [], //init datatable not ordering
        ajax: "<?php echo base_url('/usuario/ajaxUsuarios') ?>",
        columnDefs: [{
            targets: 0,
            orderable: false
        }, ],
        columns: [{
                data: 'no'
            },
            {
                data: 'id_usuario'
            },
            {
                data: 'usuario'
            },
            {
                data: 'rol_nombre'
            },
            {
                data: 'nombre'
            },
            {
                data: 'correo'
            },
            {
                data: 'acceso'
            },
            {
                data: 'estado'
            },
            {
                data: 'action',
                orderable: false,

            },
        ],
        fixedColumns: true,
        fixedHeader: true,
        responsive: true,
    });
});
</script>