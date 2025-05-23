<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	//insert users
        $user_id = DB::table('users')
			        	->insertGetId([
			        		'name' => 'Tocaan',
			        		'email' => 'tocaan@app.com',
							'mobile' => '50607080',
							'password' => bcrypt('tocaan@123'),
							'avatar' => 'storage/photos/shares/5d7f572487af6.png'
			        	]);

        //insert roles
        $role_id = DB::table('roles')
			        	->insertGetId([
			        		'name' => 'admins',
			        	]);

		DB::table('role_translations')
			->insert([
				'display_name' => 'Admins Role',
				'description'  => 'Admins Role',
				'locale'       => 'en',
				'role_id'      => $role_id
			]);

		DB::table('role_translations')
			->insert([
				'display_name' => 'المدراء',
				'description'  => 'المدراء',
				'locale'       => 'ar',
				'role_id'      => $role_id
			]);
        
        DB::table('role_user')
        	->insert([
        		'user_id' => $user_id,
        		'role_id' => $role_id
        	]);

		//insert settings
		DB::table('settings')
			->insert([
				'key' => 'default_locales',
				'value' => 'ar'
			]);

		DB::table('settings')
			->insert([
				'key' => 'locales',
				'value' => '["en","ar"]'
			]);

		DB::table('settings')
			->insert([
				'key' => 'social',
				'value' => '{"facebook":"#","twitter":"#","instagram":"#","linkedin":"#","youtube":"#","snap":"#"}'
			]);

		DB::table('settings')
			->insert([
				'key' => 'countries',
				'value' => '["AE","BH","SD","KW","SA","US","AD","QA","LB","EG"]'
			]);

		DB::table('settings')
			->insert([
				'key' => 'default_country',
				'value' => 'KW'
			]);

		DB::table('settings')
			->insert([
				'key' => 'currencies',
				'value' => '["USD","BHD","QAR","KWD","SAR","AED","IQD","OMR"]'
			]);

		DB::table('settings')
			->insert([
				'key' => 'default_currency',
				'value' => 'KWD'
			]);

		DB::table('settings')
			->insert([
				'key' => 'default_shipping',
				'value' => '3.000'
			]);

		DB::table('settings')
			->insert([
				'key' => 'privacy_policy',
				'value' => '1'
			]);

		DB::table('settings')
			->insert([
				'key' => 'env',
				'value' => '{"MAIL_DRIVER":"smtp","MAIL_ENCRYPTION":"tls","MAIL_HOST":"smtp.gmail.com","MAIL_PORT":"587","MAIL_FROM_ADDRESS":"a.khalid@tocaan.com","MAIL_FROM_NAME":"Support","MAIL_USERNAME":"a.khalid@tocaan.com","MAIL_PASSWORD":"amr147147"}'
			]);

		DB::table('settings')
			->insert([
				'key' => 'app_name',
				'value' => 'المرشد',
				'locale' => 'ar'
			]);

		DB::table('settings')
			->insert([
				'key' => 'app_name',
				'value' => 'Elmorshed',
				'locale' => 'en'
			]);

		DB::table('settings')
			->insert([
				'key' => 'translate',
				'value' => '{"app_name":"\u0643\u0627\u0631\u0627"}'
			]);

		DB::table('settings')
			->insert([
				'key' => 'other',
				'value' => '{"privacy_policy":"3"}'
			]);

		DB::table('settings')
			->insert([
				'key' => 'logo',
				'value' => 'storage/photos/shares/5d400413e6a26.svg'
			]);

		DB::table('settings')
			->insert([
				'key' => 'favicon',
				'value' => 'storage/photos/shares/5d46b5f63edc3.png'
			]);

		DB::table('settings')
			->insert([
				'key' => 'images',
				'value' => '{"logo":"http:\/\/localhost:8000\/storage\/photos\/shares\/5d400413e6a26.svg","favicon":"http:\/\/localhost:8000\/storage\/photos\/shares\/5d46b5f63edc3.png"}'
			]);

		DB::table('settings')
			->insert([
				'key' => 'gallery',
				'value' => '["http:\/\/kara.test\/storage\/photos\/shares\/5d400413e6a26.svg"]'
			]);

		DB::table('settings')
			->insert([
				'key' => 'force_update',
				'value' => '1'
			]);
    }
}
