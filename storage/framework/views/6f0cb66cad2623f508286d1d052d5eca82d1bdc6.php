

<?php $__env->startSection('content'); ?>

    <div class="content-wrapper">
        <section class="content-header">
            <h1><?php echo e($data['pageName']); ?></h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Admin-Section</a></li>
                <li class="active"><?php echo e($data['pageName']); ?></li>
            </ol>
        </section>

        <section class="content">

            <div class="row">

                <div class="col-md-12">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Manage Customer</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <table class="table table-striped text-center" id="Table">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Name</th>
                                        <th >Email</th>
                                        <th >Phone</th>
                                        <th >Postcode</th>
                                        <th >Address</th>
                                        <th >Status</th>
                                        <th >Joining date</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(count($lists) > 0): ?>
                                    <?php
                                    $i=1;
                                    ?>
                                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($list->name); ?></td>
                                        <td><?php echo e($list->email); ?></td>
                                        <td><?php echo e($list->phone); ?></td>
                                        <td><?php echo e($list->post_code); ?></td>
                                        <td><?php echo e($list->address); ?></td>
                                        <td>
                                            <div class="switch">
                                                <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                                                <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><?php echo e(changeDateFormate($list->created_at)); ?></td>
                                        <td>
                                            <a href="javascript:void(0);" onclick="deleteCustomer('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger del<?php echo e($list->id); ?>"><i class="fa fa-trash"></i></a>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">No data in record yet</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/pages/customer.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>