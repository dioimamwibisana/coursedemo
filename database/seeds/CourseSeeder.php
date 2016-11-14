<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Course;
use App\Instructor;

class CourseSeeder extends Seeder
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
        	Course::create([
        		'name' => $faker->sentence($nbWords = 6, $variableNbWords = true),
        		'description' => $faker->paragraphs(3, true),
        		'instructor_id' => Instructor::all()->random()->id,
        	]);
        }
    }
}
