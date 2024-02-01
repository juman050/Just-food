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

<div class="post_code_section">

    <div class="delivery_area">
        <input type="text" id="zipcode"  name="zipcode" placeholder="Enter Postcode" class="delivery_postcode" autocomplete="off" onblur="setPostCode()" value="<?php echo e($postcode); ?>">
        <p class="zipcode_hint"><?php echo e($records['message']); ?></p> 

    </div>
    <div class="pickup_area" id="cus_dn">
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
        <!-- <p class="offerHint">Spend more $12 & get discount on basket</p> -->
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
                    <p class="price"><?php echo e(\Session::get('currency')); ?>

                        <span id="d_c"><?php echo e($sippingCharge); ?></span></p>
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
                    <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e((Cart::total() + $sippingCharge) - $discount); ?></p>
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


<script>

    $(document).ready(function() {

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

    });


</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#zipcode").autocomplete({
            source: "<?php echo e(url('/searchPostcode')); ?>",
            minlength:1
        });
    });
</script>
