<?php $__env->startSection('css'); ?>

<style type="text/css">
    .bg-gray {color: #000;background-color: #d2d6de !important;}
    .bg-green{background-color: #00a65a !important;}
</style>

<?php $__env->stopSection(); ?>
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
                        <!-- <h3 class="box-title">Manage Orders</h3> -->
                        <div class="row">
                            <div class="col-md-6 col-xs-12">


                                <p>Search by date : </p>

                                <form action="<?php echo e(url('backoffice/orders/date-filter')); ?>" method="POST" id="filter-form-date-range">
                                    <?php echo csrf_field(); ?>
                                    <!-- Date range -->
                                    <div class="form-group">

                                        <div class="input-group col-md-8" style="float: left;">
                                            <div class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </div>
                                            <input name="date" type="text" class="form-control pull-right" id="reservation">
                                        </div>
                                        <input hidden="hidden" type="hidden" name="order_type" value="<?php echo e($order_type); ?>">

                                        <button style="margin-left: 5px;" type="submit" class="btn btn-md btn-primary">Search</button>
                                        <!-- /.input group -->
                                    </div>

                                </form>

                            </div>
                            <div class="col-md-6 col-xs-12">


                                <p class="text-right">&nbsp;</p>
                                <form action="<?php echo e(url('backoffice/orders/filter')); ?>" method="POST" id="filter-form-year">
                                    <?php echo csrf_field(); ?>
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="<?php echo e($order_type); ?>">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="year">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_year"><input type="radio" name="date-filter" value="year"/>This year</label>
                                    </div>
                                </form>

                                <form action="<?php echo e(url('backoffice/orders/filter')); ?>" method="POST" id="filter-form-month">
                                    <?php echo csrf_field(); ?>
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="<?php echo e($order_type); ?>">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="month">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_month"><input type="radio" name="date-filter" value="month"/>This month</label>
                                    </div>
                                </form>

                                <form action="<?php echo e(url('backoffice/orders/filter')); ?>" method="POST" id="filter-form-week">
                                    <?php echo csrf_field(); ?>
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="<?php echo e($order_type); ?>">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="week">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_week"><input type="radio" name="date-filter" value="week"/>This week</label>
                                    </div>
                                </form>

                                <form action="<?php echo e(url('backoffice/orders/filter')); ?>" method="POST" id="filter-form-today">
                                    <?php echo csrf_field(); ?>
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="<?php echo e($order_type); ?>">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="today">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_today"><input type="radio" name="date-filter" value="today"/>Today</label> 
                                    </div>
                                </form>

                                <form action="<?php echo e(url('backoffice/orders/filter')); ?>" method="POST" id="filter-form-all">
                                    <?php echo csrf_field(); ?>
                                    <div class="btn-group pull-right" data-toggle="buttons">
                                        <input hidden="hidden" type="hidden" name="order_type" value="<?php echo e($order_type); ?>">
                                        <input hidden="hidden" type="hidden" name="filter_type" value="all">
                                        <label style="border-radius: 0px;" class="btn btn-info btn_filter_all"><input type="radio" name="date-filter" value="all"/>All</label>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped table-bordered" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Order date</th>
                                    <th >Shipping method & time</th>
                                    <th >Customer name & number</th>
                                    <th >Address & Postcode</th>
                                    <th >Total</th>
                                    <th >Payment type(status)</th>
                                    <th >Order status</th>
                                    <th >Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if(count($lists) > 0): ?>
                                <?php
                                $i=1;
                                ?>
                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="<?php echo $list->id; ?>">

                                    <td><?php echo e($i++); ?></td>
                                    <td><?php echo e(changeDateFormate($list->order_date)); ?></td>
                                    <td><?php echo e($list->order_delivery_type); ?><br><?php echo e($list->order_delivery_time); ?></td>
                                    <td><?php echo e($list->order_customer_name); ?><br><?php echo e($list->order_contact_number); ?></td>
                                    <td><?php echo e($list->order_address); ?><br><?php echo e($list->order_postcode); ?><?php echo e(', '.$list->order_postcode); ?></td>
                                    <td><?php echo e(Session::get('currency')); ?> <?php echo e($list->order_total); ?></td>
                                    <td><?php echo e($list->order_pay_method); ?>(<?php echo e($list->order_payment_status); ?>)</td>
                                    <td><button class="btn btn-xs btn-defalut"><?php echo e($list->order_status); ?></button></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">Actions <span class="caret"></span><span class="sr-only">Toggle Dropdown</span>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                                <li><a href="javascript:void(0)"  data-href="<?php echo e(action('Backend\OrderController@show', [$list->id])); ?>" class="view_order_modal" ><i class="fa fa-eye"></i> View</a></li>

                                                <?php if($list->order_status != 'processing'): ?>
                                                <li><a href="javascript:void(0);" onclick="moveStatus('<?php echo $list->id; ?>','processing')" class="del<?php echo e($list->id); ?>"><i class="fa fa-archive"></i> Move to Processing</a></li>
                                                <?php endif; ?>

                                                <?php if($list->order_status != 'delivered'): ?>
                                                <li><a href="javascript:void(0);" onclick="moveStatus('<?php echo $list->id; ?>','delivered')" class="del<?php echo e($list->id); ?>"><i class="fa fa-archive"></i> Move to Delivered</a></li>
                                                <?php endif; ?>

                                                <?php if($list->order_status != 'cancelled'): ?>
                                                <li><a href="javascript:void(0);" onclick="moveStatus('<?php echo $list->id; ?>','cancelled')" class="del<?php echo e($list->id); ?>"><i class="fa fa-archive"></i> Move to Cancelled</a></li>
                                                <?php endif; ?>

                                                <?php if($list->order_status != 'pending'): ?>
                                                <li><a href="javascript:void(0);" onclick="moveStatus('<?php echo $list->id; ?>','pending')" class="del<?php echo e($list->id); ?>"><i class="fa fa-archive"></i> Move to Pending</a></li>
                                                <?php endif; ?>

                                            </ul>
                                        </div>

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="9" class="text-center">No data in record yet</td>
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

<div class="modal fade view_order_modal"  tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
</div>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">

    $(document).on('click', '.view_order_modal', function(){

        $( "div.view_order_modal" ).load( $(this).data('href'), function(){

            $(this).modal('show');

        });

    });

    $(document).ready(function(){
        $('.btn_filter_all').click(function(e){
            $('#filter-form-all').submit();
        });
        $('.btn_filter_today').click(function(e){
            $('#filter-form-today').submit();
        });
        $('.btn_filter_week').click(function(e){
            $('#filter-form-week').submit();
        });
        $('.btn_filter_month').click(function(e){
            $('#filter-form-month').submit();
        });
        $('.btn_filter_year').click(function(e){
            $('#filter-form-year').submit();
        });
    });

    $("#reservation").daterangepicker({
        locale: {
            format: 'YYYY/MM/DD'
        }
    });

</script>
<script src="<?php echo e(asset('admin/pages/order.js')); ?>"></script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>