<!DOCTYPE html>
<html>
<head>
	<title>Just-Food</title>
</head>
<body>
	
	<p style="font-size: 20px;color: #7f7878" ><span style="color: #000000;">Order Info :</span></p>

	<p style="color: #7f7878;">Order date : <?php echo e($order_date); ?> </p>
	<p style="color: #7f7878;">Delivery method : <?php echo e($order_delivery_type); ?> </p>
	<p style="color: #7f7878;">Delivery time : <?php echo e($order_delivery_time); ?> </p>
	<p style="color: #7f7878;">Delivery charge : <?php echo e($order_delivery_charge); ?> </p>
	<p style="color: #7f7878;">Extra fee : <?php echo e($order_extra_fee); ?> </p>


	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<th>
				<td>Item Name</td>
				<td>Qty</td>
				<td>Price</td>
			</th>
		</thead>
		<tbody>

		<?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

			<tr>
				<td>
                    <?php if($row->options->has('varName')): ?>
                        <?php echo e($row->options->varName); ?> <?php echo e($row->name); ?>

                    <?php else: ?>
                    	<?php echo e($row->name); ?>

                    <?php endif; ?>
                    <br>
                    <?php if(isset($row->options->subVariances)): ?>

                    	$subVarAll = implode(',', $row->options->subVariances);
                    	<?php $__currentLoopData = $subVarAll; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subVar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    		<?php echo e($subVar); ?>

                    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                	<?php endif; ?>
				</td>
				<td><?php echo e($row->qty); ?></td>
				<td><?php echo e(Session::get('currency')); ?> <?php echo e($row->price); ?></td>
			</tr>

		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

		</tbody>

	</table>


	<p style="color: #7f7878;">Subtotal : <?php echo e($order_subtotal); ?> </p>
	<p style="color: #7f7878;">Total : <?php echo e($order_total); ?> </p>
	<p style="color: #7f7878;">Total item : <?php echo e($order_total_item); ?> </p>


	<p style="font-size: 20px;color: #7f7878" ><span style="color: #000000;">Customer Info :</span></p>

	<p style="color: #7f7878;">Customer name : <?php echo e($order_customer_name); ?> </p>
	<p style="color: #7f7878;">Customer contact number : <?php echo e($order_contact_number); ?> </p>
	<p style="color: #7f7878;">Customer email : <?php echo e($order_email); ?> </p>

	<p style="color: #7f7878;">Delivery address : <?php echo e($order_address); ?> </p>
	<p style="color: #7f7878;">Delivery postcode : <?php echo e($order_postcode); ?> </p>
	<p style="color: #7f7878;">Postcode details : <?php echo e($order_postcode_details); ?> </p>

	<p style="color: #7f7878;">Special request : <?php echo e($order_special_request); ?> </p>
	<p style="color: #7f7878;">Payment method : <?php echo e($order_pay_method); ?> </p>
	<p style="color: #7f7878;">Order status : <?php echo e($order_status); ?> </p>


	<p style="color: #7f7878;">Thanks & Regards,</p>
	<p style="color: #000000;">Just-Food</p>

</body>
</html>