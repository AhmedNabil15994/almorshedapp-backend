<?php

use App\Modules\Days\Models\Day;
use Illuminate\Database\Seeder;

class DaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {	
        $days = Day::all();

        if (count($days) == 0) {
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Saturday',
	        			'code' => 'S'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Saturday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'السبت',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);

	        //
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Sunday',
	        			'code' => 'U'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Sunday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'الأحد',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);

	        //
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Monday',
	        			'code' => 'M'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Monday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'الأثنين',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);

	        //
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Tuesday',
	        			'code' => 'T'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Tuesday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'الثلاثاء',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);

	        //
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Wednesday',
	        			'code' => 'W'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Wednesday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'الأربعاء',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);

	        //
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Thursday',
	        			'code' => 'R'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Thursday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'الخميس',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);

	        //
        	$day_id = DB::table('days')
	        		->insertGetId([
	        			'day' => 'Friday',
	        			'code' => 'F'
	        		]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'Friday',
	        		'locale' => 'en',
	        		'day_id' => $day_id
	        	]);

	        DB::table('day_translations')
	        	->insert([
	        		'day' => 'الجمعة',
	        		'locale' => 'ar',
	        		'day_id' => $day_id
	        	]);
        }
    }
}
