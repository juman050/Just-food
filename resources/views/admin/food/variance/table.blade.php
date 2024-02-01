<table class="table table-striped text-center" id="VarTable">
    <thead>
        <tr>
            <th >#</th>
            <th >Item name</th>
            <th >Variance name</th>
            <th >Variance Price</th>
            <th >Status</th>
            <th >Action</th>
        </tr>
    </thead>
    <tbody class="row_position">
        @if($lists)
        @php
        $i=1;
        @endphp
        @foreach($lists as $list)
        <tr id="{!! $list->id !!}">
            <td>{{$i++}}</td>
            <td>{{$list->item_name}}</td>
            <td>{{$list->variance_name}}</td>
            <td>
                @if(($list->item_old_price == null) && ($list->item_old_price == 0.00))
                {{ \Session::get('currency') }} {{$list->item_new_price}}
                @else
                {{ \Session::get('currency') }} <del>{{ $list->item_old_price }}</del> {{ \Session::get('currency') }} {{$list->item_new_price}}
                @endif
            </td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                    <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);"  data-href="{{action('Backend\VarianceController@edit', ['id'=>$list->id])}}"  class="btn btn-xs btn-primary edit_variance_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deleteVariance('{!! $list->id !!}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No variance inserted yet.</td>
        </tr>
        @endif
    </tbody>
</table>
<script type="text/javascript">

    function saveItemVariancePosition() {

        var data = new Array();

        $('.row_position tr').each(function () {
            data.push($(this).attr("id"));
        });

        $.ajax({
            url: base_URL+'/'+'backoffice/food/itemVarianceSorts',
            type: 'post',
            dataType: 'json',
            data: {position: data},
            success: function (response) {
                toast(response);
                document.getElementById("sort_save").disabled = true;
            },
            error: function (response) {
                toast(response);
            }
        })
    }



    jQuery(function($){



        $('row_position').sortable();

        $(".row_position").sortable({
            delay: 150,
            change: function () {
                var selectedIds = new Array();
                $('.row_position>tr').each(function () {
                    selectedIds.push($(this).attr("id"));
                    document.getElementById("sort_save").disabled = false;
                });
            }
        });


        $('#VarTable').DataTable({
            'paging'      : true,
            'pageLength'  : 50,
            'lengthChange': true,
            'searching'   : true,
            'ordering'    : true,
            'info'        : true,
            'autoWidth'   : false
        });

        $('.switch__input').change(function(e){
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
                url: base_URL+'/'+'backoffice/food/statusupdate',
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

            $( "div.variance_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');

                $('form#variance_edit_form').submit(function(e){
                    e.preventDefault();
                    var data = $(this).serialize();

                    $.ajax({
                        method: "POST",
                        url: $(this).attr("action"),
                        dataType: "json",
                        data: data,
                        success: function(response){
                            if(response.status == 'success'){
                                tableLoad();
                                $('div.variance_modal').modal('hide');
                            }

                            toast(response);
                        }
                    });
                });

            });

        });

    });

</script>