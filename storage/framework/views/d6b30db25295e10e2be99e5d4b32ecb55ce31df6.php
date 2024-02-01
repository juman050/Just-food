<!DOCTYPE html>
<html>
<head>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e(config('app.name', 'Laravel')); ?> - <?php echo e(isset($data['title']) ? $data['title'] : ''); ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/skins/_all-skins.min.css')); ?>">
    <!-- jvectormap -->
    <!-- <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/jvectormap/jquery-jvectormap.css')); ?>"> -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css')); ?>">
    <!-- Common css start -->
    <link rel="stylesheet" href="<?php echo e(asset('admin/fk_a_custom.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('common/toast/iziToast.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('common/bootstrap-fileinput/fileinput.min.css')); ?>"> <!-- Select2 -->
    <link rel="stylesheet" href="<?php echo e(asset('common/select2/dist/css/select2.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/dist/css/AdminLTE.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/calculator/calculator.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(asset('common/jquery-ui/jquery-ui.css')); ?>">
    <!-- Common css End -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,300;0,400;0,500;0,900;1,300;1,400&display=swap" rel="stylesheet">
    <style type="text/css">
        .ui-autocomplete-input, .ui-menu, .ui-menu-item {  z-index: 2006; }
    </style>
    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('admin/bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('common/jquery_validate/jquery.validate.min.js')); ?>"></script>
    <script>
        $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });
        var base_URL = '<?php echo e(asset('')); ?>';
    </script>