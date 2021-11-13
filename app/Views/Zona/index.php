<?=$head?>

<?=$header?>
<?=$sidebar?>

<main id="main" class="main">
    <section class="section">
        <div class="card table-responsive p-5">

        <?php if(session()->get('rol') != "Usuario"):?>
                <div class="row my-2">
                <div class="d-grid d-md-block">
                    <a class="btn btn-primary float-end w-25" href="<?= base_url(session()->get('rol') . '/zona/agregar')?>"><i class="bi bi-plus-circle"></i> Agregar</a>
                </div>
            </div>
            <?php endif;?>

            <table class="table mt-5" id="tbl-zona-data">
                <thead class="table-primary">
                    <tr>
                        <th>No.Registro</th>
                        <th>ID Zona</th>
                        <th>Zona</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </section>
</main>


<?=$footer?>

<script>
var site_url = "<?php echo site_url(); ?>";

$(document).ready(function() {

    var table = $('#tbl-zona-data').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json'
        },
        buttons: [{
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="bi bi-file-excel"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger',
                text: '<i class="bi bi-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
        ],
        dom: 'Bfrtip',
        processing: true,
        serverSide: true,
        order: [], //init datatable not ordering
        ajax: "<?php echo base_url(session()->get('rol').'/zona/ajaxZonas') ?>",
        columnDefs: [{
            targets: 0,
            orderable: false
        }, ],
        columns: [{
                data: 'no'
            },
            {
                data: 'id_zona'
            },
            {
                data: 'nombre'
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