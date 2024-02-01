
<?php $__env->startSection('mainContent'); ?>

<!-- Faq Section -->
<section id="contact-section" class="p_174_100">
    <div class="container">
        <h2 class="heading-2 text-center">Faqs</h2>
        <div class="white-space30"></div>

        <?php if($faqs->count() > 0): ?>
        <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <h2 class="faq-h2"><?php echo e($faq->question); ?></h2>
        <p class="faq-p"><?php echo e($faq->answer); ?></p>
        <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <p class="text-center text-danger">No faqs inserted yet !</p>
        <?php endif; ?>

    </div><!-- End container --> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>