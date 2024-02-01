<?php echo $__env->make('frontend.imageTheme.partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    var str_sts = '<?php echo e($storeDatas->store_extra_tiny_2); ?>';
    var store_extra = '<?php echo e($storeDatas->store_extra_tiny); ?>';
</script>
<?php echo $__env->yieldContent('mainContent'); ?>

<?php echo $__env->make('frontend.imageTheme.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>