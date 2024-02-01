<!DOCTYPE html>
<html lang="en">
<head>
    
<!--=== meta ===-->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="JustFood - Online takeway | Food Delivery Restaurant Website and Online Ordering script">
<meta name="csrf-token" id="csrf-token" content="<?php echo e(csrf_token()); ?>">

<title><?php echo e($data['meta_title']); ?></title>

<link rel="icon" type="image/png" href="<?php echo e(asset('media/theme/'.$themeDatas->site_fabicon)); ?>"/>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

       <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>

       <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->


<!-- CSS -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/bootstrap.min.css')); ?>"> <!-- Bootstrap v3.3.7 -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/font-awesome.min.css')); ?>"> <!-- Font Awesome V4.7.0 -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/owl.carousel.min.css')); ?>"> <!-- Carousel css -->
<link rel="stylesheet" href="<?php echo e(asset('frontend/css/style.css')); ?>"> <!-- Style css -->
<link rel="stylesheet" href="<?php echo e(asset('common/toast/iziToast.min.css')); ?>"> <!-- Toast css -->
<link rel="stylesheet" href="<?php echo e(asset('common/bootstrap-fileinput/fileinput.min.css')); ?>"> <!-- Fileinput css -->
<link rel="stylesheet" href="<?php echo e(asset('common/select2/dist/css/select2.min.css')); ?>"> <!-- Select2 css -->
<link rel="stylesheet" href="<?php echo e(asset('common/jquery-ui/jquery-ui.css')); ?>"> <!-- jquery ui css -->

<!-- JS -->
<script type="text/javascript" src="<?php echo e(asset('frontend/js/jquery.min.js')); ?>"></script> <!-- jQuery v3.1.1 -->
<script type="text/javascript" src="<?php echo e(asset('frontend/js/loadingoverlay.min.js')); ?>"></script> <!-- loadingoverlay.min.js v3.1.1 -->
<script type="text/javascript" src="<?php echo e(asset('frontend/js/bootstrap.min.js')); ?>"></script> <!-- Bootstrap v3.3.7 -->
<script type="text/javascript" src="<?php echo e(asset('common/jquery_validate/jquery.validate.min.js')); ?>"></script> <!-- Validator js -->

<?php
    $flag = 0;
?>

<?php if($openCloseDatas->restaurantStatus=='open'): ?>

    <?php

        $flag = 1;

    ?>

    <?php if((date('H:i:s') >= $openCloseDatas->openingTime) && (date('H:i:s') <= $openCloseDatas->closingTime)): ?>

        <?php

            $flag = 1;

        ?>

    <?php else: ?>

        <?php

            $flag = 2;

        ?>

    <?php endif; ?>

<?php endif; ?>


<!-- Global JS variable by PHP -->
<script type="text/javascript">

    $.ajaxSetup({ headers: { 'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content') } });

    var base_URL = '<?php echo e(asset('/')); ?>';

    var shippingMethod = '<?php echo e($otherDatas->deliveryMethod); ?>';

    var sess_postcode = '<?php echo e(\Session::get('postcode')); ?>';

    var str_sts = '<?php echo e($storeDatas->store_extra_tiny_2); ?>';

    var store_extra = '<?php echo e($storeDatas->store_extra_tiny); ?>';

    var segment = '<?php echo e(Request::segment(1)); ?>';

    var CSRF = '<?php echo e(csrf_token()); ?>';

    var res_status = 'close';

    <?php if($flag==1): ?>

        var res_status = 'open';

    <?php endif; ?>

    <?php if($flag==2): ?>

        <?php if($otherDatas->pre_order_status=='enable'): ?>

            var res_status = 'pre_order_on';

        <?php else: ?>

            var res_status = 'pre_order_off';

        <?php endif; ?>

    <?php endif; ?>

    $.LoadingOverlaySetup({

       background      : "rgba(255, 255, 255, 0.76)",

       image           : "<?php echo e(asset('media/theme/'.$themeDatas->site_pre_loader)); ?>",

       imageAnimation  : "1.5s fadein",

       imageColor      : "#ffcc00",

       zIndex          : 9

    });

</script>

<?php echo $__env->yieldContent('css'); ?>

</head>

