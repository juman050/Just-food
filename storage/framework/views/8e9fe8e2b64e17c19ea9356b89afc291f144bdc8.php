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
        <?php if($lists): ?>
        <?php
        $i=1;
        ?>
        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($i++); ?></td>
            <td><?php echo e($list->postcode_area); ?></td>
            <td><?php echo e(\Session::get('currency')); ?> <?php echo e($list->postcode_delivery_charge); ?></td>
            <td><?php echo e(\Session::get('currency')); ?> <?php echo e($list->postcode_minimum_order); ?></td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input" <?php echo e($list->postcode_status=='disable' ? '' : 'checked'); ?> >
                    <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);"  data-href="<?php echo e(action('Backend\PostcodeController@edit', [$list->id])); ?>"  class="btn btn-xs btn-primary edit_postcode_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deletePostcode('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
        <tr>
            <td colspan="4" class="text-center">No list data</td>
        </tr>
        <?php endif; ?>
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