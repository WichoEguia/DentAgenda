<!-- Plantilla: https://site.uplabs.com/posts/esthetic-ui-kit-dashboard-groups -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>DentAgenda</title>
  <!-- TODO: Descargar todas las dependencias -->
  <link rel="stylesheet" href="<?php echo base_url('assets/css/main.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/font-awesome.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/css/jquery-ui.css') ?>">
  <link rel="stylesheet" href="<?php echo base_url('assets/js/wickedpicker/stylesheets/wickedpicker.css') ?>">
  <!-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet"> -->
  <script src="<?php echo base_url('assets/js/jquery.js') ?>" charset="utf-8"></script>
  <script src="<?php echo base_url('assets/js/moment.js') ?>" charset="utf-8"></script>
  <script src="<?php echo base_url('assets/js/jquery-ui/jquery-ui.min.js') ?>" charset="utf-8"></script>
  <script src="<?php echo base_url('assets/js/sweetalert.js') ?>"></script>
  <script src="<?php echo base_url('assets/js/wickedpicker/src/wickedpicker.js') ?>" charset="utf-8"></script>
</head>
<body>
  <header class="flex">
    <div class="titulo_vista_contenedor flex center-Y">
      <p id="titulo_vista"><?php echo isset($titulo) ? $titulo : '' ?></p>
    </div>

    <div id="informacion_usuario" class="flex center-Y">
      <div id="informacion_usuario_nombre">
        <?php
          $nombre = explode(" ", $nombre);
          // $nombre = $nombre[0] . " " . $nombre[1];
          $nombre = count($nombre) >= 2 ? $nombre[0] . " " . $nombre[1] : $nombre[0]
        ?>
        <p>Bienvenido, <?php echo $nombre ?></p>
        <p id="full_date">--/--/---- --:--</p>
      </div>

      <div id="profile_photo" class="flex center-Y">
        <img src="<?php echo $this->session->userdata("foto") ?>"  alt="Imagen de perfil">
      </div>
    </div>

    <div id="opciones_sesion">
      <div class="flex">
        <div id="foto_sesion">
          <img src="<?php echo $this->session->userdata("foto") ?>"  alt="Imagen de perfil">
        </div>
        <div id="enlaces_sesion" class="flex">
          <a href="<?php echo base_url("index.php/Perfil") ?>">Ver Perfil</a>
          <a href="<?php echo base_url("index.php/Perfil/editar") ?>">Editar Perfil</a>
          <a href="<?php echo base_url("index.php/Login/salir") ?>">Cerrar sesión</a>
        </div>
      </div>
    </div>
  </header>
