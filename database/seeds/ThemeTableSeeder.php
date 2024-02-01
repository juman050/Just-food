<?php

use Illuminate\Database\Seeder;
use App\Setting;

class ThemeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'site_title' => 'Just Food',
                'site_description' => 'A food ordering site & quality food  in United Kingdom. We provide our best service for client satisfaction. Enjoy the food with us.',
                'site_small_logo' => 'miniLogo.png',
                'site_main_logo' => 'mainiLogo.png',
                'site_pre_loader' => 'preLoader.gif',
                'site_fabicon' => 'fabIcon.png',
                'site_date_format' => 'j F, Y H:i a',
                'site_timezone' => 'Europe/London',
                'site_currency' => '£',
                'site_language' => 'en',
                'site_android_url' => NULL,
                'site_ios_url' => NULL,
                'site_facebook_link' => 'https://facebook.com',
                'site_twitter_link' => 'https://twitter.com',
                'site_instagram_link' => 'https://instagram.com',
                'site_linkedin_link' => NULL,
                'site_google_plus_link' => NULL,
                'site_pinterest_link' => NULL,
                'site_youtube_link' => NULL,
                'site_copyright' => '@all rights reserved juman',
                'site_status' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        Setting::insert($data);
    }
}
