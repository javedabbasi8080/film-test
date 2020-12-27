<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Film;
use App\Gallery;
use App\Rating;


class FilmsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker::create();
        foreach (range(1,3) as $index) {

    		$film = Film::create([
    			'name' 			=> $faker->name,	
    			'description' 	=> $faker->paragraph,	
    			'release_date' 	=> date("Y-m-d"),	
    			'ticket_price' 	=> $faker->numberBetween(1,100),	
    			'country' 		=> 'USA',
    			'slugs'			=> str_replace(' ', '-', $faker->name)
    		]);

    		$film->genre()->attach([1,2,3]);
    		$film->ratting()->saveMany([
    			 new Rating(['rat_no'  => 3 , 'user_id' => 1])
    		]);

    		Gallery::create([
    			 	'name'  	=> 'user' ,
    			 	'path' 		=> 'uploads/user.png',
    			 	'source_id' => $film->id,
    			 	'type' 		=> 'film'
    			 ]);
    		
		}
    }
}
