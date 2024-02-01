<?php

namespace App\Http\Helpers;
use App\Offer;
use DB;
use Session;
use Cart;

class OfferHelper{

    /*
    |-----------------------------------------
    | Offer Helper
    |-----------------------------------------
    |
    | 
    | Author : Juman
    | Helper : Offer Helper for Just-food Website
    | Version : 1.0.0
    |
    */

	public static function is_offer(){

		$deliveryMethod = Session::get('deliveryMethod');
		$totalQty = 0;
        foreach (Cart::content() as $row) {
            $totalQty = $totalQty+$row->qty;
        }
        $cartTotalAmount = Cart::total();

		$offers = Offer::where('status','enable')
			->where('startdate','<=',date('Y-m-d'))
			->where('enddate','>=',date('Y-m-d'))
			->first();

		if(!$offers){
			return false;
		}

		$flag = 0;

        $daysArray = explode(',', $offers->days);

        $day = '';
        $today = date('D');

        if(in_array(strtolower($today), $daysArray)){
        	$time = date('H:i');
        	if((strtotime($time) >= strtotime($offers->start_time)) && (strtotime($time) <= strtotime($offers->end_time))){

        		if($offers->coupon_code){
        			if(\Session::get('coupon_status')=="" OR \Session::get('coupon_status')=="pending"){
        				$flag = 0;
        			}else{
        				$flag = 1;
        			}
        		}else{
        			$flag = 1;
        		}

        		
        	}else{
        		$flag = 0;
        	}
        }

        $offer_success = 0;

        if($flag==1){
        	$offerConditions = DB::table('offer_conditions')->where('offer_id',$offers->id)->orderBy('id','DESC')->get();

        	$conditionStatus = 1;
        	foreach ($offerConditions as $condition) {

        		if($condition->con_type=='con_delivery_type'){
        			if($condition->con_value==$deliveryMethod){
        				$offer_success = 1;
        			}else{
        				$offer_success = 0;
        				return 'Choose '.$condition->con_value.' method &  get this offer !!';
        			}
        		}
        		

        		if($condition->con_type=='con_subtotal'){
        			if($condition->con_value=='equals'){
        				if($cartTotalAmount == $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					$amt = $condition->con_other-Cart::total();
        					return 'Spend more '.Session::get('currency').$amt.', exact '.$condition->con_other.' & get this offer !!';
        				}
        			}elseif($condition->con_value=='not_equals'){
        				if($cartTotalAmount != $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Spend more or less '.Session::get('currency').$condition->con_other.' & get this offer !!';
        				}
        			}elseif($condition->con_value=='less_than'){
        				if($cartTotalAmount < $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Spend less than '.Session::get('currency').$condition->con_other.' & get this offer !!';
        				}
        			}elseif($condition->con_value=='greater_than'){
        				if($cartTotalAmount > $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					$amt = $condition->con_other-Cart::total();
        					if($amt==0){
        						$amt = 0.1;
        					}
        					return 'Spend more '.Session::get('currency').$amt.' & get this offer !!';
        				}
        			}elseif($condition->con_value=='less_than_equal'){
        				if($cartTotalAmount <= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Spend less than '.Session::get('currency').$condition->con_other.' & get this offer !!';
        				}
        			}elseif($condition->con_value=='greater_than_equal'){
        				if($cartTotalAmount >= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					$amt = $condition->con_other-Cart::total();
        					return 'Spend more '.Session::get('currency').$amt.' & get this offer !!';
        				}
        			}else{
        				$offer_success = 0;
        			}
        		}
        		

        		if($condition->con_type=='con_total_qty'){
        			if($condition->con_value=='equals'){
        				if($totalQty == $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Buy exact '.$condition->con_other.' item & get this offer !!';
        				}
        			}elseif($condition->con_value=='not_equals'){
        				if($totalQty != $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Buy more or less '.$condition->con_other.' item & get this offer !!';
        				}
        			}elseif($condition->con_value=='less_than'){
        				if($totalQty < $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Buy less than '.$condition->con_other.' item & get this offer !!';
        				}
        			}elseif($condition->con_value=='greater_than'){
        				if($totalQty > $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Buy greater than '.$condition->con_other.' item & get this offer !!';
        				}
        			}elseif($condition->con_value=='less_than_equal'){
        				if($totalQty <= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Buy less than or equal '.$condition->con_other.' item & get this offer !!';
        				}
        			}elseif($condition->con_value=='greater_than_equal'){
        				if($totalQty >= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					return 'Buy greater than or equal '.$condition->con_other.' item & get this offer !!';
        				}
        			}else{
        				$offer_success = 0;
        				// break;
        			}
        		}
        		
        	}

        }else{
        	$offer_success = 0;
        }

        if($offer_success==1){
        	return false;
        }else{
        	return false;
        }

	}

	public static function check_coupon(){

		$offers = Offer::where('status','enable')
			->where('startdate','<=',date('Y-m-d'))
			->where('enddate','>=',date('Y-m-d'))
			->first();

		if(!$offers){
			return false;
		}

		$flag = 0;

        $daysArray = explode(',', $offers->days);

        $day = '';
        $today = date('D');

        if(in_array(strtolower($today), $daysArray)){
        	$time = date('H:i');
        	if((strtotime($time) >= strtotime($offers->start_time)) && (strtotime($time) <= strtotime($offers->end_time))){
        		$flag = 1;
        	}else{
        		$flag = 0;
        	}
        }

        if($flag==1){
        	return $offers;
        }else{
        	return false;
        }

	}

