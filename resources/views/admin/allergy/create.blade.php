<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Allergy</h4>
        </div>

        {!! Form::open(['url' => action('Backend\AllergyController@store'), 'method' => 'POST','id' => 'allergy_add_form', 'class' => '','enctype' => 'multipart/form-data','role'=>'form']) !!}
            <div class="modal-body">

                <div class="form-group col-sm-12">
                    {!! Form::label('name', 'Name', array('class' => 'control-label')) !!}
                    {!! Form::text('name', null , ['class' => 'form-control name','required' => 'required']); !!}
                    @if ($errors->has('name'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('name') }}</strong>
                    </p>
                    @endif
                </div>
                <div class="clearfix"></div>

                <div class="form-group col-sm-12">
                    {!! Form::label('image','Image') !!}  <span class="recommended">Recommended size : 80x80 pixels </span>
                    {!! Form::file('image', ['id' => 'image', 'accept' => 'image/*']); !!}
                    <small><p class="help-block">Max File size: 2MB</p></small>
                    @if ($errors->has('image'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('image') }}</strong>
                    </p>
                    @endif
                </div>
                <div class="clearfix"></div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Add</button>
            </div>

        {!! Form::close() !!}
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


    $( "#allergy_add_form" ).validate({

        rules: {
            image:  {
                required: true,
                extension: "jpg|jpeg|png|JPG|PNG|JPEG",
                filesize: 2097152,  // 2 MB
            },
            name:  {
                required: true,
            },
        },
        submitHandler: function(form) {

            var data =  new FormData($('#allergy_add_form')[0]);
            $.ajax({
                type: "POST",
                url: $('#allergy_add_form').attr("action"),
                dataType: "json",
                data: data,
                contentType: false,
                processData: false,
                success: function(response){
                    if(response.status == 'success'){
                        tableLoad();
                        $('.allergy_modal').modal('hide');
                    }
                    toast(response);
                }
            });
        }

    });

</script>