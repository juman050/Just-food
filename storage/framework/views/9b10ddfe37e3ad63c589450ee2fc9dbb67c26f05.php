<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Allergy</h4>
        </div>

        <?php echo Form::open(['url' => action('Backend\AllergyController@update', [$allergy->id]), 'method' => 'PUT', 'id' => 'allergy_edit_form', 'class' => '','enctype' => 'multipart/form-data','role'=>'form']); ?>

        <div class="modal-body">

            <div class="form-group col-sm-12">
                <?php echo Form::label('name', 'Name', array('class' => 'control-label')); ?>

                <?php echo Form::text('name', $allergy->name , ['class' => 'form-control name','required' => 'required']);; ?>

                <?php if($errors->has('name')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('name')); ?></strong>
                </p>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-8">
                <?php echo Form::label('image','Image'); ?>  <span class="recommended">Recommended size : 80x80 pixels </span>
                <?php echo Form::file('image', ['id' => 'image', 'accept' => 'image/*']);; ?>

                <small><p class="help-block">Max File size: 2MB</p></small>
                <?php if($errors->has('image')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('image')); ?></strong>
                </p>
                <?php endif; ?>
            </div>

            <div class="form-group col-sm-4">
                <?php if($allergy->image): ?>
                    <img src="<?php echo e(asset('media/allergy/'.$allergy->image)); ?>" style="height: 80px;float: right;">
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>

<script type="text/javascript">

    jQuery(function($){

        var img_fileinput_setting = {
            'showUpload':false,
            'showPreview':true,
            'browseLabel': 'Upload',
            'removeLabel': 'remove',
            'previewSettings': {
                image: {width: "auto", height: "auto", 'max-width': "100%", 'max-height': "100%"}
            } 
        };

        $("#image").fileinput(img_fileinput_setting);

    });

    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'Maximum 2MB');

    $( "#allergy_edit_form" ).validate({
        rules:{
            image:{
                extension: "jpg|jpeg|png|JPG|PNG|JPEG",
                filesize: 2097152,  // 2 MB
            },
            name:{
                required: true,
            },
        },
    });

</script>