	public static function offer_details(){

		$deliveryMethod = Session::get('deliveryMethod');
		$totalQty = 0;
        foreach (Cart::content() as $row) {
            $totalQty = $totalQty+$row->qty;
        }
        $cartTotalAmount = Cart::total();


		$offers = Offer::where('status','enable')
			->where('startdate','<=',date('Y-m-d'))
			->where('enddate','>=',date('Y-m-d'))
			->first();

		if(!$offers){
			return false;
		}
		
		$flag = 0;

        $daysArray = explode(',', $offers->days);

        $day = '';
        $today = date('D');

        if(in_array(strtolower($today), $daysArray)){
        	$time = date('H:i');
        	if((strtotime($time) >= strtotime($offers->start_time)) && (strtotime($time) <= strtotime($offers->end_time))){

        		if($offers->coupon_code){
        			if(\Session::get('coupon_status')=="" OR \Session::get('coupon_status')=="pending"){
        				$flag = 0;
        			}else{
        				$flag = 1;
        			}
        		}else{
        			$flag = 1;
        		}

        		
        	}else{
        		$flag = 0;
        	}
        }

        $offer_success = 0;

        if($flag==1){
        	$offerConditions = DB::table('offer_conditions')->where('offer_id',$offers->id)->orderBy('id','DESC')->get();

        	$conditionStatus = 1;
        	foreach ($offerConditions as $condition) {


        		if($condition->con_type=='con_condition'){
        			if($condition->con_value=='yes'){
        				$offer_success = 1;
        				break;
        			}else{
        				$offer_success = 1;
        			}
        		}


        		if($condition->con_type=='con_delivery_type'){
        			if($condition->con_value==$deliveryMethod){
        				$offer_success = 1;
        			}else{
        				$offer_success = 0;
        				break;
        			}
        		}
        		

        		if($condition->con_type=='con_subtotal'){
        			if($condition->con_value=='equals'){
        				if($cartTotalAmount == $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='not_equals'){
        				if($cartTotalAmount != $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='less_than'){
        				if($cartTotalAmount < $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='greater_than'){
        				if($cartTotalAmount > $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='less_than_equal'){
        				if($cartTotalAmount <= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='greater_than_equal'){
        				if($cartTotalAmount >= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}else{
        				$offer_success = 0;
        			}
        		}
        		

        		if($condition->con_type=='con_total_qty'){
        			if($condition->con_value=='equals'){
        				if($totalQty == $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='not_equals'){
        				if($totalQty != $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='less_than'){
        				if($totalQty < $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='greater_than'){
        				if($totalQty > $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}elseif($condition->con_value=='less_than_equal'){
        				if($totalQty <= $condition->con_other){
        					$offer_success = 1;
        				}
        			}elseif($condition->con_value=='greater_than_equal'){
        				if($totalQty >= $condition->con_other){
        					$offer_success = 1;
        				}else{
        					$offer_success = 0;
        					break;
        				}
        			}else{
        				$offer_success = 0;
        				// break;
        			}
        		}
        		
        	}

        }else{
        	$offer_success = 0;
        }

        if($offer_success==1){
        	$offerActions = DB::table('offer_actions')->where('offer_id',$offers->id)->orderBy('id','DESC')->get();
        	return $offerActions;
        }else{
        	return false;
        }

	}

	public static function getFreeItemName($freeItem){

		$itemPart = explode('-', $freeItem);
		$price = 0;
		$str = "";
		if(isset($itemPart[1])){

			$item_id = $itemPart[0];
			$variance_id = $itemPart[1];
			$varDetails = DB::table('variance')
							->leftJoin('item_variances','item_variances.variance_id','=','variance.id')
							->where('item_variances.item_id',$item_id)
							->where('variance.id',$variance_id)
							->first();
			if($varDetails){
				$price = $varDetails->item_new_price;
				$str.=$varDetails->variance_name;
				$str.=' ';
			}

			$itemDetails = DB::table('items')->where('id',$item_id)->first();
			if($itemDetails){
				$str.=$itemDetails->item_name;
			}

		}else{

			$item_id = $itemPart[0];
			$itemDetails = DB::table('items')->where('id',$item_id)->first();
			$str.=$itemDetails->item_name;
			$price = $itemDetails->item_new_price;

		}

		// $str.=' ( '.Session::get('currency').$price.' )';
		return $str;


	}



	public static function getFreeItemValue($freeItem){

		$itemPart = explode('-', $freeItem);
		$price = 0;
		$str = "";
		if(isset($itemPart[1])){

			$item_id = $itemPart[0];
			$variance_id = $itemPart[1];


			$itemDetails = DB::table('items')->where('id',$item_id)->first();
			if($itemDetails){
				$str.=$item_id.','.$itemDetails->item_name.','.$itemDetails->item_new_price;
			}


			$varDetails = DB::table('variance')
							->leftJoin('item_variances','item_variances.variance_id','=','variance.id')
							->where('item_variances.item_id',$item_id)
							->where('variance.id',$variance_id)
							->first();
			if($varDetails){
				$str.=','.$varDetails->variance_id.','.$varDetails->variance_name;
			}


		}else{

			$item_id = $itemPart[0];
			$itemDetails = DB::table('items')->where('id',$item_id)->first();
			$str.=$item_id.','.$itemDetails->item_name.','.$itemDetails->item_new_price;

		}

		// $str.=' ( '.Session::get('currency').$price.' )';
		return $str;


	}

}

?>
