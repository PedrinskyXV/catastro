<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; 2021 Copyright <strong><span>ITCA-FEPADE</span></strong>. Todo los derechos reservados.
        <?php helper('date'); ?>
        <br/> SITIO URL <?= now('America/El_Salvador') ?>
        <br/> BASE URL <?= base_url() ?>
    </div>
</footer><!-- End Footer -->

<!-- Vendor JS Files -->
<script src="<?=base_url()?>/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="<?=base_url()?>/vendor/php-email-form/validate.js"></script>
<script src="<?=base_url()?>/vendor/quill/quill.min.js"></script>
<script src="<?=base_url()?>/vendor/tinymce/tinymce.min.js"></script>
<script src="<?=base_url()?>/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?=base_url()?>/vendor/chart.js/chart.min.js"></script>
<script src="<?=base_url()?>/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?=base_url()?>/vendor/echarts/echarts.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"
    integrity="sha512-6Jym48dWwVjfmvB0Hu3/4jn4TODd6uvkxdi9GNbBHwZ4nGcRxJUCaTkL3pVY6XUQABqFo3T58EMXFQztbjvAFQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="<?=base_url()?>/vendor/Datatables/datatables.min.js"></script>

<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script> -->
<!-- Or use CDN -->
<script src="https://cdn.jsdelivr.net/gh/fcmam5/nightly.js@v1.0/dist/nightly.min.js"></script>
<script src="<?= base_url('/vendor/validetta/validetta.js');?>"></script>
<!-- Template Main JS File -->
<script src="<?=base_url()?>/js/main.js"></script>
<script src="<?=base_url()?>/js/app.js"></script>

<script>
const dui = document.getElementById("dui");
const nit = document.getElementById("nit");
const telEmpresa = document.getElementById("telEmpresa");
const telPersona = document.getElementById("telPersona");

$(document).ready(function() {
    $(dui).inputmask({
        "mask": "99999999-9"
    });
    $(nit).inputmask({
        "mask": "9999-999999-999-9"
    });

    $(telEmpresa).inputmask({
        "mask": "9999-9999"
    });
    $(telPersona).inputmask({
        "mask": "9999-9999"
    });
});
</script>

<script>
$(window).on("load", function() {
    let url = "<?= current_url() ?>";

    $("nav a.nav-link").each(function() {
        let itemMenu = $(this).attr('href');

        if (url.includes(itemMenu)) {
            console.log('nell');
            $("a.nav-link.active").removeClass("active");
            $(this).addClass("active");
        }
    })
});
</script>
<?php
    if(isset(session()->getFlashdata('alert')['msg']))
    {
        $alert_msg = session()->getFlashdata('alert')['msg'];
    }

    if(isset(session()->getFlashdata('alert')['icon']))
    {
        $alert_icon = session()->getFlashdata('alert')['icon'];
    }    
?>

<?php if(isset($alert_msg) && isset($alert_icon)): ?>
<script>
mostrarAlerta('<?= $alert_icon ?>', '<?= $alert_msg ?>');
</script>
<?php endif; ?>

</body>

</html>