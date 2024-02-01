<?php $__env->startSection('mainContent'); ?>

<!-- Privacy & Policy Section -->
<section id="contact-section" class="p_174_100">
	<div class="container">
		<h2 class="heading-2 text-center">Privacy & Policy</h2>
		<div class="white-space30"></div>
		<?php echo e($pageInfo->privacy_description); ?>


	</div><!-- End container --> 
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>