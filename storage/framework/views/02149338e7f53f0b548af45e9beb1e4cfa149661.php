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
                        <h3 class="box-title">Manage Offers</h3>
                        <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right save_sort_left_margin" onClick="saveOfferPosition();" >Save sort</button>
                        <a href="<?php echo e(action('Backend\OfferController@create')); ?>" class="btn btn-sm btn-primary pull-right"><i class="fa fa-plus"></i> Add new offer</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped" id="Table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Banner image</th>
                                    <th>Display in banner</th>
                                    <th>Start-date</th>
                                    <th>End-date</th>
                                    <th>Time start</th>
                                    <th>Time End</th>
                                    <th>Coupon code</th>
                                    <th>Free shipping</th>
                                    <th>Status</th>
                                    <th>Action</th>
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
                                    <td><?php echo e($list->title); ?></td>
                                    <td>

                                        <?php if(($list->banner_image == '') || ($list->banner_image == null)): ?>
                                        <p>No image</p>
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('media/offers/'.$list->banner_image)); ?>" height="60">
                                        <?php endif; ?>

                                    </td>
                                    <td><?php echo e($list->display_banner); ?></td>
                                    <td><?php echo e($list->startdate); ?></td>
                                    <td><?php echo e($list->enddate); ?></td>
                                    <td><?php echo e($list->start_time); ?></td>
                                    <td><?php echo e($list->end_time); ?></td>
                                    <td><?php echo e($list->coupon_code); ?></td>
                                    <td><?php echo e($list->free_shipping); ?></td>

                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                                            <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary"  href="<?php echo e(action('Backend\OfferController@edit', [$list->id])); ?>"><i class="glyphicon glyphicon-edit"></i></a>
                                        <a class="btn btn-xs btn-danger del<?php echo e($list->id); ?>" href="javascript:void(0);" onclick="deleteOffer('<?php echo $list->id; ?>')"><i class="fa fa-trash"></i></a>
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script src="<?php echo e(asset('admin/pages/offer.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>