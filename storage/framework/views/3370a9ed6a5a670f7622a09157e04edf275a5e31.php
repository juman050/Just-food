

<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('frontend/css/chekout.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>


<section id="gallery" class="p_174_100">
    <div class="container">

        <div class="col-md-6 col-xs-12 col-md-offset-3">

            <div id="cart-checkout" style="padding: 70px 0px !important;">

                <h3 class="text-center">Success</h3>

                <p class="text-center success_p">Ordered successfully !</p>
                <p class="text-center success_p">We will take care of your order.</p>
                <p class="text-center success_p">Thank you :)</p>
                <br>
                <br>
                <p class="text-center"><a href="<?php echo e(url('/menu')); ?>" class="btn btn-sm btn-primary">Go to Menu</a></p>

            </div>

        </div>


    </div><!-- End container --> 
</section>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>