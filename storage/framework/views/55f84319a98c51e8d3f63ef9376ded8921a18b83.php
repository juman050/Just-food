
<?php $__env->startSection('css'); ?>

<style type="text/css">
    .bg-gray {color: #000;background-color: #d2d6de !important;}
    .bg-green{background-color: #00a65a !important;}
</style>
<link rel="stylesheet" href="<?php echo e(asset('admin/plugins/iCheck/all.css')); ?>">

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

<div class="content-wrapper">

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
                        <h3 class="box-title">Manage Items</h3>
                        <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right save_sort_left_margin" onClick="saveItemPosition();" >Save sort</button>
                        <a href="<?php echo e(action('Backend\ItemController@create')); ?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add new item</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >Image</th>
                                    <th >Category</th>
                                    <th >Price</th>
                                    <th >Delivery method</th>
                                    <th >Variance</th>
                                    <th >SubItem</th>
                                    <th >Offer include</th>
                                    <th >Spice level</th>
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
                                    <td><?php echo e($list->item_name); ?></td>
                                    <td>

                                        <?php if(($list->item_image == 'default_item_image.png') || ($list->item_image == '') || ($list->item_image == null)): ?>
                                        <p>No image</p>
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('media/items/'.$list->item_image)); ?>" height="60">
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e($list->getCategory ? $list->getCategory->cat_name : ''); ?></td>
                                    <td>
                                        <?php if(($list->item_old_price == null) && ($list->item_old_price == 0.00)): ?>
                                        <?php echo e(\Session::get('currency')); ?> <?php echo e($list->item_new_price); ?>

                                        <?php else: ?>
                                        <?php echo e(\Session::get('currency')); ?> <del><?php echo e($list->item_old_price); ?></del> <?php echo e(\Session::get('currency')); ?> <?php echo e($list->item_new_price); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e($list->item_delivery_type); ?></td>
                                    <td><?php echo e($list->item_variance); ?></td>
                                    <td><?php echo e($list->item_sub_menu); ?></td>
                                    <td><?php echo e($list->item_offer_include); ?></td>
                                    <td><?php echo e($list->item_spice_level); ?></td>

                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                                            <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Actions <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="javascript:void(0)"  data-href="<?php echo e(action('Backend\ItemController@show', [$list->id])); ?>" class="view_product_modal" ><i class="fa fa-eye"></i> View</a></li>
                                                <li><a href="<?php echo e(action('Backend\ItemController@edit', [$list->id])); ?>"><i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                                <li><a href="javascript:void(0);" onclick="deleteItem('<?php echo $list->id; ?>')" class="del<?php echo e($list->id); ?>"><i class="fa fa-trash"></i> Delete</a></li>
                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="12" class="text-center">No data in record yet</td>
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

<div class="modal fade view_product_modal"  tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script type="text/javascript">

        $(document).on('click', '.view_product_modal', function(){

            $( "div.view_product_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');

            });

        });

    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo e(asset('admin/plugins/iCheck/icheck.min.js')); ?>"></script>
    <script src="<?php echo e(asset('admin/pages/item.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>