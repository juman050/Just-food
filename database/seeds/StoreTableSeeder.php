<?php

use Illuminate\Database\Seeder;
use App\StoreSetting;

class StoreTableSeeder extends Seeder
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
                'store_name' => 'JustFood',
                'store_address' => '332 Bethnal Green Road',
                'store_city' => 'Luton',
                'store_state' => '12 nancy Road',
                'store_country' => 'United Kingdom',
                'store_postcode' => 'E2 0AG',
                'store_support_number' => '+88***********',
                'store_support_email' => 'support.justfood@gmail.com',
                'store_fax' => NULL,
                'store_owner_name' => 'John Doe',
                'store_owner_number' => '+88***********',
                'store_owner_email' => 'johndoe@gmail.com',
                'store_map' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d233667.8223924372!2d90.27923775747219!3d23.780887456211758!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1586717608043!5m2!1sen!2sbd',
                'store_active_theme' => 1,
                'store_custom_text_1' => NULL,
                'store_custom_text_2' => NULL,
                'store_extra_tiny' => 0,
                'store_extra_tiny_2' => 1,
                'store_custom_textarea_1' => NULL,
                'store_custom_textarea_2' => NULL,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        StoreSetting::insert($data);
    }
}
