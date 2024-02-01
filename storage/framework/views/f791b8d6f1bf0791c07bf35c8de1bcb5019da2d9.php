<?php $__env->startSection('mainContent'); ?>

<!-- Gallery Section -->
<section id="gallery" class="p_174_100">
    <div class="container">
        <h2 class="heading-2 text-center">Galleries</h2>
        <div class="white-space30"></div>
        <div id="image-gallery">
            <div class="row">

                <?php if(count($galleries) > 0): ?>
                <?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gallery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 image">
                    <div class="img-wrapper">
                        <a href="<?php echo e(asset('media/gallery/'.$gallery->image)); ?>"><img src="<?php echo e(asset('media/gallery/'.$gallery->image)); ?>" class="img-responsive" alt="<?php echo e($gallery->title); ?>"></a>
                        <div class="img-overlay">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                <p class="text-center text-danger">No Photo in gallery !</p>
                <?php endif; ?>


            </div><!-- End row -->
        </div><!-- End image gallery -->
    </div><!-- End container --> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>