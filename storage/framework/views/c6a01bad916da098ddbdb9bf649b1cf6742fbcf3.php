

<?php $__env->startSection('content'); ?>

<?php if(isset($singleData)): ?>

    <?php
        $id = $singleData[0]->id;
        $image = $singleData[0]->image;
        $title = $singleData[0]->title;
        $alt = $singleData[0]->alt;
        $description = $singleData[0]->description;
        $single_status = $singleData[0]->status;
        $btn_text = 'Update';
        $formId = 'editSliderInfo';
        $url = url('backoffice/slider/'.$id);
        $method = 'PUT';
        $add_edit_status = 'Edit Slider';
    ?>

<?php else: ?>

    <?php
        $id = null;
        $image = null;
        $title = null;
        $alt = null;
        $description = null;
        $single_status = null;
        $btn_text = "Add";
        $formId = 'storeSliderInfo';
        $url = route('slider.index');
        $method = 'POST';
        $add_edit_status = 'Sliders list';
    ?>

<?php endif; ?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo e($data['pageName']); ?>

        </h1>
        <ol class="breadcrumb">

            <?php if(isset($singleData)): ?>
            <a href="<?php echo e(route('slider.index')); ?>"  class="btn btn-primary btn-sm pull-right" ><i class="fa fa-plus"></i> Add New Slider</a>
            <?php else: ?>
            <li><a href="#"><i class="fa fa-dashboard"></i> <?php echo e($add_edit_status); ?></a> </li>
            <?php endif; ?>

        </ol>
    </section>


    <!-- Main content -->
    <section class="content">

        <div class="row">

            <div class="col-md-8">
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e($data['pageName']); ?> lists </h3>
                        <button id="sort_save"  type="button" class="btn btn-primary btn-sm pull-right" onClick="saveSliderPosition();" >Save sort</button>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th style="width: 5%">#</th>
                                    <th style="width: 20%">Title</th>
                                    <th style="width: 15%">Image</th>
                                    <th style="width: 15%">Alt</th>
                                    <th style="width: 25%">Description</th>
                                    <th style="width: 5%">Status</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody class="row_position">
                                <?php if(count($lists) > 0): ?>
                                <?php
                                $i=1;
                                ?>
                                <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr id="<?php echo $list->id; ?>">
                                    <td style="text-align: left !important;"><?php echo e($i++); ?></td>
                                    <td style="text-align: left !important;"><?php echo e($list->title); ?></td>
                                    <td style="text-align: left !important;"><img height="70" src="<?php echo e(asset('media/sliders/'.$list->image)); ?>"></td>
                                    <td style="text-align: left !important;"><?php echo e($list->alt); ?></td>
                                    <td style="text-align: left !important;"><?php echo e($list->description!="" ? $list->description : 'No description'); ?></td>
                                    <td>
                                        <div class="switch">
                                            <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                                            <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="<?php echo e(route('slider.edit',$list->id)); ?>" class="btn btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0);" onclick="deleteSlider(<?php echo $list->id; ?>)" class="btn btn-xs btn-danger del<?php echo e($list->id); ?>"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="7" class="text-center">No data inserted yet</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="box box-primary">

                    <div class="box-header with-border">
                        <h3 class="box-title"><?php echo e($btn_text); ?> Slider</h3>
                    </div>

                    <?php echo Form::open(['url' => $url, 'method' => $method, 'id' => $formId, 'class' => '','files' => 'true','role'=>'form']); ?>


                    <div class="box-body row">

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('title', 'Title', array('class' => 'control-label')); ?>

                            <?php echo Form::text('title', $title , ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('title')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('title')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php if($image): ?>
                            <img src="<?php echo e(asset('media/sliders/'.$image)); ?>" style="width: 100%;">
                            <?php endif; ?>
                            <?php echo Form::label('image','Slider image'); ?>  <span class="recommended">Recommended size : 1170x600 pixels </span>
                            <?php echo Form::file('image', ['id' => 'image', 'accept' => 'image/*']);; ?>

                            <small><p class="help-block">Max File size: 1MB</p></small>
                            <?php if($errors->has('image')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('image')); ?></strong>
                            </p>
                            <?php endif; ?>


                        </div>

                        <div class="clearfix"></div>

                        <div class="form-group col-sm-12">
                            <?php echo Form::label('alt', 'Alt', array('class' => 'control-label')); ?>

                            <?php echo Form::text('alt', $alt , ['class' => 'form-control','required' => 'required']);; ?>

                            <?php if($errors->has('alt')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('alt')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-12">

                            <?php echo Form::label('description', 'Description', array('class' => 'control-label')); ?>

                            <?php echo Form::textarea('description', $description, ['class' => 'form-control textarea']);; ?>

                            <?php if($errors->has('description')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('description')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                        <div class="form-group col-sm-12">
                            <?php echo Form::label('status', 'Status', array('class' => 'control-label')); ?>

                            <?php
                            $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                            ?>
                            <?php echo e(Form::select('status', $suatus, $single_status, ['id' => 'status','class' => 'form-control'])); ?>

                            <?php if($errors->has('status')): ?>
                            <p class="help-block error_login">
                                <strong><?php echo e($errors->first('status')); ?></strong>
                            </p>
                            <?php endif; ?>
                        </div>

                        <div class="clearfix"></div>


                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary pull-right"><?php echo e($btn_text); ?></button>
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
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="<?php echo e(asset('admin/pages/slider.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>