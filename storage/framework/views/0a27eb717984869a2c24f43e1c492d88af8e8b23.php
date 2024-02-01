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
        <?php if($lists): ?>
        <?php
        $i=1;
        ?>
        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(Auth::user()->id != $list->id): ?>
        <tr id="<?php echo $list->id; ?>">
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($list->name); ?></td>
            <td><?php echo e($list->email); ?></td>
            <td><?php echo e($list->role); ?></td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->active==0 ? '' : 'checked'); ?> >
                    <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);" onclick="deleteUser('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endif; ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">No user.</td>
        </tr>
        <?php endif; ?>
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