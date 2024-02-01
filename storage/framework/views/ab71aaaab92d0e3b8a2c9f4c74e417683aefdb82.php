

<?php $__env->startSection('content'); ?>

<div class="content-wrapper">

    <section class="content-header">
        <h1>
            Payment method
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active"><?php echo e($data['pageName']); ?></li>
        </ol>
    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-12">

                <div class="box box-primary">

                    <?php echo Form::open(['url' => action('Backend\PaymentSettingController@storeManagePayment'), 'method' => 'POST','class' => 'form-inline', 'role'=>'form', 'id'=>'paymentMethodForm']); ?>

                    <div class="box-body row">


                        <div class="form-group col-sm-5">
                            <?php echo Form::label('cash', 'Cash : ', array('class' => 'control-label','style' => 'width:15%')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('cash', $suatus, $lists->cash, ['id' => 'cash','class' => 'form-control','required' => 'required','style' => 'width:70%'])); ?>

                        </div>

                        <div class="form-group col-sm-5">
                            <?php echo Form::label('online', 'Online : ', array('class' => 'control-label','style' => 'width:15%')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('online', $suatus, $lists->online, ['id' => 'online','class' => 'form-control','required' => 'required','style' => 'width:70%'])); ?>

                        </div>

                        <div class="form-group col-sm-2">
                            <button type="submit" class="btn btn-primary pull-right">Update</button>
                        </div>


                    </div>

                    <?php echo Form::close(); ?>

                </div>


            </div>

        </div>

        <div class="row">

            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Paypal information</h3>
                    </div>

                    <?php echo Form::open(['url' => action('Backend\PaymentSettingController@storePaypalInfo'), 'method' => 'POST','id' => 'paypalForm','class' => '', 'role'=>'form']); ?>

                    <div class="box-body row">

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('p_u', 'Paypal username or email', array('class' => 'control-label')); ?>

                            <?php echo Form::text('p_u', $lists->p_u, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('p_u')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('p_u')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('p_p', 'Paypal key', array('class' => 'control-label')); ?>

                            <?php echo Form::text('p_p', $lists->p_p, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('p_p')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('p_p')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('p_s', 'Paypal signature', array('class' => 'control-label')); ?>

                            <?php echo Form::text('p_s', $lists->p_s, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('p_s')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('p_s')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('p_a_t', 'Paypal account type', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('live'=> 'Live','sandbox'=>'Sandbox');
                            ?>
                            <?php echo e(Form::select('p_a_t', $suatus, $lists->p_a_t, ['id' => 'p_a_t','class' => 'form-control','required' => 'required'])); ?>

                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('p_e_d', 'Paypal status', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('p_e_d', $suatus, $lists->p_e_d, ['id' => 'p_e_d','class' => 'form-control','required' => 'required'])); ?>

                        </div>
                        <div class="clearfix"></div>

                    </div>

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                    <?php echo Form::close(); ?>

                </div>


            </div>

            <div class="col-md-6">

                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Stripe information</h3>
                    </div>

                    <?php echo Form::open(['url' => action('Backend\PaymentSettingController@storeStripeInfo'), 'method' => 'POST','id' => 'stripeForm','class' => '', 'role'=>'form']); ?>

                    <div class="box-body row">

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('s_p_k', 'Srtipe Publish key', array('class' => 'control-label')); ?>

                            <?php echo Form::text('s_p_k', $lists->s_p_k, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('s_p_k')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('s_p_k')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('s_s_k', 'Srtipe Secret key', array('class' => 'control-label')); ?>

                            <?php echo Form::text('s_s_k', $lists->s_s_k, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('s_s_k')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('s_s_k')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('s_e_d', 'Stripe status', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('s_e_d', $suatus, $lists->s_e_d, ['id' => 's_e_d','class' => 'form-control','required' => 'required'])); ?>

                        </div>
                        <div class="clearfix"></div>

                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                    <?php echo Form::close(); ?>

                </div>

            </div>

        </div>

    </section>

</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/pages/payment.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>