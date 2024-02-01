<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	// Insert home page default meta title, description and other information
        $homeData = [
            [
                'id' => 1,
                'home_title' => 'Justfood | Home',
                'home_meta_description' => 'Just home, home, food delivery website, online order etc.',
                'home_caption' => 'Taste the Best Food',
                'home_description' => NULL,
                'home_tagline' => 'We are always ready to give you best service.',
                'home_background_image' => 'home_background.png',
                'home_custom_text' => NULL,
                'home_custom_textarea' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('home_page_settings')->insert($homeData);


    	// Insert menu page default meta title, description and other information
        $menuData = [
            [
                'id' => 1,
                'menu_title' => 'Justfood | Menu',
                'menu_meta_description' => 'Justfood , food, menu, food menu, order food, online food etc',
                'menu_custom_text' => NULL,
                'menu_custom_textarea' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('menu_page_settings')->insert($menuData);


    	// Insert contact page default meta title, description and other information
        $contactData = [
            [
                'id' => 1,
                'contact_title' => 'Justfood | Contact',
                'contact_meta_description' => 'Just food, contact form, contact etc.',
                'contact_custom_text' => NULL,
                'contact_custom_textarea' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('contact_page_settings')->insert($contactData);


    	// Insert gallery page default meta title, description and other information
        $galleryData = [
            [
                'id' => 1,
                'gallery_title' => 'Justfood | Gallery',
                'gallery_meta_description' => 'Just food, gallery, galleries, photos.',
                'gallery_custom_text' => NULL,
                'gallery_custom_textarea' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('gallery_page_settings')->insert($galleryData);


    	// Insert privacy page default meta title, description and other information
        $privacyData = [
            [
                'id' => 1,
                'privacy_title' => 'Justfood | Privacy',
                'privacy_meta_description' => 'Justfood  Privacy & policy meta description',
                'privacy_custom_text' => NULL,
                'privacy_custom_textarea' => NULL,
                'privacy_description' => 'Our delivery drivers only carry up to $10 in change. We accept the following forms of payment:
Credit / Charge cards: Visa and Mastercard are accepted.
Debit Cards, such as Delta or Switch are accepted.
Upon submitting your order details, you are making an offer to us to purchase the item(s) you have specified in your order form. We reserve the right to refuse your offer should it be necessary.
In the event of Maaneks needing to issue a refund we will endeavour to credit your account within 7 - 10 working days.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('privacy_page_settings')->insert($privacyData);


    	// Insert terms page default meta title, description and other information
        $termsData = [
            [
                'id' => 1,
                'terms_title' => 'Justfood | Privacy',
                'terms_meta_description' => 'Justfood terms & condition , just food.',
                'terms_custom_text' => NULL,
                'terms_custom_textarea' => NULL,
                'terms_description' => 'Our delivery drivers only carry up to $10 in change. We accept the following forms of payment:
Credit / Charge cards: Visa and Mastercard are accepted.
Debit Cards, such as Delta or Switch are accepted.
Upon submitting your order details, you are making an offer to us to purchase the item(s) you have specified in your order form. We reserve the right to refuse your offer should it be necessary.
In the event of Maaneks needing to issue a refund we will endeavour to credit your account within 7 - 10 working days.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];
        DB::table('terms_page_settings')->insert($termsData);


    }
}
