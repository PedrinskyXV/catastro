<?=$head?>

<?=$header?>
<?=$sidebar?>

<main id="main" class="main">
    <section class="section">
        <div class="row">
            <div class="col-12">
            <div class="card table-responsive p-5">
                <h1 class="fw-bold text-dark">Administrar Empresas</h1>
                <hr>
            <div class="text-muted">
                <p><i class="bi bi-info-circle-fill"></i> Al restablecer la contraseña se establece por defecto '<b>alcaldia123</b>'
                &nbsp;&nbsp;<i class="bi bi-info-circle-fill"></i> Se puede filtrar por los campos 'usuario', 'nombre', 'apellido', 'correo' .</p>
            </div>
                <table class="table table-bordered mt-5" id="tbl-empresa-data">
                    <thead class="table-primary">
                        <tr>
                            <th>No.Registro</th>
                            <th>IDEmpresa</th>
                            <th>NIT</th>
                            <th>N.Juridico</th>
                            <th>N.Comercial</th>                           
                            <th>Zona</th>
                            <th>Colonia</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </section>
</main>


<?=$footer?>

<script>
var site_url = "<?php echo site_url(); ?>";

$(document).ready(function() {

    var table = $('#tbl-empresa-data').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.3/i18n/es-mx.json'
        },
        buttons: [{
                extend: 'copy',
                className: 'btn btn-secondary',
                text: '<i class="bi bi-clipboard"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'excel',
                className: 'btn btn-success',
                text: '<i class="bi bi-file-excel"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger',
                text: '<i class="bi bi-file-pdf"></i>',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4, 5, 6, 7]
                }
            },
        ],
        dom: 'Blfrtip',
        processing: true,
        serverSide: true,
        order: [], //init datatable not ordering
        ajax: "<?php echo base_url('empresa/ajaxEmpresas') ?>",
        columnDefs: [{
            targets: 0,
            orderable: false
        }, ],
        columns: [{
                data: 'no'
            },
            {
                data: 'id_empresa'
            },
            {
                data: 'NIT'
            },
            {
                data: 'nombre_juridico'
            },
            {
                data: 'nombre_comercial'
            },            
            {
                data: 'zona'
            },
            {
                data: 'colonia'
            },
            {
                data: 'estado'
            },
            {
                data: 'action',
                orderable: false
            },
        ],
        fixedHeader: true,
        fixedColumns: true,        
        responsive: true,
        //scrollX: true, //ERROR PROCESANDO INFINITO
        //scrollCollapse: true,
    });
});
</script>