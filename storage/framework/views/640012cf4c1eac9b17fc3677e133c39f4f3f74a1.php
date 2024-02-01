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
        <?php if($lists): ?>
        <?php
        $i=1;
        ?>
        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr id="<?php echo $list->id; ?>">
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($list->item_name); ?></td>
            <td><?php echo e($list->variance_name); ?></td>
            <td>
                <?php if(($list->item_old_price == null) && ($list->item_old_price == 0.00)): ?>
                <?php echo e(\Session::get('currency')); ?> <?php echo e($list->item_new_price); ?>

                <?php else: ?>
                <?php echo e(\Session::get('currency')); ?> <del><?php echo e($list->item_old_price); ?></del> <?php echo e(\Session::get('currency')); ?> <?php echo e($list->item_new_price); ?>

                <?php endif; ?>
            </td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                    <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);"  data-href="<?php echo e(action('Backend\VarianceController@edit', ['id'=>$list->id])); ?>"  class="btn btn-xs btn-primary edit_variance_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deleteVariance('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <tr>
            <td colspan="6" class="text-center">No variance inserted yet.</td>
        </tr>
        <?php endif; ?>
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