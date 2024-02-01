<?php if(count($lists) > 0): ?>
<?php
$i=1;
?>
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
        <?php $__currentLoopData = $lists; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $list): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
        $i++;
        ?>
        <tr id="<?php echo $list->id; ?>">
            <td><?php echo e($list->sub_item_variance_name); ?></td>
            <td>
                <?php if(($list->item_variance_old_price == null) && ($list->item_variance_old_price == 0.00)): ?>
                <?php echo e(\Session::get('currency')); ?> <?php echo e($list->item_variance_new_price); ?>

                <?php else: ?>
                <?php echo e(\Session::get('currency')); ?> <del><?php echo e($list->item_variance_old_price); ?></del>  <?php echo e(\Session::get('currency')); ?> <?php echo e($list->item_variance_new_price); ?>

                <?php endif; ?>
            </td>
            <td>
                <div class="switch">
                    <input type="checkbox" id="switch<?php echo e($list->id); ?>" data-id="<?php echo e($list->id); ?>" class="switch__input2 switch__input" <?php echo e($list->status=='disable' ? '' : 'checked'); ?> >
                    <label for="switch<?php echo e($list->id); ?>" class="switch__label">&nbsp;</label>
                </div>
            </td>
            <td>
                <a href="javascript:void(0);"  data-href="<?php echo e(url('backoffice/food/editSubVariance/'.$list->id)); ?>"  class="btn btn-xs btn-primary edit_variance_button"><i class="fa fa-pencil"></i></a>
                <a href="javascript:void(0);" onclick="deleteSubVariance('<?php echo $list->id; ?>')" class="btn btn-xs btn-danger"><i class="fa fa-trash"></i></a>
            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php endif; ?>


<div class="modal fade edit_modal" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close m_close" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit variance</h4>
            </div>

            <?php echo Form::open(['url' => action('Backend\SubitemController@updateSubVariance'), 'method' => 'POST', 'id' => 'update_sub_variance', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <div class="form-group col-sm-6">
                    <?php echo Form::label('sub_item_variance_name', 'Sub-variance name', array('class' => 'control-label')); ?>

                    <?php echo Form::text('sub_item_variance_name', null , ['class' => 'form-control sub_item_variance_name','required' => 'required']);; ?>


                    <?php if($errors->has('sub_item_variance_name')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('sub_item_variance_name')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="form-group col-sm-6">
                    <?php echo Form::label('status', 'Status', array('class' => 'control-label')); ?>

                    <?php
                    $suatus = array('enable'=> 'Enable','disable'=>'Disable');
                    ?>
                    <?php echo e(Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control status'])); ?>

                    <?php if($errors->has('status')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('status')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="clearfix"></div>


                <div class="form-group col-sm-6">
                    <?php echo Form::label('item_variance_new_price', 'Price  ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('item_variance_new_price', null , ['class' => 'form-control item_variance_new_price','required' => 'required']);; ?>

                    <?php if($errors->has('item_variance_new_price')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('item_variance_new_price')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <div class="form-group col-sm-6">
                    <?php echo Form::label('item_variance_old_price', 'Old Price  ('.\Session::get('currency').')', array('class' => 'control-label')); ?>

                    <?php echo Form::text('item_variance_old_price', null , ['class' => 'form-control item_variance_old_price']);; ?>

                    <?php if($errors->has('item_variance_old_price')): ?>
                    <p class="help-block error_login">
                        <strong><?php echo e($errors->first('item_variance_old_price')); ?></strong>
                    </p>
                    <?php endif; ?>
                </div>

                <?php echo Form::hidden('sub_item_id', null , ['class' => 'form-control sub_item_id','required' => 'required']);; ?>

                <?php echo Form::hidden('id', null , ['class' => 'form-control id','required' => 'required']);; ?>


                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default m_close">Close</button>
                <button type="submit" class="btn btn-primary">Edit</button>
            </div>

            <?php echo Form::close(); ?>

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