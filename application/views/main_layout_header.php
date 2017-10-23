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
            <i class="fa fa-bell" aria-hidden="true"></i>
          </button>
        </div>
      </div>
    </div>
  </header>
