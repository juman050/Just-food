<!DOCTYPE html>
<html>
<head>
	<title>Just-Food</title>
</head>
<body>
	
	<p style="font-size: 20px;color: #7f7878" ><span style="color: #000000;">Order Info :</span></p>

	<p style="color: #7f7878;">Order date : {{$order_date}} </p>
	<p style="color: #7f7878;">Delivery method : {{$order_delivery_type}} </p>
	<p style="color: #7f7878;">Delivery time : {{$order_delivery_time}} </p>
	<p style="color: #7f7878;">Delivery charge : {{$order_delivery_charge}} </p>
	<p style="color: #7f7878;">Extra fee : {{$order_extra_fee}} </p>


	<table class="table table-responsive table-hover table-bordered">
		<thead>
			<th>
				<td>Item Name</td>
				<td>Qty</td>
				<td>Price</td>
			</th>
		</thead>
		<tbody>

		@foreach (Cart::content() as $row)

			<tr>
				<td>
                    @if($row->options->has('varName'))
                        {{$row->options->varName}} {{$row->name}}
                    @else
                    	{{$row->name}}
                    @endif
                    <br>
                    @if(isset($row->options->subVariances))

                    	$subVarAll = implode(',', $row->options->subVariances);
                    	@foreach ($subVarAll as $subVar)
                    		{{$subVar}}
                    	@endforeach

                	@endif
				</td>
				<td>{{$row->qty}}</td>
				<td>{{Session::get('currency')}} {{$row->price}}</td>
			</tr>

		@endforeach

		</tbody>

	</table>


	<p style="color: #7f7878;">Subtotal : {{$order_subtotal}} </p>
	<p style="color: #7f7878;">Total : {{$order_total}} </p>
	<p style="color: #7f7878;">Total item : {{$order_total_item}} </p>


	<p style="font-size: 20px;color: #7f7878" ><span style="color: #000000;">Customer Info :</span></p>

	<p style="color: #7f7878;">Customer name : {{$order_customer_name}} </p>
	<p style="color: #7f7878;">Customer contact number : {{$order_contact_number}} </p>
	<p style="color: #7f7878;">Customer email : {{$order_email}} </p>

	<p style="color: #7f7878;">Delivery address : {{$order_address}} </p>
	<p style="color: #7f7878;">Delivery postcode : {{$order_postcode}} </p>
	<p style="color: #7f7878;">Postcode details : {{$order_postcode_details}} </p>

	<p style="color: #7f7878;">Special request : {{$order_special_request}} </p>
	<p style="color: #7f7878;">Payment method : {{$order_pay_method}} </p>
	<p style="color: #7f7878;">Order status : {{$order_status}} </p>


	<p style="color: #7f7878;">Thanks & Regards,</p>
	<p style="color: #000000;">Just-Food</p>

</body>
</html>