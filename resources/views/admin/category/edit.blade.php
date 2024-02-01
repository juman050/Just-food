<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Category</h4>
        </div>

        {!! Form::open(['url' => action('Backend\CategoryController@update',[$category->id]), 'method' => 'PUT','id' => 'category_edit_form', 'class' => '','enctype' => 'multipart/form-data','role'=>'form']) !!}
        <div class="modal-body">

            <div class="form-group col-sm-12">
            {!! Form::label('cat_name', 'Name', array('class' => 'control-label')) !!}
            {!! Form::text('cat_name', $category->cat_name , ['class' => 'form-control cat_name','required' => 'required']); !!}
            @if ($errors->has('cat_name'))
            <p class="help-block error_login">
                <strong>{{ $errors->first('cat_name') }}</strong>
            </p>
            @endif
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-8">
                {!! Form::label('cat_image','Image') !!} <span class="recommended">Recommended size : 350x220 pixels </span>
                {!! Form::file('cat_image', ['id' => 'cat_image', 'accept' => 'image/*']); !!}
                <small><p class="help-block">Max File size: 2MB</p></small>
            </div>

            <div class="form-group col-sm-4">
                <img src="{{asset('media/categories/'.$category->cat_image)}}" height="60px;" class="pull-right">
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                {!! Form::label('days','Available days') !!}
                <br>
                <?php  $daysArray = explode(',', $category->cat_available_days);   ?>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sun" <?php if(in_array('sun', $daysArray)){echo 'checked';} ?> > Sunday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="mon"  <?php if(in_array('mon', $daysArray)){echo 'checked';} ?> > Monday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="tue"  <?php if(in_array('tue', $daysArray)){echo 'checked';} ?> > Tuesday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="wed"  <?php if(in_array('wed', $daysArray)){echo 'checked';} ?> > Wednesday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="thu"  <?php if(in_array('thu', $daysArray)){echo 'checked';} ?> > Thursday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="fri"  <?php if(in_array('fri', $daysArray)){echo 'checked';} ?> > Friday</label>
                <label class="customLabel"><input type="checkbox" class="flat-red days" name="days[]" value="sat"  <?php if(in_array('sat', $daysArray)){echo 'checked';} ?> > Saturday</label>
            </div>
            <div class="clearfix"></div>


            <div class="form-group col-sm-6">
                {!! Form::label('cat_available_delivery_method', 'Delivery method', array('class' => 'control-label')) !!}
                @php
                $suatus = array(''=> 'Select any method','delivery'=>'Delivery','collection'=>'Collection','both'=>'Both');
                @endphp
                {{ Form::select('cat_available_delivery_method', $suatus,  $category->cat_available_delivery_method, ['id' => 'cat_available_delivery_method','class' => 'form-control']) }}
                @if ($errors->has('cat_available_delivery_method'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('cat_available_delivery_method') }}</strong>
                </p>
                @endif
            </div>

            <div class="form-group col-sm-6">
                {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
                @php
                $suatus = array(''=> 'Select status','enable'=> 'Enable','disable'=>'Disable');
                @endphp
                {{ Form::select('status', $suatus,  $category->status, ['id' => 'status','class' => 'form-control']) }}

                @if ($errors->has('status'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('status') }}</strong>
                </p>
                @endif
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-sm-12">
                {!! Form::label('cat_description', 'Description', array('class' => 'control-label')) !!}
                {!! Form::textarea('cat_description',  $category->cat_description , ['class' => 'form-control cat_name','required' => 'required']); !!}
                @if ($errors->has('cat_description'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('cat_description') }}</strong>
                </p>
                @endif
            </div>
            <div class="clearfix"></div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

        {!! Form::close() !!}
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

$( "#category_edit_form" ).validate({

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

        if($('.days').is(':checked')){
            var data =  new FormData($('#category_edit_form')[0]);
            $.ajax({
            type: "POST",
            url: $('#category_edit_form').attr("action"),
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
