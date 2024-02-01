<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Category</h4>
        </div>

        <?php echo Form::open(['url' => action('Backend\CategoryController@store'), 'method' => 'POST','id' => 'category_add_form', 'class' => '','enctype' => 'multipart/form-data','role'=>'form']); ?>

        <div class="modal-body">

            <div class="form-group col-sm-12">
                <?php echo Form::label('cat_name', 'Name', array('class' => 'control-label')); ?>

                <?php echo Form::text('cat_name', null , ['class' => 'form-control cat_name','required' => 'required']);; ?>

                <?php if($errors->has('cat_name')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('cat_name')); ?></strong>
                </p>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                <?php echo Form::label('cat_image','Image'); ?> <span class="recommended">Recommended size : 350x220 pixels </span>
                <?php echo Form::file('cat_image', ['id' => 'cat_image', 'accept' => 'image/*']);; ?>

                <small><p class="help-block">Max File size: 2MB</p></small>
                <?php if($errors->has('cat_image')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('cat_image')); ?></strong>
                </p>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                <?php echo Form::label('days','Available days'); ?>

                <br>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sun" checked> Sunday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="mon" checked> Monday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="tue" checked> Tuesday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="wed" checked> Wednesday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="thu" checked> Thursday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="fri" checked> Friday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sat" checked> Saturday</label>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-6">
                <?php echo Form::label('cat_available_delivery_method', 'Delivery method', array('class' => 'control-label')); ?>

                <?php
                $suatus = array(''=> 'Select any method','delivery'=>'Delivery','collection'=>'Collection','both'=>'Both');
                ?>
                <?php echo e(Form::select('cat_available_delivery_method', $suatus, null, ['id' => 'cat_available_delivery_method','class' => 'form-control'])); ?>

                <?php if($errors->has('cat_available_delivery_method')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('cat_available_delivery_method')); ?></strong>
                    </p>
                <?php endif; ?>
            </div>

            <div class="form-group col-sm-6">
                <?php echo Form::label('status', 'Status', array('class' => 'control-label')); ?>

                <?php
                $suatus = array(''=> 'Select status','enable'=> 'Enable','disable'=>'Disable');
                ?>
                <?php echo e(Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control'])); ?>

                <?php if($errors->has('status')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('status')); ?></strong>
                </p>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                <?php echo Form::label('cat_description', 'Description', array('class' => 'control-label')); ?>

                <?php echo Form::textarea('cat_description', null , ['class' => 'form-control cat_name','required' => 'required']);; ?>

                <?php if($errors->has('cat_description')): ?>
                <p class="help-block error_login">
                    <strong><?php echo e($errors->first('cat_description')); ?></strong>
                </p>
                <?php endif; ?>
            </div>
            <div class="clearfix"></div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
        </div>

        <?php echo Form::close(); ?>

    </div>
</div>

<script type="text/javascript">

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
        checkboxClass: 'icheckbox_minimal-blue',
        radioClass   : 'iradio_minimal-blue'
    })

    //Red color scheme for iCheck
    $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
        checkboxClass: 'icheckbox_minimal-red',
        radioClass   : 'iradio_minimal-red'
    })

    //Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass   : 'iradio_flat-green'
    })

    var img_fileinput_setting = {
        'showUpload':false,
        'showPreview':true,
        'browseLabel': 'Upload',
        'removeLabel': 'remove',
        'previewSettings': {
            image: {width: "auto", height: "auto", 'max-width': "100%", 'max-height': "100%"}
        } 
    };

    $("#cat_image").fileinput(img_fileinput_setting);


    $.validator.addMethod('filesize', function (value, element, param) {
        return this.optional(element) || (element.files[0].size <= param)
    }, 'Maximum 2MB');

    $( "#category_add_form" ).validate({

        rules: {
            cat_image:  {
                extension: "jpg|jpeg|png|JPG|PNG|JPEG",
                filesize: 2097152,  // 2 MB
            },
            cat_name:  {
                required: true,
            },
            cat_available_delivery_method:  {
                required: true,
            },
            status:  {
                required: true,
            },
            cat_description:  {
                required: true,
            },
        },
        submitHandler: function(form) {

            var data =  new FormData($('#category_add_form')[0]);
            if($('.days').is(':checked')){
                $.ajax({
                    type: "POST",
                    url: $('#category_add_form').attr("action"),
                    dataType: "json",
                    data: data,
                    contentType: false,
                    processData: false,
                    success: function(response){
                        if(response.status == 'success'){
                            $('.category_modal').modal('hide');
                            window.location.reload();
                        }
                        toast(response);
                    }
                });
            }else{
                toast(response);
            }
        }

    });

</script>