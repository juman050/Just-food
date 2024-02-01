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
                            <h3 class="box-title">Contact messages</h3>
                        </div>
                    <div class="box-body no-padding">
                        <table class="table table-striped text-center" id="Table">
                            <thead>
                                <tr>
                                    <th >#</th>
                                    <th >Name</th>
                                    <th >Email</th>
                                    <th >Subject</th>
                                    <th >Time</th>
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
                                    <td><?php echo e($list->name); ?></td>
                                    <td><?php echo e($list->email); ?></td>
                                    <td><?php echo e($list->subject); ?></td>
                                    <td><?php echo e($list->created_at); ?></td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="viewMessage('<?php echo $list->name; ?>','<?php echo $list->email; ?>','<?php echo $list->subject; ?>','<?php echo $list->message; ?>')" class="btn btn-xs btn-primary">View</a>
                                        <a href="javascript:void(0);" onclick="replyMessage('<?php echo $list->id; ?>','<?php echo $list->name; ?>','<?php echo $list->email; ?>','<?php echo $list->subject; ?>')" class="btn btn-xs btn-success">Reply</a>
                                        <a href="javascript:void(0);" onclick="deleteMessage('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger del<?php echo e($list->id); ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="text-center">No contact data</td>
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

    <div class="modal fade" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">View Message</h4>
                </div>

                <div class="modal-body">
                    <p><b>Name : </b><span class="name"></span></p>
                    <p><b>Email : </b><span class="email"></span></p>
                    <p><b>Subject : </b><span class="subject"></span></p>
                    <p><b>Message : </b><span class="message"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="replyModel">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Reply message</h4>
                </div>

                <?php echo Form::open(['url' => action('Backend\ContactController@replyMessage'), 'method' => 'POST', 'id' => 'replyForm', 'class' => '','role'=>'form']); ?>


                <div class="modal-body">

                    <?php echo Form::hidden('id', null , ['class' => 'form-control id','required' => 'required']);; ?>


                    <div class="form-group col-sm-12">
                        <?php echo Form::label('name', 'Name', array('class' => 'control-label')); ?>

                        <?php echo Form::text('name', null , ['class' => 'form-control name','required' => 'required']);; ?>

                        <?php if($errors->has('name')): ?>
                        <p class="help-block error_login">
                            <strong><?php echo e($errors->first('name')); ?></strong>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        <?php echo Form::label('email', 'Email', array('class' => 'control-label')); ?>

                        <?php echo Form::text('email', null , ['class' => 'form-control email','required' => 'required']);; ?>

                        <?php if($errors->has('email')): ?>
                        <p class="help-block error_login">
                            <strong><?php echo e($errors->first('email')); ?></strong>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        <?php echo Form::label('subject', 'Subject', array('class' => 'control-label')); ?>

                        <?php echo Form::text('subject', null , ['class' => 'form-control subject','required' => 'required']);; ?>

                        <?php if($errors->has('subject')): ?>
                        <p class="help-block error_login">
                            <strong><?php echo e($errors->first('subject')); ?></strong>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>

                    <div class="form-group col-sm-12">
                        <?php echo Form::label('message', 'Message', array('class' => 'control-label')); ?>

                        <?php echo Form::textarea('message', null , ['class' => 'form-control','rows' => '5','required' => 'required']);; ?>

                        <?php if($errors->has('message')): ?>
                        <p class="help-block error_login">
                            <strong><?php echo e($errors->first('message')); ?></strong>
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="clearfix"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reply</button>
                </div>

                <?php echo Form::close(); ?>

            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script src="<?php echo e(asset('admin/pages/contact.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>