<?php

use Illuminate\Database\Seeder;
use App\Genre;
use Faker\Factory as Faker;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	foreach (range(1,10) as $index) {
    		Genre::create(['name' => 'genre'.$index]);
		}
    }
}
