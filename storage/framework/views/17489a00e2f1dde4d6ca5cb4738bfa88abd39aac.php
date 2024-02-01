<?php if($records->count() > 0): ?>

<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<?php if(($item->item_delivery_type == 'both') || ($otherDatas->deliveryMethod == 'both') || ($item->item_delivery_type == $otherDatas->deliveryMethod)): ?>
    <?php if($item->variances->count() > 0): ?>
        <?php $__currentLoopData = $item->variances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

            <?php if($storeDatas->store_active_theme==1): ?>
            <div class="trending-food-item">
                <div class="img-box">
                    <img src="<?php echo e(asset('media/items/'.$item->item_image)); ?>" alt="food">
                </div>
                <div class="food-info">
                    <p class="p-text food-name"><?php echo e($variance->variance_name); ?> <?php echo e($item->item_name); ?></p>
                    <div class="p-text-vox">
                        <div class="price">
                            <span class="min-price">
                                <?php if($variance->item_old_price): ?>
                                <del><?php echo e(\Session::get('currency')); ?> <?php echo e($variance->item_old_price); ?></del>  <?php echo e(\Session::get('currency')); ?> <?php echo e($variance->item_new_price); ?>

                                <?php else: ?>
                                <?php echo e(\Session::get('currency')); ?> <?php echo e($variance->item_new_price); ?>

                                <?php endif; ?>
                            </span>
                        </div>
                        <?php if($item->item_sub_menu === 'yes'): ?>
                        <div class="btn_add"><a href="javascript:void(0)" onclick="get_sub_variance('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo $variance->item_new_price; ?>','<?php echo $variance->id; ?>','<?php echo $variance->variance_name; ?>')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                        <?php else: ?>
                        <div class="btn_add"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo e($variance->item_new_price); ?>','<?php echo $variance->id; ?>','<?php echo $variance->variance_name; ?>')">Add to cart</a></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php else: ?>
            <div class="trending-food-item-theme-2">
                <div class="p-text-vox-theme-2">
                    <div class="name-theme-2">
                        <?php echo e($variance->variance_name); ?> <?php echo e($item->item_name); ?>

                    </div>
                    <div class="price-theme-2">
                        <span class="min-price-theme-2">
                            <?php if($variance->item_old_price): ?>
                            <del><?php echo e(\Session::get('currency')); ?> <?php echo e($variance->item_old_price); ?></del>  <?php echo e(\Session::get('currency')); ?> <?php echo e($variance->item_new_price); ?>

                            <?php else: ?>
                            <?php echo e(\Session::get('currency')); ?> <?php echo e($variance->item_new_price); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($item->item_sub_menu === 'yes'): ?>
                    <div class="btn_add  btn-add-theme-2"><a href="javascript:void(0)" onclick="get_sub_variance('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo $variance->item_new_price; ?>','<?php echo $variance->id; ?>','<?php echo $variance->variance_name; ?>')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                    <?php else: ?>
                    <div class="btn_add  btn-add-theme-2"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo e($variance->item_new_price); ?>','<?php echo $variance->id; ?>','<?php echo $variance->variance_name; ?>')">Add to cart</a></div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php else: ?>

        <?php if($storeDatas->store_active_theme==1): ?>
        <div class="trending-food-item">
            <div class="img-box">
                <img src="<?php echo e(asset('media/items/'.$item->item_image)); ?>" alt="food">
            </div>
            <div class="food-info">
                <p class="p-text food-name"><?php echo e($item->item_name); ?></p>
                <div class="p-text-vox">
                    <div class="price">
                        <span class="min-price">
                            <?php if($item->item_old_price): ?>
                            <del><?php echo e(\Session::get('currency')); ?> <?php echo e($item->item_old_price); ?></del>  <?php echo e(\Session::get('currency')); ?> <?php echo e($item->item_new_price); ?>

                            <?php else: ?>
                            <?php echo e(\Session::get('currency')); ?> <?php echo e($item->item_new_price); ?>

                            <?php endif; ?>
                        </span>
                    </div>
                    <?php if($item->item_sub_menu === 'yes'): ?>
                    <div class="btn_add"><a href="javascript:void(0)" onclick="get_sub_variance('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo $item->item_new_price; ?>')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                    <?php else: ?>
                    <div class="btn_add"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo e($item->item_new_price); ?>')">Add to cart</a></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php else: ?>

        <div class="trending-food-item-theme-2">
            <div class="p-text-vox-theme-2">
                <div class="name-theme-2">
                    <?php echo e($item->item_name); ?>

                </div>
                <div class="price-theme-2">
                    <span class="min-price-theme-2">
                        <?php if($item->item_old_price): ?>
                        <del><?php echo e(\Session::get('currency')); ?> <?php echo e($item->item_old_price); ?></del>  <?php echo e(\Session::get('currency')); ?> <?php echo e($item->item_new_price); ?>

                        <?php else: ?>
                        <?php echo e(\Session::get('currency')); ?> <?php echo e($item->item_new_price); ?>

                        <?php endif; ?>
                    </span>
                </div>
                <?php if($item->item_sub_menu === 'yes'): ?>
                <div class="btn_add btn-add-theme-2"><a href="javascript:void(0)" onclick="get_sub_variance('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo $item->item_new_price; ?>')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                <?php else: ?>
                <div class="btn_add btn-add-theme-2"><a href="javascript:void(0)" onclick="add_in_basket('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo e($item->item_new_price); ?>')" class="btn-add">Add to cart</a></div>
                <?php endif; ?>
            </div>
        </div>

        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php else: ?>
    <p class="text-center text-danger no_item">No Item found</p>
<?php endif; ?>