<body>



<div class="page-wrapper">

    <!-- header -->

    <?php if($offers): ?>

        <p class="text-center offer_title"><?php echo e($offers->custom_text); ?></p>

    <?php endif; ?>

    <?php if((\Request::segment(1)=='home') || (\Request::segment(1)=='')): ?>

    <header class="home_header" style="background-image: url(<?php echo e(asset('media/theme/'.$pageInfo->home_background_image)); ?>);">

    <?php else: ?>

    <header>

    <?php endif; ?>

        <nav>

            <div id="menu-toggle" class="menu-toggle">

                <div class="hamburger">

                    <span class="bar"></span>

                    <span class="bar"></span>

                    <span class="bar"></span>

                </div>

                <div class="cross">

                    <span class="bar"></span>

                    <span class="bar"></span>

                </div>

            </div>


            <div class="container-fluid nav-container">

                <div class="logo">

                    <a href="<?php echo e(url('/')); ?>"><img class="logo-img" src="<?php echo e(asset('media/theme/'.$themeDatas->site_main_logo)); ?>" alt="Logo"></a>

                </div>

                <div class="menu-box">

                    <ul class="menu-list">



                        <?php if($otherDatas->home_page_status == 'enable'): ?>

                            <li><a href="<?php echo e(url('/')); ?>" class="menu-item">Home</a></li>

                        <?php endif; ?>



                        <?php if($otherDatas->menu_page_status == 'enable'): ?>

                            <li><a href="<?php echo e(url('/menu')); ?>" class="menu-item">Menu</a></li>

                        <?php endif; ?>



                        <?php if($otherDatas->table_book_status=='enable'): ?>

                            <li><a href="<?php echo e(url('/table-reservation')); ?>" class="menu-item">Book Table</a></li>

                        <?php endif; ?>



                        <?php if($otherDatas->menu_file_status=='enable'): ?>

                            <li><a href="<?php echo e(url('/menu-download')); ?>" class="menu-item">Menu download</a></li>

                        <?php endif; ?>



                        <?php if($otherDatas->gallery_page_status=='enable'): ?>

                            <li><a href="<?php echo e(url('/gallery')); ?>" class="menu-item">Gallery</a></li>

                        <?php endif; ?>



                        <?php if($otherDatas->contact_page_status=='enable'): ?>

                            <li><a href="<?php echo e(url('/contact')); ?>" class="menu-item">Contact</a></li>

                        <?php endif; ?>



                        <?php if(Session::get('customerEmail') != null): ?>

                            <li><a href="<?php echo e(url('/pre-orders')); ?>" class="menu-item">My Orders</a></li>

                        <?php endif; ?>



                    </ul>

                    <div class="signup-box">

                        <?php if(Session::get('customerEmail') != null): ?>

                        <a href="<?php echo e(url('profile')); ?>" class="register btn-rounded btn-o"><?php echo e(Session::get('customerName')); ?></a>

                        <?php else: ?>

                        <a href="javascript:void(0)" class="register btn-rounded btn-o log_reg">Login / Register</a>

                        <?php endif; ?>

                    </div>

                </div>

            </div>

        </nav>

        <?php if((\Request::segment(1)=='home') || (\Request::segment(1)=='')): ?>

        <div class="header-info">

            <div class="container">

                <h1 class="heading-1">Restaurant <?php echo e(($flag==1) ? 'Open' : 'Close'); ?></h1>

                <p class="p-text">We are also taking order via <a href="tel:<?php echo e($storeDatas->store_support_number); ?>" class="p-text">Call <?php echo e($storeDatas->store_support_number); ?></a></p>

                <form>

                    <?php if($flag==1): ?>

                        <a href="<?php echo e(url('/menu')); ?>" class="btn-rounded res_btn_rounded">Order now</a>

                    <?php endif; ?>

                    <?php if($flag==2): ?>

                        <?php if($otherDatas->pre_order_status=='enable'): ?>

                            <a href="<?php echo e(url('/menu')); ?>" class="btn-rounded res_btn_rounded">Pre-order now</a>

                        <?php endif; ?>

                    <?php endif; ?>

                </form>

            </div>

        </div>

        <?php endif; ?>

    </header>
