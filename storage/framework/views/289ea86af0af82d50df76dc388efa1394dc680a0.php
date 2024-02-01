

<?php $__env->startSection('mainContent'); ?>

<!-- How it works section -->
<section class="about">
    <div class="white-space"></div>
    <div class="container">
        <h2 class="heading-2">How it works</h2>
        <div class="about-list">
            <div class="about-item">
                <div class="icon">
                    <img src="<?php echo e(asset('media/theme/icon-1.png')); ?>" alt="Icon">
                </div>
                <h3 class="heading-3">Choose</h3>
                <p class="p-text">
                    Choose your food from various item.
                </p>
            </div>
            <div class="about-item">
                <div class="icon">
                    <img src="<?php echo e(asset('media/theme/icon-2.png')); ?>" alt="Icon">
                </div>
                <h3 class="heading-3">Order</h3>
                <p class="p-text">
                    Order your choosen food.
                </p>
            </div>
            <div class="about-item">
                <div class="icon">
                    <img src="<?php echo e(asset('media/theme/icon-3.png')); ?>" alt="Icon">
                </div>
                <h3 class="heading-3">Pay</h3>
                <p class="p-text">
                    Pay and receive your food within time.
                </p>
            </div>
        </div>
    </div>
    <div class="white-space"></div>
</section>

<!-- Popular categories section -->
<section class="popular-restaurant">
    <div class="white-space30"></div>
    <div class="white-space10"></div>
    <div class="container">

        <h2 class="heading-2">Popular Categories</h2>
        <div class="popular-restaurant-list">
            <?php if($categories): ?>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($category->getItems->count() > 0): ?>
            <div class="popular-restaurant-item">
                <div class="img-box">
                    <img src="<?php echo e(asset('media/categories/'.$category->cat_image)); ?>" alt="Resturent">
                </div>
                <div class="info-box">
                    <div class="location">
                        <p class="address p-text"><?php echo e(str_limit(strip_tags($category->cat_name), 25)); ?> (<?php echo e($category->getItems->count()); ?>)</p>
                        <a href="<?php echo e(url('/menu/'.$category->id )); ?>" class="btn-square">Menu</a>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>

    </div>
    <div class="white-space"></div>
</section>

<!-- History section -->
<section class="about">
    <div class="white-space"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="homeItemBox">
                    <h2 class="homeItemBox-h2">We've been Making</h2>
                    <h2 class="homeItemBox-h2">The Delicious Foods Since 1999</h2>
                    <p  class="homeItemBox-p">Fusce hendrerit malesuada lacinia. Donec semper semper sem vitae malesuada. Proin scelerisque risus et ipsum semper molestie sed in nisi. Ut rhoncus congue lectus, rhoncus venenatis leo malesuada id.</p>

                    <p  class="homeItemBox-p">Sed elementum vel felis sed scelerisque. In arcu diam, sollicitudin eu nibh ac, posuere tristique magna. You can use this template for your cafe or restaurant website. Please tell your friends about us. Thank you.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="homeimg-box">
                    <img src="<?php echo e(asset('media/theme/chef.jpg')); ?>">
                </div>
            </div>
        </div>
    </div>
    <div class="white-space"></div>
</section>

<script type="text/javascript">
    var str_sts = '<?php echo e($storeDatas->store_extra_tiny_2); ?>';
    var store_extra = '<?php echo e($storeDatas->store_extra_tiny); ?>';
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>