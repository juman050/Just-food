<div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
	    <h5 class="modal-title" id="sBModal"><?php echo e($data['var_name']); ?> <?php echo e($data['item_name']); ?> </h5>
	    <p class="modal-title-p">Total price : <?php echo e(\Session::get('currency')); ?><span class="priceHtml"> <?php echo e($data['item_price']); ?></span></p>
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cus_o">
	      <span class="span-modal" aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <form action="<?php echo e(url('/add_cart_from_modal')); ?>" method="POST" id="subItemForm">

	  	  <input type="hidden" class="item_id" name="item_id" value="<?php echo e($data['item_id']); ?>">
	  	  <input type="hidden" class="item_name" name="item_name" value="<?php echo e($data['item_name']); ?>">
	  	  <input type="hidden" class="item_price" name="item_price" value="<?php echo e($data['item_price']); ?>">
	  	  <input type="hidden" class="variance_id" name="variance_id" value="<?php echo e($data['item_var_id']); ?>">
	  	  <input type="hidden" class="variance_name" name="variance_name" value="<?php echo e($data['var_name']); ?>">

		  <div class="modal-body">
	  			<?php
	    			$ct = 1;
	    		?>
		    	<?php $__currentLoopData = $sub_items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subItems): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
			    	<?php if($subItems->sub_variances->count() > 0): ?>

			    	<?php
			    		$minMax = 0;
			    	?>
			    	<?php if(($subItems->min_value==1) && ($subItems->max_value==1)): ?>
				    	<?php
				    		$minMax = 1;
				    	?>
			    	<?php endif; ?>

			    	<h4 class="customSubHeading"><?php echo e($subItems->sub_item_name); ?> <span>(<?php echo e(($subItems->required=='no') ? 'Optional' : 'Required'); ?>)</span></h4>
			    	<?php if($minMax == 1): ?>
			    		<p class="customSubHeadingTag">You can choose only <?php echo e($subItems->min_value); ?> item</p>
			    	<?php else: ?>
			    		<p class="customSubHeadingTag">You can choose minimum  <?php echo e($subItems->min_value); ?> and maximum <?php echo e($subItems->max_value); ?> item</p>
			    	<?php endif; ?>
			    	<p class="alertMsg alert<?php echo e($ct); ?>">This field is required</p>

			    	<div class="h15"></div>

			    	<p class="subItemMinVal<?php echo e($ct); ?>" id="cus_dn"><?php echo e($subItems->min_value); ?></p>
			    	<p class="subItemMaxVal<?php echo e($ct); ?>" id="cus_dn"><?php echo e($subItems->max_value); ?></p>
			    	<input type="hidden" class="subItemsCount" name="subItems" value="<?php echo e($subItems->required); ?>">
			    	<input type="hidden" class="subItemsDatas" name="subItemsDatas" value="<?php echo e($subItems->sub_item_name); ?>">


				    	<?php $__currentLoopData = $subItems->sub_variances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subVariance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

				    	<?php if($minMax==1): ?>


							<div class="form-group col-sm-12">
								<label class="customLabel container-radio"><?php echo e($subVariance->sub_item_variance_name); ?>

									<input type="radio" class="minMaxBtn subVar<?php echo e($ct); ?>" name="subVar<?php echo e($ct); ?>[]" value="<?php echo e($subVariance->sub_item_variance_name); ?>" data-ct="<?php echo e($ct); ?>" data-minval="<?php echo e($subItems->min_value); ?>" data-maxval="<?php echo e($subItems->max_value); ?>" data-price="<?php echo e($subVariance->item_variance_new_price); ?>">
									<span class="checkmark"></span>
				                	<span class="priceModal">
				                	<?php if($subVariance->item_variance_old_price): ?>
				                	(<del><?php echo e(\Session::get('currency').''.$subVariance->item_variance_old_price); ?></del> <?php echo e(\Session::get('currency').''.$subVariance->item_variance_new_price); ?>)
				                	<?php else: ?>
				                	(<?php echo e(\Session::get('currency').''.$subVariance->item_variance_new_price); ?>)
				                	<?php endif; ?>
				                	</span>
								</label>
							</div>

				        <?php else: ?>

							<div class="form-group col-sm-12">
				                <label class="customLabel container-checkbox">
				                	<?php echo e($subVariance->sub_item_variance_name); ?>

				                	<input type="checkbox" class="minMaxBtn subVar<?php echo e($ct); ?>" name="subVar<?php echo e($ct); ?>[]" value="<?php echo e($subVariance->sub_item_variance_name); ?>" data-ct="<?php echo e($ct); ?>" data-minval="<?php echo e($subItems->min_value); ?>" data-maxval="<?php echo e($subItems->max_value); ?>" data-price="<?php echo e($subVariance->item_variance_new_price); ?>" >
				                	<span class="checkmark-checkbox"></span>
				                	<span class="priceModal">
				                	<?php if($subVariance->item_variance_old_price): ?>
				                	(<del><?php echo e(\Session::get('currency').''.$subVariance->item_variance_old_price); ?></del> <?php echo e(\Session::get('currency').''.$subVariance->item_variance_new_price); ?>)
				                	<?php else: ?>
				                	(<?php echo e(\Session::get('currency').''.$subVariance->item_variance_new_price); ?>)
				                	<?php endif; ?>
				                	</span>
				                </label>
				            </div>

				        <?php endif; ?>
				        <div class="clearfix"></div>


				    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

				    <div class="h15"></div>
			    	<?php endif; ?>
			    	<?php
		    			$ct++;
		    		?>
		    	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		  </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
		    <a class="btn btn-add" onclick="addCartFromModal()">Add to cart</a>
		  </div>
	  </form>
	</div>
</div>