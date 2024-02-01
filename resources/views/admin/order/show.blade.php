<div class="modal-dialog modal-xl" role="document" style="width: 85%">
	<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close no-print" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="modalTitle">Order id : {{$lists[0]->id}}</h4>
		</div>
		<div class="modal-body">
			<div class="row invoice-info">

				<div class="col-sm-4 col-md-4 invoice-col">

					@if($lists[0]->order_items)
					<div class="table-responsive">
						<table class="table table-hover table-bordered">
							<thead>
								<th>Item name</th>
								<th>Qty</th>
								<!-- <th>Price</th> -->
							</thead>
							<tbody>
								@foreach($lists[0]->order_items as $items)
								<tr>
									<td>
										<b>{{$items->var_name ? $items->var_name : '' }} {{$items->item_name}}</b><br>
										@php
										$subVar = explode(',',$items->sub_var);
										@endphp
										@if($subVar)
										@foreach($subVar as $svar)
										<span style="padding-left: 10px;">{{$svar ? ' + '.$svar : ''}}</span></br>
										@endforeach
										@endif
									</td>
									<td>{{$items->qty}}</td>
									<!-- <td>{{Session::get('currency')}}{{$items->price}}</td> -->
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					@endif

				</div>

				<div class="col-sm-4 invoice-col">

					<b>Order date :</b> {{changeDateFormate($lists[0]->order_date)}}<br>
					<b>Delivery time : </b> {{ $lists[0]->order_delivery_time }}<br>
					<b>Shipping method : </b> <button class="btn btn-xs btn-defalut">{{$lists[0]->order_delivery_type}}</button><br>
					<b>Shipping charge : </b> {{ \Session::get('currency') }}  {{$lists[0]->order_delivery_charge}}<br>
					<b>Special request : </b> {{$lists[0]->order_special_request}}<br>


					<b>Payment method : </b> <button class="btn btn-xs btn-defalut">{{$lists[0]->order_pay_method}}</button><br>
					@if($lists[0]->order_payment)
					@foreach($lists[0]->order_payment as $payment)
					<b>Payment via : </b> <button class="btn btn-xs btn-defalut">{{$payment->order_payment_method}}</button><br>
					<b>Transaction id : </b> {{$payment->transaction_id}}<br>
					@endforeach
					@endif
					<b>Payment status : </b> <button class="btn btn-xs btn-defalut">{{$lists[0]->order_payment_status}}</button><br>
					<b>Order status : </b> <button class="btn btn-xs btn-defalut">{{$lists[0]->order_status}}</button><br>

					<b>Extra fee : </b> {{ \Session::get('currency') }}  {{$lists[0]->order_extra_fee}}<br>
					<b>Total item : </b> {{$lists[0]->order_total_item}}<br>

					<b>Subtotal : </b> {{ \Session::get('currency') }}  {{$lists[0]->order_subtotal}}<br>
					<b>Total : </b> {{ \Session::get('currency') }} {{$lists[0]->order_total}}<br>


				</div>

				<div class="col-sm-4 invoice-col">

					<b>Customer name : </b> {{$lists[0]->order_customer_name}}<br>
					<b>Customer number : </b> {{$lists[0]->order_contact_number}}<br>
					<b>Customer email : </b> {{$lists[0]->order_email}}<br>
					<b>Customer Postcode : </b> {{$lists[0]->order_postcode}}{{', '.$lists[0]->order_postcode_details}}<br>
					<b>Customer Address : </b> {{$lists[0]->order_address}}<br>

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