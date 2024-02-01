

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

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Faq lists </h3>
                        <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right" onClick="saveFaqPosition();" >Save sort</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 35%">Question ?</th>
                                    <th style="width: 50%">Answer</th>
                                    <th style="width: 5%">Status</th>
                                    <th style="width: 5%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="row_position">
                                <?php if($faqs): ?>
                                <?php
                                $i=1;
                                ?>
                                <?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="<?php echo $faq->id; ?>">
                                    <td style="text-align: left !important;"><?php echo e($i++); ?></td>
                                    <td style="text-align: left !important;"><?php echo e($faq->question); ?></td>
                                    <td style="text-align: left !important;"><?php echo e($faq->answer); ?></td>
                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch<?php echo e($faq->id); ?>" data-id="<?php echo e($faq->id); ?>" class="switch__input" <?php echo e($faq->status=='disable' ? '' : 'checked'); ?> >
                                            <label for="switch<?php echo e($faq->id); ?>" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td><a href="javascript:void(0);" onclick="deleteFaq(<?php echo $faq->id; ?>)" class="btn btn-xs btn-danger del<?php echo e($faq->id); ?>">Delete</a></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No faq data</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="col-md-4">
                <div class="box box-primary">
                    <?php echo Form::open(['url' => action('Backend\PageSettingController@storeFaqs'), 'method' => 'POST', 'id' => 'storeFAQInfo', 'class' => '','role'=>'form']); ?>

                    <div class="box-body row">

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('question', 'Question ?', array('class' => 'control-label')); ?>

                            <?php echo Form::text('question', null , ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('question')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('question')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-12">

                            <?php echo Form::label('answer', 'Answer', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('answer', null, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('answer')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('answer')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-12">
                            <?php echo Form::label('status', 'Status', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control'])); ?>

                        </div>

                        <div class="clearfix"></div>

                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    </div>

                    <?php echo Form::close(); ?>

                </div>
            </div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
<script src="<?php echo e(asset('admin/pages/pageSetting.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>