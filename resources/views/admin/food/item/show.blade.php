<div class="modal-dialog modal-xl" role="document" style="width: 85%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modalTitle">{{$lists[0]->item_name}}</h4>
		</div>
		<div class="modal-body">
			<div class="row invoice-info">

				<div class="col-sm-3 invoice-col">
					<b>New price:</b> {{$lists[0]->item_new_price}} {{ \Session::get('currency') }}<br>
					<b>Old price: </b> @if($lists[0]->item_old_price) {{ $lists[0]->item_old_price }} {{ \Session::get('currency') }} @endif<br>
					<b>Category: </b> {{$lists[0]->getCategory->cat_name}}<br>
					<b>Spice level: </b> {{$lists[0]->item_spice_level}}<br>
					<b>Allergy: </b>
					@if($lists[0]->getAllergies)
					@foreach($lists[0]->getAllergies as $allergies)
					<button class="btn btn-xs btn-defalut">{{ $allergies->name }}</button>
					@endforeach
					@endif
					<br>	
				</div>

				<div class="col-sm-3 invoice-col">
					<b>Delivery method: </b> {{$lists[0]->item_delivery_type}}<br>
					<b>Special request: </b> {{$lists[0]->item_sp_request_sts}}<br>
					<b>Variance product: </b> {{$lists[0]->item_variance}}<br>
					<b>Sub-item product: </b> {{$lists[0]->item_sub_menu}}<br>
					<b>Include in offer: </b> {{$lists[0]->item_offer_include}} <br>
				</div>

				<div class="col-sm-3 invoice-col">
					<b>Item status: </b> {{$lists[0]->status}}<br>
					<b>Custom integer field: </b> {{$lists[0]->cus_int_field}}<br>
					<b>Custom text field: </b> {{$lists[0]->cus_text_field}}<br>
					<b>Custom select field: </b> {{$lists[0]->cus_tinyInt_field}}<br>
				</div>

				<div class="col-sm-3 col-md-3 invoice-col">
					<div class="thumbnail">
						<img src="{{asset('media/items/'.$lists[0]->item_image)}}" height="60" alt="{{$lists[0]->item_name}} image">
					</div>
				</div>

			</div>
			<br>

			<div class="row">
				<div class="col-md-12">
					<h4>Variance of {{$lists[0]->item_name}}:</h4>
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
							@if(count($lists[0]->variance) > 0)

							@php
							$i=1;
							@endphp
							@foreach($lists[0]->variance as $variance)
							<tr>
								<td>{{$i++}}</td>
								<td>{{$variance->variance_name}}</td>
								<td> <del>{{$variance->item_old_price}}</del> {{$variance->item_new_price}} {{ \Session::get('currency') }}</td>
								<td>{{$variance->status=='enable' ? 'Enable' : 'Disable'}}</td>
							</tr>
							@endforeach

							@else
							<tr>
								<td colspan="4">No variance of this product</td>
							</tr>
							@endif


						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12">
					<h4>Sub-variance of {{$lists[0]->item_name}}:</h4>
				</div>

				@if(count($lists[0]->sub_items) > 0)

				@foreach($lists[0]->sub_items as $sub_item)

				<div class="col-md-4">

					<div class="row">

						<div class="col-md-12">
							<h4 style="background: #029552; margin: 0;padding: 10px 5px;color: white;text-align: center;font-size: 13px;">{{$sub_item->sub_item_name}} (Required {{$sub_item->required}}, Min-{{$sub_item->min_value}}, Max-{{$sub_item->max_value}}, {{$sub_item->status}})</h4>
						</div>
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-condensed bg-gray text-center">
									<tr class="bg-green">
										<th>Serial</th>
										<th>Sub-variance name</th>
										<th>Price</th>
									</tr>
									@if(count($sub_item->sub_variances) > 0)
									@php
									$k=1;
									@endphp
									@foreach($sub_item->sub_variances as $sub_variance)
									<tr>
										<td>{{$k++}}</td>
										<td>{{$sub_variance->sub_item_variance_name}}</td>
										<td><del>{{$sub_variance->item_variance_old_price}}</del> {{$sub_variance->item_variance_new_price}} {{ \Session::get('currency') }}</td>
									</tr>
									@endforeach
									@else
									<tr>
										<td colspan="3">No sub-variance</td>
									</tr>
									@endif
								</table>
							</div>
						</div>

					</div>

				</div>

				@endforeach
				@else
				<div class="col-md-12">
					<p class="" style="background: #d2d6de;padding: 10px;">No Sub variance</p>
				</div>
				@endif

			</div>

		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default no-print" data-dismiss="modal">Close</button>
		</div>
	</div>
</div>