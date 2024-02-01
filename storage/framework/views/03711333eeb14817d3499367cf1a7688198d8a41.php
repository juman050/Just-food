<?php $__env->startSection('mainContent'); ?>

<!-- Terms & Conditions Section -->
<section id="contact-section" class="p_174_100">
	<div class="container">
		<h2 class="heading-2 text-center">Terms & Conditions</h2>
		<div class="white-space30"></div>
		<?php echo e($pageInfo->terms_description); ?>

	</div>
</section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>