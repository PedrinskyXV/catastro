
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link" href="index.html">
          <i class="bi bi-grid"></i>
          <span>Bienvenido </span>
        </a>
      </li><!-- End Bienvenido Nav -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/usuario/index') ?>">
          <i class="bi bi-person"></i>
          <span>Usuarios</span>
        </a>
      </li><!-- End Empresa Nav -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/empresa/index') ?>">
          <i class="bi bi-building"></i>
          <span>Empresas</span>
        </a>
      </li><!-- End Empresa Nav -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/colonia/index') ?>">
          <i class="bi bi-pin-map-fill"></i>
          <span>Colonias</span>
        </a>
      </li><!-- End Colonias Nav -->

      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('/zona/index') ?>">
          <i class="bi bi-pin-fill"></i>
          <span>Zonas o Distritos</span>
        </a>
      </li><!-- End Zonas o Distritos Nav -->

      <li class="nav-heading">Reportes</li>      

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url('/informes/estadocuenta') ?>">
          <i class="bi bi-question-circle"></i>
          <span>Estado de cuenta</span>
        </a>
      </li><!-- End Estado de cuenta Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="<?php echo base_url('/informes/informeTributoporRubro') ?>">
          <i class="bi bi-check2-all"></i>
          <span>Tributo por Rubro</span>
        </a>
      </li><!-- End Completo de empresa Nav -->

    </ul>

  </aside><!-- End Sidebar-->
