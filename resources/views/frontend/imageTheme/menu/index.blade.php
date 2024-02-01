@extends('frontend.imageTheme.layout.master')
@section('mainContent')
@php
    $flag = 0;
@endphp
@if($openCloseDatas->restaurantStatus=='open')
    @php
        $flag = 1;
    @endphp
    @if((date('H:i:s') >= $openCloseDatas->openingTime) && (date('H:i:s') <= $openCloseDatas->closingTime))
        @php
            $flag = 1;
        @endphp
    @else
        @php
            $flag = 2;
        @endphp
    @endif
@endif

    <!-- Added success message -->
    <p id="cartStatus">Added successfully. Thank you ! <span onclick="crossCartStatus()"><i class="fa fa-times"></i></span></p>
    <section class="trending-food">
        
        <div class="white-space30"></div>
        
        <div class="container-fluid">
            
            <!-- Let Sidebar -->
            <div class="col-md-3 leftSidebar">
                <div class="theiaStickySidebar menu-category-div">
                    <p class="category-title">All Categories</p>
                    <ul class="categories">
                        @if($categories)
                            @foreach($categories as $category)

                            <?php
                            $days = explode(',',$category->cat_available_days);
                            if(in_array(mb_strtolower(date('D')), $days)) { ?>

                            @if(($category->cat_available_delivery_method == 'both') || ($otherDatas->deliveryMethod == 'both') || ($category->cat_available_delivery_method == $otherDatas->deliveryMethod))
                            <li>
                                <a href="javascript:void(0)" class="categories-item {{ ($category->id==$cat_id) ? 'active' : '' }}" onclick="getCatItems('{{ $category->cat_name }}','{{ $category->id }}')">{{$category->cat_name}}
                                <!-- <span>({{$category->getItems->count()}})</span> -->
                                </a>
                            </li>
                            @endif

                            <?php } ?>

                            @endforeach
                        @else
                        <li><a href="javascript:void(0)" class="categories-item">No Category</a></li>
                        @endif
                    </ul>
                </div>
            </div>
            
            
            <!-- Middle Content - Items -->
            <div class="col-md-6 food-section">
                <div class="div-md-6">
                <!-- <div class="div-6-custom"> -->
                    <div class="theiaStickySidebar">
                        @if(count($categories) > 0)
                        <p class="category-title web-cat-title">
                            <span id="append-cat-name">{{$cat_name}}</span>
                           
                                @if($flag==2)
                                    @if($otherDatas->pre_order_status=='enable')
                                        <span class="menu-pre-status">Pre-order</span>
                                    @endif
                                @endif
                            
                        </p>
                        @endif

                        <div class="trending-food-list" id="append-item">

                            @if(count($records) > 0)

                            @foreach($records as $item)

                            @if(($item->item_delivery_type == 'both') || ($otherDatas->deliveryMethod == 'both') || ($item->item_delivery_type == $otherDatas->deliveryMethod))

                                @if($item->variances->count() > 0)
                                    @foreach($item->variances as $variance)
                                
                                    @if($storeDatas->store_active_theme==1)
                                    <div class="trending-food-item">
                                    <div class="img-box">
                                        <img src="{{asset('media/items/'.$item->item_image)}}" alt="food">
                                    </div>
                                    <div class="food-info">
                                        <p class="p-text food-name">{{$variance->variance_name}} {{$item->item_name}}</p>
                                        <div class="p-text-vox">
                                            <div class="price">
                                                <span class="min-price">
                                                    @if($variance->item_old_price)
                                                    <del>{{\Session::get('currency')}} {{$variance->item_old_price}}</del>  {{\Session::get('currency')}} {{$variance->item_new_price}}
                                                    @else
                                                    {{\Session::get('currency')}} {{$variance->item_new_price}}
                                                    @endif
                                                </span>
                                            </div>
                                            @if($item->item_sub_menu === 'yes')
                                            <div class="btn_add"><a href="javascript:void(0)" onclick="get_sub_variance('{!! $item->id !!}','{!!$item->item_name!!}','{!!$variance->item_new_price!!}','{!!$variance->id!!}','{!!$variance->variance_name!!}')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                                            @else
                                            <div class="btn_add"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$variance->item_new_price}}','{!!$variance->id!!}','{!!$variance->variance_name!!}')">Add to cart</a></div>
                                            @endif
                                        </div>
                                    </div>
                                    </div>
                                    @else
                                    <div class="trending-food-item-theme-2">
                                        <div class="p-text-vox-theme-2">
                                            <div class="name-theme-2">
                                                {{$variance->variance_name}} {{$item->item_name}}
                                            </div>
                                            <div class="price-theme-2">
                                                <span class="min-price-theme-2">
                                                    @if($variance->item_old_price)
                                                    <del>{{\Session::get('currency')}} {{$variance->item_old_price}}</del>  {{\Session::get('currency')}} {{$variance->item_new_price}}
                                                    @else
                                                    {{\Session::get('currency')}} {{$variance->item_new_price}}
                                                    @endif
                                                </span>
                                            </div>
                                            @if($item->item_sub_menu === 'yes')
                                            <div class="btn_add  btn-add-theme-2"><a href="javascript:void(0)" onclick="get_sub_variance('{!! $item->id !!}','{!!$item->item_name!!}','{!!$variance->item_new_price!!}','{!!$variance->id!!}','{!!$variance->variance_name!!}')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                                            @else
                                            <div class="btn_add  btn-add-theme-2"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$variance->item_new_price}}','{!!$variance->id!!}','{!!$variance->variance_name!!}')">Add to cart</a></div>
                                            @endif
                                        </div>
                                    </div>
                                    @endif

                                    @endforeach
                                @else
                                    @if($storeDatas->store_active_theme==1)

                                    <div class="trending-food-item">
                                        <div class="img-box">
                                            <img src="{{asset('media/items/'.$item->item_image)}}" alt="food">
                                        </div>
                                        <div class="food-info">
                                            <p class="p-text food-name">{{$item->item_name}}</p>
                                            <div class="p-text-vox">
                                                <div class="price">
                                                    <span class="min-price">
                                                        @if($item->item_old_price)
                                                        <del>{{\Session::get('currency')}} {{$item->item_old_price}}</del>  {{\Session::get('currency')}} {{$item->item_new_price}}
                                                        @else
                                                        {{\Session::get('currency')}} {{$item->item_new_price}}
                                                        @endif
                                                    </span>
                                                </div>
                                                @if($item->item_sub_menu === 'yes')
                                                <div class="btn_add"><a href="javascript:void(0)" onclick="get_sub_variance('{!! $item->id !!}','{!!$item->item_name!!}','{!!$item->item_new_price!!}')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                                                @else
                                                <div class="btn_add"><a href="javascript:void(0)" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$item->item_new_price}}')" class="btn-add">Add to cart</a></div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @else

                                    <div class="trending-food-item-theme-2">
                                        <div class="p-text-vox-theme-2">
                                            <div class="name-theme-2">
                                                {{$item->item_name}}
                                            </div>
                                            <div class="price-theme-2">
                                                <span class="min-price-theme-2">
                                                    @if($item->item_old_price)
                                                    <del>{{\Session::get('currency')}} {{$item->item_old_price}}</del>  {{\Session::get('currency')}} {{$item->item_new_price}}
                                                    @else
                                                    {{\Session::get('currency')}} {{$item->item_new_price}}
                                                    @endif
                                                </span>
                                            </div>
                                            @if($item->item_sub_menu === 'yes')
                                            <div class="btn_add btn-add-theme-2"><a href="javascript:void(0)" onclick="get_sub_variance('{!! $item->id !!}','{!!$item->item_name!!}','{!!$item->item_new_price!!}')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                                            @else
                                            <div class="btn_add btn-add-theme-2"><a href="javascript:void(0)" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$item->item_new_price}}')" class="btn-add">Add to cart</a></div>
                                            @endif
                                        </div>
                                    </div>

                                    @endif
                                @endif

                            @endif
                            
                            @endforeach

                            @else
                                <p class="text-center text-danger no_item">No Item found</p>
                            @endif

                        </div>

                        <!-- Mobile Menu -->

                        <div id="mobile-area">


                                @if($categories)
                                    @php
                                        $mb_count = 0;
                                    @endphp
                                    @foreach($categories as $category)
                                    @php
                                        $mb_count++;
                                    @endphp

                                    <?php
                                    $days = explode(',',$category->cat_available_days);
                                    if(in_array(mb_strtolower(date('D')), $days)) { ?>

                                    @if(($category->cat_available_delivery_method == 'both') || ($otherDatas->deliveryMethod == 'both') || ($category->cat_available_delivery_method == $otherDatas->deliveryMethod))

                                    <p class="category-title mobile-category"><a href="javascript:void(0)" class="cla-{{$category->id}}" onclick="itemShowHideMb('{{$category->id}}','cla-{{$category->id}}')">{{$category->cat_name}} <i class="{{ ($mb_count=='1') ? 'fa fa-chevron-down' : 'fa fa-chevron-up' }}"></i></a></p>


                                        <div class="trending-food-list" id="cla-{{$category->id}}">

                                        @if($mb_count==1)

                                            @if($records->count() > 0)

                                            @foreach($records as $item)

                                            @if(($item->item_delivery_type == 'both') || ($otherDatas->deliveryMethod == 'both') || ($item->item_delivery_type == $otherDatas->deliveryMethod))

                                                @if($item->variances->count() > 0)
                                                    @foreach($item->variances as $variance)
                                                    <div class="trending-food-item">
                                                        @if($storeDatas->store_active_theme==1)
                                                        <div class="img-box">
                                                            <img src="{{asset('media/items/'.$item->item_image)}}" alt="food">
                                                        </div>
                                                        @endif
                                                        <div class="food-info">
                                                            <p class="p-text food-name">{{$variance->variance_name}} {{$item->item_name}}</p>
                                                            <div class="p-text-vox">
                                                                <div class="price">
                                                                    <span class="min-price">
                                                                        @if($variance->item_old_price)
                                                                        <del>{{\Session::get('currency')}} {{$variance->item_old_price}}</del>  {{\Session::get('currency')}} {{$variance->item_new_price}}
                                                                        @else
                                                                        {{\Session::get('currency')}} {{$variance->item_new_price}}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                @if($item->item_sub_menu === 'yes')
                                                                <div class="btn_add"><a href="javascript:void(0)" onclick="get_sub_variance('{!! $item->id !!}','{!!$item->item_name!!}','{!!$variance->item_new_price!!}','{!!$variance->id!!}','{!!$variance->variance_name!!}')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                                                                @else
                                                                <div class="btn_add"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$variance->item_new_price}}','{!!$variance->id!!}','{!!$variance->variance_name!!}')">Add to cart</a></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                @else
                                                    <div class="trending-food-item">
                                                        @if($storeDatas->store_active_theme==1)
                                                        <div class="img-box">
                                                            <img src="{{asset('media/items/'.$item->item_image)}}" alt="food">
                                                        </div>
                                                        @endif
                                                        <div class="food-info">
                                                            <p class="p-text food-name">{{$item->item_name}}</p>
                                                            <div class="p-text-vox">
                                                                <div class="price">
                                                                    <span class="min-price">
                                                                        @if($item->item_old_price)
                                                                        <del>{{\Session::get('currency')}} {{$item->item_old_price}}</del>  {{\Session::get('currency')}} {{$item->item_new_price}}
                                                                        @else
                                                                        {{\Session::get('currency')}} {{$item->item_new_price}}
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                                @if($item->item_sub_menu === 'yes')
                                                                <div class="btn_add"><a href="javascript:void(0)" onclick="get_sub_variance('{!! $item->id !!}','{!!$item->item_name!!}','{!!$item->item_new_price!!}')" class="btn-add">Choose <i class="fa fa-angle-down"></i></a></div>
                                                                @else
                                                                <div class="btn_add"><a href="javascript:void(0)" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$item->item_new_price}}')" class="btn-add">Add to cart</a></div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif

                                            @endif

                                            @endforeach

                                            @else
                                                <p class="text-center text-danger no_item">No Item found</p>
                                            @endif

                                        @endif

                                        </div>

                                    @endif

                                    <?php } ?>

                                    @endforeach
                                @endif


                        </div>

                        <!-- End mobile menu -->

                    </div>
                </div>
            </div>
            
            
            <!-- Right Sidebar -->
            <div class="col-md-3 rightSidebar">
                <div class="theiaStickySidebar menu-cart-div">
                    <div id="right-section">
                        <p class="category-title">Basket Details</p>
                        <div class="basketDiv">

                            {!! Form::open(['url' => action('CartController@checkout'), 'method' => 'POST', 'id' => 'checkOutForm', 'role'=>'form']) !!}


                            <div class="shipping_method_radio">

                            @if($otherDatas->deliveryMethod=='both')

                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" onclick="shippingMethodFunc('delivery')" value="delivery" @if((Session::get('deliveryMethod')=='delivery') OR (Session::get('deliveryMethod')=='')) checked @endif><label>Delivery</label>
                                </div>
                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" value="collection" onclick="shippingMethodFunc('collection')"  @if(Session::get('deliveryMethod')=='collection') checked @endif ><label>Pick-up</label>  
                                </div>

                            @elseif($otherDatas->deliveryMethod=='delivery')
                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" onclick="shippingMethodFunc('delivery')" value="delivery" checked><label class="cus_lebel">Delivery</label>      
                                </div>
                            @elseif($otherDatas->deliveryMethod=='collection')
                                <div class="input-container">
                                    <input class="shippingMethodBtn" type="radio" name="shippingMethod" value="collection" onclick="shippingMethodFunc('collection')" checked><label class="cus_lebel">Pick-up</label>  
                                </div>
                            @endif


                            </div>

                            <p class="ShippingimeHint">Delivery time taken {{$otherDatas->deliveryTimeLimit}} min & pickup time {{$otherDatas->collectionTimeLimit}} min</p>

                            <div id="postcode_cart">

                                <div class="post_code_section">

                                    <div class="delivery_area" @if(($otherDatas->deliveryMethod=='collection') OR (Session::get('deliveryMethod')=='collection'))  id="cus_dn" @endif >
                                        <input type="text" id="zipcode"  name="zipcode" placeholder="Enter Postcode" class="delivery_postcode" autocomplete="off" onblur="setPostCode()" value="{{\Session::get('postcode')}}">
                                        <p class="zipcode_hint">@if(\Session::get('postcode')) Previous delivery postcode was : {{\Session::get('postcode')}}  @endif</p>
                                    </div>

                                    @if(Session::get('deliveryMethod')=='collection')
                                        <input type="text" name="zipcode" class="collection_postcode" value="{{ $storeDatas->store_postcode }}" disabled="disabled">
                                    @endif

                                    <div class="pickup_area" @if(($otherDatas->deliveryMethod!='collection') OR ((Session::get('deliveryMethod')=='delivery')))  id="cus_dn" @endif>
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
                                                    <p class="price">{{\Session::get('currency')}}{{$sippingCharge}}</p>
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
                                                    <p class="price">{{\Session::get('currency')}}
                                                    {{(Cart::total() + $sippingCharge) - $discount}}</p>
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

                            </div>

                            {!! Form::close() !!}


                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        
        <div class="white-space"></div>
        
    </section>

    <div class="modal fade" id="subVarianceModal" tabindex="-1" role="dialog" aria-labelledby="sBModal" aria-hidden="true">

    </div>

@endsection
@section('js')

<script type="text/javascript">

    var str_sts = '{{$storeDatas->store_extra_tiny_2}}';
    var store_extra = '{{$storeDatas->store_extra_tiny}}';
            
    $(document).ready(function() {

        $('.leftSidebar, .food-section, .rightSidebar')
            .theiaStickySidebar({
                additionalMarginTop: 110
            });


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

        $("#zipcode").autocomplete({
            source: "{{ url('/searchPostcode') }}",
            minlength:1
        });
    });

</script>

@endsection