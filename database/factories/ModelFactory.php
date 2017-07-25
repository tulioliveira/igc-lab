<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Equipment::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->unique()->isbn10,
        'time' => $faker->numberBetween(0, 3),
        'name' => $faker->name,
        'description' => $faker->paragraph(2)
    ];
});

$factory->define(App\Student::class, function (Faker\Generator $faker) {
    return [
    	'enrollment' => $faker->unique()->numerify('##########'),
        'cpf'        => $faker->unique()->numerify('###.###.###-##'),
        'name'       => $faker->name,
        'email'      => $faker->email,
        'course'     => $faker->name,
        'zipcode'    => $faker->unique()->numerify('#####-###'),
        'street'     => $faker->streetName,
        'city'       => $faker->city,
        'state'      => 'MG',
        'number'     => $faker->unique()->numerify('###'),
        'complement' => $faker->catchPhrase,
        'phone'      => $faker->unique()->numerify('(31)99###-####'),
    ];
});

