<!-- Plantilla: https://site.uplabs.com/posts/esthetic-ui-kit-dashboard-groups -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEET</title>
  <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css') ?>">
</head>
<body>
  <header>
    <div id="appdata">
      <!-- Logo e imagen de usuario -->
      <div id="logo" class="flex center-Y center-X">
        <div id="logo_container" class="flex center-Y">
          <div id="logo_image">
            <img src="https://bluerobotics.com/images/br-logo-trans-blue-trans-sm-updated.png" alt="">
          </div>
          <p>GEET</p>
        </div>
      </div>

      <div id="user_session_options" class="flex center-Y center-X">
        <div id="profile_photo_container" class="flex center-Y">
          <div id="profile_photo" class="flex center-Y">
            <img src="https://www.shitpostbot.com/img/sourceimages/happy-doggo-57b1df2fb27db.jpeg">
          </div>
          <p>▼</p>
        </div>
      </div>
    </div>
    <div id="actionbar" class="flex">
      <!-- Barra de busqueda, añadir persona, estilos de vista -->
      <div class="section_actionbar left flex center-Y">
        <!-- <div id="searchbar_container" class="flex center-X center-Y">
          <div id="searchbar" class="flex center-Y">
            <i class="fa fa-search" aria-hidden="true"></i>
            <input type="text" placeholder="Buscar equipos y personas">
          </div>
        </div> -->
      </div>
      <div class="section_actionbar right">
        <div id="msg_container" class="flex center-Y">
          <p id="full_date"></p>
          
          <button clss="flex center-Y center-X">
            <i class="fa fa-calendar" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </div>
  </header>
  <nav>
    <div id="nav_container">
      <div class="flex">
        <div class="icon_nav flex center-X center-Y">
          <i class="fa fa-home" aria-hidden="true"></i>
        </div>
        <div class="text_nav flex center-Y">Inicio</div>
      </div>
      <div class="flex">
        <div class="icon_nav flex center-X center-Y">
          <i class="fa fa-id-card-o" aria-hidden="true"></i>
        </div>
        <div class="text_nav flex center-Y">Perfil</div>
      </div>
      <div class="flex">
        <div class="icon_nav flex center-X center-Y">
          <i class="fa fa-address-book-o" aria-hidden="true"></i>
        </div>
        <div class="text_nav flex center-Y">Agenda</div>
      </div>
      <div class="flex">
        <div class="icon_nav flex center-X center-Y">
          <i class="fa fa-list" aria-hidden="true"></i>
        </div>
        <div class="text_nav flex center-Y">Inventario</div>
      </div>
    </div>
  </nav>
  <main>
    <!-- Pequeñas secciones para reprecentar los usuarios, notificando si están activos, foto y cantidad de equipos y proyectos -->
    <div id="main_content">
