<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{   
    /*
    |-------------------------------------
    | Order model
    |-------------------------------------
    |
    | Company : Webexcel
    | Author : Emon Ahmed
    | Version : 1.0.0
    |
    */

	protected $table = 'orders';
	protected $fillable = [
        'order_date',
        'order_delivery_time',
        'order_delivery_type',
        'order_extra_fee',
        'order_delivery_charge',
        'order_subtotal',
        'order_total',
        'order_total_item',
        'order_pay_method',
        'order_customer_name',
        'order_contact_number',
        'order_email',
        'order_address',
        'order_postcode',
        'order_payment_status',
        'order_status',
        'inserted',
        'login_user_id',
        'order_postcode_details',
        'order_special_request',
    ];
}
