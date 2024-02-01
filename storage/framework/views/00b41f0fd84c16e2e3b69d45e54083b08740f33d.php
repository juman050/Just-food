

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
        <!-- Small boxes (Stat box) -->
        <div class="row">

            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <!-- /.box-header -->
                    <!-- form start -->
                    <?php echo Form::open(['url' => action('Backend\ExtraChargeController@update'), 'method' => 'POST', 'id' => 'updateExtraCharge','class' => '', 'role'=>'form']); ?>

                    <div class="box-body row">


                        <div class="form-group col-sm-12">
                            <?php echo Form::label('deliveryMethod', 'Delivery method', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('both'=>'Both','delivery'=>'Delivery','collection'=> 'Collection');
                            ?>
                            <?php echo e(Form::select('deliveryMethod', $suatus, $record->deliveryMethod, ['id' => 'deliveryMethod','class' => 'form-control'])); ?>

                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('extraAmount', 'Amount', array('class' => 'control-label')); ?>

                            <?php echo Form::text('extraAmount', $record->extraAmount, ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('extraAmount')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('extraAmount')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('ExtraChargeStatus', 'Status', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('ExtraChargeStatus', $suatus, $record->ExtraChargeStatus, ['id' => 'ExtraChargeStatus','class' => 'form-control'])); ?>

                        </div>

                        <div class="clearfix"></div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Update</button>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
                <!-- /.box -->

            </div>

        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admin/pages/del_col_extra.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>