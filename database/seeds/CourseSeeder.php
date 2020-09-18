<?php

use Illuminate\Database\Seeder;
use App\Course;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Course::class, 6)->create();
        for($i = 1; $i<=6; $i++)
        {
            $course = Course::where('id',$i)->first();
            $variable = [rand(1,3),rand(4,6)];
            $course->users()->attach($variable);
        }
    }
}
