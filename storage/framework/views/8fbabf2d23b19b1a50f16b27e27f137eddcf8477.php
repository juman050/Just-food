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
                            <h3 class="box-title">Manage Allergies</h3>
                            <button type="button" class="btn btn-sm btn-primary btn-modal pull-right" data-href="<?php echo e(action('Backend\AllergyController@create')); ?>" data-container=".allergy_modal"><i class="fa fa-plus"></i> Add</button>
                        </div>
                        <div class="box-body no-padding TableData">


                        </div>
                    </div>
                </div>

            </div>

        </section>

    </div>

    <div class="modal fade allergy_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>

    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo e(asset('admin/pages/allergy.js')); ?>"></script>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>