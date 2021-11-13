<?=$head?>

<?=$header?>
<?=$sidebar?>

<main id="main" class="main">
    <section class="section">
        <div class="card table-responsive p-5">
            <div class="text-center">
                <h1>Bienvenido <span class="fw-bold text-dark"><?= session()->get('usuario') ?></span></h1>
                <h2>Visita tu perfil para ver mas detalles.</h2>
            </div>
        </div>
    </section>

    <?php if( session()->get('rol') != "Usuario"): ?>
    <section class="section">
        <div class="card p-5">
            <div class="lead">
                <h5>Estos son los ultimos movimientos realizados por otros usuario:</h5>
            </div>
            <?= $bitacora; ?>            
        </div>
    </section>
    <?php endif;?>

    <section class="section">
        <div class="card table-responsive p-5">
            <div class="lead">
                <h6>Proximamente mas funciones ...</h6>
            </div>
        </div>
    </section>
</main>

<?=$footer?>