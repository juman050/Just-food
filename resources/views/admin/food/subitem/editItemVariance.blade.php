<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Sub-variance for <b>{{ $subItemName }}</b></h4>
        </div>

        {!! Form::open(['url' => action('Backend\SubitemController@storeItem'), 'method' => 'POST','id' => 'add_form', 'class' => '','role'=>'form']) !!}
        <div class="modal-body">

            <div class="form-group col-sm-11">

                {{ Form::select('item_id', $itemLists , $item_id, ['id' => 'item_id','class' => 'form-control select2','placeholder' => 'Select item','style' => 'width:100%;','disabled' => 'disabled']) }}

                @if ($errors->has('item_id'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('item_id') }}</strong>
                </p>
                @endif
            </div>

            <div class="form-group col-sm-1">

                <a href="javascript:void(0)" data-link="{{ url('backoffice/food/deleteSubItemVariance/'.$id) }}" class="sub_var_delete"><i class="fa fa-trash" style="color: white;padding: 10px;background: #1abc9c;"></i></a>

            </div>

            {!! Form::hidden('sub_item_id', $subItemId , ['class' => 'form-control sub_item_id','required' => 'required']); !!}

            <div class="clearfix"></div>

            <div id="subVarianceTable" style="background: #e7e7e7;width: 100%;height: auto;">
                @if(count($lists) > 0)
                @php
                $i=1;
                @endphp
                <table class="table text-center" id="subVarTable">
                    <thead>
                        <tr>
                            <th width="20%">Sub-variance</th>
                            <th width="55%">Name</th>
                            <th width="25%">Price</th>
                        </tr>
                    </thead>
                    <tbody class="row_position">
                        @foreach($lists as $list)
                        @php
                        $i++;
                        @endphp
                        <tr id="{!! $list->id !!}">
                            <td width="20%"><label class="customLabel"><input type="checkbox" class="flat-red subVariance" name="subVariance" value="{{$list->id}}" <?php if(in_array($list->id, $checkArray)){echo 'checked';} ?> ></label></td>
                            <td width="55%">{{$list->sub_item_variance_name}}</td>
                            <td width="25%">
                                @if(($list->item_variance_old_price == null) && ($list->item_variance_old_price == 0.00))
                                {{ \Session::get('currency') }} {{$list->item_variance_new_price}}
                                @else
                                {{ \Session::get('currency') }} <del>{{ $list->item_variance_old_price }}</del>  {{ \Session::get('currency') }} {{$list->item_variance_new_price}}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>

        {!! Form::close() !!}

    </div>
</div>

<script type="text/javascript">

    var subitemId = "{{ $subItemId }}";
    $('.select2').select2();

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


    $( "#add_form" ).validate({
        rules: {
            item_id:  {
                required: true,
            },
        },
        submitHandler: function(form) {

            var idsArray = [];

            $("input:checkbox[name=subVariance]:checked").each(function(){
                idsArray.push($(this).val());
            });

            if(idsArray.length <= 0){
                alert('Please select Sub-variance');
            }else{
                var item_id = $('#item_id').val();
                var sub_item_id = $('.sub_item_id').val();
                $.ajax({
                    method: "POST",
                    url: $('#add_form').attr("action"),
                    dataType: "json",
                    data: {item_id:item_id,sub_item_id:sub_item_id,idsArray:idsArray},
                    success: function(response){
                        if(response.status == 'success'){
                            $('.subitem_modal').modal('hide');
                            tableLoad();
                        }
                        toast(response);
                    }
                });
            }

        }

    });

    $('.sub_var_delete').click(function(e){
        var link = $(this).data('link');
        if(confirm('Are you sure ?')){
            $.ajax({
                method: "GET",
                url: link,
                dataType: "json",
                success: function(response){
                    if(response.status == 'success'){
                        $('.subitem_modal').modal('hide');
                        tableLoad();
                    }
                    toast(response);
                }
            });
        }
    })


    </script>