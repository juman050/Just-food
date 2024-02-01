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
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Restaurant opening/closing time schedule</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Day</th>
                                    <th >Opening time</th>
                                    <th >Closing time time</th>
                                    <th >Status</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($lists): ?>
                                <?php
                                $i=1;
                                ?>
                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e($list->day); ?></td>
                                    <td><?php echo e($list->openingTime); ?></td>
                                    <td><?php echo e($list->closingTime); ?></td>
                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->restaurantStatus=='close' ? '' : 'checked'); ?> >
                                            <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" onclick="editOpenCloseTime('<?php echo $list->id; ?>','<?php echo $list->openingTime; ?>','<?php echo $list->closingTime; ?>','<?php echo $list->day; ?>')" class="btn btn-xs btn-primary">Change</a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No list data</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="openCloseModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Change open/close time for "<span id="day"></span>"</h4>
            </div>

            <?php echo Form::open(['url' => action('Backend\RestaurantOpenCloseController@updateOpenCloseData'), 'method' => 'POST', 'id' => 'openCloseForm', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <?php echo Form::hidden('id', null , ['class' => 'form-control id','required' => 'required']);; ?>


                <div class="form-group col-sm-12">
                    <?php echo Form::label('openingTime', 'Opening time', array('class' => 'control-label')); ?>

                    <?php echo Form::text('openingTime', null , ['class' => 'form-control openingTime','required' => 'required']);; ?>

                    <?php if($errors->has('openingTime')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('openingTime')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    <?php echo Form::label('closingTime', 'Closing time', array('class' => 'control-label')); ?>

                    <?php echo Form::text('closingTime', null , ['class' => 'form-control closingTime','required' => 'required']);; ?>

                    <?php if($errors->has('closingTime')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('closingTime')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>

            <?php echo Form::close(); ?>

        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="<?php echo e(asset('admin/pages/open_close.js')); ?>"></script>
    <!-- InputMask -->
    <script src="<?php echo e(asset('admin/plugins/input-mask/jquery.inputmask.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/plugins/input-mask/jquery.inputmask.date.extensions.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/plugins/input-mask/jquery.inputmask.extensions.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>