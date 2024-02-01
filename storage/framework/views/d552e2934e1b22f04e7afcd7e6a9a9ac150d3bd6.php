

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('frontend/css/gallery.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

<section id="gallery" class="p_174_100">
    <div class="container">
        <h2 class="heading-2 text-center">Galleries</h2>
        <div class="white-space30"></div>
        <div id="image-gallery">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                        <a href="<?php echo e(asset('media/theme/food-1.jpg')); ?>"><img src="<?php echo e(asset('media/theme/food-1.jpg')); ?>" class="img-responsive"></a>
                        <div class="img-overlay">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                        <a href="<?php echo e(asset('media/theme/item_856787.jpg')); ?>"><img src="<?php echo e(asset('media/theme/item_856787.jpg')); ?>" class="img-responsive"></a>
                        <div class="img-overlay">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div><!-- End row -->
        </div><!-- End image gallery -->
    </div><!-- End container --> 
</section>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript" src="<?php echo e(asset('frontend/js/gallery.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>