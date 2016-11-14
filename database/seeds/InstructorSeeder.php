<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Instructor;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,50) as $index)
        {
        	Instructor::create([
        		'name' => $faker->name,
        		'gender' => $faker->randomElement(['male' ,'female']),
        	]);
        }
    }
}
