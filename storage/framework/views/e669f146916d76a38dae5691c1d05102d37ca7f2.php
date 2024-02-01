<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('admin/plugins/iCheck/all.css')); ?>">
<?php $__env->stopSection(); ?>

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
                            <h3 class="box-title">Manage Category</h3>
                            <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right save_sort_left_margin" onClick="saveCategoryPosition();" >Save sort</button>
                            <button type="button" class="btn btn-sm btn-primary btn-modal pull-right" data-href="<?php echo e(action('Backend\CategoryController@create')); ?>" data-container=".category_modal"><i class="fa fa-plus"></i> Add</button>
                        </div>

                        <div class="box-body no-padding">
                            <table class="table table-striped text-center" id="Table">
                                <thead>
                                    <tr>
                                        <th >#</th>
                                        <th >Name</th>
                                        <th >Image</th>
                                        <th >Available Days</th>
                                        <th >Delivery method</th>
                                        <th >Status</th>
                                        <th >Action</th>
                                    </tr>
                                </thead>
                                <tbody class="row_position">
                                    <?php if(count($lists) > 0): ?>
                                    <?php
                                    $i=1;
                                    ?>
                                    <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr id="<?php echo $list->id; ?>">
                                        <td><?php echo e($i++); ?></td>
                                        <td><?php echo e($list->cat_name); ?></td>
                                        <td>
                                            <?php if(($list->cat_image == 'default_cat_image.png') || ($list->cat_image == '') || ($list->cat_image == null)): ?>
                                            <p>No image</p>
                                            <?php else: ?>
                                            <img src="<?php echo e(asset('media/categories/'.$list->cat_image)); ?>" height="60">
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $days = explode(',',$list->cat_available_days);
                                            foreach ($days as $day) { ?>
                                                <button class="btn btn-xs btn-success"><?php echo $day; ?></button>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo e($list->cat_available_delivery_method); ?></td>
                                        <td>
                                            <div class="switch">
                                                <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                                                <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0);"  data-href="<?php echo e(action('Backend\CategoryController@edit', [$list->id])); ?>"  class="btn btn-xs btn-primary edit_category_button"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0);" onclick="deleteCategory('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger del<?php echo e($list->id); ?>"><i class="fa fa-trash"></i></a>
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
    <div class="modal fade category_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">


    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo e(asset('admin/plugins/iCheck/icheck.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/pages/category.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>