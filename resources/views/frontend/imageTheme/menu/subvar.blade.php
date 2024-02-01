<div class="modal-dialog" role="document">
	<div class="modal-content">
	  <div class="modal-header">
	    <h5 class="modal-title" id="sBModal">{{$data['var_name']}} {{$data['item_name']}} </h5>
	    <p class="modal-title-p">Total price : {{\Session::get('currency')}}<span class="priceHtml"> {{$data['item_price']}}</span></p>
	    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="cus_o">
	      <span class="span-modal" aria-hidden="true">&times;</span>
	    </button>
	  </div>
	  <form action="{{ url('/add_cart_from_modal') }}" method="POST" id="subItemForm">

	  	  <input type="hidden" class="item_id" name="item_id" value="{{$data['item_id']}}">
	  	  <input type="hidden" class="item_name" name="item_name" value="{{$data['item_name']}}">
	  	  <input type="hidden" class="item_price" name="item_price" value="{{$data['item_price']}}">
	  	  <input type="hidden" class="variance_id" name="variance_id" value="{{$data['item_var_id']}}">
	  	  <input type="hidden" class="variance_name" name="variance_name" value="{{$data['var_name']}}">

		  <div class="modal-body">
	  			@php
	    			$ct = 1;
	    		@endphp
		    	@foreach($sub_items as $subItems)
			    	@if($subItems->sub_variances->count() > 0)

			    	@php
			    		$minMax = 0;
			    	@endphp
			    	@if(($subItems->min_value==1) && ($subItems->max_value==1))
				    	@php
				    		$minMax = 1;
				    	@endphp
			    	@endif

			    	<h4 class="customSubHeading">{{ $subItems->sub_item_name }} <span>({{ ($subItems->required=='no') ? 'Optional' : 'Required' }})</span></h4>
			    	@if($minMax == 1)
			    		<p class="customSubHeadingTag">You can choose only {{$subItems->min_value}} item</p>
			    	@else
			    		<p class="customSubHeadingTag">You can choose minimum  {{$subItems->min_value}} and maximum {{$subItems->max_value}} item</p>
			    	@endif
			    	<p class="alertMsg alert{{$ct}}">This field is required</p>

			    	<div class="h15"></div>

			    	<p class="subItemMinVal{{ $ct }}" id="cus_dn">{{ $subItems->min_value }}</p>
			    	<p class="subItemMaxVal{{ $ct }}" id="cus_dn">{{ $subItems->max_value }}</p>
			    	<input type="hidden" class="subItemsCount" name="subItems" value="{{ $subItems->required }}">
			    	<input type="hidden" class="subItemsDatas" name="subItemsDatas" value="{{ $subItems->sub_item_name }}">


				    	@foreach($subItems->sub_variances as $subVariance)

				    	@if($minMax==1)


							<div class="form-group col-sm-12">
								<label class="customLabel container-radio">{{ $subVariance->sub_item_variance_name }}
									<input type="radio" class="minMaxBtn subVar{{ $ct }}" name="subVar{{ $ct }}[]" value="{{ $subVariance->sub_item_variance_name }}" data-ct="{{$ct}}" data-minval="{{ $subItems->min_value }}" data-maxval="{{ $subItems->max_value }}" data-price="{{ $subVariance->item_variance_new_price }}">
									<span class="checkmark"></span>
				                	<span class="priceModal">
				                	@if($subVariance->item_variance_old_price)
				                	(<del>{{ \Session::get('currency').''.$subVariance->item_variance_old_price }}</del> {{ \Session::get('currency').''.$subVariance->item_variance_new_price }})
				                	@else
				                	({{ \Session::get('currency').''.$subVariance->item_variance_new_price }})
				                	@endif
				                	</span>
								</label>
							</div>

				        @else

							<div class="form-group col-sm-12">
				                <label class="customLabel container-checkbox">
				                	{{ $subVariance->sub_item_variance_name }}
				                	<input type="checkbox" class="minMaxBtn subVar{{ $ct }}" name="subVar{{ $ct }}[]" value="{{ $subVariance->sub_item_variance_name }}" data-ct="{{$ct}}" data-minval="{{ $subItems->min_value }}" data-maxval="{{ $subItems->max_value }}" data-price="{{ $subVariance->item_variance_new_price }}" >
				                	<span class="checkmark-checkbox"></span>
				                	<span class="priceModal">
				                	@if($subVariance->item_variance_old_price)
				                	(<del>{{ \Session::get('currency').''.$subVariance->item_variance_old_price }}</del> {{ \Session::get('currency').''.$subVariance->item_variance_new_price }})
				                	@else
				                	({{ \Session::get('currency').''.$subVariance->item_variance_new_price }})
				                	@endif
				                	</span>
				                </label>
				            </div>

				        @endif
				        <div class="clearfix"></div>


				    	@endforeach

				    <div class="h15"></div>
			    	@endif
			    	@php
		    			$ct++;
		    		@endphp
		    	@endforeach
		  </div>
		  <div class="modal-footer">
		    <button type="button" class="btn btn-close" data-dismiss="modal">Close</button>
		    <a class="btn btn-add" onclick="addCartFromModal()">Add to cart</a>
		  </div>
	  </form>
	</div>
</div>