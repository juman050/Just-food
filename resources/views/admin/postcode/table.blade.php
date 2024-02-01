<table class="table table-striped text-center" id="Table">
    <thead>
        <tr>
            <th >#</th>
            <th >Postcode</th>
            <th >Delivery charge</th>
            <th >Minimum order</th>
            <th >Status</th>
            <th >Action</th>
        </tr>
    </thead>
    <tbody>
        @if($lists)
        @php
        $i=1;
        @endphp
        @foreach($lists as $list)
        <tr>
            <td>{{$i++}}</td>
            <td>{{$list->postcode_area}}</td>
            <td>{{ \Session::get('currency') }} {{$list->postcode_delivery_charge}}</td>
            <td>{{ \Session::get('currency') }} {{$list->postcode_minimum_order}}</td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->postcode_status=='disable' ? '' : 'checked' }} >
                    <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);"  data-href="{{action('Backend\PostcodeController@edit', [$list->id])}}"  class="btn btn-xs btn-primary edit_postcode_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deletePostcode('{!! $list->id !!}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endforeach
        @else
        <tr>
            <td colspan="4" class="text-center">No list data</td>
        </tr>
        @endif
    </tbody>
</table>

<script type="text/javascript">

    jQuery(function($){


        $('#Table').DataTable({
            'paging'      : true,
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
                url: base_URL+'/'+'backoffice/postcodeormileage/statusupdate',
                data: {id:id,status:status},
                async: false,
                success: function(response){
                    toast(response);
                }
            });

            e.stopImmediatePropagation();
            return false;
        })



        $(document).on('click', '.edit_postcode_button', function(){

            $( "div.postcode_modal" ).load( $(this).data('href'), function(){

                $(this).modal('show');

                $('form#postcode_edit_form').submit(function(e){
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
                                $('div.postcode_modal').modal('hide');
                            }

                            toast(response);
                        }
                    });
                });

            });

        });

    });

</script>