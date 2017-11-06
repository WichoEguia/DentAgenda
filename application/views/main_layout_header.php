<!-- Plantilla: https://site.uplabs.com/posts/esthetic-ui-kit-dashboard-groups -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>GEET</title>
  <!-- TODO: Descargar todas las dependencias -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
  <script src="<?php echo base_url('assets/js/jquery.js') ?>" charset="utf-8"></script>
  <script src="<?php echo base_url('assets/js/moment.js') ?>" charset="utf-8"></script>
  <script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui.min.js') ?>" charset="utf-8"></script>
  <script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>
</head>
<body>
  <header>
    <div id="appdata">
      <div id="logo" class="flex center-Y center-X">
        <div id="logo_container" class="flex center-Y">
          <div id="logo_image">
            <img src="<?php echo base_url("assets/img/logo_da.png") ?>" alt="Logo DentAgenda">
          </div>
          <p>DentAgenda</p>
        </div>
      </div>

      <div id="user_session_options" class="flex center-Y center-X">
        <div id="profile_photo_container" class="flex center-Y">
          <div id="profile_photo" class="flex center-Y">
            <img src="<?php echo base_url("assets/img/dogo_da.jpeg") ?>"  alt="Imagen de perfil">
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
        <p id="titulo_vista"><?php echo isset($titulo) ? $titulo : '' ?></p>
      </div>
      <div class="section_actionbar right">
        <div id="msg_container" class="flex center-Y">
          <p id="full_date"></p>

          <div class="flex center-Y center-X">
            <i class="fa fa-bell" aria-hidden="true"></i>
          </div>
        </div>
      </div>
    </div>
    <div id="opciones_usuario" class="">
      <ul>
        <li>
          <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
          Editar perfil
        </li>
        <li id="cerrar_sesion">
          <i class="fa fa-sign-out" aria-hidden="true"></i>
          Cerrar sesion
        </li>
      </ul>
    </div>
  </header>
