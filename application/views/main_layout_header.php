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
  <link rel="stylesheet" href="<?php echo base_url('assets/js/wickedpicker/stylesheets/wickedpicker.css') ?>">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
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
        <p>Bienvenido, Luis</p>
        <p id="full_date">--/--/---- --:--</p>
      </div>

      <div id="profile_photo" class="flex center-Y">
        <img src="<?php echo base_url("assets/img/perfil_da.jpg") ?>"  alt="Imagen de perfil">
      </div>
    </div>
  </header>
