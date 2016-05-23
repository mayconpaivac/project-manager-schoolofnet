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

$factory->define(ManagerProject\Entities\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(ManagerProject\Entities\Client::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'cpf_cnpj' => mt_rand(1, 2),
        'responsible' => $faker->name,
        'email' => $faker->safeEmail,
        'address' => $faker->address,
        'neighborhood' => $faker->word,
        'number' => rand(1, 100),
        'complement' => $faker->word,
        'phone_1' => $faker->randomNumber,
        'phone_2' => $faker->randomNumber,
        'city' => $faker->word(2),
        'state' => 'RO',
    ];
});

$factory->define(ManagerProject\Entities\Project::class, function (Faker\Generator $faker) {
    return [
        'owner_id' => rand(1, 10),
        'client_id' => rand(1, 10),
        'title' => $faker->word,
        'progress' => rand(1,100),
        'description' => $faker->sentence,
        'status' => rand(1,3),
        'due_date' => $faker->date('now'),
    ];
});

$factory->define(ManagerProject\Entities\ProjectNote::class, function (Faker\Generator $faker) {
    return [
        'project_id' => rand(1,10),
        'title' => $faker->word,
        'note' => $faker->text,
    ];
});
