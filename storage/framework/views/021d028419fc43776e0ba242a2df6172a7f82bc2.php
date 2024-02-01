
<?php $__env->startSection('mainContent'); ?>
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

    <!-- Added success message -->
    <p id="cartStatus">Added successfully. Thank you ! <span onclick="crossCartStatus()"><i class="fa fa-times"></i></span></p>
    <section class="trending-food">
        
        <div class="white-space30"></div>
        
        <div class="container-fluid">
            
            <!-- Let Sidebar -->
            <div class="col-md-3 leftSidebar">
                <div class="theiaStickySidebar menu-category-div">
                    <p class="category-title">All Categories</p>
                    <ul class="categories">
                        <?php if($categories): ?>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php
                            $days = explode(',',$category->cat_available_days);
                            if(in_array(mb_strtolower(date('D')), $days)) { ?>

                            <?php if(($category->cat_available_delivery_method == 'both') || ($otherDatas->deliveryMethod == 'both') || ($category->cat_available_delivery_method == $otherDatas->deliveryMethod)): ?>
                            <li>
                                <a href="javascript:void(0)" class="categories-item <?php echo e(($category->id==$cat_id) ? 'active' : ''); ?>" onclick="getCatItems('<?php echo e($category->cat_name); ?>','<?php echo e($category->id); ?>')"><?php echo e($category->cat_name); ?>

                                <!-- <span>(<?php echo e($category->getItems->count()); ?>)</span> -->
                                </a>
                            </li>
                            <?php endif; ?>

                            <?php } ?>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                        <li><a href="javascript:void(0)" class="categories-item">No Category</a></li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            
            
            <!-- Middle Content - Items -->
            <div class="col-md-6 food-section">
                <div class="div-md-6">
                <!-- <div class="div-6-custom"> -->
                    <div class="theiaStickySidebar">
                        <?php if(count($categories) > 0): ?>
                        <p class="category-title web-cat-title">
                            <span id="append-cat-name"><?php echo e($cat_name); ?></span>
                           
                                <?php if($flag==2): ?>
                                    <?php if($otherDatas->pre_order_status=='enable'): ?>
                                        <span class="menu-pre-status">Pre-order</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            
                        </p>
                        <?php endif; ?>

                        <div class="trending-food-list" id="append-item">

                            <?php if(count($records) > 0): ?>

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
                                                <div class="btn_add"><a href="javascript:void(0)" onclick="add_in_basket('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo e($item->item_new_price); ?>')" class="btn-add">Add to cart</a></div>
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

                        </div>

                        <!-- Mobile Menu -->

                        <div id="mobile-area">


                                <?php if($categories): ?>
                                    <?php
                                        $mb_count = 0;
                                    ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $mb_count++;
                                    ?>

                                    <?php
                                    $days = explode(',',$category->cat_available_days);
                                    if(in_array(mb_strtolower(date('D')), $days)) { ?>

                                    <?php if(($category->cat_available_delivery_method == 'both') || ($otherDatas->deliveryMethod == 'both') || ($category->cat_available_delivery_method == $otherDatas->deliveryMethod)): ?>

                                    <p class="category-title mobile-category"><a href="javascript:void(0)" class="cla-<?php echo e($category->id); ?>" onclick="itemShowHideMb('<?php echo e($category->id); ?>','cla-<?php echo e($category->id); ?>')"><?php echo e($category->cat_name); ?> <i class="<?php echo e(($mb_count=='1') ? 'fa fa-chevron-down' : 'fa fa-chevron-up'); ?>"></i></a></p>


                                        <div class="trending-food-list" id="cla-<?php echo e($category->id); ?>">

                                        <?php if($mb_count==1): ?>

                                            <?php if($records->count() > 0): ?>

                                            <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                            <?php if(($item->item_delivery_type == 'both') || ($otherDatas->deliveryMethod == 'both') || ($item->item_delivery_type == $otherDatas->deliveryMethod)): ?>

                                                <?php if($item->variances->count() > 0): ?>
                                                    <?php $__currentLoopData = $item->variances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="trending-food-item">
                                                        <?php if($storeDatas->store_active_theme==1): ?>
                                                        <div class="img-box">
                                                            <img src="<?php echo e(asset('media/items/'.$item->item_image)); ?>" alt="food">
                                                        </div>
                                                        <?php endif; ?>
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
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php else: ?>
                                                    <div class="trending-food-item">
                                                        <?php if($storeDatas->store_active_theme==1): ?>
                                                        <div class="img-box">
                                                            <img src="<?php echo e(asset('media/items/'.$item->item_image)); ?>" alt="food">
                                                        </div>
                                                        <?php endif; ?>
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
                                                                <div class="btn_add"><a href="javascript:void(0)" onclick="add_in_basket('<?php echo $item->id; ?>','<?php echo $item->item_name; ?>','<?php echo e($item->item_new_price); ?>')" class="btn-add">Add to cart</a></div>
                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>

                                            <?php endif; ?>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <?php else: ?>
                                                <p class="text-center text-danger no_item">No Item found</p>
                                            <?php endif; ?>

                                        <?php endif; ?>

                                        </div>

                                    <?php endif; ?>

                                    <?php } ?>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>


                        </div>

                        <!-- End mobile menu -->

                    </div>
                </div>
            </div>
            
            
            <!-- Right Sidebar -->
            <div class="col-md-3 rightSidebar">
                <div class="theiaStickySidebar menu-cart-div">
                    <div id="right-section">
                        <p class="category-title">Basket Details</p>
                        <div class="basketDiv">

                            <?php echo Form::open(['url' => action('CartController@checkout'), 'method' => 'POST', 'id' => 'checkOutForm', 'role'=>'form']); ?>



                            <div class="shipping_method_radio">

                            <?php if($otherDatas->deliveryMethod=='both'): ?>

                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" onclick="shippingMethodFunc('delivery')" value="delivery" <?php if((Session::get('deliveryMethod')=='delivery') OR (Session::get('deliveryMethod')=='')): ?> checked <?php endif; ?>><label>Delivery</label>
                                </div>
                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" value="collection" onclick="shippingMethodFunc('collection')"  <?php if(Session::get('deliveryMethod')=='collection'): ?> checked <?php endif; ?> ><label>Pick-up</label>  
                                </div>

                            <?php elseif($otherDatas->deliveryMethod=='delivery'): ?>
                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" onclick="shippingMethodFunc('delivery')" value="delivery" checked><label class="cus_lebel">Delivery</label>      
                                </div>
                            <?php elseif($otherDatas->deliveryMethod=='collection'): ?>
                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" value="collection" onclick="shippingMethodFunc('collection')" checked><label class="cus_lebel">Pick-up</label>  
                                </div>
                            <?php endif; ?>


                            </div>

                            <p class="ShippingimeHint">Delivery time taken <?php echo e($otherDatas->deliveryTimeLimit); ?> min & pickup time <?php echo e($otherDatas->collectionTimeLimit); ?> min</p>

                            <div id="postcode_cart">

                                <div class="post_code_section">

                                    <div class="delivery_area" <?php if(($otherDatas->deliveryMethod=='collection') OR (Session::get('deliveryMethod')=='collection')): ?>  id="cus_dn" <?php endif; ?> >
                                        <input type="text" id="zipcode"  name="zipcode" placeholder="Enter Postcode" class="delivery_postcode" autocomplete="off" onblur="setPostCode()" value="<?php echo e(\Session::get('postcode')); ?>">
                                        <p class="zipcode_hint"><?php if(\Session::get('postcode')): ?> Previous delivery postcode was : <?php echo e(\Session::get('postcode')); ?>  <?php endif; ?></p>
                                    </div>

                                    <?php if(Session::get('deliveryMethod')=='collection'): ?>
                                        <input type="text" name="zipcode" class="collection_postcode" value="<?php echo e($storeDatas->store_postcode); ?>" disabled="disabled">
                                    <?php endif; ?>

                                    <div class="pickup_area" <?php if(($otherDatas->deliveryMethod!='collection') OR ((Session::get('deliveryMethod')=='delivery'))): ?>  id="cus_dn" <?php endif; ?>>
                                        <input type="text" name="zipcode" class="collection_postcode" value="<?php echo e($storeDatas->store_postcode); ?>" disabled="disabled">
                                    </div>
                                    
                                </div>

                                <div id="cart-main-div">
                                    <div id="cart-section">

                                        <?php
                                            $discount = 0.00;
                                        ?>

                                        <?php if(\Session::get('deliveryCharge')): ?> 
                                            <?php
                                                $sippingCharge = \Session::get('deliveryCharge');
                                            ?>
                                        <?php else: ?> 
                                            <?php
                                                $sippingCharge = 0.00;
                                            ?>
                                        <?php endif; ?>

                                        <?php if(\Session::get('postcode')): ?> 
                                            <?php
                                                $postcode = \Session::get('postcode');
                                            ?>
                                        <?php else: ?> 
                                            <?php
                                                $postcode = null;
                                            ?>
                                        <?php endif; ?>

                                        <?php if($otherDatas->free_shipping_status=='enable'): ?>
                                            <?php if(Cart::total() >= $otherDatas->amount_for_free_shipping): ?> 
                                                <?php
                                                    $sippingCharge = 0.00;
                                                ?>
                                            <?php endif; ?>
                                        <?php endif; ?>

                                        <?php if(OfferHelper::is_offer()): ?>
                                            <p class="offerHint"><?php echo e(OfferHelper::is_offer()); ?></p>
                                        <?php endif; ?>

                                        <?php if(OfferHelper::check_coupon()): ?>
                                            <?php
                                                $offerData = OfferHelper::check_coupon();
                                            ?>
                                            <?php if($offerData->coupon_code): ?>

                                            <?php if(\Session::get('coupon_status')=='done'): ?>
                                                <p class="offerHint cus_p5">Your coupon code is : <?php echo e(\Session::get('coupon_code')); ?></p>
                                            <?php endif; ?>

                                            <?php if(\Session::get('coupon_status')=="" || \Session::get('coupon_status')=="pending"): ?>
                                            <div id="coupon-vox">
                                                <input hidden type="text" class="offer_id" name="offer_id" value="<?php echo e($offerData->id); ?>">
                                                <input type="text" class="check_coupon_code" name="check_coupon_code" placeholder="Enter coupon code" value="">
                                                <a href="javascript:void(0)" class="btn-add cus_p_5_15" onclick="checkCoupon()">Submit</a>
                                            </div>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        <?php if(OfferHelper::offer_details()): ?>
                                            <?php
                                                $offerResponse = OfferHelper::offer_details();
                                            ?>
                                            <?php $__currentLoopData = $offerResponse; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $singleOffer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <?php if($singleOffer->action_type == 'action_basket'): ?>

                                                    <?php
                                                        $amount = $singleOffer->action_other;
                                                    ?>

                                                    <?php if($singleOffer->action_value == 'percent'): ?>
                                                        <?php
                                                            $discount = Cart::total()*$singleOffer->action_other;
                                                            $discount = $discount / 100;
                                                        ?>
                                                    <?php endif; ?>

                                                    <?php if($singleOffer->action_value == 'fix_amount'): ?>
                                                        <?php
                                                            $discount = $singleOffer->action_other;
                                                        ?>
                                                    <?php endif; ?>

                                                <?php endif; ?>

                                                <?php if($singleOffer->action_type == 'action_free_item'): ?>
                                                    <?php
                                                      $free_item_allowed = $singleOffer->action_value;
                                                      $free_items = explode(',',$singleOffer->action_other);
                                                    ?>
                                                <?php endif; ?>


                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            
                                        <?php endif; ?>

                                        

                                        <input type="hidden" class="postcode" name="postcode" value="<?php echo e($postcode); ?>">
                                        <input type="hidden" class="deliveryCharge" name="deliveryCharge" value="<?php echo e($sippingCharge); ?>">
                                        <input type="hidden" class="discount" name="discount" value="<?php echo e($discount); ?>">

                                        <?php if(Cart::count() > 0): ?>
                                            <?php
                                                $count_free_item = 0;
                                                $free_items_array = [];
                                            ?>
                                            <?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                                <div class="sin-item">
                                                    <div class="sin-item-up">
                                                        <div class="sin-item-left">
                                                            <p><?php echo e($row->options->has('varName') ? $row->options->varName : ''); ?> <?php echo e($row->name); ?></p>
                                                        </div>
                                                        <div class="sin-item-right">
                                                            <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e($row->price); ?></p>
                                                        </div>
                                                    </div>
                                                    <div class="sin-item-down">    
                                                        <div class="sin-item-up">
                                                            <div class="sin-item-left">
                                                                <?php if($row->options->subVariances): ?>
                                                                <?php $__currentLoopData = $row->options->subVariances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subVariance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                <p class="sub-variance">+ <?php echo e($subVariance); ?></p>
                                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                <?php endif; ?>
                                                            </div>
                                                            <div class="sin-item-right">
                                                                <div class="card-item-actions mt-08">

                                                                    <?php if($row->price!=0): ?>
                                                                    <i class="fa fa-minus" onclick="update_qty('<?php echo e($row->rowId); ?>','<?php echo e($row->qty); ?>','decr')"></i>
                                                                    <span><?php echo e($row->qty); ?></span>
                                                                    <i class="fa fa-plus" onclick="update_qty('<?php echo e($row->rowId); ?>','<?php echo e($row->qty); ?>','incr')"></i>
                                                                    <?php endif; ?>
                                                                    <?php if($row->price==0): ?>
                                                                    <?php
                                                                        $count_free_item = $count_free_item+$row->qty;
                                                                    ?>

                                                                        <?php if($row->options->varId): ?>
                                                                            <?php
                                                                            $free_items_array[] = $row->id.'-'.$row->options->varId;
                                                                            ?>
                                                                        <?php else: ?>
                                                                            <?php
                                                                            $free_items_array[] = $row->id;
                                                                            ?>
                                                                        <?php endif; ?>
                                                                    <i class="fa fa-trash" onclick="update_qty('<?php echo e($row->rowId); ?>','<?php echo e($row->qty); ?>','decr')"></i>
                                                                    <?php endif; ?>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                        <?php else: ?>
                                            <p class="empty_text">Cart empty !</p>
                                            <img src="<?php echo e(asset('media/theme/cart_empty.jpg')); ?>" class="emptyImage">
                                        <?php endif; ?>

                                        <?php if(Cart::count() > 0): ?>
                                        <div class="sin-item">
                                            <div class="sin-item-up">
                                                <div class="sin-item-left">
                                                    <p>Subtotal</p>
                                                </div>
                                                <div class="sin-item-right">
                                                    <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e(Cart::total()); ?></p>
                                                </div>
                                            </div>
                                            <div class="sin-item-up">
                                                <div class="sin-item-left">
                                                    <p>Delivery charge</p>
                                                </div>
                                                <div class="sin-item-right">
                                                    <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e($sippingCharge); ?></p>
                                                </div>
                                            </div>
                                            <div class="sin-item-up">
                                                <div class="sin-item-left">
                                                    <p>Discount</p>
                                                </div>
                                                <div class="sin-item-right">
                                                    <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e($discount); ?></p>
                                                </div>
                                            </div>
                                            <div class="sin-item-up">
                                                <div class="sin-item-left">
                                                    <p>Total</p>
                                                </div>
                                                <div class="sin-item-right">
                                                    <p class="price"><?php echo e(\Session::get('currency')); ?>

                                                    <?php echo e((Cart::total() + $sippingCharge) - $discount); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>

                                    </div>

                                    <div class="checkout-section">

                                            <?php if(isset($free_item_allowed)): ?>
                                                <select id="free_item" class="form-control cus_free">
                                                    <option value="">Choose <?php echo e(($free_item_allowed-$count_free_item==0) ? '' : $free_item_allowed-$count_free_item.' more'); ?> free itmes </option>
                                                    <?php 

                                                    foreach ($free_items as $free_item) {
                                                            if(!in_array($free_item, $free_items_array)){
                                                     ?>

                                                    <option value="<?php echo $free_item_allowed.','.$count_free_item.','.OfferHelper::getFreeItemValue($free_item); ?>"><?php echo OfferHelper::getFreeItemName($free_item); ?></option>

                                                    <?php  } ?>
                                                    <?php  } ?>
                                                </select>
                                            <?php endif; ?>
                                        
                                        <?php if( (Cart::total() + $sippingCharge) - $discount < 10): ?>
                                            <button type="submit" class="checkout-btn" disabled="disabled" id="dn_c" >Order minimum <?php echo e(Session::get('currency')); ?> 10</button>
                                        <?php else: ?>
                                            <button type="submit" class="checkout-btn" >Checkout</button>
                                        <?php endif; ?>
                                        
                                        <a href="#right-section" class="mb-checkBasket">Total Basket <span class="total-amount"><?php echo e(Session::get('currency')); ?> <?php echo e((Cart::total() + $sippingCharge) - $discount); ?></span></a>

                                    </div>
                                </div>

                            </div>

                            <?php echo Form::close(); ?>



                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="white-space"></div>
        
    </section>

    <div class="modal fade" id="subVarianceModal" tabindex="-1" role="dialog" aria-labelledby="sBModal" aria-hidden="true">

    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<script type="text/javascript">

    var str_sts = '<?php echo e($storeDatas->store_extra_tiny_2); ?>';
    var store_extra = '<?php echo e($storeDatas->store_extra_tiny); ?>';
            
    $(document).ready(function() {

        $('.leftSidebar, .food-section, .rightSidebar')
            .theiaStickySidebar({
                additionalMarginTop: 110
            });


        $('#free_item').on('change',function(e){

          if(res_status!='pre_order_off'){

            var allData = $(this).val();
            var res = allData.split(",");

            if(res[0]==res[1]){
              alert('You already added 2 items');
            }else{
              $.ajax({
                  type: 'post',
                  url: base_URL+"cart/storeFreeItem",
                  dataType: "html",
                  data: {allData:allData},
                  success: function(result){
                    $('#cart-main-div').html(result);
                    $('#cartStatus').fadeIn(400).delay(1000).fadeOut(400);
                  }
              });
            }
          }else{
            alert('Restaurant is close now');
          }

        })

        $("#zipcode").autocomplete({
            source: "<?php echo e(url('/searchPostcode')); ?>",
            minlength:1
        });
    });

</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>