<div class="modal-dialog modal-xl" role="document" style="width: 85%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modalTitle"><?php echo e($lists[0]->item_name); ?></h4>
		</div>
		<div class="modal-body">
			<div class="row invoice-info">

				<div class="col-sm-3 invoice-col">
					<b>New price:</b> <?php echo e($lists[0]->item_new_price); ?> <?php echo e(\Session::get('currency')); ?><br>
					<b>Old price: </b> <?php if($lists[0]->item_old_price): ?> <?php echo e($lists[0]->item_old_price); ?> <?php echo e(\Session::get('currency')); ?> <?php endif; ?><br>
					<b>Category: </b> <?php echo e($lists[0]->getCategory->cat_name); ?><br>
					<b>Spice level: </b> <?php echo e($lists[0]->item_spice_level); ?><br>
					<b>Allergy: </b>
					<?php if($lists[0]->getAllergies): ?>
					<?php $__currentLoopData = $lists[0]->getAllergies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $allergies): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<button class="btn btn-xs btn-defalut"><?php echo e($allergies->name); ?></button>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<?php endif; ?>
					<br>	
				</div>

				<div class="col-sm-3 invoice-col">
					<b>Delivery method: </b> <?php echo e($lists[0]->item_delivery_type); ?><br>
					<b>Special request: </b> <?php echo e($lists[0]->item_sp_request_sts); ?><br>
					<b>Variance product: </b> <?php echo e($lists[0]->item_variance); ?><br>
					<b>Sub-item product: </b> <?php echo e($lists[0]->item_sub_menu); ?><br>
					<b>Include in offer: </b> <?php echo e($lists[0]->item_offer_include); ?> <br>
				</div>

				<div class="col-sm-3 invoice-col">
					<b>Item status: </b> <?php echo e($lists[0]->status); ?><br>
					<b>Custom integer field: </b> <?php echo e($lists[0]->cus_int_field); ?><br>
					<b>Custom text field: </b> <?php echo e($lists[0]->cus_text_field); ?><br>
					<b>Custom select field: </b> <?php echo e($lists[0]->cus_tinyInt_field); ?><br>
				</div>

				<div class="col-sm-3 col-md-3 invoice-col">
					<div class="thumbnail">
						<img src="<?php echo e(asset('media/items/'.$lists[0]->item_image)); ?>" height="60" alt="<?php echo e($lists[0]->item_name); ?> image">
					</div>
				</div>

			</div>
			<br>

			<div class="row">
				<div class="col-md-12">
					<h4>Variance of <?php echo e($lists[0]->item_name); ?>:</h4>
				</div>
				<div class="col-md-12">

					<div class="table-responsive">
						<table class="table table-condensed bg-gray text-center">
							<tr class="bg-green">
								<th>Serial</th>
								<th>Variance name</th>
								<th>Price</th>
								<th>Status</th>
							</tr>
							<?php if(count($lists[0]->variance) > 0): ?>

							<?php
							$i=1;
							?>
							<?php $__currentLoopData = $lists[0]->variance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $variance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr>
								<td><?php echo e($i++); ?></td>
								<td><?php echo e($variance->variance_name); ?></td>
								<td> <del><?php echo e($variance->item_old_price); ?></del> <?php echo e($variance->item_new_price); ?> <?php echo e(\Session::get('currency')); ?></td>
								<td><?php echo e($variance->status=='enable' ? 'Enable' : 'Disable'); ?></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

							<?php else: ?>
							<tr>
								<td colspan="4">No variance of this product</td>
							</tr>
							<?php endif; ?>


						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h4>Sub-variance of <?php echo e($lists[0]->item_name); ?>:</h4>
				</div>

				<?php if(count($lists[0]->sub_items) > 0): ?>

				<?php $__currentLoopData = $lists[0]->sub_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				<div class="col-md-4">

					<div class="row">

						<div class="col-md-12">
							<h4 style="background: #029552; margin: 0;padding: 10px 5px;color: white;text-align: center;font-size: 13px;"><?php echo e($sub_item->sub_item_name); ?> (Required <?php echo e($sub_item->required); ?>, Min-<?php echo e($sub_item->min_value); ?>, Max-<?php echo e($sub_item->max_value); ?>, <?php echo e($sub_item->status); ?>)</h4>
						</div>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-condensed bg-gray text-center">
									<tr class="bg-green">
										<th>Serial</th>
										<th>Sub-variance name</th>
										<th>Price</th>
									</tr>
									<?php if(count($sub_item->sub_variances) > 0): ?>
									<?php
									$k=1;
									?>
									<?php $__currentLoopData = $sub_item->sub_variances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub_variance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<tr>
										<td><?php echo e($k++); ?></td>
										<td><?php echo e($sub_variance->sub_item_variance_name); ?></td>
										<td><del><?php echo e($sub_variance->item_variance_old_price); ?></del> <?php echo e($sub_variance->item_variance_new_price); ?> <?php echo e(\Session::get('currency')); ?></td>
									</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php else: ?>
									<tr>
										<td colspan="3">No sub-variance</td>
									</tr>
									<?php endif; ?>
								</table>
							</div>
						</div>

					</div>

				</div>

				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				<?php else: ?>
				<div class="col-md-12">
					<p class="" style="background: #d2d6de;padding: 10px;">No Sub variance</p>
				</div>
				<?php endif; ?>

			</div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>