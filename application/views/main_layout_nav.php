<nav>
  <div id="logo_imagen" class="flex center-X center-Y">
    <img src="<?php echo base_url("assets/img/logo_da.svg") ?>" alt="Logo DentAgenda">
  </div>

  <div id="navegacion_wrapper">
    <div class="linea_separacion"></div>

    <a href="<?php echo base_url('index.php/Perfil') ?>" class="text_nav flex center-Y" style="<?php echo $item == 1 ? 'background: #26c0ab; color: #fff;' : '' ?>">
      <i class="fa fa-id-card-o" aria-hidden="true"></i>
      <p class="label_nav flex center-Y">Perfil</p>
    </a>

    <a href="<?php echo base_url('index.php/Contactos') ?>" class="text_nav flex center-Y" style="<?php echo $item == 2 ? 'background: #26c0ab; color: #fff;' : '' ?>">
      <i class="fa fa-address-book-o" aria-hidden="true"></i>
      <p class="label_nav flex center-Y">Pacientes</p>
    </a>

    <a href="<?php echo base_url('index.php/Citas/nueva_cita') ?>" class="text_nav flex center-Y" style="<?php echo $item == 3 ? 'background: #26c0ab; color: #fff;' : '' ?>">
      <i class="fa fa-plus" aria-hidden="true"></i>
      <p class="label_nav flex center-Y">Crear cita</p>
    </a>

    <a href="<?php echo base_url('index.php/Agenda') ?>" class="text_nav flex center-Y" style="<?php echo $item == 4 ? 'background: #26c0ab; color: #fff;' : '' ?>">
      <i class="fa fa-calendar" aria-hidden="true"></i>
      <p class="label_nav flex center-Y">Agenda</p>
    </a>

    <a href="<?php echo base_url('index.php/Inventario') ?>" class="text_nav flex center-Y"  style="<?php echo $item == 5 ? 'background: #26c0ab; color: #fff;' : '' ?>">
      <i class="fa fa-list" aria-hidden="true"></i>
      <p class="label_nav flex center-Y">Inventario</p>
    </a>
  </div>
</nav>

<main>
  <!-- Pequeñas secciones para reprecentar los usuarios, notificando si están activos, foto y cantidad de equipos y proyectos -->
  <div id="main_content">
