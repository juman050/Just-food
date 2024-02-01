<table class="table table-striped text-center" id="VarTable">
    <thead>
        <tr>
            <th>#</th>
            <th>Sub-item name</th>
            <th>Required</th>
            <th>Min</th>
            <th>Max</th>
            <th>Status</th>
            <th>Manage Item</th>
            <th>Sub-variances</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody class="row_position">
        @if($lists)
        @php
        $i=1;
        @endphp
        @foreach($lists as $list)
        <tr id="{!! $list->id !!}">
            <td width="4%">{{$i++}}</td>
            <td width="15%">{{$list->sub_item_name}}</td>
            <td width="8%">{{$list->required}}</td>
            <td width="7%">{{$list->min_value}}</td>
            <td width="7%">{{$list->max_value}}</td>
            <td width="7%">
                <div class="switch">
                    <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->status=='disable' ? '' : 'checked' }} >
                    <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td width="30%">
                @if($list->itemLists)
                @foreach($list->itemLists as $singleItem)
                <a  href="javascript:void(0);"  data-href="{{ url('backoffice/food/itemSubVariance/'.$singleItem->id) }}"  class="btn btn-xs btn-success editSubVariance">{{$singleItem->item_name}}</a>
                @endforeach
                @endif
                <a href="javascript:void(0);"  data-href="{{ url('backoffice/food/addItem/'.$list->id) }}"  class="btn btn-xs btn-primary addItem"><i class="fa fa-plus"></i> item</a>
            </td>
            <td width="13%">
                <a href="javascript:void(0);"  data-href="{{ url('backoffice/food/addSubVariance/'.$list->id) }}"  class="btn btn-xs btn-primary addSubVariance"><i class="fa fa-plus"></i> Sub-variance</a>
            </td>
            <td width="7%">
                <a href="javascript:void(0);"  data-href="{{action('Backend\SubitemController@edit', ['id'=>$list->id])}}"  class="btn btn-xs btn-primary edit_subitem_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deleteSubItem('{!! $list->id !!}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="9" class="text-center">No Sub item inserted yet.</td>
        </tr>
        @endif
    </tbody>
</table>
<script type="text/javascript">

    function saveSubItemPosition(){

        var data = new Array();
        $('.row_position tr').each(function () {
            data.push($(this).attr("id"));
        });

        $.ajax({
            url: base_URL+'/'+'backoffice/food/itemSubItemSorts',
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
                url: base_URL+'backoffice/food/statusSubItem',
                data: {id:id,status:status},
                async: false,
                success: function(response){
                    toast(response)
                }
            });

            e.stopImmediatePropagation();
            return false;
        })


        $(document).on('click', '.edit_subitem_button', function(e){

            $( "div.subitem_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');

            });

            e.stopImmediatePropagation();
            return false;

        });

        $(document).on('click', '.addSubVariance', function(e){

            $( "div.subitem_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');
            });

            e.stopImmediatePropagation();
            return false;
        });


        $(document).on('click', '.editSubVariance', function(e){

            $( "div.subitem_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');

            });

            e.stopImmediatePropagation();
            return false;
        });


        $(document).on('click', '.addItem', function(e){

            $( "div.subitem_modal" ).load( $(this).data('href'), function(e){

                $(this).modal('show');

                $('form#subitem_modal').submit(function(e){
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
                                $('div.subitem_modal').modal('hide');
                            }

                            toast(response);
                        }
                    });
                });

            });

            e.stopImmediatePropagation();
            return false;
        });

    });

</script>