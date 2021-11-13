<?= $rol = session()->get('rol'); ?>


  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link">
          <i class="bi bi-grid"></i>
          <span>Bienvenido </span>
        </a>
      </li><!-- End Bienvenido Nav -->

      <?php if($rol == "SuperAdmin"):?>
        <li class="nav-item">
        <a class="nav-link" href="<?= base_url($rol . '/usuario/index') ?>">
          <i class="bi bi-person"></i>
          <span>Usuarios</span>
        </a>
      </li><!-- End Empresa Nav -->
      <?php endif;?>

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url($rol . '/empresa/index') ?>">
          <i class="bi bi-building"></i>
          <span>Empresas</span>
        </a>
      </li><!-- End Empresa Nav -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url($rol . '/colonia/index') ?>">
          <i class="bi bi-pin-map-fill"></i>
          <span>Colonias</span>
        </a>
      </li><!-- End Colonias Nav -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url($rol . '/zona/index') ?>">
          <i class="bi bi-pin-fill"></i>
          <span>Zonas o Distritos</span>
        </a>
      </li><!-- End Zonas o Distritos Nav -->

      <?php if($rol == "SuperAdmin" || $rol == "Administador"):?>
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url($rol . '/bitacora/index') ?>">
          <i class="bi bi-file"></i>
          <span>Bitacoras</span>
        </a>
      </li><!-- End Empresa Nav -->
      <?php endif;?>

      <?php if($rol == "SuperAdmin" || $rol == "Administador"):?>
      <li class="nav-heading">Reportes</li>      

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url($rol . '/informes/estadocuenta') ?>">
          <i class="bi bi-question-circle"></i>
          <span>Estado de cuenta</span>
        </a>
      </li><!-- End Estado de cuenta Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url($rol . '/informes/informeTributoporRubro') ?>">
          <i class="bi bi-check2-all"></i>
          <span>Tributo por Rubro</span>
        </a>
      </li><!-- End Completo de empresa Nav -->
      <?php endif;?>
    </ul>

  </aside><!-- End Sidebar-->
