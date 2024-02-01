@extends('frontend.imageTheme.layout.master')

@section('css')
    
@endsection

@section('mainContent')

    @if($user)
        @php
            $first_name = $user->name;
            $email = $user->email;
            $phone = $user->phone;
            $postcode_details = $user->postcode;
            $address = $user->address;
        @endphp
    @else
        @php
            $first_name = "";
            $email = "";
            $phone = "";
            $postcode_details = "";
            $address = "";
        @endphp
    @endif



<section id="gallery" class="p_174_100">
    <div class="container">

        <div class="col-md-6 col-xs-12">

            <div id="cart-checkout">

                <h3>Order Details</h3>

                @if(Cart::count() > 0)
                @foreach(Cart::content() as $row)

                <div class="sin-item">
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>{{ $row->options->has('varName') ? $row->options->varName : '' }} {{$row->name}}</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price">{{\Session::get('currency')}}{{$row->price}}</p>
                        </div>
                    </div>
                    <div class="sin-item-down">    
                        <div class="sin-item-up">
                            <div class="sin-item-left">
                                @if($row->options->subVariances)
                                @foreach($row->options->subVariances as $subVariance)
                                <p class="sub-variance">+ {{$subVariance}}</p>
                                @endforeach
                                @endif
                            </div>
                            <div class="sin-item-right">
                                <div class="card-item-actions mt-08">
                                    <span>Qty : {{$row->qty}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @endforeach
                @endif

                @if(Cart::count() > 0)
                <div class="sin-item">
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>Subtotal</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price">{{\Session::get('currency')}}{{Cart::total()}}</p>
                        </div>
                    </div>
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>Delivery charge</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price">{{\Session::get('currency')}}{{$reqDatas['deliveryCharge']}}</p>
                        </div>
                    </div>
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>Discount</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price">{{\Session::get('currency')}}{{$reqDatas['discount']}}</p>
                        </div>
                    </div>
                    <div class="sin-item-up">
                        <div class="sin-item-left">
                            <p>Total</p>
                        </div>
                        <div class="sin-item-right">
                            <p class="price">{{\Session::get('currency')}}
                            {{ (Cart::total() + $reqDatas['deliveryCharge']) - $reqDatas['discount'] }}</p>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>

        <div class="col-md-6 col-xs-12">

            {!! Form::open(['url' => action('CartController@order'), 'method' => 'POST', 'id' => 'contact', 'class' => 'orderForm', 'role'=>'form']) !!}

                {{csrf_field()}}

                @if($reqDatas['shippingMethod']=='delivery')
                    @php
                        $timeLimit = $otherDatas->deliveryTimeLimit;
                        $zipcode = $reqDatas['zipcode'];
                    @endphp
                @endif

                @if($reqDatas['shippingMethod']=='collection')
                    @php
                        $timeLimit = $otherDatas->collectionTimeLimit;
                        $zipcode = $storeDatas->store_postcode;
                    @endphp
                @endif



                @if (Session::has('message'))
                    <p class="sV">{{ Session::get('message') }}</p>
                @endif

                <h3>Specify 
                    @if($reqDatas['shippingMethod']=='collection') pick-up @endif
                    @if($reqDatas['shippingMethod']=='delivery') delivery @endif  time</h3>

                <select name="shipping_time" id="shipping_time" tabindex="1" required="required">
                    <option value="asap">ASAP (Estimate {{ $timeLimit }} min)</option>
                    <?php

                    $addTime = $timeLimit * 60;
                    $start=strtotime(date("H:i:s"))+$addTime;
                    $end=strtotime($openCloseDatas->closingTime);

                    for ($i=$start;$i<=$end;$i = $i + 15*60) { ?>
                        <option value="<?php echo date('H:i',$i); ?>"><?php echo date('H:i',$i); ?></option>
                    <?php } ?>
                </select>

                @if ($errors->has('status'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('status') }}</strong>
                </p>
                @endif

                <br>
                <br>
                <h3>Customer info</h3>

                {!! Form::hidden('shippingMethod', $reqDatas['shippingMethod'], ['tabindex' => '1','required' => 'required']); !!}
                {!! Form::hidden('zipcode', $reqDatas['zipcode'], ['tabindex' => '1']); !!}
                {!! Form::hidden('postcode', $reqDatas['postcode'], ['tabindex' => '1']); !!}
                {!! Form::hidden('deliveryCharge', $reqDatas['deliveryCharge'], ['tabindex' => '1','required' => 'required']); !!}
                {!! Form::hidden('discount', $reqDatas['discount'], ['tabindex' => '1','required' => 'required']); !!}

                {!! Form::text('first_name', $first_name, ['placeholder' => 'Name','tabindex' => '1','required' => 'required']); !!}
                @if ($errors->has('first_name'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('first_name') }}</strong>
                </p>
                @endif

                {!! Form::email('email', $email, ['placeholder' => 'Email','tabindex' => '3','required' => 'required']); !!}
                @if ($errors->has('email'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('email') }}</strong>
                </p>
                @endif

                {!! Form::text('phone', $phone, ['placeholder' => 'Phone','tabindex' => '4','required' => 'required']); !!}
                @if ($errors->has('phone'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('phone') }}</strong>
                </p>
                @endif

                <br>
                <br>
                <h3>Shipping info</h3>

                {!! Form::hidden('shippingMethod', $reqDatas['shippingMethod'], ['required' => 'required']); !!}

                {!! Form::hidden('deliveryCharge', $reqDatas['deliveryCharge'], ['required' => 'required']); !!}

                {!! Form::hidden('discount', $reqDatas['discount'], ['required' => 'required']); !!}
                {!! Form::hidden('store_postcode', $storeDatas->store_postcode, ['required' => 'required']); !!}

                {!! Form::text('postcode', $zipcode, ['placeholder' => 'Postcode','tabindex' => '5','required' => 'required','disabled' => 'disabled']); !!}
                @if ($errors->has('postcode'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('postcode') }}</strong>
                </p>
                @endif

                @if($reqDatas['shippingMethod']=='delivery')

                {!! Form::text('postcode_details', $postcode_details, ['placeholder' => 'Postcode details','tabindex' => '6']); !!}
                @if ($errors->has('postcode_details'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('postcode_details') }}</strong>
                </p>
                @endif

                @endif


                {!! Form::textarea('address', $address, ['placeholder' => 'Address....','tabindex' => '7','required' => 'required','class' => 'cus_w_99']); !!}
                @if ($errors->has('address'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('address') }}</strong>
                </p>
                @endif

                <br>
                <br>
                <h3>Special request</h3>


                {!! Form::textarea('special_request', null, ['placeholder' => 'Special request....','tabindex' => '7','class' => 'cus_w_99']); !!}
                @if ($errors->has('address'))
                <p class="help-block error_login">
                    <strong>{{ $errors->first('address') }}</strong>
                </p>
                @endif

                <br>
                <br>
                <h3>Payment info</h3>

                <div class="form__custom">
                    <div class="form__group">

                        @if($paymentInfo->cash == 'enable')
                        <div class="form__radio-group">
                            <input type="radio" class="form__radio-input" id="cash" name="payment" value="cash" checked>
                            <label for="cash" class="form__radio-label">
                                <span class="form__radio-botton"></span>
                                Cash
                            </label>
                        </div>
                        @endif

                        @if($paymentInfo->online == 'enable')

                        @if($paymentInfo->p_e_d == 'enable')
                        <div class="form__radio-group">
                            <input type="radio" class="form__radio-input" id="paypal" name="payment" value="paypal">
                            <label for="paypal" class="form__radio-label">
                                <span class="form__radio-botton"></span>
                                Paypal
                            </label>  
                        </div>
                        @endif

                        @if($paymentInfo->s_e_d == 'enable')
                        <div class="form__radio-group">
                            <input type="radio" class="form__radio-input card-stripe" id="card" name="payment" value="card">
                            <label for="card" class="form__radio-label">
                                <span class="form__radio-botton"></span>
                                Stripe
                            </label>  
                        </div>
                        @endif

                        @endif

                    </div>
                </div>

                {{ Form::button('Order now',['type' => 'submit','id' => 'table-submit','name' => 'submit']) }}

            {!! Form::close() !!}

        </div>


    </div><!-- End container --> 
</section>


@endsection

@section('js')

<script type="text/javascript">

    $( ".orderForm" ).validate({

        rules: {
            shipping_time:  {
                required: true,
            },
            first_name:  {
                required: true,
            },
            email: {
                required: true,
                email: true,
            },
            phone:  {
                required: true,
                maxlength: 20,
            },
            postcode: {
                required: true,
            },
            postcode_details: {
                required: true,
            },
            address: {
                required: true,
                maxlength: 500,
            }
        },
        messages: {
            shipping_time: {
                required: "Please select shipping method.",
            },
            first_name: {
                email: "Please enter first name",
            },
            email: {
                required: "Please enter your email.",
                email: "Please enter valid email.",
            },
            phone: {
                required: "Please enter contact number.",
                maxlength: "Maximum 20 digits.",
            },
            postcode: {
                required: "Please enter postcode.",
            },
            postcode_details: {
                required: "Please enter postcode details.",
            },
            address: {
                required: "Please type your address.",
                maxlength: "Maximum 500 characters.",
            },
        },

    });


</script>

@if(Session::get('customerEmail') == null)
<script type="text/javascript">
    $(document).ready(function() {
        $('#LoginModal').modal('show');
    });
</script>
@endif

@endsection
