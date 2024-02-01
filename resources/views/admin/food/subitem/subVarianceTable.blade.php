@if(count($lists) > 0)
@php
$i=1;
@endphp
<table class="table text-center" id="subVarTable">
    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="row_position">
        @foreach($lists as $list)
        @php
        $i++;
        @endphp
        <tr id="{!! $list->id !!}">
            <td>{{$list->sub_item_variance_name}}</td>
            <td>
                @if(($list->item_variance_old_price == null) && ($list->item_variance_old_price == 0.00))
                {{ \Session::get('currency') }} {{$list->item_variance_new_price}}
                @else
                {{ \Session::get('currency') }} <del>{{ $list->item_variance_old_price }}</del>  {{ \Session::get('currency') }} {{$list->item_variance_new_price}}
                @endif
            </td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input2 switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                    <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);"  data-href="{{ url('backoffice/food/editSubVariance/'.$list->id) }}"  class="btn btn-xs btn-primary edit_variance_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deleteSubVariance('{!! $list->id !!}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif


<div class="modal fade edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close m_close" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit variance</h4>
            </div>

            {!! Form::open(['url' => action('Backend\SubitemController@updateSubVariance'), 'method' => 'POST', 'id' => 'update_sub_variance', 'class' => '','role'=>'form']) !!}
            <div class="modal-body">

                <div class="form-group col-sm-6">
                    {!! Form::label('sub_item_variance_name', 'Sub-variance name', array('class' => 'control-label')) !!}
                    {!! Form::text('sub_item_variance_name', null , ['class' => 'form-control sub_item_variance_name','required' => 'required']); !!}

                    @if ($errors->has('sub_item_variance_name'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('sub_item_variance_name') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('status', 'Status', array('class' => 'control-label')) !!}
                    @php
                    $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                    @endphp
                    {{ Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control status']) }}
                    @if ($errors->has('status'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('status') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="clearfix"></div>


                <div class="form-group col-sm-6">
                    {!! Form::label('item_variance_new_price', 'Price  ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                    {!! Form::text('item_variance_new_price', null , ['class' => 'form-control item_variance_new_price','required' => 'required']); !!}
                    @if ($errors->has('item_variance_new_price'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('item_variance_new_price') }}</strong>
                    </p>
                    @endif
                </div>

                <div class="form-group col-sm-6">
                    {!! Form::label('item_variance_old_price', 'Old Price  ('.\Session::get('currency').')', array('class' => 'control-label')) !!}
                    {!! Form::text('item_variance_old_price', null , ['class' => 'form-control item_variance_old_price']); !!}
                    @if ($errors->has('item_variance_old_price'))
                    <p class="help-block error_login">
                        <strong>{{ $errors->first('item_variance_old_price') }}</strong>
                    </p>
                    @endif
                </div>

                {!! Form::hidden('sub_item_id', null , ['class' => 'form-control sub_item_id','required' => 'required']); !!}
                {!! Form::hidden('id', null , ['class' => 'form-control id','required' => 'required']); !!}

                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default m_close">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>



<script type="text/javascript">


    function deleteSubVariance(id){
        if(confirm('Are you sure ?')){
            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: base_URL+'/'+'backoffice/food/subvariance/'+id,
                data: {id:id},
                async: false,
                success: function(response){
                    varianceTableLoad();
                    toast(response);
                }
            });
        }
    }

    $('.switch__input2').change(function(e){
        e.preventDefault();
        if($(this).is(':checked')){
            var sts = 'Enable';
            var status = 'enable';
        }else{
            var sts = 'Disable';
            var status = 'disable';
        }

        var id = $(this).data('id');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: base_URL+'/'+'backoffice/food/statusSubVariance',
            data: {id:id,status:status},
            async: false,
            success: function(response){
                toast(response)
            }
        });

        e.stopImmediatePropagation();
        return false;
    })



    $(document).on('click', '.edit_variance_button', function(){

        var url = $(this).data('href');
        $.ajax({
            type: 'get',
            dataType: 'json',
            url: url,
            data: {},
            async: false,
            success: function(response){
                var id = response.id;
                var sub_item_variance_name = response.sub_item_variance_name;
                var item_variance_new_price = response.item_variance_new_price;
                var item_variance_old_price = response.item_variance_old_price;
                var status = response.status;
                var sub_item_id = response.sub_item_id;

                $('#update_sub_variance').find('.id').val(id);
                $('#update_sub_variance').find('.sub_item_variance_name').val(sub_item_variance_name);
                $('#update_sub_variance').find('.item_variance_new_price').val(item_variance_new_price);
                $('#update_sub_variance').find('.item_variance_old_price').val(item_variance_old_price);
                $('#update_sub_variance').find('.status').val(status);
                $('#update_sub_variance').find('.sub_item_id').val(sub_item_id);

                $('.edit_modal').modal('show');
            }
        });



    });

    $(document).on('click', '.m_close', function(){

        $('.edit_modal').modal('hide');

    });

    $( "#update_sub_variance" ).validate({
        rules: {
            sub_item_variance_name:  {
                required: true,
                maxlength: 255,
            },
            item_variance_new_price:  {
                required: true,
                number : true,
            },
            item_variance_old_price:  {
                number: true,
            },
            sub_item_id:  {
                required: true,
            },
            id:  {
                required: true,
            },
            status:  {
                required: true,
            },
        },
        submitHandler: function(form) {
            var data = $('#update_sub_variance').serialize();
            $.ajax({
                method: "POST",
                url: $('#update_sub_variance').attr("action"),
                dataType: "json",
                data: data,
                success: function(response){
                    if(response.status == 'success'){
                        $('#update_sub_variance')[0].reset();
                        $('.edit_modal').modal('hide');
                        varianceTableLoad();
                    }
                    toast(response);
                }
            });
        }

    });

</script>