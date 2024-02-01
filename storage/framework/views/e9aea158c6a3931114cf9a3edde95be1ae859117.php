<?php $__env->startSection('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo e($data['pageName']); ?>

        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
            <li class="active"><?php echo e($data['pageName']); ?></li>
        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#changePassword" data-toggle="tab">Change Password</a></li>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('super-admin-only',Auth::user())): ?>
                        <li><a href="#addNewUser" data-toggle="tab">Add New User</a></li>
                        <li><a href="#userLists" data-toggle="tab">User Lists</a></li>
                        <?php endif; ?>
                    </ul>
                    <div class="tab-content">
                        <div class="active tab-pane" id="changePassword">

                            <?php echo Form::open(['url' => action('Backend\DashboardController@changePassword'), 'method' => 'POST', 'id' => 'changePasswordForm','class' => 'form-horizontal', 'role'=>'form']); ?>


                            <div class="form-group">
                                <?php echo Form::label('old_password', 'Old Password', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::text('old_password', null, ['placeholder' => '*********','class' => 'form-control']);; ?>

                                    <?php if($errors->has('old_password')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('old_password')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <?php echo Form::label('new_password', 'New Password', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::text('new_password', null, ['placeholder' => '*********','class' => 'form-control']);; ?>

                                    <?php if($errors->has('new_password')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('new_password')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <?php echo Form::label('confirm_password', 'Confirm Password', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::text('confirm_password', null, ['placeholder' => '*********','class' => 'form-control']);; ?>

                                    <?php if($errors->has('confirm_password')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('confirm_password')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                            <?php echo Form::close(); ?>


                        </div>
                        <!-- /.tab-pane -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('super-admin-only',Auth::user())): ?>
                        <div class="tab-pane" id="addNewUser">


                            <?php echo Form::open(['url' => action('Backend\DashboardController@addUser'), 'method' => 'POST', 'id' => 'registerUser','class' => 'form-horizontal', 'role'=>'form']); ?>


                            <div class="form-group">
                                <?php echo Form::label('name', 'Name', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::text('name', null, ['placeholder' => 'Enter name','class' => 'form-control']);; ?>

                                    <?php if($errors->has('name')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <?php echo Form::label('email', 'Email', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::email('email', null, ['placeholder' => 'Enter email','class' => 'form-control']);; ?>

                                    <?php if($errors->has('email')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('email')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <?php echo Form::label('role', 'Role', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php
                                    $roles = array('super-admin'=>'Super-admin','admin'=>'Admin');
                                    ?>
                                    <?php echo e(Form::select('role', $roles, null, ['id' => 'role','class' => 'form-control'])); ?>

                                    <?php if($errors->has('role')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('role')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <?php echo Form::label('active', 'Status', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php
                                    $active = array('0'=>'De-active','1'=>'Active');
                                    ?>
                                    <?php echo e(Form::select('active', $active, null, ['id' => 'active','class' => 'form-control'])); ?>

                                    <?php if($errors->has('active')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('active')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <?php echo Form::label('password', 'Password', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::text('password', null, ['placeholder' => '*********','class' => 'form-control']);; ?>

                                    <?php if($errors->has('password')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('password')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <?php echo Form::label('add_confirm_password', 'Confirm Password', array('class' => 'col-sm-2 control-label')); ?>

                                <div class="col-sm-7">
                                    <?php echo Form::text('add_confirm_password', null, ['placeholder' => '*********','class' => 'form-control','id' => 'password-confirm']);; ?>

                                    <?php if($errors->has('add_confirm_password')): ?>
                                    <p class="help-block error_login">
                                        <strong><?php echo e($errors->first('add_confirm_password')); ?></strong>
                                    </p>
                                    <?php endif; ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                            </div>


                            <?php echo Form::close(); ?>


                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane" id="userLists">

                            <div class="TableData">

                            </div>

                        </div>
                        <?php endif; ?>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('admin/pages/profile.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>