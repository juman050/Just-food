<?php

use Illuminate\Database\Seeder;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Insert default delevery & collection information. Also added some other information like every page status.
        $datas = [
            [
                'id' => 1,
                'deliveryMethod' => 'both',
                'deliveryTimeLimit' => 20,
                'collectionTimeLimit' => 10,
                'mileage_or_postcode' => 'postcode',
                'menu_file' => 'menu.pdf',
                'menu_file_status' => 'enable',
                'table_book_status' => 'enable',
                'home_page_status' => 'enable',
                'contact_page_status' => 'enable',
                'gallery_page_status' => 'enable',
                'menu_page_status' => 'enable',
                'privacy_page_status' => 'enable',
                'terms_page_status' => 'enable',
                'pre_order_status' => 'enable',
                'special_reequest_status' => 'enable',
                'instant_open_close' => 'disable',
                'image_showing' => 'enable',
                'free_shipping_status' => 'enable',
                'amount_for_free_shipping' => 500,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('delivery_collection_others')->insert($datas);

        // Insert default extra charge
        $chargeData = [
            [
                'id' => 1,
                'deliveryMethod' => 'both',
                'extraAmount' => 500,
                'ExtraChargeStatus' => 'disable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('extra_charges')->insert($chargeData);


        // Insert default payment information
        $paymentData = [
            [
                'id' => 1,
                'cash' => 'enable',
                'online' => 'enable',
                'p_u' => 'paypal_username@gmail.com',
                'p_p' => 'paypalpassword',
                'p_s' => 'paypalkey124iuyt_key',
                'p_a_t' => 'test',
                'p_e_d' => 'enable',
                's_p_k' => 'pk_test_0Rj6WblKbZHgag6Z0dcwNqWa00ct8GwCNb',
                's_s_k' => 'sk_test_D8v3NcwD0fHHe2fr9FfNmiDx00IeJWCrvz',
                's_e_d' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('payment_settings')->insert($paymentData);


        // Insert some of default post codes/areas
        $postCodeData = [
            [
                'id' => 1,
                'postcode_area' => 'B23',
                'postcode_delivery_charge' => 2,
                'postcode_minimum_order' => 0,
                'postcode_status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'postcode_area' => 'B24',
                'postcode_delivery_charge' => 5,
                'postcode_minimum_order' => 0,
                'postcode_status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'postcode_area' => 'PO1',
                'postcode_delivery_charge' => 3,
                'postcode_minimum_order' => 0,
                'postcode_status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'postcode_area' => 'PO2',
                'postcode_delivery_charge' => 4,
                'postcode_minimum_order' => 0,
                'postcode_status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'postcode_area' => 'PO3',
                'postcode_delivery_charge' => 2.5,
                'postcode_minimum_order' => 0,
                'postcode_status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'postcode_area' => 'PO4',
                'postcode_delivery_charge' => 1.5,
                'postcode_minimum_order' => 0,
                'postcode_status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('postcodes')->insert($postCodeData);


        // Insert per day open & closing time
        $openCloseData = [
            [
                'id' => 1,
                'day' => 'Sunday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'day' => 'Monday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'day' => 'Tuesday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'day' => 'Wednesday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'day' => 'Thursday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'day' => 'Friday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'day' => 'Saturday',
                'openingTime' => '10:00:00',
                'closingTime' => '23:59:00',
                'restaurantStatus' => 'open',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('restaurant_open_closes')->insert($openCloseData);


        // Insert default gallery
        $gallery = [
            [
                'id' => 1,
                'image' => 'default_gallery_image.png',
                'title' => 'Special Biriyani',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'image' => 'default_gallery_image.png',
                'title' => 'Beaf Biriyani',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'image' => 'default_gallery_image.png',
                'title' => 'Chicken Biriyani',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'image' => 'default_gallery_image.png',
                'title' => 'Mutton Biriyani',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'image' => 'default_gallery_image.png',
                'title' => 'Onion Bhaji',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'image' => 'default_gallery_image.png',
                'title' => 'Special Nan',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'image' => 'default_gallery_image.png',
                'title' => 'Special Mutton',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'image' => 'default_gallery_image.png',
                'title' => 'Thanduri',
                'description' => 'Default Description',
                'status' => 'enable',
                'position' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('gallery')->insert($gallery);


        // Insert default categories
        $categories = [
            [
                'id' => 1,
                'cat_name' => 'Starters',
                'cat_description' => 'Starters description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'cat_name' => 'Biryani dishes',
                'cat_description' => 'Biryani description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 2,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'cat_name' => 'Rice Dishes',
                'cat_description' => 'Rice Dishes description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 3,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'cat_name' => 'Side Dishes',
                'cat_description' => 'Side Dishes description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 4,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'cat_name' => 'Nan Breads',
                'cat_description' => 'Nan Breads description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 5,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'cat_name' => 'Steaks',
                'cat_description' => 'Steaks description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 6,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 7,
                'cat_name' => 'Traditional Dishes',
                'cat_description' => 'Traditional Dishes description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 7,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 8,
                'cat_name' => 'Curry Sauce',
                'cat_description' => 'Traditional Dishes description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 8,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 9,
                'cat_name' => 'Set menu',
                'cat_description' => 'Set menu description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 9,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 10,
                'cat_name' => 'Soft Drinks',
                'cat_description' => 'Soft Drinks description',
                'cat_image' => 'default_cat_image.png',
                'cat_available_days' => 'sun,mon,tue,wed,thu,fri,sat',
                'cat_available_delivery_method' => 'both',
                'status' => 'enable',
                'sort' => 10,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('categories')->insert($categories);

        // Insert default Items
        $items = [
            [
                'id' => 1,
                'item_name' => 'Onion Bhaji',
                'item_description' => NULL,
                'item_image' => 'default_item_image.png',
                'item_cat_id' => 1,
                'item_new_price' => 2.70,
                'item_old_price' => NULL,
                'item_delivery_type' => 'both',
                'item_variance' => 'no',
                'item_sub_menu' => 'no',
                'item_sp_request_sts' => 'yes',
                'item_offer_include' => 'yes',
                'item_spice_level' => 'medium',
                'cus_int_field' => NULL,
                'cus_text_field' => NULL,
                'cus_tinyInt_field' => NULL,
                'status' => 'enable',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'item_name' => 'Lamb Chops',
                'item_description' => NULL,
                'item_image' => 'default_item_image.png',
                'item_cat_id' => 1,
                'item_new_price' => 5.00,
                'item_old_price' => NULL,
                'item_delivery_type' => 'both',
                'item_variance' => 'no',
                'item_sub_menu' => 'no',
                'item_sp_request_sts' => 'yes',
                'item_offer_include' => 'yes',
                'item_spice_level' => 'medium',
                'cus_int_field' => NULL,
                'cus_text_field' => NULL,
                'cus_tinyInt_field' => NULL,
                'status' => 'enable',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'item_name' => 'Spicy Meatballs',
                'item_description' => NULL,
                'item_image' => 'default_item_image.png',
                'item_cat_id' => 1,
                'item_new_price' => 5.00,
                'item_old_price' => NULL,
                'item_delivery_type' => 'both',
                'item_variance' => 'no',
                'item_sub_menu' => 'no',
                'item_sp_request_sts' => 'yes',
                'item_offer_include' => 'yes',
                'item_spice_level' => 'medium',
                'cus_int_field' => NULL,
                'cus_text_field' => NULL,
                'cus_tinyInt_field' => NULL,
                'status' => 'enable',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 4,
                'item_name' => 'Tikka Chaat',
                'item_description' => NULL,
                'item_image' => 'default_item_image.png',
                'item_cat_id' => 2,
                'item_new_price' => 5.00,
                'item_old_price' => NULL,
                'item_delivery_type' => 'both',
                'item_variance' => 'no',
                'item_sub_menu' => 'no',
                'item_sp_request_sts' => 'yes',
                'item_offer_include' => 'yes',
                'item_spice_level' => 'medium',
                'cus_int_field' => NULL,
                'cus_text_field' => NULL,
                'cus_tinyInt_field' => NULL,
                'status' => 'enable',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 5,
                'item_name' => 'Lamb Stir Fry',
                'item_description' => NULL,
                'item_image' => 'default_item_image.png',
                'item_cat_id' => 1,
                'item_new_price' => 5.00,
                'item_old_price' => NULL,
                'item_delivery_type' => 'both',
                'item_variance' => 'no',
                'item_sub_menu' => 'no',
                'item_sp_request_sts' => 'yes',
                'item_offer_include' => 'yes',
                'item_spice_level' => 'medium',
                'cus_int_field' => NULL,
                'cus_text_field' => NULL,
                'cus_tinyInt_field' => NULL,
                'status' => 'enable',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 6,
                'item_name' => 'Prawn Cocktail',
                'item_description' => NULL,
                'item_image' => 'default_item_image.png',
                'item_cat_id' => 4,
                'item_new_price' => 5.00,
                'item_old_price' => NULL,
                'item_delivery_type' => 'both',
                'item_variance' => 'no',
                'item_sub_menu' => 'no',
                'item_sp_request_sts' => 'yes',
                'item_offer_include' => 'yes',
                'item_spice_level' => 'medium',
                'cus_int_field' => NULL,
                'cus_text_field' => NULL,
                'cus_tinyInt_field' => NULL,
                'status' => 'enable',
                'sort' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('items')->insert($items);


        // Insert default FAQS
        $faqs = [
            [
                'id' => 1,
                'question' => 'Can I pay cash on delivery ?',
                'answer' => 'Yes, you can pay cash on delivery too.',
                'sorting_position' => 1,
                'status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 2,
                'question' => 'I would like to organize a meal for a party, how can I do it ?',
                'answer' => 'Yes, you can book an advance table by Table reservation option.',
                'sorting_position' => 2,
                'status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'id' => 3,
                'question' => 'What if I have a food allergy ?',
                'answer' => 'Special requirements are open for this option. You can write here.',
                'sorting_position' => 3,
                'status' => 'enable',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
        ];
        DB::table('faqs')->insert($faqs);

    }
}
