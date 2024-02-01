@if($records->count() > 0)

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
                    <div class="btn_add"><a href="javascript:void(0)" class="btn-add" onclick="add_in_basket('{!! $item->id !!}','{!!$item->item_name!!}','{{$item->item_new_price}}')">Add to cart</a></div>
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
