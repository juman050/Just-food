<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('mainContent'); ?>

    <?php if($user): ?>
        <?php
            $first_name = $user->name;
            $email = $user->email;
            $phone = $user->phone;
            $postcode_details = $user->postcode;
            $address = $user->address;
        ?>
    <?php else: ?>
        <?php
            $first_name = "";
            $email = "";
            $phone = "";
            $postcode_details = "";
            $address = "";
        ?>
    <?php endif; ?>



<section id="gallery" class="p_174_100">
    <div class="container">

        <div class="col-md-6 col-xs-12">

            <div id="cart-checkout">

                <h3>Order Details</h3>

                <?php if(Cart::count() > 0): ?>
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
                                    <span>Qty : <?php echo e($row->qty); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                            <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e($reqDatas['deliveryCharge']); ?></p>
                        </div>
                    </div>
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>Discount</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price"><?php echo e(\Session::get('currency')); ?><?php echo e($reqDatas['discount']); ?></p>
                        </div>
                    </div>
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>Total</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price"><?php echo e(\Session::get('currency')); ?>

                            <?php echo e((Cart::total() + $reqDatas['deliveryCharge']) - $reqDatas['discount']); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>

        <div class="col-md-6 col-xs-12">

            <?php echo Form::open(['url' => action('CartController@order'), 'method' => 'POST', 'id' => 'contact', 'class' => 'orderForm', 'role'=>'form']); ?>


                <?php echo e(csrf_field()); ?>


                <?php if($reqDatas['shippingMethod']=='delivery'): ?>
                    <?php
                        $timeLimit = $otherDatas->deliveryTimeLimit;
                        $zipcode = $reqDatas['zipcode'];
                    ?>
                <?php endif; ?>

                <?php if($reqDatas['shippingMethod']=='collection'): ?>
                    <?php
                        $timeLimit = $otherDatas->collectionTimeLimit;
                        $zipcode = $storeDatas->store_postcode;
                    ?>
                <?php endif; ?>



                <?php if(Session::has('message')): ?>
                    <p class="sV"><?php echo e(Session::get('message')); ?></p>
                <?php endif; ?>

                <h3>Specify 
                    <?php if($reqDatas['shippingMethod']=='collection'): ?> pick-up <?php endif; ?>
                    <?php if($reqDatas['shippingMethod']=='delivery'): ?> delivery <?php endif; ?>  time</h3>

                <select name="shipping_time" id="shipping_time" tabindex="1" required="required">
                    <option value="asap">ASAP (Estimate <?php echo e($timeLimit); ?> min)</option>
                    <?php

                    $addTime = $timeLimit * 60;
                    $start=strtotime(date("H:i:s"))+$addTime;
                    $end=strtotime($openCloseDatas->closingTime);

                    for ($i=$start;$i<=$end;$i = $i + 15*60) { ?>
                        <option value="<?php echo date('H:i',$i); ?>"><?php echo date('H:i',$i); ?></option>
                    <?php } ?>
                </select>

                <?php if($errors->has('status')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('status')); ?></strong>
                </p>
                <?php endif; ?>

                <br>
                <br>
                <h3>Customer info</h3>

                <?php echo Form::hidden('shippingMethod', $reqDatas['shippingMethod'], ['tabindex' => '1','required' => 'required']);; ?>

                <?php echo Form::hidden('zipcode', $reqDatas['zipcode'], ['tabindex' => '1']);; ?>

                <?php echo Form::hidden('postcode', $reqDatas['postcode'], ['tabindex' => '1']);; ?>

                <?php echo Form::hidden('deliveryCharge', $reqDatas['deliveryCharge'], ['tabindex' => '1','required' => 'required']);; ?>

                <?php echo Form::hidden('discount', $reqDatas['discount'], ['tabindex' => '1','required' => 'required']);; ?>


                <?php echo Form::text('first_name', $first_name, ['placeholder' => 'Name','tabindex' => '1','required' => 'required']);; ?>

                <?php if($errors->has('first_name')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('first_name')); ?></strong>
                </p>
                <?php endif; ?>

                <?php echo Form::email('email', $email, ['placeholder' => 'Email','tabindex' => '3','required' => 'required']);; ?>

                <?php if($errors->has('email')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('email')); ?></strong>
                </p>
                <?php endif; ?>

                <?php echo Form::text('phone', $phone, ['placeholder' => 'Phone','tabindex' => '4','required' => 'required']);; ?>

                <?php if($errors->has('phone')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('phone')); ?></strong>
                </p>
                <?php endif; ?>

                <br>
                <br>
                <h3>Shipping info</h3>

                <?php echo Form::hidden('shippingMethod', $reqDatas['shippingMethod'], ['required' => 'required']);; ?>


                <?php echo Form::hidden('deliveryCharge', $reqDatas['deliveryCharge'], ['required' => 'required']);; ?>


                <?php echo Form::hidden('discount', $reqDatas['discount'], ['required' => 'required']);; ?>

                <?php echo Form::hidden('store_postcode', $storeDatas->store_postcode, ['required' => 'required']);; ?>


                <?php echo Form::text('postcode', $zipcode, ['placeholder' => 'Postcode','tabindex' => '5','required' => 'required','disabled' => 'disabled']);; ?>

                <?php if($errors->has('postcode')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('postcode')); ?></strong>
                </p>
                <?php endif; ?>

                <?php if($reqDatas['shippingMethod']=='delivery'): ?>

                <?php echo Form::text('postcode_details', $postcode_details, ['placeholder' => 'Postcode details','tabindex' => '6']);; ?>

                <?php if($errors->has('postcode_details')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('postcode_details')); ?></strong>
                </p>
                <?php endif; ?>

                <?php endif; ?>


                <?php echo Form::textarea('address', $address, ['placeholder' => 'Address....','tabindex' => '7','required' => 'required','class' => 'cus_w_99']);; ?>

                <?php if($errors->has('address')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('address')); ?></strong>
                </p>
                <?php endif; ?>

                <br>
                <br>
                <h3>Special request</h3>


                <?php echo Form::textarea('special_request', null, ['placeholder' => 'Special request....','tabindex' => '7','class' => 'cus_w_99']);; ?>

                <?php if($errors->has('address')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('address')); ?></strong>
                </p>
                <?php endif; ?>

                <br>
                <br>
                <h3>Payment info</h3>

                <div class="form__custom">
                    <div class="form__group">

                        <?php if($paymentInfo->cash == 'enable'): ?>
                        <div class="form__radio-group">
                            <input type="radio" class="form__radio-input" id="cash" name="payment" value="cash" checked>
                            <label for="cash" class="form__radio-label">
                                <span class="form__radio-botton"></span>
                                Cash
                            </label>
                        </div>
                        <?php endif; ?>

                        <?php if($paymentInfo->online == 'enable'): ?>

                        <?php if($paymentInfo->p_e_d == 'enable'): ?>
                        <div class="form__radio-group">
                            <input type="radio" class="form__radio-input" id="paypal" name="payment" value="paypal">
                            <label for="paypal" class="form__radio-label">
                                <span class="form__radio-botton"></span>
                                Paypal
                            </label>  
                        </div>
                        <?php endif; ?>

                        <?php if($paymentInfo->s_e_d == 'enable'): ?>
                        <div class="form__radio-group">
                            <input type="radio" class="form__radio-input card-stripe" id="card" name="payment" value="card">
                            <label for="card" class="form__radio-label">
                                <span class="form__radio-botton"></span>
                                Stripe
                            </label>  
                        </div>
                        <?php endif; ?>

                        <?php endif; ?>

                    </div>
                </div>

                <?php echo e(Form::button('Order now',['type' => 'submit','id' => 'table-submit','name' => 'submit'])); ?>


            <?php echo Form::close(); ?>


        </div>


    </div><!-- End container --> 
</section>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">

    $( ".orderForm" ).validate({

        rules: {
            shipping_time:  {
                required: true,
            },
            first_name:  {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone:  {
                required: true,
                maxlength: 20,
            },
            postcode: {
                required: true,
            },
            postcode_details: {
                required: true,
            },
            address: {
                required: true,
                maxlength: 500,
            }
        },
        messages: {
            shipping_time: {
                required: "Please select shipping method.",
            },
            first_name: {
                email: "Please enter first name",
            },
            email: {
                required: "Please enter your email.",
                email: "Please enter valid email.",
            },
            phone: {
                required: "Please enter contact number.",
                maxlength: "Maximum 20 digits.",
            },
            postcode: {
                required: "Please enter postcode.",
            },
            postcode_details: {
                required: "Please enter postcode details.",
            },
            address: {
                required: "Please type your address.",
                maxlength: "Maximum 500 characters.",
            },
        },

    });


</script>

<?php if(Session::get('customerEmail') == null): ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#LoginModal').modal('show');
    });
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>