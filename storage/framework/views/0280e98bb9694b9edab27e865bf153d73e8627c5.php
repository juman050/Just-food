

<?php $__env->startSection('mainContent'); ?>


<!-- Pre Order Section -->

<section id="bg-section">

    <div class="container" id="cus_p_bg">

        <div class="row">


            <div class="col-md-12">

                <div class="table-responsive">

                    <table class="table table-striped table-bordered" id="Table">

                        <thead class="cus_t_bg">

                            <tr>

                                <th class="cus_th">#</th>

                                <th class="cus_th">Order date</th>

                                <th class="cus_th">Shipping method</th>

                                <th class="cus_th">Payment type</th>

                                <th class="cus_th">Order status</th>

                                <th class="cus_th">Total</th>

                                <th class="cus_th">Action</th>

                            </tr>

                        </thead>

                        <tbody>

                            <?php if(count($lists) > 0): ?>

                            <?php

                            $i=1;

                            ?>

                            <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <tr id="<?php echo $list->id; ?>">

                                <td class="cus_tdf"><?php echo e($i++); ?></td>

                                <td class="cus_tdf"><?php echo e(changeDateFormate($list->order_date)); ?></td>

                                <td class="cus_tdf"><?php echo e($list->order_delivery_type); ?></td>

                                <td class="cus_tdf"><?php echo e($list->order_pay_method); ?></td>

                                <td><button class="btn btn-xs btn-defalut"><?php echo e($list->order_status); ?></button></td>

                                <td class="cus_tdf"><?php echo e(Session::get('currency')); ?> <?php echo e($list->order_total); ?></td>

                                <td>

                                    <a href="javascript:void(0)"  data-href="<?php echo e(action('ProfileController@viewOrderDetails', [$list->id])); ?>" class="view_order_modal btn btn-info  btn-xs" ><i class="fa fa-eye"></i> View</a>

                                </td>

                            </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php else: ?>

                            <tr>

                                <td  colspan="9" class="text-center cus_tdf">You have no order yet</td>

                            </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- /.nav-tabs-custom -->

        </div>

    </div>

</section>

<div class="modal fade view_order_modal"  tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">

</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

<script type="text/javascript">

    jQuery(function($){

        $(document).on('click', '.view_order_modal', function(){

            $( "div.view_order_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');

            });

        });

    });

</script>

<?php $__env->stopSection(); ?>




<?php echo $__env->make('frontend.imageTheme.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>