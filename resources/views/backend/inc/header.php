<!DOCTYPE html>
<html lang="<?= __settings('language'); ?>" dir="<?= direction(); ?>">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?= csrf_token();; ?>">
  <meta name="base_url" content="<?= asset_url(); ?>">
  <meta name="app-language" content="<?= $this->config->item('site_lang') ?? 'en'; ?>">


  <title><?= isset($title) ? $title : (isset($page_title) ? $page_title : ''); ?></title>
  <link rel="icon" href="<?= __image(__settings('favicon'), 'thumb'); ?>" type="image/*" sizes="16x16">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?= asset_url('app/assets/backend/plugins/fontawesome-free/css/all.min.css'); ?>">

  <!-- summernote -->
  <link rel="stylesheet" href="<?= asset_url("app/assets/backend/plugins/summernote/summernote-bs4.main.css"); ?>" />
  <link rel="stylesheet" href="<?= asset_url("app/assets/backend/plugins/date/daterangepicker.css"); ?>" />

  <script>
    let LoadUrl = "<?= isset($LoadUrl) ? $LoadUrl : ''; ?>";
  </script>
  <!-- Js Error MSG -->
  <?php include VIEWPATH . "component/jsErrorMsg.php"; ?>
  <!-- Js Error MSG -->

  <style>
    :root {
      --themeColor: #50cd89;
    }
  </style>

  <?php if (auth('role') == 'user') : ?>
    <style>
      :root {
        --activeColor: #<?= !empty(__vsettings('color')) ? __vsettings('color') : 'e8088e' ?>;
        --defaultColor: var(--activeColor);
        --themeColor: var(--activeColor);
        --dcolor: var(--activeColor);
      }
    </style>
  <?php else: ?>
    <style>
      :root {
        --activeColor: #<?= !empty(__settings('color')) ? __settings('color') : 'e8088e' ?>;
        --defaultColor: var(--activeColor);
        --themeColor: var(--activeColor);
        --dcolor: var(--activeColor);
      }
    </style>
  <?php endif; ?>


  <!-- Theme style -->


  <link rel="stylesheet" href="<?= asset_url('app/assets/css/flag-icons.min.css'); ?>">
  <link rel="stylesheet" href="<?= asset_url('app/assets/plugins/icofont.css'); ?>">


  <?php
  $context = stream_context_create([
    "ssl" => [
      "verify_peer" => false,
      "verify_peer_name" => false,
    ]
  ]);
  $css = file_get_contents($this->common_m->generateCss(__settings('version'), true), false, $context);

  ?>
  <style rel="stylesheet">
    <?= $css; ?>
  </style>

  <?php if (direction() == 'rtl') : ?>
    <link rel="stylesheet" href="<?= asset_url('app/assets/backend/css/bootstraprtl.main.css'); ?>">
  <?php endif; ?>

  <!-- custom Css -->
  <style rel="stylesheet">
    <?=
    $this->common_m->cssFiles();
    ?>
  </style>




  <?php if (__auth('role') == 'admin') : ?>
    <?php $atheme = !empty(__settings('theme')) ? __settings('theme') : 'light'; ?>
    <?php $acolor = !empty(__settings('color')) ? __settings('color') : 'e8088e'; ?>
    <link rel="stylesheet" href="<?= asset_url('app/assets/backend/themeCss.php'); ?>?theme=<?= $atheme; ?>&color=<?= $acolor; ?>&t=<?= time(); ?>">
  <?php endif; ?>


  <?php if (auth('role') == 'user') : ?>
    <?php $vtheme = !empty(__vsettings('theme')) ? __vsettings('theme') : 'light'; ?>
    <?php $vcolor = !empty(__vsettings('color')) ? __vsettings('color') : 'e8088e'; ?>
    <link rel="stylesheet" href="<?= asset_url('app/assets/backend/themeCss.php'); ?>?theme=<?= $vtheme; ?>&color=<?= $vcolor; ?>&t=<?= time(); ?>">
  <?php endif; ?>




  <?php if (direction() == 'rtl') : ?>
    <link rel="stylesheet" href="<?= asset_url('app/assets/backend/adminrtl.css'); ?>?t=<?= time(); ?>">
  <?php endif; ?>

  <link rel="stylesheet" href="<?= asset_url('public/css/responsive.main.css'); ?>?t=<?= time(); ?>">
  <link rel="stylesheet" href="<?= asset_url('app/assets/css/reset.css'); ?>?t=<?= time(); ?>">




  <script src="<?= asset_url('app/assets/plugins/axios.main.js') ?>"></script>
  <script src="<?= asset_url('app/assets/plugins/jquery.main.js') ?>"></script>
  <script src="<?= asset_url("app/assets/backend/plugins/chart/chart.js") ?>"></script>

  <script src="<?= asset_url("app/assets/notification.js"); ?>?time=<?= time(); ?>"></script>

</head>
<?php if (__auth('role') == 'admin') : ?>

  <body class="hold-transition sidebar-mini theme-1 theme-<?= __settings('theme'); ?>">
  <?php endif; ?>

  <?php if (auth('role') == 'user') : ?>

    <body class="hold-transition sidebar-mini theme-1 theme-<?= __vsettings('theme'); ?>">
    <?php endif; ?>
    <div class="wrapper">

      <?php $this->security->xs_clean(); ?>
      <!-- content-wrapper is in sidebar.blade.php -->