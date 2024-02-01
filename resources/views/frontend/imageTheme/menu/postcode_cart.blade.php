@if(\Session::get('deliveryCharge')) 
    @php
        $sippingCharge = \Session::get('deliveryCharge');
    @endphp
@else 
    @php
        $sippingCharge = 0.00;
    @endphp
@endif

@if(\Session::get('postcode')) 
    @php
        $postcode = \Session::get('postcode');
    @endphp
@else 
    @php
        $postcode = null;
    @endphp
@endif

@if($otherDatas->free_shipping_status=='enable')
    @if(Cart::total() >= $otherDatas->amount_for_free_shipping) 
        @php
            $sippingCharge = 0.00;
        @endphp
    @endif
@endif

<div class="post_code_section">

    <div class="delivery_area">
        <input type="text" id="zipcode"  name="zipcode" placeholder="Enter Postcode" class="delivery_postcode" autocomplete="off" onblur="setPostCode()" value="{{$postcode}}">
        <p class="zipcode_hint">{{$records['message']}}</p> 

    </div>
    <div class="pickup_area" id="cus_dn">
        <input type="text" name="zipcode" class="collection_postcode" value="{{ $storeDatas->store_postcode }}" disabled="disabled">
    </div>
    
</div>

<div id="cart-main-div">
    <div id="cart-section">


    @php
        $discount = 0.00;
    @endphp

    @if(\Session::get('deliveryCharge')) 
        @php
            $sippingCharge = \Session::get('deliveryCharge');
        @endphp
    @else 
        @php
            $sippingCharge = 0.00;
        @endphp
    @endif

    @if(\Session::get('postcode')) 
        @php
            $postcode = \Session::get('postcode');
        @endphp
    @else 
        @php
            $postcode = null;
        @endphp
    @endif

    @if($otherDatas->free_shipping_status=='enable')
        @if(Cart::total() >= $otherDatas->amount_for_free_shipping) 
            @php
                $sippingCharge = 0.00;
            @endphp
        @endif
    @endif

    @if(OfferHelper::is_offer())
        <p class="offerHint">{{ OfferHelper::is_offer() }}</p>
        <!-- <p class="offerHint">Spend more $12 & get discount on basket</p> -->
    @endif

    @if(OfferHelper::check_coupon())
        @php
            $offerData = OfferHelper::check_coupon();
        @endphp
        @if($offerData->coupon_code)

        @if(\Session::get('coupon_status')=='done')
            <p class="offerHint cus_p5">Your coupon code is : {{\Session::get('coupon_code')}}</p>
        @endif

        @if(\Session::get('coupon_status')=="" || \Session::get('coupon_status')=="pending")
        <div id="coupon-vox">
            <input hidden type="text" class="offer_id" name="offer_id" value="{{$offerData->id}}">
            <input type="text" class="check_coupon_code" name="check_coupon_code" placeholder="Enter coupon code" value="">
            <a href="javascript:void(0)" class="btn-add cus_p_5_15" onclick="checkCoupon()">Submit</a>
        </div>
        @endif
        @endif
    @endif


    @if(OfferHelper::offer_details())
        @php
            $offerResponse = OfferHelper::offer_details();
        @endphp
        @foreach($offerResponse as $singleOffer)

            @if($singleOffer->action_type == 'action_basket')

                @php
                    $amount = $singleOffer->action_other;
                @endphp

                @if($singleOffer->action_value == 'percent')
                    @php
                        $discount = Cart::total()*$singleOffer->action_other;
                        $discount = $discount / 100;
                    @endphp
                @endif

                @if($singleOffer->action_value == 'fix_amount')
                    @php
                        $discount = $singleOffer->action_other;
                    @endphp
                @endif

            @endif

            @if($singleOffer->action_type == 'action_free_item')
                @php
                  $free_item_allowed = $singleOffer->action_value;
                  $free_items = explode(',',$singleOffer->action_other);
                @endphp
            @endif


        @endforeach

        
    @endif


        <input type="hidden" class="postcode" name="postcode" value="{{$postcode}}">
        <input type="hidden" class="deliveryCharge" name="deliveryCharge" value="{{$sippingCharge}}">
        <input type="hidden" class="discount" name="discount" value="{{$discount}}">

        @if(Cart::count() > 0)
            @php
                $count_free_item = 0;
                $free_items_array = [];
            @endphp
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
                                    @if($row->price!=0)
                                    <i class="fa fa-minus" onclick="update_qty('{{$row->rowId}}','{{$row->qty}}','decr')"></i>
                                    <span>{{$row->qty}}</span>
                                    <i class="fa fa-plus" onclick="update_qty('{{$row->rowId}}','{{$row->qty}}','incr')"></i>
                                    @endif
                                    @if($row->price==0)
                                    @php
                                        $count_free_item = $count_free_item+$row->qty;
                                    @endphp

                                        @if($row->options->varId)
                                            @php
                                            $free_items_array[] = $row->id.'-'.$row->options->varId;
                                            @endphp
                                        @else
                                            @php
                                            $free_items_array[] = $row->id;
                                            @endphp
                                        @endif
                                    <i class="fa fa-trash" onclick="update_qty('{{$row->rowId}}','{{$row->qty}}','decr')"></i>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        @endforeach
                
        @else

            <p class="empty_text">Cart empty !</p>
            <img src="{{asset('media/theme/cart_empty.jpg')}}" class="emptyImage">
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
                    <p class="price">{{\Session::get('currency')}}
                        <span id="d_c">{{$sippingCharge}}</span></p>
                </div>
            </div>
            <div class="sin-item-up">
                <div class="sin-item-left">
                    <p>Discount</p>
                </div>
                <div class="sin-item-right">
                    <p class="price">{{\Session::get('currency')}}{{$discount}}</p>
                </div>
            </div>
            <div class="sin-item-up">
                <div class="sin-item-left">
                    <p>Total</p>
                </div>
                <div class="sin-item-right">
                    <p class="price">{{\Session::get('currency')}}{{(Cart::total() + $sippingCharge) - $discount}}</p>
                </div>
            </div>
        </div>
        @endif

    </div>

    <div class="checkout-section">

        @isset($free_item_allowed)
            <select id="free_item" class="form-control cus_free">
                <option value="">Choose {{ ($free_item_allowed-$count_free_item==0) ? '' : $free_item_allowed-$count_free_item.' more' }} free itmes </option>
                <?php 

                foreach ($free_items as $free_item) {
                        if(!in_array($free_item, $free_items_array)){
                 ?>

                <option value="<?php echo $free_item_allowed.','.$count_free_item.','.OfferHelper::getFreeItemValue($free_item); ?>"><?php echo OfferHelper::getFreeItemName($free_item); ?></option>

                <?php  } ?>
                <?php  } ?>
            </select>
        @endisset

        @if( (Cart::total() + $sippingCharge) - $discount < 10)
        <button type="submit" class="checkout-btn" disabled="disabled" id="dn_c" >Order minimum {{Session::get('currency')}} 10</button>
        @else
        <button type="submit" class="checkout-btn" >Checkout</button>
        @endif
        
        <a href="#right-section" class="mb-checkBasket">Total Basket <span class="total-amount">{{Session::get('currency')}} {{(Cart::total() + $sippingCharge) - $discount}}</span></a>


    </div>
</div>


<script>

    $(document).ready(function() {

        $('#free_item').on('change',function(e){

          if(res_status!='pre_order_off'){

            var allData = $(this).val();
            var res = allData.split(",");

            if(res[0]==res[1]){
              alert('You already added 2 items');
            }else{
              $.ajax({
                  type: 'post',
                  url: base_URL+"cart/storeFreeItem",
                  dataType: "html",
                  data: {allData:allData},
                  success: function(result){
                    $('#cart-main-div').html(result);
                    $('#cartStatus').fadeIn(400).delay(1000).fadeOut(400);
                  }
              });
            }
          }else{
            alert('Restaurant is close now');
          }

        })

    });


</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#zipcode").autocomplete({
            source: "{{ url('/searchPostcode') }}",
            minlength:1
        });
    });
</script>
