<div class="modal-dialog modal-xl" role="document" style="width: 85%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modalTitle">Order id : <?php echo e($lists[0]->id); ?></h4>
		</div>
		<div class="modal-body">
			<div class="row invoice-info">

				<div class="col-sm-4 col-md-4 invoice-col">

					<?php if($lists[0]->order_items): ?>
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<th>Item name</th>
								<th>Qty</th>
								<!-- <th>Price</th> -->
							</thead>
							<tbody>
								<?php $__currentLoopData = $lists[0]->order_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $items): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<td>
										<b><?php echo e($items->var_name ? $items->var_name : ''); ?> <?php echo e($items->item_name); ?></b><br>
										<?php
										$subVar = explode(',',$items->sub_var);
										?>
										<?php if($subVar): ?>
										<?php $__currentLoopData = $subVar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $svar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<span style="padding-left: 10px;"><?php echo e($svar ? ' + '.$svar : ''); ?></span></br>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										<?php endif; ?>
									</td>
									<td><?php echo e($items->qty); ?></td>
									<!-- <td><?php echo e(Session::get('currency')); ?><?php echo e($items->price); ?></td> -->
								</tr>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</tbody>
						</table>
					</div>
					<?php endif; ?>

				</div>

				<div class="col-sm-4 invoice-col">

					<b>Order date :</b> <?php echo e(changeDateFormate($lists[0]->order_date)); ?><br>
					<b>Delivery time : </b> <?php echo e($lists[0]->order_delivery_time); ?><br>
					<b>Shipping method : </b> <button class="btn btn-xs btn-defalut"><?php echo e($lists[0]->order_delivery_type); ?></button><br>
					<b>Shipping charge : </b> <?php echo e(\Session::get('currency')); ?>  <?php echo e($lists[0]->order_delivery_charge); ?><br>
					<b>Special request : </b> <?php echo e($lists[0]->order_special_request); ?><br>


					<b>Payment method : </b> <button class="btn btn-xs btn-defalut"><?php echo e($lists[0]->order_pay_method); ?></button><br>
					<?php if($lists[0]->order_payment): ?>
					<?php $__currentLoopData = $lists[0]->order_payment; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<b>Payment via : </b> <button class="btn btn-xs btn-defalut"><?php echo e($payment->order_payment_method); ?></button><br>
					<b>Transaction id : </b> <?php echo e($payment->transaction_id); ?><br>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<b>Payment status : </b> <button class="btn btn-xs btn-defalut"><?php echo e($lists[0]->order_payment_status); ?></button><br>
					<b>Order status : </b> <button class="btn btn-xs btn-defalut"><?php echo e($lists[0]->order_status); ?></button><br>

					<b>Extra fee : </b> <?php echo e(\Session::get('currency')); ?>  <?php echo e($lists[0]->order_extra_fee); ?><br>
					<b>Total item : </b> <?php echo e($lists[0]->order_total_item); ?><br>

					<b>Subtotal : </b> <?php echo e(\Session::get('currency')); ?>  <?php echo e($lists[0]->order_subtotal); ?><br>
					<b>Total : </b> <?php echo e(\Session::get('currency')); ?> <?php echo e($lists[0]->order_total); ?><br>


				</div>

				<div class="col-sm-4 invoice-col">

					<b>Customer name : </b> <?php echo e($lists[0]->order_customer_name); ?><br>
					<b>Customer number : </b> <?php echo e($lists[0]->order_contact_number); ?><br>
					<b>Customer email : </b> <?php echo e($lists[0]->order_email); ?><br>
					<b>Customer Postcode : </b> <?php echo e($lists[0]->order_postcode); ?><?php echo e(', '.$lists[0]->order_postcode_details); ?><br>
					<b>Customer Address : </b> <?php echo e($lists[0]->order_address); ?><br>

				</div>

			</div>
			<br>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-primary no-print" 
			aria-label="Print" 
			onclick="$(this).closest('div.modal').printThis();">
			<i class="fa fa-print"></i> Print
		</button>
		<button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
	</div>
</div>
</div>