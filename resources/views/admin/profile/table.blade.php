<table class="table table-striped text-center" id="UsersTable">
    <thead>
        <tr>
            <th >#</th>
            <th >Name</th>
            <th >Email</th>
            <th >Role</th>
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
        @if(Auth::user()->id != $list->id)
        <tr id="{!! $list->id !!}">
            <td>{{$i++}}</td>
            <td>{{$list->name}}</td>
            <td>{{$list->email}}</td>
            <td>{{$list->role}}</td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch{{ $list->id }}" data-id="{{ $list->id }}" class="switch__input" {{ $list->active==0 ? '' : 'checked' }} >
                    <label for="switch{{ $list->id }}" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);" onclick="deleteUser('{!! $list->id !!}')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        @endif
        @endforeach
        @else
        <tr>
            <td colspan="6" class="text-center">No user.</td>
        </tr>
        @endif
    </tbody>
</table>

<script type="text/javascript">

    jQuery(function($){

        $('#UsersTable').DataTable({
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
                var sts = 1;
                var status = 1;
            }else{
                var sts = 0;
                var status = 0;
            }

            var id = $(this).data('id');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: base_URL+'/'+'backoffice/dashboard/userstatusupdate',
                data: {id:id,status:status},
                async: false,
                success: function(response){
                    toast(response)
                }
            });

            e.stopImmediatePropagation();
            return false;
        })


    });


</script>