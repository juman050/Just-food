<div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Sub-variance for <b><?php echo e($subItemName); ?></b></h4>
            </div>

            <div id="subVarianceTable" style="background: #e7e7e7;max-height: 300px;overflow: auto;width: 100%;">

            </div>

            <?php echo Form::open(['url' => action('Backend\SubitemController@storeSubVariance'), 'method' => 'POST', 'id' => 'store_sub_variance', 'class' => '','role'=>'form']); ?>

            <div class="modal-body">

                <div class="form-group col-sm-6">
                    <?php echo Form::label('sub_item_variance_name', 'Sub-variance name', array('class' => 'control-label')); ?>

                    <?php echo Form::text('sub_item_variance_name', null , ['class' => 'form-control','required' => 'required']);; ?>


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
                    <?php echo e(Form::select('status', $suatus, null, ['id' => 'status','class' => 'form-control'])); ?>

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

                <?php echo Form::hidden('sub_item_id', $subItemId , ['class' => 'form-control sub_item_id','required' => 'required']);; ?>


                <div class="clearfix"></div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary storeSuvVarianceBtn">Add</button>
            </div>

            <?php echo Form::close(); ?>

        </div>
    </div>

    <script type="text/javascript">

        var subitemId = "<?php echo e($subItemId); ?>";

        varianceTableLoad();

        function varianceTableLoad(){
            $.ajax({
                method: "GET",
                url: base_URL+'/'+'backoffice/food/subVarianceTable/'+subitemId,
                dataType: "html",
                success: function(result){
                    $('#subVarianceTable').html(result);
                }
            });
        }


        $( "#store_sub_variance" ).validate({
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
                status:  {
                    required: true,
                },
            },
            submitHandler: function(form) {
                var data = $('#store_sub_variance').serialize();
                $.ajax({
                    method: "POST",
                    url: $('#store_sub_variance').attr("action"),
                    dataType: "json",
                    data: data,
                    success: function(response){
                        if(response.status == 'success'){
                            $('#store_sub_variance')[0].reset();
                            varianceTableLoad();
                        }
                        toast(response);
                    }
                });
            }

        });

    </script>