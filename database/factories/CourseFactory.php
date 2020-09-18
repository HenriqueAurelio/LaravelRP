<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Course::class, function (Faker $faker) {
    $name= $faker->unique()->name;
    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'category_id' => $faker->numberBetween($min = 1, $max = 5),
        'video' => 'https://www.youtube.com/watch?v=tg0nW0THqfs',
        'imglink' => "vamos.jpg",
        'description' => $faker->sentence($nbWords = 40 , $variableNbWords = true),
    ];
});
