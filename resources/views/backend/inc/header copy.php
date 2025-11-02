<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="csrf-token" content="<?= csrf_token(); ;?>">
  <meta name="base_url" content="<?= base_url();?>">
  <title><?= isset($title)?$title:(isset($page_title)?$page_title:'');?></title>
  <link rel="icon" href="<?= __image(__settings('favicon'),'thumb'); ?>" type="image/*" sizes="16x16">
    <script>
        let base_url = `<?= base_url();?>`;
        let _csrf = `<?= csrf_token();?>`;
    </script>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap4-tagsinput@4.1.3/tagsinput.css">
  
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/plugins/fontawesome-free/css/all.min.css');?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/plugins/animate/animate.css');?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/plugins/sweetalert/sweet-alert.css');?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/plugins/nice-select/nice-select.css');?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simplesnackbarjs@1.0.0/dist/simpleSnackbar.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">


    <!-- select 2 -->
  <link rel="stylesheet" href="<?= base_url("app/assets/backend/plugins/select2/select2.main.css");?>" />
  <link rel="stylesheet" href="<?= base_url("app/assets/backend/plugins/select2/select-2.main.css");?>" />
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/plugins/notify/notify.main.css') ?>" />
    <!-- summernote -->
  <link rel="stylesheet" href="<?= base_url("app/assets/backend/plugins/summernote/summernote-bs4.main.css");?>" />



    <style>
        :root{
            --themeColor:#50cd89;
        }
    </style>
  
  
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/css/adminlte.min.css');?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/css/flag-icons.min.css');?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/plugins/icofont.css');?>">


   <?php $css = file_get_contents($this->common_m->generateCss()) ?>
   <style>
     <?= $css; ?>
   </style>




  
  <link rel="stylesheet" href="<?= base_url('app/assets/plugins/commoncss.php');?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/common.css');?>?t=<?= time();?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/default.css');?>?t=<?= time();?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/admin.css');?>?t=<?= time();?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/style.main.css');?>?t=<?= time();?>">
  <link rel="stylesheet" href="<?= base_url('app/assets/backend/themeCss.php');?>?theme=<?= __settings('theme');?>&t=<?= time();?>">



  
  <script src="<?= base_url('app/assets/plugins/axios.main.js')?>"></script>
  <script src="<?= base_url('app/assets/plugins/jquery.main.js')?>" ></script>
</head>
<body class="hold-transition sidebar-mini theme-1 theme-<?= __settings('theme');?>">
<div class="wrapper">
<!-- content-wrapper is in sidebar.blade.php -->